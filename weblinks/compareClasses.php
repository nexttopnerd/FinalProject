<?php
@ob_start();
session_start();
include_once('../datastructures/course.php');
include_once('../datastructures/review.php');

if (!ini_get('display_errors')) {
    ini_set('display_errors', '0');
}

$classes = array();
$diffAvgs = $timeAvgs = $enjAvgs = array();


$courses = $_SESSION['view'];
$courses = unserialize($courses);
if(isset($_POST["submit"])):
foreach($_POST['class'] as $value)
{
    $classes[] = $courses[$value];
    $courses[$value]->setReviews();
    $weights = [];
    $avgdiff = $avgtime = $avgenj = 0;
    $idx = 0;
    $norm = 0;
    $reviews = $courses[$value]->getReviews();
    foreach ($reviews as $review){
        $cntid = $review->getId();
        include_once('../resources/database.php');
        $pdo = Database::connect();
        $cid = $_SESSION["sid"];
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT COUNT(*) FROM reviewjoin WHERE rid = '$cntid'";

        //creating the weight vector to normalize the final rating results
        foreach($pdo->query($sql) as $row){
            $weights[$idx] = $row[0];
            $norm = $norm + $weights[$idx];
            $idx = $idx+1;
        }
    }

    $idx = 0;
    //getting the normalized ratings
    foreach ($reviews as $review){

        $avgdiff = $avgdiff+ ($review->getDifficulty() * ($weights[$idx]/$norm));
        $avgtime = $avgtime + ($review->getTime() * ($weights[$idx]/$norm));
        $avgenj = $avgenj + ($review->getEnjoyment() * ($weights[$idx]/$norm));
        $idx = $idx+1;
    }

    $diffAvgs[] = $avgdiff;
    $timeAvgs[] = $avgtime;
    $enjAvgs[] = $avgenj;


}
endif;




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

    <?
    if(isset($_POST["submit"])){

            ?>
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>

        <script type='text/javascript'>
        google.load('visualization', '1', {packages:['table']});
        google.setOnLoadCallback(drawTable);
        function drawTable() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Code');
            data.addColumn('number','average difficulty' );
            data.addColumn('number','average time');
            data.addColumn('number', 'average enjoyment');

            data.addRows([
                <? for($i=0; $i<count($classes); $i++):
                    if($i!=(count($classes)-1)):?>
                        ['<? echo $classes[$i]->getTitle()?>', '<? echo $classes[$i]->getCode()?>',
                        <? echo $diffAvgs[$i]?>, <? echo $timeAvgs[$i]?>, <? echo $enjAvgs[$i]?>],
                    <? else:?>
                        ['<? echo $classes[$i]->getTitle()?>', '<? echo $classes[$i]->getCode()?>',
                            <? echo $diffAvgs[$i]?>, <? echo $timeAvgs[$i]?>, <? echo $enjAvgs[$i]?>]
                    <?
                    endif;
                   endfor;?>
             ]);


            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(data, {showRowNumber: true});
        }
    </script><?
    }
    ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <![endif]-->

    <script type='text/javascript' src='https://www.google.com/jsapi'></script>

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
                <li><a href="courses.php">Courses</a></li>
                <li><a href="meetups.php">Meetups</a></li>
                <li><a href="connect.php">Connect</a></li>
                <li class="active"><a href="compareClasses.php">Compare</a></li>


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <br>
    <form class="form-horizontal" role="form" action="compareClasses.php" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="class">
                Class
            </label>
            <div class="col-sm-10">
                <select multiple class="form-control" name="class[]" id="class">
                    <option value="0">Select option...</option>
                    <?

                    foreach ($courses as $course){
                        ?>
                        <option value="<? echo $course->getCode() ?>"> <? echo $course->getCode() ?></option> <?
                    }
                    ?>
                </select>
            </div>
        </div>
        <h4 class="text-center"><small>You have to select atleast 2 options, but not more than 5</small></h4>
        <input type="submit" name="submit" class="btn btn-primary center-block">
    </form>


</div>
<div id="table_div"></div>


</body>
</html>