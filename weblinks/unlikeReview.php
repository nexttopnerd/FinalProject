<?php
/**
 * Unmark the review post which the user was already marked useful. The entry specifying
 *the corresponding detail in deleted from the database if the user unmarks the review post
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
$sql = "DELETE FROM reviewjoin WHERE uid = ? AND rid = ?";
$q = $pdo->prepare($sql);
$q->execute(array($sid, $mid));

Database::disconnect();

$mid = $_GET["rev"];
$mid = strip_tags($mid);
header("Location: coursedetails.php?title=$mid");
?>
