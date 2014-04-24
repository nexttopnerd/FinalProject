<?
/*Computing the normalized rating for each course */
$reviews = $courses[$_GET['title']]->getReviews();

//setting up the variables to compute the normalized rating for each class
$count = 0;
$avgdiff = 0;
$avgtime = 0;
$avgenj = 0;
$weights =[];
$idx = 0;
$norm = 0;

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
        $norm = $norm + $weights[$idx];
        $idx = $idx+1;
    }
}
$idx = 0;
$dec1 = 0;
$dec2 = 0;
$dec3 = 0;
//getting the normalized ratings
foreach ($reviews as $review){

    $avgdiff = $avgdiff+ ($review->getDifficulty() * ($weights[$idx]/$norm));
    $avgtime = $avgtime + ($review->getTime() * ($weights[$idx]/$norm));
    $avgenj = $avgenj + ($review->getEnjoyment() * ($weights[$idx]/$norm));
    $count = $count +1;
    $idx = $idx+1;
}

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


?>
    <div class="row">
        <div class="col-sm-2"><i class="glyphicon glyphicon-align-justify"></i> <?
            echo "Stats"; ?></div>
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
