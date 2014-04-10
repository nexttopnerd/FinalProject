<?php
/**
 * Created by PhpStorm.
 * User: Sonia
 * Date: 4/4/14
 * Time: 2:36 AM
 */
$name = $_POST['name'];
if(isset($name)){
    $html = "Your name is". $name;
    echo $html;
}