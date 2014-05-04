<?
/*Computing the normalized rating for each course */
function getAverageGrade($grade){
   if($grade==4.0)
       return "A";
   if($grade>=3.67)
       return "A-";
   if($grade>=3.33)
       return "B+";
   if($grade>=3.00)
       return "B";
   if($grade>=2.67)
       return "B-";
   if($grade>=2.33)
       return "C+";
   if($grade>=2.00)
       return "C";
   if($grade>=1.67)
       return "C-";
   if($grade>=1.33)
       return "D+";
   if($grade>=1.00)
       return "D";
   if($grade>=0.67)
       return "D-";
   else
       return "F";
}

$reviews = $courses[$_GET['title']]->getReviews();

//setting up the variables to compute the normalized rating for each class
$count = 0;
$avgdiff = 0;
$avgtime = 0;
$avgenj = 0;
$weights =[];
$idx = 0;
$norm = 0;

$avggrade = 0;
$gradeMap = array(
    "A" => 4.00,
    "A-" => 3.67,
    "B+" => 3.33,
    "B" => 3.00,
    "B-" => 2.67,
    "C+" => 2.33,
    "C" => 2.00,
    "C-" => 1.67,
    "D+" => 1.33,
    "D" => 1.00,
    "D-" => 0.67,
    "F" => 0.00
);
$normGrade = 0;

//iterating through all the reviews related to the current class
foreach ($reviews as $review){

    $cntid = $review->getId();
    $pdo = Database::connect();
    $cid = $_SESSION["sid"];
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT COUNT(*) FROM reviewjoin WHERE rid = '$cntid'";

    //creating the weight vector to normalize the final rating results
    foreach($pdo->query($sql) as $row){
        $weights[$idx] = $row[0];
        $review->setApprovals($weights[$idx]);
        $norm = $norm + $weights[$idx];
        $idx = $idx+1;
    }
}
$idx = 0;
$dec1 = 0;
$dec2 = 0;
$dec3 = 0;
$dec4 = 0;
//getting the normalized ratings
foreach ($reviews as $review){
    $avgdiff = $avgdiff+ ($review->getDifficulty() * ($weights[$idx]/$norm));
    $avgtime = $avgtime + ($review->getTime() * ($weights[$idx]/$norm));
    $avgenj = $avgenj + ($review->getEnjoyment() * ($weights[$idx]/$norm));
    if ($review->getGrade()!="NC" && $review->getGrade()!="CR")
        $normGrade = $weights[$idx];
    $count = $count +1;
    $idx = $idx+1;
}

//computing average grade
$idx = 0;
foreach ($reviews as $review){
   $grade = $review->getGrade();
   if($grade=="NC" || $grade=="CR")
       continue;
   $gradeNum = $gradeMap[$grade];
   $avggrade += $gradeNum * ($weights[$idx]/$norm);
   $idx++;
}
$avggrade = getAverageGrade($avggrade);
echo str_replace("##grade##", $avggrade, ob_get_clean());
//computing the values to fill the rating stars, iff the rating is greater than
// x.6 then it is set to x+1 else x
if($count != 0){
    $dec1 = $avgdiff;
    $dec2 = $avgtime;
    $dec3 = $avgenj;

    if($avgdiff - ($avgdiff % 10) > 0.6)
        $avgdiff = (($avgdiff) % 10)+1;
    else
        $avgdiff = (($avgdiff) % 10);

    if($avgtime - ($avgtime % 10) > 0.6)
        $avgtime = (($avgtime) % 10)+1;
    else
        $avgtime = (($avgtime) % 10);

    if($avgenj - ($avgenj % 10) > 0.6)
        $avgenj = (($avgenj) % 10)+1;
    else
        $avgenj = (($avgenj) % 10);
}
$totalQuality = ($avgdiff+$avgtime+$avgenj)/3;
$total = str_repeat('<i class="glyphicon glyphicon-star" style="color:goldenrod; font-size:20px"></i>', round($totalQuality));
$total .= str_repeat('<i class="glyphicon glyphicon-star-empty" style="color:goldenrod; font-size:20px"></i>', 5-round($totalQuality));
//echo ob_get_clean();
echo str_replace("##test##", $total, ob_get_clean());


?>
    <script>
        /*$(document).ready(function(){
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
        });*/
       /* $(document).on('click', "#btn1", function(){
            $("#stats1").toggle();
        }*/

        $('.collapse').collapse()

    </script>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group btn-group-justified">
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="collapse"
                            data-parent="#stats" data-target="#stats1" >Average Statistics</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="collapse"
                            data-parent="#stats" data-target="#stats2">Grade distributions by professors</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="collapse"
                            data-parent="#stats" data-target="#stats3">Difficulty/Quality Matrix</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="collapse"
                            data-parent="#stats" data-target="#stats4">Quantitative Ratings</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="collapse"
                            data-parent="#stats" data-target="#stats5">Exams/Assignments</button>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default" data-toggle="collapse"
                            data-parent="#stats" data-target="#stats6">Requirement Stats</button>
                </div>
            </div>
         </div>
    <br>
    <div id="stats">
        <div class="row collapse in" id="stats1">
            <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
                echo "Average Stats";
                ?></div>
            <div class="col-sm-10">
                <table class="table text-center">

                    <tr>
                        <th class="col-sm-3 text-center">Average Difficulty - <? echo $dec1; echo "/5";?></th>
                        <th class="col-sm-3 text-center">Average Time - <? echo $dec2; echo "/5";?></th>
                        <th class="col-sm-3 text-center">Average Enjoyment - <? echo $dec3; echo "/5";?></th>
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
<?include_once('displayStatistics.php');?>