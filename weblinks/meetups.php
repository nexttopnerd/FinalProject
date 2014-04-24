<?php
@ob_start();
session_start();
?>
<?php

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
    if ($start != null && $start < $today){
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
        header("Location: insertMeetupContent.php?content=$content&mwhen=$start&mtill=$end&mwhere=$location");

    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Port Illinois</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/jumbotron.css" rel="stylesheet">

    <script>
        /**
         * ajax function set up
         */
        $.ajaxSetup({
            key: 'value'
        });

        /**
         * ajax function to check if any error was encountered while executing any ajax function
         */
        $(function() {
            $.ajaxSetup({
                error: function(jqXHR, exception) {
                    if (jqXHR.status === 0) {
                        alert('Not connect.\n Verify Network.');
                    } else if (jqXHR.status == 404) {
                        alert('Requested page not found. [404]');
                    } else if (jqXHR.status == 500) {
                        alert('Internal Server Error [500].');
                    } else if (exception === 'parsererror') {
                        alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                        alert('Time out error.');
                    } else if (exception === 'abort') {
                        alert('Ajax request aborted.');
                    } else {
                        alert('Uncaught Error.\n' + jqXHR.responseText);
                    }
                }
            });
        });


        /**
         * ajax function to insert meetup details into the database
         *
         */
        function insertContent()
        {

            // jQuery AJAX Get Error Handler
            //$.get("insertIntoDb.php");

            var cnt = document.getElementById("activity").value;
            var mwh = document.getElementById("when").value;
            var mtl = document.getElementById("till").value;
            var mwhr = document.getElementById("where").value;
            if (window.XMLHttpRequest)
             {// code for IE7+, Firefox, Chrome, Opera, Safari
             xmlhttp=new XMLHttpRequest();
             }
             else
             {// code for IE6, IE5
             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
             }

            //opening the xml http request
            alert(cnt);
            xmlhttp.open("POST","insertMeetupContent.php?content="+cnt+"&mwhen="+mwh+"&mtill="+mtl+"&mwhere="+mwhr,false);
            xmlhttp.send();

            //window.location.reload();

            //loading the new set of comments after a new comment has been posted
            loadMeetups();
        }

        /**
         *Loads and displays all the valid meetups asynchronousy
         *
         */
        function loadMeetups()
        {
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.status==200)
                {
                    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST","displayMeetups.php",true);
            xmlhttp.send();
        }
    </script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>-->
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>




    <![endif]-->
</head>


<body>

<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">About us</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li class="active"><a href="meetups.php">Meetups</a>
                <li><a href="connect.php">Connect</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <div id = "myDiv">
        <br>
        <?php
        //displays all the valid meetups
        require('displayMeetups.php');
        ?>
    </div>

    <hr>
    <p></p>

    <form class="form-horizontal" action="meetups.php" method="post">
        <div class="control-group <?php echo !empty($contentError)?'error':'';?>">
            <label class="control-label">Content: </label>
            <div class="controls">
                <textarea style="width: 500px;" id ="content" name="mcontent" type="content"  class="form-control" value="<?php echo !empty($content)?$content:'';?>">Add an activity, find study groups, hangout...</textarea>
                <?php if (!empty($contentError)): ?>
                    <span class="help-inline"><?php echo $contentError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
            <label class="control-label">Location: </label>
            <div class="controls">
                <textarea style="width: 300px;" id="where" name="mwhere"  class="form-control" value="<?php echo !empty($location)?$location:'';?>">Where</textarea>
                <?php if (!empty($locationError)): ?>
                    <span class="help-inline"><?php echo $locationError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($startError)?'error':'';?>">
            <label class="control-label">From: </label>
            <div class="controls">
                <input style="width: 300px;" id="when" name="mwhen" type="date" class="form-control" value="<?php echo !empty($start)?$start:'';?>">
                <?php if (!empty($startError)): ?>
                    <span class="help-inline"><?php echo $startError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($endError)?'error':'';?>">
            <label class="control-label">Till: </label>
            <div class="controls">
                <input style="width: 300px;" id="till" name="mtill" type="date" class="form-control" value="<?php echo !empty($end)?$end:'';?>">
                <?php if (!empty($endError)): ?>
                    <span class="help-inline"><?php echo $endError;?></span>
                <?php endif; ?>
            </div>
        </div>


        <br>

        <div class="form-actions">
            <button type="submit" class="btn btn-large btn-primary">Submit!</button>
        </div>

        <hr>

    <footer>
        <p>&copy; Company 2014</p>
    </footer>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>