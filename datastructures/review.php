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
    private $grade;
    private $difficulty;
    private $time;
    private $enjoyment;
    private $exams;
    private $examtype;
    private $mps;
    private $papers;
    private $comments_on_professor;
    private $tips;
    private $semester;
    private $timestamp;
    private $part_of_core;
    private $comments_on_course;
    private $user;
    private $id;
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @param $n, semester
     * @param $o, was the course a core requirement or an elective
     * @param $, was the review of the class
     */
    function __construct($a,$b,$c,$d,$e,$f,$g,$h,$j,$k,$l,$m,$n,$o,$p,$q,$r,$s){

        $this->professor = $a;
        $this->ta = $b;
        $this->grade = $c;
        $this->difficulty = $d;
        $this->time = $e;
        $this->enjoyment = $f;
        $this->exams = $g;
        $this->examtype = $h;
        $this->mps = $j;
        $this->papers = $k;
        $this->comments_on_professor = $l;
        $this->tips = $m;
        $this->semester = $n;
        $this->part_of_core = $o;
        $this->timestamp = $p;
        $this->comments_on_course = $q;
        $this->user = $r;
        $this->id = $s;


    }

    /**
     * @param mixed $comments_on_course
     */
    public function setCommentsOnCourse($comments_on_course)
    {
        $this->comments_on_course = $comments_on_course;
    }

    /**
     * @return mixed
     */
    public function getCommentsOnCourse()
    {
        return $this->comments_on_course;
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
     * @param mixed $exams
     */
    public function setExams($exams)
    {
        $this->exams = $exams;
    }

    /**
     * @return mixed
     */
    public function getExams()
    {
        return $this->exams;
    }

    /**
     * @param mixed $examtype
     */
    public function setExamtype($examtype)
    {
        $this->examtype = $examtype;
    }

    /**
     * @return mixed
     */
    public function getExamtype()
    {
        return $this->examtype;
    }

    /**
     * @param mixed $grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;
    }

    /**
     * @return mixed
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param mixed $mps
     */
    public function setMps($mps)
    {
        $this->mps = $mps;
    }

    /**
     * @return mixed
     */
    public function getMps()
    {
        return $this->mps;
    }

    /**
     * @param mixed $papers
     */
    public function setPapers($papers)
    {
        $this->papers = $papers;
    }

    /**
     * @return mixed
     */
    public function getPapers()
    {
        return $this->papers;
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
     * @param mixed $semester
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this->semester;
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
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }



}
