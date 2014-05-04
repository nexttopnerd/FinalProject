<?php
@ob_start();
ob_start();
ob_start();
session_start();

if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

error_reporting(E_ALL);

include_once ("reviewprocessing.php");
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
        <link href="http://getbootstrap.com/assets/css/docs.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../css/jumbotron.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#div2" ).fadeOut("fast");
                $("#div3" ).fadeOut("fast");
            });

            $(document).ready(function(){
                $("#b1").click(function(){
                    $("#div2" ).fadeOut("fast");
                    $("#div3" ).fadeOut("fast");
                    $("#div1").fadeToggle("slow");
                });
            });

            $(document).ready(function(){
                $("#b2").click(function(){
                    $("#div1" ).fadeOut("fast");
                    $("#div3" ).fadeOut("fast");
                    $("#div2").fadeToggle("slow");
                });
            });

            $(document).ready(function(){
                $("#b3").click(function(){
                    $("#div1" ).fadeOut("fast");
                    $("#div2" ).fadeOut("fast");
                    $("#div3").fadeToggle("slow");
                });
            });
        </script>

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
                    <li class="active"><a href="courses.php">Courses</a></li>
                    <li><a href="meetups.php">Meetups</a>
                    <li><a href="connect.php">Connect</a></li>
                    <li><a href="compareClasses.php">Compare</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="glyphicon glyphicon-comment" style="font-size:20px;" href="messages.php"></a></li>

                    <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

        <?php

        include_once("../datastructures/course.php");

        $courses = $_SESSION['view'];
        $courses = unserialize($courses);?>
        <div class="row"><?

        echo "<h3><span class='text-primary center-block text-center'>".$_GET['title'].": "."<small>".$courses[$_GET['title']]->getTitle()."</small></span>";?>
        <span class="pull-right center-block text-center">
            ##test##
            <small class="center-block text-center">##num## Ratings</small>
            <div class="text-primary text-center" style="font-size: 60px;">##grade##</div>
            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal" id = "tutors">Find Tutors</button>
        </span></h3>
        <?
        echo "<font size='4' face='Arial'>";
        echo '<dl class="dl-horizontal">';
        echo "<dt>Credit</dt>";
        echo "<dd>";
        echo $courses[$_GET['title']]->getCredit();
        echo "</dd>";
        echo "<dt>Description</dt>";
        echo "<dd>";
        echo $courses[$_GET['title']]->getDescription();
        echo "</dd>";
        echo "<dt>Semesters Offered</dt>";
        $courses[$_GET['title']]->setSemesters();
        echo "<dd>";
        $sems = $courses[$_GET['title']]->getSemesters();
        $lastSem = end($sems);
        foreach($sems as $semester){
            echo $semester;
            if($semester!=$lastSem)
                echo ",\n";
        }
        echo "</dd>";
        echo "</dl>";
        echo "</div>";
     //   echo "<dt>Tutors</dt>";?>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">List of Awesome Tutors</h4>
                    </div>
                    <div class="modal-body">
                        <?
                        require '../resources/database.php';

                        $cid = $_GET['title'];
                        $sid = $_SESSION['sid'];

                        $tok = strtok($cid, " ");
                        $cid = strtok(" ");

                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT * FROM users, interests WHERE users.user_id = interests.user_id AND tutorone = '$cid' OR users.user_id = interests.user_id AND tutortwo = '$cid'";

                        foreach($pdo->query($sql) as $row){

                            echo $row['username'];
                            echo "<br>";
                        }

                        Database::disconnect();?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>




        <hr>
        <table style="width: 100%;">
            <tr>
                <td align="left" width="30%"><button type="button" class="btn btn-default" id = "b1">Reviews</button></td>
                <td align="center" width="40%"><button type="button" class="btn btn-default" id = "b2">Get Stats</button></td>
                <td align="right" width="30%"><button type="button" class="btn btn-default" id = "b3">Submit a review</button></td>
            </tr>
        </table>

        <hr>
        <div id="div1">
            <? include_once('displayreviews.php'); ?>


        </div>

        <div id="div2">
            <?php require('getCourseStats.php') ?>
        </div>

        <div id = "div3">
            <?
            if ($userfound==false)
                include_once('submitreview.php');
            else{
                echo '<h4>You have already submitted a review!!!</h4>';
            }?>
        </div>

        <footer>
            <p>&copy; Company 2014</p>
        </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="http://twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-collapse.js"></script>
    <script src="../js/bootstrap.js"></script>
    </body>
    </html>