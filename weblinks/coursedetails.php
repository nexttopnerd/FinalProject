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

        <? include_once('displayreviews.php'); ?>




        <?
        if ($userfound==false)
            include_once('submitreview.php');?>
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