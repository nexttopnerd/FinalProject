<?php
@ob_start();
session_start();
/**
 * Insert the messages into database
 * User: anirud
 * Date: 4/17/14
 * Time: 2:44 PM
 */
require ("../resources/database.php");

$pdo = Database::connect();

$sid = $_SESSION["sid"];
$content= $_GET["content"];
$rid =  $_GET["receiver"];
$subject =  $_GET["subject"];
$readby = 0;

$content = strip_tags($content, '<p><a>');
$mwhen = strip_tags($receiver, '<p><a>');
$mwhere = strip_tags($subject, '<p><a>');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO messages (sender_id, receiver_id, content, subject, readby) values(?, ?, ?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($sid, $rid, $content, $subject, $readby));

Database::disconnect();

header("Location: messages.php");

?>