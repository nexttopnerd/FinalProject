<?
$courses[$_GET['title']]->setReviews();
$reviews = $courses[$_GET['title']]->getReviews();
foreach ($reviews as $review){?>
    <div class="row">
        <div class="col-sm-2"><i class="glyphicon glyphicon-user"></i> <?
            if ($review->getUser()==$_SESSION["username"])
                $userfound = true;
            echo $review->getUser() ?></div>
        <div class="col-sm-10">
            <table class="table text-center">
                <tr>
                    <th class="col-sm-3 text-center">Semester</th>
                    <th class="col-sm-3 text-center">Professor</th>
                    <th class="col-sm-3 text-center">TA</th>
                </tr>
                <tr>
                    <td><? echo $review->getSemester(); ?></td>
                    <td><a href="professordetails.php?name=<? echo $review->getProfessor(); ?>"><? echo $review->getProfessor(); ?></a> </td>
                    <td><? echo $review->getTA(); ?></td>
                </tr>
                <tr>
                    <th class="col-sm-3 text-center">Difficulty</th>
                    <th class="col-sm-3 text-center">Time</th>
                    <th class="col-sm-3 text-center">Enjoyment</th>
                </tr>
                <tr>
                    <td>
                        <?
                        for ($i = 0; $i < $review->getDifficulty(); $i++)
                            echo '<i class="glyphicon glyphicon-star" style="color:orange"></i>';
                        for ($i = 0; $i < (5-$review->getDifficulty()); $i++)
                            echo '<i class="glyphicon glyphicon-star-empty" style="color:orange"></i>';
                        ?>
                    </td>
                    <td>
                        <?
                        for ($i = 0; $i < $review->getTime(); $i++)
                            echo '<i class="glyphicon glyphicon-star" style="color:blue"></i>';
                        for ($i = 0; $i < (5-$review->getTime()); $i++)
                            echo '<i class="glyphicon glyphicon-star-empty" style="color:blue"></i>';
                        ?>
                    </td>
                    <td>
                        <?
                        for ($i = 0; $i < $review->getEnjoyment(); $i++)
                            echo '<i class="glyphicon glyphicon-star" style="color:red"></i>';
                        for ($i = 0; $i < (5-$review->getEnjoyment()); $i++)
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
                    <td><? echo $review->getExams() ?></td>
                    <td><? echo $review->getMps() ?></td>
                    <td><? echo $review->getPapers() ?></td>
                </tr>

            </table>
            <dl class="dl-horizontal">
                <dt>Prof comments:</dt>
                <dd><? echo $review->getCommentsOnProfessor() ?></dd>


                <dt>User comments:</dt>
                <dd><? echo $review->getCommentsOnCourse() ?></dd>


                <dt>Tips:</dt>
                <dd><? echo $review->getTips() ?></dd>

                <dt>Part Of:</dt>
                <dd> <?
                    if($review->getPartOfCore()==1):
                        echo "College Core";
                    elseif($review->getPartOfCore()==2):
                        echo "Major Requirement";
                    else:
                        echo "Elective";
                    endif;?>
                </dd>

            </dl>
                    <span class="pull-right col-sm-offset-1">
                        <?
                        if ($review->getUser()==$_SESSION["username"])
                            echo '<a class="btn btn-danger" href="deletereview.php?id='.$review->getId().'">Delete</a>';
                        else{?>
                            <a class="btn btn-default"><i class="glyphicon glyphicon-thumbs-up"></i> Useful</a>

                        <? }
                        ?>
                    </span>
        </div>
    </div>
    <hr>
<?
}?>