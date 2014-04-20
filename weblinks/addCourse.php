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
$course= $_GET["course"];
$course = strip_tags($course, '<p><a>');
$registered = 0;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stid = $_SESSION["sid"];
$sql = "SELECT * FROM enrollment WHERE studentID = '$sid' AND courseID = '$course'";

foreach($pdo->query($sql) as $row){
    $registered = 1;
}

if($registered == 0){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO enrollment (courseID, studentID) values(?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($course, $sid));
}

Database::disconnect();

?>