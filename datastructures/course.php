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
    private $department;
    private $description;

    /**
     * An argument constructor for Course object type
     *
     * @param $a, title of the course
     * @param $b, code of the course
     * @param $c, department offering the course
     * @param $d, details and description of the course.
     */
    function __construct($a, $b, $c, $d){

        $this->title = $a;
        $this->code = $b;
        $this->department = $c;
        $this->description = $d;
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
}
?>