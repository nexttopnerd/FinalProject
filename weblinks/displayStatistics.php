<?php

include_once '../resources/database.php';
$reviews = $courses[$_GET['title']]->getReviews();
$professors = array();
$difficultyVals = array(0, 0, 0, 0, 0);
$timeVals = array(0, 0, 0, 0, 0);
$enjoymentVals = array(0, 0, 0, 0, 0);
$req = array(0,0,0);
foreach($reviews as $review){
    $req[$review->getPartOfCore()-1]++;
    $professor = $review->getProfessor();
    if(!isset($professors[$professor]))
        $professors[$professor] = array(
            "A" => 0,
            "A-" => 0,
            "B+" => 0,
            "B" => 0,
            "B-" => 0,
            "C+" => 0,
            "C" => 0,
            "C-" => 0,
            "D+" => 0,
            "D" => 0,
            "D-" => 0,
            "F" => 0,
            "CR" => 0,
            "NC" => 0,
            "difficulty" => array(),
            "time" => array(),
            "enjoyment" => array(),
            "approvals" => array(),
            "norm" => 0,
            "avgdiff" => 0,
            "avgtime" => 0,
            "avgenj" => 0,
        );

    $grade = $review->getGrade();
    $professors[$professor][$grade]++;

    $difficulty = $review->getDifficulty();
    $difficultyVals[$difficulty-1]++;
    $professors[$professor]["difficulty"][] = $difficulty;

    $time = $review->getTime();
    $timeVals[$time-1]++;
    $professors[$professor]["time"][] = $time;

    $enjoyment = $review->getEnjoyment();
    $enjoymentVals[$enjoyment-1]++;
    $professors[$professor]["enjoyment"][] = $enjoyment;

    $approval = $review->getApprovals();
    $professors[$professor]["approvals"][] = $approval;
    $professors[$professor]["norm"] += $approval;


}



foreach($professors as &$professor){
    for($x = 0; $x < count($professor["approvals"]); $x++){
        $professor["avgdiff"] += ($professor["difficulty"][$x] * ($professor["approvals"][$x]/$professor["norm"]));
        $professor["avgtime"] += ($professor["time"][$x] * ($professor["approvals"][$x]/$professor["norm"]));
        $professor["avgenj"] += ($professor["enjoyment"][$x] * ($professor["approvals"][$x]/$professor["norm"]));
    }
    unset($professor["difficulty"]);
    unset($professor["time"]);
    unset($professor["enjoyment"]);
    //unset($professor["approvals"]);
    unset($professor["norm"]);
}
unset($professor);
$professorNames = array_keys($professors);
$lastProfessor = end($professorNames);

