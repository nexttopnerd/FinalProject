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

        include("../datastructures/course.php");
        echo "<h3 class='text-center'>".$_GET['title']."</h3>";
        $courses = $_SESSION['view'];
        $courses = unserialize($courses);
        echo "<font size='4' face='Arial'>";
        echo $courses[$_GET['title']]->getTitle();
        echo "<br>"."<br>";
        echo $courses[$_GET['title']]->getDescription();
        ?>

        <hr>
        <form class="form-horizontal" role="form">
            <h3>Add a Review</h3>
            <hr>
            <div class="form-group">

                <label class="col-sm-2 control-label">
                    Professor name:
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    TA:
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    Semester
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    Expected Grade/Grade:
                </label>
                <div class="col-sm-10">
                    <select class="form-control">
                        <option value="0">Select option...</option>
                        <option value="A">A+/A</option>
                        <option value="B">B+/B/B-</option>
                        <option value="C">C+/C/C-</option>
                        <option value="D">D or below</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    Part of:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="type">College Core
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type">Major Requirement
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="type">Elective</br>
                    </label>
                </div>
            </div>
            <hr>
            <h3>
                <i>Qualitative Reviews</i>
            </h3>

            <div class="form-group">
                <label class="col-sm-2 control-label">
                    Difficulty:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="difficulty" value="option1"> 1
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="difficulty"value="option2"> 2
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="difficulty"value="option3"> 3
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="difficulty"value="option3"> 4
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="difficulty"value="option3"> 5
                    </label>
                </div>

            </div>
            <div class="form-group">
                <label class="col-sm-2">
                    Time Commitment:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="time" value="option1"> 1
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="time"value="option2"> 2
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="time"value="option3"> 3
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="time"value="option3"> 4
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="time"value="option3"> 5
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    Enjoyment:
                </label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="enjoyment" value="option1"> 1
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="enjoyment"value="option2"> 2
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="enjoyment"value="option3"> 3
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="enjoyment"value="option3"> 4
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="enjoyment"value="option3"> 5
                    </label>
                </div>

            </div>
            <hr>
            <h3>
            <i>Exams</i>
            </h3>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    # of exams:
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    Exam type:
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
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
            </div>
            <hr>
            <h3>
            <i>Assignments
             </i>   </h3>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    # of MPs:
                </label>
                <div class="col-sm-10">
                     <input type="number" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">
                    # of Papers:
                </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea class="col-sm-12 form-control" style="height: 100px">Comments Regarding Professor</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea class="col-sm-12 form-control" style="height:100px">Course Content:</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <textarea class="col-sm-12 form-control" style="height:100px">Additional Comments/Tips</textarea>
                </div>
            </div>



        <input type="submit" class="btn btn-primary center-block">
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