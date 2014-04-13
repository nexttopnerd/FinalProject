<?php
@ob_start();
session_start();
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
                <a class="navbar-brand" href="#"><?php echo $_GET['title']; ?></a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <?php

        include("../datastructures/course.php");

        echo "<br>"."<br>";
        $courses = $_SESSION['view'];
        $courses = unserialize($courses);
        echo "<font size='4' face='Arial'>";
        echo $courses[$_GET['title']]->getTitle();
        echo "<br>"."<br>";
        echo $courses[$_GET['title']]->getDescription();
        ?>

        <hr>
        <form>
            <h3>Add a Review</h3>
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    Professor name:
                </div>
                <div class="col-xs-4">
                    <input type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    TA:
                </div>
                <div class="col-xs-4">
                    <input type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Semester
                </div>
                <div class="col-xs-4">
                    <input type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Expected Grade/Grade:
                </div>
                <div class="col-xs-4">
                    <select class="col-xs-5">
                        <option value="0">Select option...</option>
                        <option value="A">A+/A</option>
                        <option value="B">B+/B/B-</option>
                        <option value="C">C+/C/C-</option>
                        <option value="D">D or below</option>
                    </select>
                </div>
            </div>
            <hr>
            Qualitative Reviews
            <div class="row">
                <div class="col-xs-4">
                    Difficulty:
                </div>
                <div class="col-xs-4">
                    <input type="radio" name="difficulty" value="1">1
                    <input type="radio" name="difficulty" value="2">2
                    <input type="radio" name="difficulty" value="3">3
                    <input type="radio" name="difficulty" value="4">4
                    <input type="radio" name="difficulty" value="5">5
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Time Commitment:
                </div>
                <div class="col-xs-4">
                    <input type="radio" name="time" value="1">1
                    <input type="radio" name="time" value="2">2
                    <input type="radio" name="time" value="3">3
                    <input type="radio" name="time" value="4">4
                    <input type="radio" name="time" value="5">5
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Enjoyment:
                </div>
                <div class="col-xs-4">
                    <input type="radio" name="enjoyment" value="1">1
                    <input type="radio" name="enjoyment" value="2">2
                    <input type="radio" name="enjoyment" value="3">3
                    <input type="radio" name="enjoyment" value="4">4
                    <input type="radio" name="enjoyment" value="5">5
                </div>
            </div>
            <hr>
            Exams
            <div class="row">
                <div class="col-xs-4">
                    # of exams:
                </div>
                <div class="col-xs-4">
                    <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Exam type:
                </div>
                <div class="col-xs-4">
                    <input type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Final Exam?
                </div>
                <div class="col-xs-4">
                    <input type="radio" name="final"> Yes
                    <input type="radio" name="final"> No<hr>
                </div>
            </div>
            Assignments
            <div class="row">
                <div class="col-xs-4">
                    # of MPs:
                </div>
                <div class="col-xs-4">
                     <input type="number">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    # of Papers:
                </div>
                <div class="col-xs-4">
                    <input type="number">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-8">
                    <textarea style="width: 547px; height: 80px;">Comments Regarding Professor:</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <textarea style="width: 547px; height: 80px;">Course Content:</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <textarea style="width: 547px; height: 80px;">Additional Comments/Tips</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    Part of:
                </div>
                <div class="col-xs-4">
                    <input type="radio" name="type">College Core
                    <input type="radio" name="type">Major Requirement
                    <input type="radio" name="type">Elective
                </div>
            </div>



        </form>
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