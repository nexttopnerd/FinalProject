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

            xmlhttp.open("POST","insertMeetupContent.php?content="+cnt+"&mwhen="+mwh+"&mtill="+mtl+"&mwhere="+mwhr,false);
            xmlhttp.send();

            window.location.reload();

            //loading the new set of comments after a new comment has been posted
            //loadComments(assign, file);
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
                <li><a href="meetups.php">Meetups</a>
                <li class="active"><a href="connect.php">Connect</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <br>

    <div style="position:relative; top: 15px;" class="glyphicon glyphicon-glass"></div>
    <div style="position:relative; left: 20px; top: -30px;"><h3>Update your interests</h3></div>

    <form class="form-horizontal" action="meetups.php" method="post">

        <label class="control-label">What do you like to do in your leisure time?</label>
        <br>
        <select name="leisure" form="leisureform">
            <option value="volvo">Read books</option>
            <option value="opel">Play videogames</option>
            <option value="audi">Hang out with friends</option>
            <option value="audi">Sports</option>
            <option value="audi">Partying</option>
            <option value="audi">Movies/TV shows</option>
            <option value="audi">Explore CS beyond classes</option>
        </select>
        <br><br>

        <label class="control-label">What field of CS intrigues you the most?</label>
        <br>
        <select name="leisure" form="leisureform">
            <option value="volvo">Artificial Intelligence</option>
            <option value="saab">Systems programming</option>
            <option value="opel">Theoretical computer science</option>
            <option value="audi">Computer architecture and engineering</option>
            <option value="saab">Computer graphics and visualization</option>
            <option value="saab">Computer security and cryptography</option>
            <option value="saab">Computational science</option>
            <option value="saab">Databases</option>
            <option value="saab">Health informatics</option>
            <option value="saab">Sofware engineering</option>

        </select>
        <br><br>


        <label class="control-label">Do you prefer indoors or outdoors?</label>
        <br>
        <select name="leisure" form="leisureform">
            <option value="volvo">Indoors</option>
            <option value="saab">Outdoors</option>
        </select>
        <br><br>


        <label class="control-label">What do you like to do in your leisure time?</label>
        <br>
        <select name="leisure" form="leisureform">
            <option value="volvo">Reading books</option>
            <option value="saab">Play outdoors</option>
            <option value="opel">Play videogames</option>
            <option value="audi">Hang out with friends</option>
        </select>
        <br><br>


        <label class="control-label">What do you like to do in your leisure time?</label>
        <br>
        <select name="leisure" form="leisureform">
            <option value="volvo">Reading books</option>
            <option value="saab">Play outdoors</option>
            <option value="opel">Play videogames</option>
            <option value="audi">Hang out with friends</option>
        </select>
        <br><br>

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