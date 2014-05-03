<?php
@ob_start();
session_start();

/*if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}

echo ini_get('display_errors');*/

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
        echo "<dt>Tutors</dt>";
        echo "<dd>";
        require '../resources/database.php';

        $cid = $_GET['title'];
        $sid = $_SESSION['sid'];

        $tok = strtok($cid, " ");
        $cid = strtok(" ");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users, interests WHERE users.user_id = '$sid' AND tutorone = '$cid' OR users.user_id = '$sid' AND tutortwo = '$cid'";

        foreach($pdo->query($sql) as $row){

            echo $row['username'];
            echo ", ";
        }

        Database::disconnect();
        echo "</dd>";
        echo "</dl>";
        ?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    </body>
    </html>