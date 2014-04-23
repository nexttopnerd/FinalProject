<?php
/**
 * Created by PhpStorm.
 * User: Sonia
 * Date: 4/20/14
 * Time: 3:06 PM
 */
?>
<form class="form-horizontal" role="form" action="coursedetails.php?title=<? echo $_GET['title']?>" method="post">

<h4>Add a Review</h4>
<hr>

<div class="form-group <?echo $professorDiv?> ">

    <label class="col-sm-2 control-label" for = "professor">
        Professor name:
    </label>
    <div class="col-sm-10">
        <input type="text" name="professor" id = "professor" class="form-control" value="<? echo $professor ?>">
        <? echo $professorIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $professorMessage?>
    </div>
</div>
<div class="form-group <?echo $taDiv?> ">
    <label class="col-sm-2 control-label" for="ta">
        TA:
    </label>
    <div class="col-sm-10">
        <input type="text" name = "ta" id = "ta" class="form-control" value="<? echo $ta?>">
        <? echo $taIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $taMessage?>
    </div>
</div>
<div class="form-group <?echo $semesterDiv?> ">
    <label class="col-sm-2 control-label" for="semester">
        Semester
    </label>
    <div class="col-sm-10">
        <?
        $courses[$_GET['title']]->setSemesters();
        ?>
        <select class="form-control" name="semester" id="semester">
            <option value="0">Select option...</option>
            <?
            $semesters = $courses[$_GET['title']]->getSemesters();
            foreach ($semesters as $semester){
                ?>
                <option value="<? echo $semester?>"> <? echo $semester ?></option> <?
            }
            ?>
        </select>
        <? echo $semesterIcon; ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $semesterMessage ?>
    </div>
</div>
<div class="form-group <?echo $gradeDiv?>">
    <label class="col-sm-2 control-label" for ="grade">
        Expected Grade/Grade:
    </label>
    <div class="col-sm-10">
        <select class="form-control" name="grade" id="grade">
            <option value="0">Select option...</option>
            <option value="A">A+/A</option>
            <option value="B">B+/B/B-</option>
            <option value="C">C+/C/C-</option>
            <option value="D">D or below</option>
        </select>
        <? echo $gradeIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $gradeMessage ?>
    </div>
</div>
<div class="form-group <?echo $typeDiv?>">
    <label class="col-sm-2 control-label">
        Part of:
    </label>
    <div class="col-sm-10">
        <label class="radio-inline">
            <input type="radio" name="type" value="1">College Core
        </label>
        <label class="radio-inline">
            <input type="radio" name="type" value="2">Major Requirement
        </label>
        <label class="radio-inline">
            <input type="radio" name="type" value="3">Elective</br>
        </label>
        <? echo $typeIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $typeMessage ?>
    </div>
</div>
<hr>
<h4>
    <i><b>Qualitative Reviews</b></i>
</h4>

<div class="form-group <?echo $difficultyDiv?> ">
    <label class="col-sm-2 control-label">
        Difficulty:
    </label>
    <div class="col-sm-10">
        <label class="radio-inline" for="difficulty1">
            <input type="radio" name="difficulty" id="difficulty1" value="1"> 1
        </label>
        <label class="radio-inline" for="difficulty2">
            <input type="radio" name="difficulty" id="difficulty2" value="2"> 2
        </label>
        <label class="radio-inline" for="difficulty3">
            <input type="radio" name="difficulty" id="difficulty3" value="3"> 3
        </label>
        <label class="radio-inline" for="difficulty4">
            <input type="radio" name="difficulty" id="difficulty4" value="4"> 4
        </label>
        <label class="radio-inline" for="difficulty5">
            <input type="radio" name="difficulty" id="difficulty5" value="5"> 5
        </label>
        <? echo $difficultyIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $difficultyMessage ?>
    </div>

</div>

<div class="form-group <?echo $timeDiv?> ">
    <label class="col-sm-2 control-label">
        Time Commitment:
    </label>
    <div class="col-sm-10">
        <label class="radio-inline" for="time1">
            <input type="radio" name="time" id="time1" value="1"> 1
        </label>
        <label class="radio-inline" for="time2">
            <input type="radio" name="time" id="time2" value="2"> 2
        </label>
        <label class="radio-inline" for="time3">
            <input type="radio" name="time" id="time3" value="3"> 3
        </label>
        <label class="radio-inline" for="time4">
            <input type="radio" name="time" id="time4" value="4"> 4
        </label>
        <label class="radio-inline" for="time5">
            <input type="radio" name="time" id="time5" value="5"> 5
        </label>
        <? echo $timeIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $timeMessage ?>
    </div>
