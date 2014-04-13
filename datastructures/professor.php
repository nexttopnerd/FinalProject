<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/10/14
 * Time: 1:02 PM
 */

class Professor{

    private $name;
    private $courses;
    private $comments;

    /**
     * An argument constructor for Professor object type
     *
     * @param $a, name of the professor
     * @param $b, list of courses taught by the professor
     * @param $c, comments about the professor
     */
    function __construct($a, $b, $c){

        $this->name = $a;
        $this->courses = $b;
        $this->comments = $c;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}

?>
