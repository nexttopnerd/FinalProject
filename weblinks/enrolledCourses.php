<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/22/14
 * Time: 6:17 PM
 */
if(isset($_GET["reset"])){
    @ob_start();
    session_start();
}
require ("../resources/database.php");
      //list of courses the user is enrolled in
      $courses = array();
      $pdo = Database::connect();

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stid = $_SESSION["sid"];
      $sql = "SELECT * FROM enrollment WHERE studentID = '$stid'";

      foreach($pdo->query($sql) as $row){
            echo $row['courseID'];
            echo"<br>";
            }

Database::disconnect();
?>