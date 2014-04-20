<?php
@ob_start();
session_start();
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/17/14
 * Time: 2:44 PM
 */
require ("../resources/database.php");

$pdo = Database::connect();

$name = $_SESSION["username"];
$content= $_GET["content"];
$mwhen =  $_GET["mwhen"];
$mwhere =  $_GET["mwhere"];
$content = strip_tags($content, '<p><a>');
$mwhen = strip_tags($mwhen, '<p><a>');
$mwhere = strip_tags($mwhere, '<p><a>');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO meetups (user, content, mwhen, mwhere) values(?, ?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($name, $content, $mwhen, $mwhere));

Database::disconnect();

?>