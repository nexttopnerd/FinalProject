<?php
/**
 * Join the meetup. The php file adds the row to the table containing the
 * details of the user and the meetup he/she wants to join
 * User: soniamohanlal
 * Date: 4/19/14
 * Time: 4:47 PM
 */
@ob_start();
session_start();
require ("../resources/database.php");
$pdo = Database::connect();

$sid = $_SESSION["sid"];
$mid = $_GET["mid"];

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO meetupjoin (uid, mid) values(?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($sid, $mid));

Database::disconnect();

$mid = $_GET["mid"];
$mid = strip_tags($mid);
header("Location: meetupDetail.php?cntid=$mid");
?>
