<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/22/14
 * Time: 9:01 PM
 */
//displays all the valid meetups

$uid = $_SESSION["sid"];

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM users,messages WHERE receiver_id = '$uid' AND sender_id = users.user_id ORDER BY messages.timestamp DESC";

$spc = str_repeat('&nbsp;', 2);

$userids = array();
$readids = array();
foreach($pdo->query($sql) as $row){

    if(!in_array($row['sender_id'], $userids)){
        $userids[$row['sender_id']] = $row['sender_id'];
    }

    if($row['readby'] == 0){
        $readids[$row['sender_id']] = 0;
    }
    if(!array_key_exists($row['sender_id'], $readids)){
        $readids[$row['sender_id']] = 1;
    }
}

foreach($pdo->query($sql) as $row){


    if(in_array($row['sender_id'], $userids)){
        echo '<hr>';
        if($readids[$row['sender_id']] != 0)
            echo '<table><tr><td width="0%"><div class="glyphicon glyphicon-check"></div></td><td><h4><a href="messageDetails.php?cntid='.$row['sender_id'].'&rid='.$row['receiver_id'].'">'.$spc.$row['username'].'</a></h4></td></tr></table>';
        else
            echo '<table style="background-color: lightgrey;"><tr><td width="0%"><div class="glyphicon glyphicon-envelope"></div></td><td><h4><a href="messageDetails.php?cntid='.$row['sender_id'].'&rid='.$row['receiver_id'].'">'.$spc.$row['username'].'</a></h4></td></tr></table>';

        unset($userids[$row['sender_id']]);
    }
}

Database::disconnect();
?>