</div>
<div class="form-group <?echo $enjoymentDiv?> ">
    <label class="col-sm-2 control-label">
        Enjoyment:
    </label>
    <div class="col-sm-10">
        <label class="radio-inline" for="enjoyment1">
            <input type="radio" name="enjoyment" id="enjoyment1" value="1"> 1
        </label>
        <label class="radio-inline" for="enjoyment2">
            <input type="radio" name="enjoyment" id="enjoyment2" value="2"> 2
        </label>
        <label class="radio-inline" for="enjoyment3">
            <input type="radio" name="enjoyment" id="enjoyment3" value="3"> 3
        </label>
        <label class="radio-inline" for="enjoyment4">
            <input type="radio" name="enjoyment" id="enjoyment4" value="4"> 4
        </label>
        <label class="radio-inline" for="enjoyment5">
            <input type="radio" name="enjoyment" id="enjoyment5" value="5"> 5
        </label>
        <? echo $enjoymentIcon ?>
    </div>
    <div class="col-sm-10 col-sm-offset-2 text-danger">
        <? echo $enjoymentMessage ?>
    </div>

</div>

<hr>
<h4>
    <i><b>Exams</b></i>
    </h3>
    <div class="form-group <?echo $examsDiv?>">
        <label class="col-sm-2 control-label" for="exams">
            # of exams:
        </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="exams" name="exams" value="<? echo $exams ?>">
            <? echo $examsIcon ?>
        </div>
        <div class="col-sm-10 col-sm-offset-2 text-danger">
            <? echo $examsMessage ?>
        </div>
    </div>
    <div class="form-group <?echo $examDiv?>">
        <label class="col-sm-2 control-label" for="exam">
            Exam type:
        </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="exam" name="exam" value="<? echo $exam ?>">
            <? echo $examIcon ?>
        </div>
        <div class="col-sm-10 col-sm-offset-2 text-danger">
            <? echo $examMessage ?>
        </div>
    </div>
    <!-- <div class="form-group">
         <label class="col-sm-2 control-label">
             Final Exam?
         </label>
         <div class="col-sm-10">
             <label class="radio-inline">
                 <input type="radio" name="final"> Yes
             </label>
             <label class="radio-inline">
                 <input type="radio" name="final"> No
             </label>
         </div>
     </div> -->
    <hr>
    <h4>
        <i><b>Assignments
        </i></b></h4>
    <div class="form-group <?echo $mpsDiv?>">
        <label class="col-sm-2 control-label" for="mps">
            # of MPs:
        </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="mps" id="mps" value="<? echo $mps ?>">
            <? echo $mpsIcon ?>
        </div>
        <div class="col-sm-10 col-sm-offset-2 text-danger">
            <? echo $mpsMessage ?>
        </div>
    </div>
    <div class="form-group <?echo $papersDiv?>">
        <label class="col-sm-2 control-label" for="papers">
            # of Papers:
        </label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="papers" id="papers" value="<? echo $papers ?>">
            <? echo $papersIcon ?>
        </div>
        <div class="col-sm-10 col-sm-offset-2 text-danger">
            <? echo $papersMessage ?>
        </div>
    </div>
    <hr>
    <div class="form-group <?echo $pComDiv?>">
        <div class="col-sm-12">
            <textarea class="col-sm-12 form-control" rows="3" placeholder="Comments Regarding Professor" name="pCom"><? echo $pCom?></textarea>
            <? echo $pComIcon ?>
        </div>
        <div class="col-sm-12 text-danger">
            <? echo $pComMessage ?>
        </div>
    </div>
    <div class="form-group <?echo $cComDiv?>">
        <div class="col-sm-12">
            <textarea class="col-sm-12 form-control" rows="3" placeholder="Comments Regarding Course Content" name="cCom"><? echo $cCom?></textarea>
            <? echo $cComIcon ?>
        </div>
        <div class="col-sm-12 text-danger">
            <? echo $cComMessage ?>
        </div>
    </div>
    <div class="form-group <?echo $tipsDiv?>">
        <div class="col-sm-12">
            <textarea class="col-sm-12 form-control" rows="3" placeholder="Additional Comments/Tips" name="tips"><? echo $tips?></textarea>
            <? echo $tipsIcon ?>
        </div>
        <div class="col-sm-12 text-danger">
            <? echo $tipsMessage ?>
        </div>
    </div>



    <input type="submit" name="submit" class="btn btn-primary center-block">
</form>