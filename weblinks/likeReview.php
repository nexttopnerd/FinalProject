<?php
/**
 * Mark the review post useful. If the the user clicks on the useful button
 * corresponding to any post then it is stored in the database.
 * User: anirud
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
$sql = "INSERT INTO reviewjoin (uid, rid) values(?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($sid, $mid));

Database::disconnect();

$mid = $_GET["rev"];
$mid = strip_tags($mid);
header("Location: coursedetails.php?title=$mid");
?>
