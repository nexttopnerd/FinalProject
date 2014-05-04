<?php
/**
 * Created by PhpStorm.
 * User: Sonia
 * Date: 4/20/14
 * Time: 2:04 PM
 */
session_start();
$professor = null;
include_once('../resources/database.php');
$pdo = Database::connect();

$count = 0;
$avgdiff = 0;
$avgtime = 0;
$avgenj = 0;
$req = array(0, 0, 0, 0, 0);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM reviews WHERE professor = ?";
$q = $pdo->prepare($sql);
$q->execute(array($_GET['name']));
$professor = $q->fetchAll();
Database::disconnect();

foreach($professor as $row){
    switch($row['grade']):
        case "A":
        case "A-":
        case "A+":
            $req[0]++;
            break;
        case "B":
        case "B-":
        case "B+":
            $req[1]++;
            break;
        case "C":
        case "C-":
        case "C+":
            $req[2]++;
            break;
        case "D":
        case "D-":
        case "D+":
            $req[3]++;
            break;
        default:
            $req[4]++;
            break;
    endswitch;
    $avgdiff = $avgdiff+ $row['difficulty'];
    $avgtime = $avgtime + $row['time'];
    $avgenj = $avgenj + $row['enjoyment'];
    $count = $count+1;;
}

if($count != 0){
    $avgdiff = ($avgdiff/$count) % 10;
    $avgtime = ($avgtime/$count) % 10;
    $avgenj = ($avgenj/$count) % 10;
}

$totalQuality = ($avgdiff + $avgtime + $avgenj)/3;

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
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">


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

        <script type='text/javascript' src='https://www.google.com/jsapi'></script>
        <script type='text/javascript'>
            google.load('visualization', '1', {packages:['table']});
            google.setOnLoadCallback(drawTable);
            google.load("visualization", "1", {packages:["corechart"]});
            google.setOnLoadCallback(drawChart3);
            function drawTable() {
                var data = new google.visualization.DataTable();
                var options = {'allowHtml': true};
                data.addColumn('string', 'Date');
                data.addColumn('string', 'Class');
                data.addColumn('number', 'Rating');
                data.addColumn('string', 'Comment');
                data.addRows([
                    <?
                    for($i=0; $i<count($professor); $i++):
                        $overallRating1 = ($professor[$i]['difficulty']+$professor[$i]['time']+$professor[$i]['enjoyment'])/3;
                        $overallRating = str_repeat('<i class="glyphicon glyphicon-star" style="color:goldenrod; font-size: 15px;"></i>',round($overallRating1));
                        $overallRating = $overallRating.str_repeat('<i class="glyphicon glyphicon-star-empty" style="color:goldenrod; font-size: 15px;"></i>', round(5-$overallRating1));
                        $difficulty = str_repeat('<i class="glyphicon glyphicon-warning-sign" style="color:darkgray"></i>',$professor[$i]['difficulty']);
                        $difficulty = $difficulty.str_repeat('<i class="glyphicon glyphicon-warning-sign" style="color:white"></i>', 5-$professor[$i]['difficulty']);
                        $time = str_repeat('<i class="glyphicon glyphicon-time" style="color:darkgray"></i>',$professor[$i]['time']);
                        $time = $time.str_repeat('<i class="glyphicon glyphicon-time" style="color:white"></i>', 5-$professor[$i]['time']);
                        $enjoyment = str_repeat('<i class="glyphicon glyphicon-thumbs-up" style="color:darkgray"></i>',$professor[$i]['enjoyment']);
                        $enjoyment = $enjoyment.str_repeat('<i class="glyphicon glyphicon-thumbs-up" style="color:white"></i>', 5-$professor[$i]['enjoyment']);?>

                        ['<? echo date('m/d/y', strtotime($professor[$i]['timestamp'])) ?>',
                         '<? echo $professor[$i]['code']?>', {v: <?echo $overallRating1?>, f:
                         '<dl class="dl-horizontal"><dt>Overall: </dt><dd><? echo $overallRating?></dd><hr><dt><small>Difficulty: </small></dt><dd><? echo $difficulty?></dd><hr><dt><small>Time: </small></dt><dd><?echo $time?></dd><hr><dt><small>Enjoyment: </small></dt><dd><?echo $enjoyment?></dd><hr><</dl>'},
                         '<? echo $professor[$i]['professorcomments']?>']
                         <? if($i!=(count($professor)-1)):
                            echo ",";
                         ?>
                       <?
                       endif;
                    endfor;?>
                ]);


                var table = new google.visualization.Table(document.getElementById('table_div'));
                table.draw(data,options);
            }

            function drawChart3() {
                var data = google.visualization.arrayToDataTable([
                    ['Grade:', 'percentage'],
                    ['A',     <? echo $req[0]?>],
                    ['B',      <?echo $req[1]?>],
                    ['C',       <?echo $req[2]?>],
                    ['D',       <?echo $req[3]?>],
                    ['F or below', <?echo $req[4]?>]
                ]);

                var options = {
                    width: '100%',
                    height: 400,
                    is3D: true
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

                chart.draw(data, options);
            }
        </script>
        <style>
            .google-visualization-table-td, .google-visualization-table-th{
                border: 0;
                text-align: center;
            }

            .ratings td{
                border-bottom: 1px solid grey;
            }
            .hrowclass, .trowclass, .otrowclass, .strowclass, .hcellclass, .tcellclass
                {
                background-color: transparent;
                border: 1px solid #c8c8c8;
            }

        </style>
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
                    <li><a href="meetups.php">Meetups</a></li>
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
        <div class="row">
        <br><br>
        <div class="center-block text-center">
        <i class="glyphicon glyphicon-user" style="font-size: 75px"></i>
        <h4><? echo $_GET["name"] ?><br>
            <small style="font-size: 14px"><? echo $count." ratings"; ?></small><br>
            <? echo str_repeat('<i class="glyphicon glyphicon-star" style="color:goldenrod; font-size: 25px;"></i>',round($totalQuality));
            echo  str_repeat('<i class="glyphicon glyphicon-star-empty" style="color:goldenrod; font-size: 25px;"></i>',5-round($totalQuality)); ?></h4>
        </div>





        </div>
        <hr>
        <h3>Reviews</h3>
        <hr>

        <div class="row">
        <div id="table_div"></div>
        </div>

        <hr>
        <h3>Statistics</h3>
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
        <div class="row">
            <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
                echo "Grade Distribution"; ?></div>
            <div class="col-sm-10">
                <div id="piechart_3d"></div>
            </div>
        </div>
      </div>
    </body>
</html>


