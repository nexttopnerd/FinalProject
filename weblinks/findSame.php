<?php
/**
 * Finds all the students who are taking the same courses as the user
 * User: soniamohanlal
 * Date: 4/19/14
 * Time: 2:11 PM
 */
require ("../resources/database.php");

$courses = array();
$pdo = Database::connect();

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stid = $_SESSION["sid"];
$sql = "SELECT * FROM enrollment WHERE studentID = '$stid'";

foreach($pdo->query($sql) as $row){
    $cid = $row['courseID'];
    $sql_two = "SELECT * FROM enrollment WHERE studentID != '$stid' AND courseID = '$cid'";


    //echo '<table><tr><td width="15%"><div class="glyphicon glyphicon-user"></div></td><td><p>Students taking '.$cid.'<p></td></tr></table>';

    echo "Students taking ".$cid;
    echo "<br>";
    echo "&nbsp"."&nbsp"."&nbsp";
    foreach($pdo->query($sql_two) as $row_two){
        $sname = $row_two['studentID'];
        $sql_three = "SELECT * FROM users WHERE user_id = '$sname'";

        foreach($pdo->query($sql_three) as $row_three){
            echo '<b>'.$row_three['username'].'</b>';
            echo ", ";
        }

    }
    echo "<br><br>";
}

Database::disconnect();
?>