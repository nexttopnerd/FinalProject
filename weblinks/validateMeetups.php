<?php
/**
 * Validates the input fields in the meetuos page.
 * User: anirud
 * Date: 4/22/14
 * Time: 9:23 PM
 */
if (!empty($_POST)){
    $contentError = null;
    $locationError = null;

    $content = $_POST["mcontent"];
    $location = $_POST["mwhere"];
    $start = $_POST["mwhen"];
    $end = $_POST["mtill"];

    $valid = true;

    if (empty($content)){
        $contentError = 'Please add some content';
        $valid = false;
    }

    if (empty($location)){
        $locationError = 'Please specify a location';
        $valid = false;
    }

    if (empty($start)){
        $startError = 'Please specify the start date';
        $valid = false;
    }

    //get current date
    date_default_timezone_set('America/Chicago');
    $today = date('Y-m-d');
    if ($start < $today){
        $startError = "Cannot specify any earlier date than today's";
        $valid = false;
    }

    if (empty($end)){
        $endError = 'Please specify the end date';
        $valid = false;
    }

    if ($end != null && $end < $start){
        $endError = "End date can't be before the start date";
        $valid = false;
    }

    if($valid == true){
        //header("Location: insertMeetupContent.php?content=$content&mwhen=$start&mtill=$end&mwhere=$location");

    }

}

?>