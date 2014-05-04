<?
/**
 * Takes an array of the review objects and returns a sorted array
 * and the sorting is done on one of the attributes of the reviews object
 *
 * @param $val, attribute of the reviews to sort on the basis of
 * @param $arr, array of the review objects which needs to be sorted
 * @return array, the final sorted array
 */
function getSorted($val, $arr){

    $sorted = array();

    while(count($arr) != 0) {
        $min = findSmallest($val, $arr);
        array_push($sorted, $arr[$min]);
        unset($arr[$min]);
    }

    return $sorted;
}

/**
 * Finds the review object with smallest value of the attribute, on the basis
 * of which the review objects are being sorted
 *
 * @param $val, attribute of the reviews to sort on the basis of
 * @param $arr, array of the review objects which needs to be sorted
 * @return int|string, index of the review object with smallest attribute value
 */
function findSmallest($val, $arr)
{
    $size = count($arr);
    $idx = array_keys($arr)[0];
    $min = $arr[$idx];

    foreach ($arr as $key => $value) {
        if( compare($val, $min, $value) != $min){
             $min = $value;
             $idx = $key;
        }
    }

    return $idx;
}

/**
 * Comparator function which compares the review objects on the basis of one
 * of the attribute values.
 *
 * @param $val, attribute of the reviews to sort on the basis of
 * @param $rev_one, review object one
 * @param $rev_two, review object two
 * @return mixed, the review object with smallest attribute value
 */
function compare($val, $rev_one, $rev_two){

    //sorting on the basis of the difficulty of the review object
    if($val == 1){
        if($rev_one->getDifficulty() < $rev_two->getDifficulty())
            return $rev_one;
        else
            return $rev_two;
    }
    //sorting on the basis of the enjoyment of the review object
    else if($val == 2){
            if($rev_one->getEnjoyment() < $rev_two->getEnjoyment())
                return $rev_one;
            else
                return $rev_two;
    }
    //sorting on the basis of the time commitment of the review object
    else if($val == 3){
            if($rev_one->getTime() < $rev_two->getTime())
                return $rev_one;
            else
                return $rev_two;
    }
    //sorting on the basis of the professor of the review object
    else if($val == 4){
            if($rev_one->getProfessor() < $rev_two->getProfessor())
                return $rev_one;
            else
                return $rev_two;
    }
    else
        return $rev_two;
}
$tid = $_GET['title'];
$courses[$_GET['title']]->setReviews();
$reviews = $courses[$_GET['title']]->getReviews();
echo str_replace("##num##", count($reviews), ob_get_clean());
?>

        <script>
            function myFunction(val)
            {
                var ur = document.URL;
                window.location.href = ur+"&sort="+val;
            }
        </script>


        <table  style="width: 100%;">
            <tr>
                <td align="left">
                    <label>Sort by: </label>
                    <select id="sel_id" name="sel_name"  onchange="myFunction(this.value);">
                        <option value="-1">Select</option>
                        <option value="1">Difficulty </option>
                        <option value="2">Enjoyment </option>
                        <option value="3">Time commitment </option>
                        <option value="4">Professor </option>
                    </select>
                </td>
                <td align="right">
                </td>
            </tr>
        </table>

