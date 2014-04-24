<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/22/14
 * Time: 9:01 PM
 */
    //displays all the valid meetups
    require '../resources/database.php';

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM meetups";

    foreach($pdo->query($sql) as $row){

        //get current date
        date_default_timezone_set('America/Chicago');
        $today = date('Y-m-d');
        if($today > $row['mtill'])
        {
            //delete expired comments
            $cid = $row['id'];
            $sql_two = "DELETE FROM meetups WHERE id = ?";
            $q = $pdo->prepare($sql_two);
            $q->execute(array($cid));
        }
        else
        {
            //echo all the valid meetups which are still live
            echo '<table><tr><td width="0%"><div class="glyphicon glyphicon-chevron-right"></div></td><td><h4><a href="meetupDetail.php?cntid='.$row['id'].'">'.$row['content'].'</a></h4></td></tr></table>';

            //echo '<h4><a href="meetupDetail.php?cntid='.$row['id'].'">'.$row['content'].'</a></h4>';
        }
    }

    Database::disconnect();
?>