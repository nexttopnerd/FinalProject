<?php
/**
 * Displays the list of people sorted on the basis of their compatability with the
 * current user. Compatability is determined on the basis on common interests.
 * User: soniamohanlal
 * Date: 4/29/14
 * Time: 6:33 PM
 */

if(isset($_GET['match'])){
    @ob_start();
    session_start();

    require ("../resources/database.php");

    $uid = $_SESSION["sid"];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT username, csinterest, leisure, door, look FROM interests, users WHERE interests.user_id = '$uid' AND
    interests.user_id = users.user_id";

    //getting the current user's name and interests
    $v = null;
    foreach($pdo->query($sql) as $row){
        $v = $row;
    }

    //getting all the other users' names and interests
    $sql = "SELECT username,csinterest, leisure, door, look FROM interests,users WHERE interests.user_id != '$uid' AND
    interests.user_id = users.user_id";

    echo '<h3>Compatability:</h3>';

    $compt = array();
    foreach($pdo->query($sql) as $row){

        $C = array_intersect_assoc($v,$row);
        $compt[$row['username']] = ((count($C)/2)/4)*100;

    }

    //sorting the users on the basis on their compatability with the user
    array_multisort($compt, SORT_DESC);
    foreach($compt as $key => $row){
        echo $key;
        echo " - ";
        echo $row;
        echo "%";
        echo '<br>';
    }

    Database::disconnect();

}

?>