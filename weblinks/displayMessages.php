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
$sql = "SELECT * FROM messages WHERE receiver_id = '$uid'";

$spc = str_repeat('&nbsp;', 2);

foreach($pdo->query($sql) as $row){

    echo '<hr>';
    if($row['readby'] != 0)
        echo '<table><tr><td width="0%"><div class="glyphicon glyphicon-check"></div></td><td><h4><a href="messageDetails.php?cntid='.$row['id'].'">'.$spc.$row['subject'].'</a></h4></td></tr></table>';
    else
        echo '<table style="background-color: lightgrey;"><tr><td width="0%"><div class="glyphicon glyphicon-envelope"></div></td><td><h4><a href="messageDetails.php?cntid='.$row['id'].'">'.$spc.$row['subject'].'</a></h4></td></tr></table>';

}

Database::disconnect();
?>