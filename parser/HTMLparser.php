<?php
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/9/14
 * Time: 8:46 PM
 */
require ("../database.php");
class Parser{

    //public $courses = array();

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

        $pdo = Database::connect();
        foreach($html->find('tr') as $e)  {
            $department= $e->find('td', 0);
            $code =  $e->find('td', 1);
            $title =  $e->find('td', 2);
            $code = strip_tags($code);
            $title = strip_tags($title);
            $department = strip_tags($department);

            $html_two = file_get_html('https://courses.illinois.edu/cisapp/dispatcher/schedule/2014/fall/CS/'.$code);

            $subject = $html_two->find('div[id=subject-info1]');

            if($count != 0){
                //echo $subject[0];
                $description = strip_tags($subject[0]);
                $code = $department." ".$code;
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT IGNORE INTO Courses (Code, Department, Name, Description) values(?, ?, ?, ?)";
                $q = $pdo->prepare($sql);
                $q->execute(array($code, $department, $title, $description));

            }





            $count = $count+1;

            $html_two->clear();
        }
        Database::disconnect();

    }

}

$parser = new Parser();
$parser->__parser();
header('Location: ../weblinks/index.php');
?>