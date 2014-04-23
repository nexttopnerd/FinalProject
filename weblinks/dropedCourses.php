<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/22/14
 * Time: 6:32 PM
 */
if(isset($_GET["reset"])){
    @ob_start();
    session_start();
}

require ("../resources/database.php");

//list of courses the user is enrolled in
$courses = array();
$pdo = Database::connect();

$sid = $_SESSION["sid"];
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM enrollment WHERE studentID = '$sid'";

foreach($pdo->query($sql) as $row){
    $token = $row['courseID'];
    $first_token  = strtok($token, ' ');
    $second_token = strtok(' ');
    echo '<option value='.$second_token.' id="crs">'.$row['courseID'].'</option>';
}

Database::disconnect();
?>