?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    google.setOnLoadCallback(drawVisualization);
    google.setOnLoadCallback(drawVisualization2);
    google.setOnLoadCallback(drawChart2);
    google.setOnLoadCallback(drawChart3);




    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Grade', 'A', 'A-', 'B+', 'B', 'B-',
                'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F',
                'CR', 'NC', { role: 'annotation' } ],<?
                foreach($professorNames as $professor){
                    $currProfessor = $professors[$professor];
                    $i = 0;
                    ?>
                    ['<? echo $professor?>',<?
                        foreach($currProfessor as $currGrade){
                            echo $currGrade.",";

                            if($i==13)
                                break;
                            $i++;
                        }?>
                        '']<?
                        if($professor!=$lastProfessor)
                            echo ",";

                }?>
            ]);

        var options = {
            width: "100%",
            legend: { position: 'top', maxLines: 3 },
            bar: { groupWidth: '75%' },
            isStacked: true
        };

       var container = document.getElementById('stats2');
       container.className += ' in';

       var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
       google.visualization.events.addListener(chart, 'ready', function() {
           container.className = 'row collapse';
       });
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
            series: {5: {type: "line"}},
            width: "100%"
        };

        var container = document.getElementById('stats4');
        container.className += ' in';

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
        google.visualization.events.addListener(chart, 'ready', function() {
           container.className = 'row collapse';
        });
        chart.draw(data, options);
    }

    function drawVisualization2() {
        // Create and populate the data table.
        var data = google.visualization.arrayToDataTable([
            ['Professor', 'Difficulty', 'Enjoyment',   'Weight'],
            ['Overall',    <? echo $dec1?>,              <? echo $dec3?>,     <?echo count($reviews)?>],
                <?
                foreach($professorNames as $professor){
                    $currProf = $professors[$professor];?>
                    ['<?echo $professor?>', <? echo $currProf["avgdiff"]?>, <?echo $currProf["avgenj"]?>, <?echo count($currProf["approvals"])?>]
                    <?
                    if($professor != $lastProfessor)
                        echo ",";
                }?>
            ]);

        var options = {
            title: 'Correlation between average difficulty and time for each professor',
            hAxis: {title: 'Difficulty', minValue:1, maxValue:5.5},
            vAxis: {title: 'Enjoyment', minValue:1, maxValue:5.5},
            bubble: {textStyle: {fontSize: 11}},
            colorAxis: {colors: ['yellow', 'red']},
            height:400,
            width:"100%"
        };

        var container = document.getElementById('stats3');
        container.className += ' in';
        // Create and draw the visualization.
        var chart = new google.visualization.BubbleChart(
            document.getElementById('chart_div3'));
        google.visualization.events.addListener(chart, 'ready', function() {
            container.className = 'row collapse';
        });
        chart.draw(data, options);
    }

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ['Papers', 'MPs','Exams'],
            <?
            $lastReview = end($reviews);
            foreach($reviews as $review){
                echo "[".$review->getPapers().",".$review->getMps().",".$review->getExams()."]";
                if($review!=$lastReview)
                    echo ",";
            }?>
        ]);

        var options = {
            width: '100%',
            title: 'Class Assignments & Papers & Exams',
            colors: ['#1A8763', '#871B47', '#999999']
        };
        var container = document.getElementById('stats5');
        container.className += ' in';


        var chart = new google.visualization.Histogram(document.getElementById('chart_div4'));
        google.visualization.events.addListener(chart, 'ready', function() {
            container.className = 'row collapse';
        });
        chart.draw(data, options);
    }

    function drawChart3() {
        var data = google.visualization.arrayToDataTable([
            ['Part of:', '%'],
            ['College Core',     <? echo $req[0]?>],
            ['Major Requirement',      <?echo $req[1]?>],
            ['Elective',  <?echo $req[2]?>]
        ]);

        var options = {
            width: '100%',
            height: 400,
            is3D: true
        };

        var container = document.getElementById('stats6');
        container.className += ' in';
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        google.visualization.events.addListener(chart, 'ready', function() {
            container.className = 'row collapse';
        });
        chart.draw(data, options);
    }



    $('.collapse').collapse()

</script>

  <div class="row collapse" id="stats2">
        <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
        echo "Grade Distributions By Professor"; ?></div>
        <div id="chart_div" class="col-sm-offset-2" style=""></div>
  </div>

<div class="row collapse" id="stats3">
    <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
        echo "Difficulty and Enjoyment Matrix by Professor"; ?></div>
    <div id="chart_div3" class="col-sm-offset-2"></div>
</div>

<div class="row collapse" id="stats4">
    <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
        echo "Misc Ratings"; ?></div>
    <div class="col-sm-10">
    <div id="chart_div2"></div>
    </div>
</div>

<div class="row collapse" id="stats5">
    <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
        echo "Exams/MPs/Papers Distribution"; ?></div>
    <div id="chart_div4" class="col-sm-offset-2"></div>
</div>

<div class="row collapse" id="stats6">
    <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
        echo "Part of Core"; ?></div>
    <div id="piechart_3d" class="col-sm-offset-2"></div>
</div>
</div>









