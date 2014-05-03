<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/29/14
 * Time: 9:02 PM
 */
class Tutor{

    private $id;
    private $course;

    /**
     * An argument constructor for Tutor object type
     *
     * @param $a, id of the tutor
     * @param $b, name of the course
     */
    function __construct($a, $b){

        $this->id = $a;
        $this->course = $b;
    }

    /**
     * @param mixed $course
     */
    public function setCourse($course)
    {
        $this->course = $course;
    }

    /**
     * @return mixed
     */
    public function getCourse()
    {
        return $this->course;
    }

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

}
?>