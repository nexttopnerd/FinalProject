<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/29/14
 * Time: 6:33 PM
 */

if(isset($_GET['intr'])){
    @ob_start();
    session_start();

    require ("../resources/database.php");
    require ("../datastructures/tutor.php");

    $uid = $_SESSION["sid"];
    $intr = $_GET['intr'];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //declaring local variables to be used
    $classes = array();
    $cmnIntr = "null";
    $idArray = array();

    //checking if the user is finding people with same interests or looking for tutors
    //
    //if the user is looking for tutors, first find all the courses the user is enrolled in
    // and store them in an array
    if(strcmp($intr, "tutors") == 0){
        echo '<h3>Tutors for the courses you are taking:</h3>';
        $sql_one = "SELECT courseID FROM enrollment WHERE studentID = '$uid'";

        foreach($pdo->query($sql_one) as $row){
            array_push($classes, $row['courseID']);
        }
    }

    //else determine which common interest the user is interested in
    else{
        $val = "null";
        if(strcmp($intr, 'csinterest') == 0)
            $val = "have same CS interest";
        else if(strcmp($intr, 'leisure') == 0)
            $val = "like same leisure activity";
        else if(strcmp($intr, 'door') == 0)
            $val = "have same preference between indoors and outdoors";
        else if(strcmp($intr, 'look') == 0)
            $val = "are looking for same groups";

        echo '<h3>People who '.$val.' as you:</h3>';
        $sql_one = "SELECT * FROM interests WHERE user_id = '$uid'";
        foreach($pdo->query($sql_one) as $row){
            $cmnIntr = $row[$intr];
        }
    }

    //search the interests table to get the id of all those users who share the same
    //interests as the current user or tutor for one of the courses the current user is enrolled in
    $sql = "SELECT * FROM interests WHERE user_id != '$uid'";

    foreach($pdo->query($sql) as $row){

        //printing the users who tutor for one of the courses the current user is enrolled in
        if(strcmp($intr, "tutors") == 0){

            if($row['tutorone'] != -1){
                $name = "CS ".$row['tutorone'];

                if(in_array($name, $classes)){
                    $tutor = new Tutor($row['user_id'], $name);
                    array_push($idArray, $tutor);
                }

            }

            if($row['tutortwo'] != -1){
                $name = "CS ".$row['tutortwo'];

                if(in_array($name, $classes)){
                    $tutor = new Tutor($row['user_id'], $name);
                    array_push($idArray, $tutor);
                }

            }
        }

        //store the user ids who share the same interests as the current user
        else{
            if($cmnIntr == $row[$intr])
                array_push($idArray, $row['user_id']);
        }
    }

    //print the name of the users sharing the same interests as the current user
    if(strcmp($intr, "tutors") != 0){
        $sql = "SELECT * FROM users WHERE user_id != '$uid'";

        $checker = 0;
        foreach($pdo->query($sql) as $row){
            if(in_array($row['user_id'], $idArray)){
                echo $row['username'];

                $checker = $checker + 1;
                if($checker != count($idArray))
                    echo ", ";
            }
        }

        Database::disconnect();
    }

    else{
        $courses = array();
        $pdo = Database::connect();

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stid = $_SESSION["sid"];
        $sql = "SELECT * FROM enrollment WHERE studentID = '$stid'";

        foreach($pdo->query($sql) as $row){
            $cid = $row['courseID'];

            echo "Tutors for ".$cid.":";
            echo "<br>";
            echo "&nbsp"."&nbsp"."&nbsp";

            $sql = "SELECT * FROM users WHERE user_id != '$stid'";

            foreach($pdo->query($sql) as $row){
                $checker = 0;
                foreach($idArray as $tt){
                    if($tt->getId() == $row['user_id'] && $tt->getCourse() == $cid){
                        echo $row['username'];

                        $checker = $checker + 1;
                        if($checker != count($idArray))
                            echo ", ";
                    }
                }
            }


            echo "<br><br>";
        }

        Database::disconnect();
    }

}

?>