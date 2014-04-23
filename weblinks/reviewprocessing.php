<?php
/**
 * Created by PhpStorm.
 * User: Sonia
 * Date: 4/20/14
 * Time: 3:11 PM
 */
include_once ("../resources/validations.php");
$professor = $professorDiv = $professorIcon = $professorMessage = "";
$ta = $taDiv = $taIcon = $taMessage = "";
$semester = $semesterDiv = $semesterIcon = $semesterMessage = "";
$grade = $gradeDiv = $gradeIcon = $gradeMessage = "";
$type = $typeDiv = $typeIcon = $typeMessage = "";
$difficulty = $difficultyDiv = $difficultyIcon = $difficultyMessage = "";
$time = $timeDiv = $timeIcon = $timeMessage = "";
$enjoyment = $enjoymentDiv = $enjoymentIcon = $enjoymentMessage = "";
$exams = $examsDiv = $examsIcon = $examsMessage = "";
$exam = $examDiv = $examIcon = $examMessage = "";
$mps = $mpsDiv = $mpsIcon = $mpsMessage = "";
$papers = $papersDiv = $papersIcon = $papersMessage = "";
$pCom = $pComDiv = $pComIcon = $pComMessage = "";
$cCom = $cComDiv = $cComIcon = $cComMessage = "";
$tips = $tipsDiv = $tipsIcon = $tipsMessage = "";
$error = false;
$userfound = false;

$_SESSION["class"] = $_GET["title"];

if (isset($_POST["submit"])){
    $professor = $_POST["professor"];
    checkTextInput($professor, $professorDiv, $professorIcon, $professorMessage);
    $ta = $_POST["ta"];
    checkTextInput($ta, $taDiv, $taIcon, $taMessage);
    $semester = $_POST["semester"];
    checkSelectInput($semester, $semesterDiv, $semesterIcon, $semesterMessage);
    $grade = $_POST["grade"];
    checkSelectInput($grade, $gradeDiv, $gradeIcon, $gradeMessage);
    checkRadioInput("type", $typeDiv, $typeIcon, $typeMessage);
    $type = $_POST["type"];
    checkRadioInput("difficulty", $difficultyDiv, $difficultyIcon, $difficultyMessage);
    $difficulty = $_POST["difficulty"];
    checkRadioInput("time", $timeDiv, $timeIcon, $timeMessage);
    $time = $_POST["time"];
    checkRadioInput("enjoyment", $enjoymentDiv, $enjoymentIcon, $enjoymentMessage);
    $enjoyment = $_POST["enjoyment"];
    $exams = $_POST["exams"];
    checkNumericalInput($exams, $examsDiv, $examsIcon, $examsMessage);
    $exam = $_POST["exam"];
    checkTextInput($exam, $examDiv, $examIcon, $examMessage);
    $mps = $_POST["mps"];
    checkNumericalInput($mps, $mpsDiv, $mpsIcon, $mpsMessage);
    $papers = $_POST["papers"];
    checkNumericalInput($papers, $papersDiv, $papersIcon, $papersMessage);
    $pCom = $_POST["pCom"];
    checkAreaInput($pCom, $pComDiv, $pComIcon, $pComMessage);
    $cCom = $_POST["cCom"];
    checkAreaInput($cCom, $cComDiv, $cComIcon, $cComMessage);
    $tips = $_POST["tips"];
    checkAreaInput($tips, $tipsDiv, $tipsIcon, $tipsMessage);

    if(!$error){
        include_once("../resources/database.php");
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO reviews (code, professor, ta,  user, semester, grade,
                difficulty, enjoyment, time, exams, examstype, mps, papers, professorcomments, coursecomments, tips, type) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $code = $_GET["title"];
        $user = $_SESSION["username"];
        $q->execute(array($code, $professor, $ta, $user, $semester, $grade,
            $difficulty, $enjoyment, $time, exams, $exam, $mps, $papers, $pCom, $cCom, $tips,
            $type
        ));
    }




}
