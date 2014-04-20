<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/19/14
 * Time: 4:47 PM
 */
@ob_start();
session_start();
require ("../resources/database.php");
$pdo = Database::connect();

$sid = $_SESSION["sid"];
$course = $_GET["course"];
echo $sid;
echo "<br>";
echo $course;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "DELETE FROM enrollment WHERE courseID = ? AND studentID = ?";
$q = $pdo->prepare($sql);
$q->execute(array($course, $sid));

Database::disconnect();
//header("Location: dropCourse.php")
?>
