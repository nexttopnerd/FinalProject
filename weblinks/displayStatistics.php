<?php
session_start();
error_reporting(E_ALL);

include_once '../resources/database.php';
$reviews = $courses[$_GET['title']]->getReviews();
$numA = 0;
$numB = 0;
$numC = 0;
$numD = 0;
$difficultyVals = array(0, 0, 0, 0, 0);
$timeVals = array(0, 0, 0, 0, 0);
$enjoymentVals = array(0, 0, 0, 0, 0);
foreach($reviews as $review){
    $grade = $review->getGrade();
    switch($grade):
        case 'A':
            $numA++;
            break;
        case 'B':
            $numB++;
            break;
        case 'C':
            $numC++;
            break;
        case 'D':
            $numD++;
            break;
    endswitch;

    $difficulty = $review->getDifficulty();
    switch($difficulty):
        case 1:
            $difficultyVals[0]++;
            break;
        case 2:
            $difficultyVals[1]++;
            break;
        case 3:
            $difficultyVals[2]++;
            break;
        case 4:
            $difficultyVals[3]++;
            break;
        case 5:
            $difficultyVals[4]++;
            break;
    endswitch;

    $time = $review->getTime();
    switch($time):
        case 1:
            $timeVals[0]++;
            break;
        case 2:
            $timeVals[1]++;
            break;
        case 3:
            $timeVals[2]++;
            break;
        case 4:
            $timeVals[3]++;
            break;
        case 5:
            $timeVals[4]++;
            break;
    endswitch;

    $enjoyment = $review->getEnjoyment();
    switch($enjoyment):
        case 1:
            $enjoymentVals[0]++;
            break;
        case 2:
            $enjoymentVals[1]++;
            break;
        case 3:
            $enjoymentVals[2]++;
            break;
        case 4:
            $enjoymentVals[3]++;
            break;
        case 5:
            $enjoymentVals[4]++;
            break;
    endswitch;

}




?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    google.setOnLoadCallback(drawVisualization);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Grade', 'Number of Students', {role: 'style'}],
            ['A', <?php echo $numA?>, 'color:gray'],
            ['B',  <?php echo $numB?>, 'color: #76A7FA'],
            ['C', <?php echo $numC?>, 'color: #703593'],
            ['D or below',  <?php echo $numD?>, 'color: #871B47']
        ]);

        var options = {
            vAxis: {title: 'Grade',  titleTextStyle: {color: 'red'}},
            hAxis: {title: 'Number of Students', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }


   function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Type', 'Very Easy', 'Easy', 'Medium', 'Hard', 'Very Hard'],
            ['Difficulty',  <?echo $difficultyVals[0]?>, <?echo $difficultyVals[1]?>, <?echo $difficultyVals[2]?>,  <?echo $difficultyVals[3]?>,  <?echo $difficultyVals[4]?>],
            ['Time',  <?echo $timeVals[0]?>,      <?echo $timeVals[1]?>,         <?echo $timeVals[2]?>,            <?echo $timeVals[3]?>,           <?echo $timeVals[4]?>],
            ['Enjoyment',  <?echo $enjoymentVals[0]?>,      <?echo $enjoymentVals[1]?>,         <?echo $enjoymentVals[2]?>,            <?echo $enjoymentVals[3]?>,           <?echo $enjoymentVals[4]?>]
        ]);

        var options = {
            vAxis: {title: "Number of Respondents"},
            hAxis: {title: "Quantitative Ratings"},
            seriesType: "bars",
            series: {5: {type: "line"}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }
</script>
<? echo $dec1;
var_dump($dec1);?>

<h3 class="text-center">Grade Distributions</h3>
<div id="chart_div">
</div>
<h3 class="text-center">Quantitative Reviews</h3>
<div id="chart_div2"></div>