<? $arr = array();
foreach ($reviews as $review){

    array_push($arr, $review);
    }

    $sortIdx = -1;
    if(isset($_GET['sort'])){
        $sortIdx = $_GET['sort'];
        $arr = getSorted($sortIdx, $arr);
    }

    ?>

    <? for($x = 0; $x < count($arr); $x++){
        ?>

    <hr>
    <div class="row" id="myDiv">
        <div class="col-sm-2"><i class="glyphicon glyphicon-user"></i> <?
            if ($arr[$x]->getUser()==$_SESSION["username"])
                $userfound = true;
            echo $arr[$x]->getUser() ?></div>
        <div class="col-sm-10">
            <table class="table text-center">
                <tr>
                    <th class="col-sm-3 text-center">Semester</th>
                    <th class="col-sm-3 text-center">Professor</th>
                    <th class="col-sm-3 text-center">TA</th>
                </tr>
                <tr>
                    <td><? echo $arr[$x]->getSemester(); ?></td>
                    <td><a href="professordetails.php?name=<? echo $arr[$x]->getProfessor(); ?>"><? echo $arr[$x]->getProfessor(); ?></a> </td>
                    <td><? echo $arr[$x]->getTA(); ?></td>
                </tr>
                <tr>
                    <th class="col-sm-3 text-center">Difficulty</th>
                    <th class="col-sm-3 text-center">Time</th>
                    <th class="col-sm-3 text-center">Enjoyment</th>
                </tr>
                <tr>
                    <td>
                        <?
                        for ($i = 0; $i < $arr[$x]->getDifficulty(); $i++)
                            echo '<i class="glyphicon glyphicon-star" style="color:orange"></i>';
                        for ($i = 0; $i < (5-$arr[$x]->getDifficulty()); $i++)
                            echo '<i class="glyphicon glyphicon-star-empty" style="color:orange"></i>';
                        ?>
                    </td>
                    <td>
                        <?
                        for ($i = 0; $i < $arr[$x]->getTime(); $i++)
                            echo '<i class="glyphicon glyphicon-star" style="color:blue"></i>';
                        for ($i = 0; $i < (5-$arr[$x]->getTime()); $i++)
                            echo '<i class="glyphicon glyphicon-star-empty" style="color:blue"></i>';
                        ?>
                    </td>
                    <td>
                        <?
                        for ($i = 0; $i < $arr[$x]->getEnjoyment(); $i++)
                            echo '<i class="glyphicon glyphicon-star" style="color:red"></i>';
                        for ($i = 0; $i < (5-$arr[$x]->getEnjoyment()); $i++)
                            echo '<i class="glyphicon glyphicon-star-empty" style="color:red"></i>';

                        ?>
                    </td>
                </tr>
                <tr>
                    <th class="col-sm-3 text-center">Exams</th>
                    <th class="col-sm-3 text-center">MPS</th>
                    <th class="col-sm-3 text-center">Papers</th>
                </tr>
                <tr>
                    <td><? echo $arr[$x]->getExams() ?></td>
                    <td><? echo $arr[$x]->getMps() ?></td>
                    <td><? echo $arr[$x]->getPapers() ?></td>
                </tr>

            </table>
            <dl class="dl-horizontal">
                <dt>Prof comments:</dt>
                <dd><? echo $arr[$x]->getCommentsOnProfessor() ?></dd>


                <dt>User comments:</dt>
                <dd><? echo $arr[$x]->getCommentsOnCourse() ?></dd>


                <dt>Tips:</dt>
                <dd><? echo $arr[$x]->getTips() ?></dd>

                <dt>Part Of:</dt>
                <dd> <?
                    if($arr[$x]->getPartOfCore()==1):
                        echo "College Core";
                    elseif($arr[$x]->getPartOfCore()==2):
                        echo "Major Requirement";
                    else:
                        echo "Elective";
                    endif;?>
                </dd>

            </dl>
                    <span class="pull-right col-sm-offset-1">
                        <?php
                        //tells how many people found the review useful
                        $cntid = $arr[$x]->getId();
                        $pdo = Database::connect();
                        $cid = $_SESSION["sid"];
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT COUNT(*) FROM reviewjoin WHERE rid = '$cntid'";

                        foreach($pdo->query($sql) as $row){
                            echo '<h4><font color="blue">'.$row[0].' approvals</font><h4>';
                        }
                        ?>



                        <?
                        if ($arr[$x]->getUser()==$_SESSION["username"])
                            echo '<a class="btn btn-danger" href="deletereview.php?id='.$arr[$x]->getId().'">Delete</a>';
                        else{?>

                            <!-- Start here-->
                            <?php
                            //displays the like or unlike button next to every post depending whether the current
                            //user has already liked the post or not
                            $joined = 0;
                            $cntid = $arr[$x]->getId();
                            $pdo = Database::connect();
                            $cid = $_SESSION["sid"];
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM reviewjoin WHERE uid = '$cid' AND rid = '$cntid'";

                            foreach($pdo->query($sql) as $row){
                            $joined = 1;
                            }

                            Database::disconnect();
                            $rev = $_GET['title'];
                            if ($joined == 0){
                            echo '<p><a class="btn btn-default" href="likeReview.php?mid='.$cntid.'&rev='.$rev.'"><i class="glyphicon "></i> Useful?</a></p>';
                            }
                            else{
                            echo '<p><a class="btn btn-default" href="unlikeReview.php?mid='.$cntid.'&rev='.$rev.'" style="background-color: gold"><i class="glyphicon glyphicon-thumbs-up"></i> Useful</a></p>';
                            }
                            ?>
                            <!-- End here-->

                        <? }
                        ?>
                    </span>
        </div>
    </div>
    <hr>
<?
}

