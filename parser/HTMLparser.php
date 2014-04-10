<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/9/14
 * Time: 8:46 PM
 */
class Parser{

    public $courses = array();

    public function __parser(){

        // Pull in PHP Simple HTML DOM Parser
        include("../simplehtmldom_1_5/simple_html_dom.php");
        include("../datastructures/course.php");

        // Retrieve the DOM from a given URL
        $html = file_get_html('https://courses.illinois.edu/cisapp/dispatcher/schedule/2014/fall/CS');

        // Find the table tag with a specific class name
        $count = 0;
        $ret = $html->find('table[class=tablesorter]');

        //get each course offered in the cs department
        foreach($html->find('tr') as $e)  {

            $code =  $e->find('td', 1);
            $title =  $e->find('td', 2);
            $code = strip_tags($code);
            echo $code."<br>";
            $html_two = file_get_html('https://courses.illinois.edu/cisapp/dispatcher/schedule/2014/fall/CS/'.$code);

            $subject = $html_two->find('div[id=subject-info1]');
            if($count != 0){
                //echo $subject[0];
                $code = "CS ".$code;
                $course = new Course($title, $code, "CS", $subject[0]);
                array_push($this->courses, $course);
            }

            if($count == 9000)
                break;

            $count = $count+1;

            $html_two->clear();
        }
    }
}
?>