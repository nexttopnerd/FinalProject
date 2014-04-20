<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/9/14
 * Time: 10:59 PM
 */

class Course{

    private $title;
    private $code;
    private $credit;
    private $department;
    private $description;
    private $semesters = array();
    private $reviews = array();

    /**
     * An argument constructor for Course object type
     *
     * @param $a, title of the course
     * @param $b, code of the course
     * @param $c, department offering the course
     * @param $d, details and description of the course.
     */
    function __construct($a, $b, $c, $d, $e){

        $this->title = $a;
        $this->code = $b;
        $this->credit = $c;
        $this->department = $d;
        $this->description = $e;
    }

    /**
     * Gets and returns the title of the course
     * @return mixed
     */
    function getTitle(){
        return $this->title;
    }

    /**
     * Gets and returns the code of the course
     * @return mixed
     */
    function getCode(){
        return $this->code;
    }

    /**
     * Gets and returns the credit of the course
     * @return mixed
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Gets and returns the department name offering course
     * @return mixed
     */
    function getDepartment(){
        return $this->department;
    }

    /**
     * Gets and returns the description of the course
     * @return mixed
     */
    function getDescription(){
        return $this->description;
    }

    function setSemesters(){
        $curryear = date("Y");
        $month = date("n");

        include_once("../simplehtmldom_1_5/simple_html_dom.php");
        $code = str_replace($this->department." ", "", $this->code);
        $html = file_get_html('https://courses.illinois.edu/cisapp/dispatcher/catalog/2014/fall/CS/'.$code);
        $semesters = $html->find('div.portlet-list-wrapper ul li a');
        foreach ($semesters as $semester){

            $newSem = trim($semester->innertext);
            if ($month < 3){
                if ($newSem == "Spring ".$curryear)
                    continue;
            }
            elseif ($month < 7){
                if ($newSem == "Summer ".$curryear || $newSem == "Fall ".$curryear )
                    continue;
            }
            elseif ($month < 10){
                if ($newSem == "Fall ".$curryear || $newSem == "Spring ".($curryear+1))
                    continue;
            }
            else {
                if ($newSem == "Spring ".($curryear+1))
                    continue;
            }
            $this->semesters[] = $newSem;
        }

    }

    function setReviews(){
        include_once('../resources/database.php');
        include_once('review.php');
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM reviews WHERE code = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($this->code));
        while($row = $q->fetch()){
            $this->reviews[] = new Review($row['professor'], $row['ta'], $row['grade'], $row['difficulty'], $row['time'], $row['enjoyment'], $row['exams'], $row['examstype'], $row['mps'],
            $row['papers'], $row['professorcomments'], $row['tips'], $row['semester'], $row['type'], $row['timestamp'], $row['coursecomments'], $row['user'], $row['id']);
        }
        Database::disconnect();
    }

    function getReviews(){
        return $this->reviews;
    }

//db connect
        //db disconnect

    function getSemesters(){
        return $this->semesters;
    }

}
