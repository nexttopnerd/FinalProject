<?php
@ob_start();
session_start();
/**
 * Enables the user to register/add courses and stores it in the database.
 * User: soniamohanlal
 * Date: 4/17/14
 * Time: 2:44 PM
 */
require ("../resources/database.php");

$pdo = Database::connect();

$sid = $_SESSION["sid"];
$int= $_GET["interest"];
$tone= $_GET["tone"];
$ttwo= $_GET["ttwo"];
$leis= $_GET["leis"];
$dor= $_GET["dor"];
$lok= $_GET["lok"];

$registered = 0;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stid = $_SESSION["sid"];
$sql = "SELECT * FROM interests WHERE user_id = '$sid'";

foreach($pdo->query($sql) as $row){
    $registered = 1;
}

if($registered != 0){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM interets WHERE user_id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($sid));
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO interests (user_id, csinterest, tutorone, tutortwo, leisure, door, look) values(?,?,?,?,?,?,?)";
$q = $pdo->prepare($sql);
$q->execute(array($sid, $int, $tone, $ttwo, $leis, $dor, $lok));

Database::disconnect();

?>