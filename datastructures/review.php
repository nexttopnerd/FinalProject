<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/9/14
 * Time: 10:59 PM
 */

class Review{

    private $professor;
    private $ta;
    private $expected_grade;
    private $difficulty;
    private $time_commitment;
    private $enjoyment;
    private $number_of_exams;
    private $exam_type;
    private $no_of_projects;
    private $no_of_papers;
    private $comments_on_professor;
    private $tips;
    private $year;
    private $part_of_core;

    /**
     * Argument constructor for review
     *
     * @param $a, professor name
     * @param $b, ta name
     * @param $c, expected grade in the course
     * @param $d, difficulty of the course
     * @param $e, time commitment needed for the course
     * @param $f, enjoyment/fun in the course
     * @param $g, number of exams in the course
     * @param $h, type of the exam
     * @param $i, is there a final exam
     * @param $j, number of projects/mp in the course
     * @param $k, number of papers to be written for the course
     * @param $l, comment about the professor
     * @param $m, tips to excel in the course
     * @param $n, year in which the course was offered
     * @param $o, was the course a core requirement or an elective
     */
    function __construct($a,$b,$c,$d,$e,$f,$g,$h,$j,$k,$l,$m,$n,$o){

        $this->professor = $a;
        $this->ta = $b;
        $this->expected_grade = $c;
        $this->difficulty = $d;
        $this->time_commitment = $e;
        $this->enjoyment = $f;
        $this->number_of_exams = $g;
        $this->exam_type = $h;
        $this->no_of_projects = $j;
        $this->no_of_papers = $k;
        $this->comments_on_professor = $l;
        $this->tips = $m;
        $this->year = $n;
        $this->part_of_core = $o;
    }
    /**
     * @param mixed $comments_on_professor
     */
    public function setCommentsOnProfessor($comments_on_professor)
    {
        $this->comments_on_professor = $comments_on_professor;
    }

    /**
     * @return mixed
     */
    public function getCommentsOnProfessor()
    {
        return $this->comments_on_professor;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param mixed $enjoyment
     */
    public function setEnjoyment($enjoyment)
    {
        $this->enjoyment = $enjoyment;
    }

    /**
     * @return mixed
     */
    public function getEnjoyment()
    {
        return $this->enjoyment;
    }

    /**
     * @param mixed $exam_type
     */
    public function setExamType($exam_type)
    {
        $this->exam_type = $exam_type;
    }

    /**
     * @return mixed
     */
    public function getExamType()
    {
        return $this->exam_type;
    }

    /**
     * @param mixed $expected_grade
     */
    public function setExpectedGrade($expected_grade)
    {
        $this->expected_grade = $expected_grade;
    }

    /**
     * @return mixed
     */
    public function getExpectedGrade()
    {
        return $this->expected_grade;
    }

    /**
     * @param mixed $no_of_papers
     */
    public function setNoOfPapers($no_of_papers)
    {
        $this->no_of_papers = $no_of_papers;
    }

    /**
     * @return mixed
     */
    public function getNoOfPapers()
    {
        return $this->no_of_papers;
    }

    /**
     * @param mixed $no_of_projects
     */
    public function setNoOfProjects($no_of_projects)
    {
        $this->no_of_projects = $no_of_projects;
    }

    /**
     * @return mixed
     */
    public function getNoOfProjects()
    {
        return $this->no_of_projects;
    }

    /**
     * @param mixed $number_of_exams
     */
    public function setNumberOfExams($number_of_exams)
    {
        $this->number_of_exams = $number_of_exams;
    }

    /**
     * @return mixed
     */
    public function getNumberOfExams()
    {
        return $this->number_of_exams;
    }

    /**
     * @param mixed $part_of_core
     */
    public function setPartOfCore($part_of_core)
    {
        $this->part_of_core = $part_of_core;
    }

    /**
     * @return mixed
     */
    public function getPartOfCore()
    {
        return $this->part_of_core;
    }

    /**
     * @param mixed $professor
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;
    }

    /**
     * @return mixed
     */
    public function getProfessor()
    {
        return $this->professor;
    }

    /**
     * @param mixed $ta
     */
    public function setTa($ta)
    {
        $this->ta = $ta;
    }

    /**
     * @return mixed
     */
    public function getTa()
    {
        return $this->ta;
    }

    /**
     * @param mixed $time_commitment
     */
    public function setTimeCommitment($time_commitment)
    {
        $this->time_commitment = $time_commitment;
    }

    /**
     * @return mixed
     */
    public function getTimeCommitment()
    {
        return $this->time_commitment;
    }

    /**
     * @param mixed $tips
     */
    public function setTips($tips)
    {
        $this->tips = $tips;
    }

    /**
     * @return mixed
     */
    public function getTips()
    {
        return $this->tips;
    }
}
?>