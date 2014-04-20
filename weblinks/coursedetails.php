<?php
@ob_start();
session_start();

/*if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

echo ini_get('display_errors');*/

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
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>Port Illinois</title>

        <!-- Bootstrap core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/jumbotron.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


        <![endif]-->
    </head>

    <body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">About us</a></li>
                    <li class="active"><a href="courses.php">Courses</a></li>
                    <li><a href="meetups.php">Meetups</a>
                    <li><a href="connect.php">Connect</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

        <?php

        include_once("../datastructures/course.php");

        echo "<h3 class='text-center'>".$_GET['title']."</h3>";
        $courses = $_SESSION['view'];
        $courses = unserialize($courses);
        echo "<font size='4' face='Arial'>";
         echo '<dl class="dl-horizontal">';

        echo "<dt>Title</dt>";
        echo "<dd>".$courses[$_GET['title']]->getTitle()."</dd>";
        echo "<dt>Credit</dt>";
        echo "<dd>";
        echo $courses[$_GET['title']]->getCredit();
        echo "</dd>";
        echo "<dt>Description</dt>";
        echo "<dd>";
        echo $courses[$_GET['title']]->getDescription();
        echo "</dd>";
        echo "</dl>";
        ?>

        <hr>
        Reviews
        <hr>

        <?
        $courses[$_GET['title']]->setReviews();
        $reviews = $courses[$_GET['title']]->getReviews();
        foreach ($reviews as $review){?>
            <div class="row">
                <div class="col-sm-2"><i class="glyphicon glyphicon-user"></i> <?
                    if ($review->getUser()==$_SESSION["username"])
                        $userfound = true;
                    echo $review->getUser() ?></div>
                <div class="col-sm-10">
                <table class="table text-center">
                    <tr>
                        <th class="col-sm-3 text-center">Semester</th>
                        <th class="col-sm-3 text-center">Professor</th>
                        <th class="col-sm-3 text-center">TA</th>
                    </tr>
                    <tr>
                        <td><? echo $review->getSemester(); ?></td>
                        <td><a href="professordetails.php?name=<? echo $review->getProfessor(); ?>"><? echo $review->getProfessor(); ?></a> </td>
                        <td><? echo $review->getTA(); ?></td>
                    </tr>
                    <tr>
                        <th class="col-sm-3 text-center">Difficulty</th>
                        <th class="col-sm-3 text-center">Time</th>
                        <th class="col-sm-3 text-center">Enjoyment</th>
                    </tr>
                    <tr>
                        <td>
                            <?
                                for ($i = 0; $i < $review->getDifficulty(); $i++)
                                    echo '<i class="glyphicon glyphicon-star" style="color:orange"></i>';
                                for ($i = 0; $i < (5-$review->getDifficulty()); $i++)
                                    echo '<i class="glyphicon glyphicon-star-empty" style="color:orange"></i>';
                            ?>
                        </td>
                        <td>
                            <?
                            for ($i = 0; $i < $review->getTime(); $i++)
                                echo '<i class="glyphicon glyphicon-star" style="color:blue"></i>';
                            for ($i = 0; $i < (5-$review->getTime()); $i++)
                                echo '<i class="glyphicon glyphicon-star-empty" style="color:blue"></i>';
                            ?>
                        </td>
                        <td>
                            <?
                            for ($i = 0; $i < $review->getEnjoyment(); $i++)
                                echo '<i class="glyphicon glyphicon-star" style="color:red"></i>';
                            for ($i = 0; $i < (5-$review->getEnjoyment()); $i++)
                                echo '<i class="glyphicon glyphicon-star-empty" style="color:red"></i>';

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-sm-3 text-center">Exams</th>
                        <th class="col-sm-3 text-center">MPS</th>
                        <th class="col-sm-3 text-center">Papers</th>
                    </tr>
                    <tr>
                        <td><? echo $review->getExams() ?></td>
                        <td><? echo $review->getMps() ?></td>
                        <td><? echo $review->getPapers() ?></td>
                    </tr>

                </table>
                    <dl class="dl-horizontal">
                        <dt>Prof comments:</dt>
                        <dd><? echo $review->getCommentsOnProfessor() ?></dd>


                        <dt>User comments:</dt>
                        <dd><? echo $review->getCommentsOnCourse() ?></dd>


                        <dt>Tips:</dt>
                        <dd><? echo $review->getTips() ?></dd>

                            <dt>Part Of:</dt>
                            <dd> <?
                                if($review->getPartOfCore()==1):
                                    echo "College Core";
                                elseif($review->getPartOfCore()==2):
                                    echo "Major Requirement";
                                else:
                                    echo "Elective";
                                endif;?>
                            </dd>

                    </dl>
                    <span class="pull-right col-sm-offset-1">
                        <?
                        if ($review->getUser()==$_SESSION["username"])
                           echo '<a class="btn btn-danger" href="deletereview.php?id='.$review->getId().'">Delete</a>';
                        else{?>
                            <a class="btn btn-default"><i class="glyphicon glyphicon-thumbs-up"></i> Useful</a>

                        <? }
                        ?>
                    </span>
                </div>
            </div>
            <hr>
        <?
        }?>




        <?
        if ($userfound==false){?>
        <form class="form-horizontal" role="form" action="coursedetails.php?title=<? echo $_GET['title']?>" method="post">

        <h4>Add a Review</h4>
            <hr>

            <div class="form-group <?echo $professorDiv?> ">

                <label class="col-sm-2 control-label" for = "professor">
                    Professor name:
                </label>
                <div class="col-sm-10">
                    <input type="text" name="professor" id = "professor" class="form-control" value="<? echo $professor ?>">
                    <? echo $professorIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $professorMessage?>
                </div>
            </div>
            <div class="form-group <?echo $taDiv?> ">
                <label class="col-sm-2 control-label" for="ta">
                    TA:
                </label>
                <div class="col-sm-10">
                    <input type="text" name = "ta" id = "ta" class="form-control" value="<? echo $ta?>">
                    <? echo $taIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $taMessage?>
                </div>
            </div>
            <div class="form-group <?echo $semesterDiv?> ">
                <label class="col-sm-2 control-label" for="semester">
                    Semester
                </label>
                <div class="col-sm-10">
                    <?
                        $courses[$_GET['title']]->setSemesters();
                    ?>
                    <select class="form-control" name="semester" id="semester">
                        <option value="0">Select option...</option>
                        <?
                        $semesters = $courses[$_GET['title']]->getSemesters();
                        foreach ($semesters as $semester){
                            ?>
                            <option value="<? echo $semester?>"> <? echo $semester ?></option> <?
                        }
                        ?>
                    </select>
                    <? echo $semesterIcon; ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $semesterMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $gradeDiv?>">
                <label class="col-sm-2 control-label" for ="grade">
                    Expected Grade/Grade:
                </label>
                <div class="col-sm-10">
                    <select class="form-control" name="grade" id="grade">
                        <option value="0">Select option...</option>
                        <option value="A">A+/A</option>
                        <option value="B">B+/B/B-</option>
                        <option value="C">C+/C/C-</option>
                        <option value="D">D or below</option>
                    </select>
                    <? echo $gradeIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $gradeMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $typeDiv?>">
                <label class="col-sm-2 control-label">
                    Part of:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="type" value="1">College Core
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type" value="2">Major Requirement
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type" value="3">Elective</br>
                    </label>
                    <? echo $typeIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $typeMessage ?>
                </div>
            </div>
            <hr>
            <h4>
                <i><b>Qualitative Reviews</b></i>
            </h4>

            <div class="form-group <?echo $difficultyDiv?> ">
                <label class="col-sm-2 control-label">
                    Difficulty:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" for="difficulty1">
                        <input type="radio" name="difficulty" id="difficulty1" value="1"> 1
                    </label>
                    <label class="radio-inline" for="difficulty2">
                        <input type="radio" name="difficulty" id="difficulty2" value="2"> 2
                    </label>
                    <label class="radio-inline" for="difficulty3">
                        <input type="radio" name="difficulty" id="difficulty3" value="3"> 3
                    </label>
                    <label class="radio-inline" for="difficulty4">
                        <input type="radio" name="difficulty" id="difficulty4" value="4"> 4
                    </label>
                    <label class="radio-inline" for="difficulty5">
                        <input type="radio" name="difficulty" id="difficulty5" value="5"> 5
                    </label>
                    <? echo $difficultyIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $difficultyMessage ?>
                </div>

            </div>

            <div class="form-group <?echo $timeDiv?> ">
                <label class="col-sm-2 control-label">
                    Time Commitment:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" for="time1">
                        <input type="radio" name="time" id="time1" value="1"> 1
                    </label>
                    <label class="radio-inline" for="time2">
                        <input type="radio" name="time" id="time2" value="2"> 2
                    </label>
                    <label class="radio-inline" for="time3">
                        <input type="radio" name="time" id="time3" value="3"> 3
                    </label>
                    <label class="radio-inline" for="time4">
                        <input type="radio" name="time" id="time4" value="4"> 4
                    </label>
                    <label class="radio-inline" for="time5">
                        <input type="radio" name="time" id="time5" value="5"> 5
                    </label>
                    <? echo $timeIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $timeMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $enjoymentDiv?> ">
                <label class="col-sm-2 control-label">
                    Enjoyment:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline" for="enjoyment1">
                        <input type="radio" name="enjoyment" id="enjoyment1" value="1"> 1
                    </label>
                    <label class="radio-inline" for="enjoyment2">
                        <input type="radio" name="enjoyment" id="enjoyment2" value="2"> 2
                    </label>
                    <label class="radio-inline" for="enjoyment3">
                        <input type="radio" name="enjoyment" id="enjoyment3" value="3"> 3
                    </label>
                    <label class="radio-inline" for="enjoyment4">
                        <input type="radio" name="enjoyment" id="enjoyment4" value="4"> 4
                    </label>
                    <label class="radio-inline" for="enjoyment5">
                        <input type="radio" name="enjoyment" id="enjoyment5" value="5"> 5
                    </label>
                    <? echo $enjoymentIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $enjoymentMessage ?>
                </div>
    
            </div>
           
            <hr>
            <h4>
            <i><b>Exams</b></i>
            </h3>
            <div class="form-group <?echo $examsDiv?>">
                <label class="col-sm-2 control-label" for="exams">
                    # of exams:
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="exams" name="exams" value="<? echo $exams ?>">
                    <? echo $examsIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $examsMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $examDiv?>">
                <label class="col-sm-2 control-label" for="exam">
                    Exam type:
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="exam" name="exam" value="<? echo $exam ?>">
                    <? echo $examIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $examMessage ?>
                </div>
            </div>
           <!-- <div class="form-group">
                <label class="col-sm-2 control-label">
                    Final Exam?
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="final"> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="final"> No
                    </label>
                </div>
            </div> -->
            <hr>
            <h4>
            <i><b>Assignments
             </i></b></h4>
            <div class="form-group <?echo $mpsDiv?>">
                <label class="col-sm-2 control-label" for="mps">
                    # of MPs:
                </label>
                <div class="col-sm-10">
                     <input type="number" class="form-control" name="mps" id="mps" value="<? echo $mps ?>">
                    <? echo $mpsIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $mpsMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $papersDiv?>">
                <label class="col-sm-2 control-label" for="papers">
                    # of Papers:
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="papers" id="papers" value="<? echo $papers ?>">
                    <? echo $papersIcon ?>
                </div>
                <div class="col-sm-10 col-sm-offset-2 text-danger">
                    <? echo $papersMessage ?>
                </div>
            </div>
            <hr>
            <div class="form-group <?echo $pComDiv?>">
                <div class="col-sm-12">
                    <textarea class="col-sm-12 form-control" rows="3" placeholder="Comments Regarding Professor" name="pCom"><? echo $pCom?></textarea>
                    <? echo $pComIcon ?>
                </div>
                <div class="col-sm-12 text-danger">
                    <? echo $pComMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $cComDiv?>">
                <div class="col-sm-12">
                    <textarea class="col-sm-12 form-control" rows="3" placeholder="Comments Regarding Course Content" name="cCom"><? echo $cCom?></textarea>
                    <? echo $cComIcon ?>
                </div>
                <div class="col-sm-12 text-danger">
                    <? echo $cComMessage ?>
                </div>
            </div>
            <div class="form-group <?echo $tipsDiv?>">
                <div class="col-sm-12">
                    <textarea class="col-sm-12 form-control" rows="3" placeholder="Additional Comments/Tips" name="tips"><? echo $tips?></textarea>
                    <? echo $tipsIcon ?>
                </div>
                <div class="col-sm-12 text-danger">
                    <? echo $tipsMessage ?>
                </div>
            </div>



        <input type="submit" name="submit" class="btn btn-primary center-block">
        </form><?}?>
        <hr>

        <footer>
            <p>&copy; Company 2014</p>
        </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    </body>
    </html>