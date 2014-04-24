<?php
/**
 * Created by PhpStorm.
 * User: Sonia
 * Date: 4/20/14
 * Time: 2:04 PM
 */
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
                    <li><a href="meetups.php">Meetups</a></li>
                    <li><a href="connect.php">Connect</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">
        <h4 class="text-center"><? echo $_GET["name"] ?></h4>
        <hr>
        <h3>Reviews</h3>
        <hr>

        <?php

            include_once('../resources/database.php');

            $pdo = Database::connect();

            $count = 0;
            $avgdiff = 0;
            $avgtime = 0;
            $avgenj = 0;

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM reviews WHERE professor = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($_GET['name']));
            while($row = $q->fetch()){
                echo '<dl class="dl-horizontal">';
                echo '<dt>'.$row['user'].'</dt>';
                echo '<dd>'.$row['professorcomments'].'</dd>';
                echo '</dl>';

                $avgdiff = $avgdiff+ $row['difficulty'];
                $avgtime = $avgtime + $row['time'];
                $avgenj = $avgenj + $row['enjoyment'];
                $count = $count+1;;
            }
            Database::disconnect();

        if($count != 0){
        $avgdiff = ($avgdiff/$count) % 10;
        $avgtime = ($avgtime/$count) % 10;
        $avgenj = ($avgenj/$count) % 10;
        }

        ?>
        <hr>
        <div class="row">
            <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
                echo "Summary"; ?></div>
            <div class="col-sm-10">
                <table class="table text-center">

                    <tr>
                        <th class="col-sm-3 text-center">Average Difficulty</th>
                        <th class="col-sm-3 text-center">Average Time</th>
                        <th class="col-sm-3 text-center">Average Enjoyment</th>
                    </tr>
                    <tr>
                        <td>
                            <?
                            for ($i = 0; $i < $avgdiff; $i++)
                                echo '<i class="glyphicon glyphicon-star" style="color:orange"></i>';
                            for ($i = 0; $i < (5-$avgdiff); $i++)
                                echo '<i class="glyphicon glyphicon-star-empty" style="color:orange"></i>';
                            ?>
                        </td>
                        <td>
                            <?
                            for ($i = 0; $i < $avgtime; $i++)
                                echo '<i class="glyphicon glyphicon-star" style="color:blue"></i>';
                            for ($i = 0; $i < (5-$avgtime); $i++)
                                echo '<i class="glyphicon glyphicon-star-empty" style="color:blue"></i>';
                            ?>
                        </td>
                        <td>
                            <?
                            for ($i = 0; $i < $avgenj; $i++)
                                echo '<i class="glyphicon glyphicon-star" style="color:red"></i>';
                            for ($i = 0; $i < (5-$avgenj); $i++)
                                echo '<i class="glyphicon glyphicon-star-empty" style="color:red"></i>';

                            ?>
                        </td>
                    </tr>


                </table>

            </div>
        </div>

    </div>
    </body>
</html>


