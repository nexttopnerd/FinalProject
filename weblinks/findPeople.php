<?php
@ob_start();
session_start();
/**
 * Created by PhpStorm.
 * User: soniamohanlal
 * Date: 4/17/14
 * Time: 2:44 PM
 */
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

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

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
         * ajax function to find people with same interests as the user
         *
         */
        function findPeople()
        {
            var course_id = document.getElementById("int").value;

            //loading the new set of comments after a new comment has been posted
            if(course_id == "-1"){
                alert("Select a valid option");
            }
            else{
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
                        document.getElementById("sameInterests").innerHTML=xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET","displayCommonInterests.php?intr="+course_id,true);
                xmlhttp.send();
            }

        }

        /**
         * ajax function to find and sort people by their compatability with the user
         *
         */
        function getStat()
        {
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
                        document.getElementById("sameInterests").innerHTML=xmlhttp.responseText;
                    }
                }
            xmlhttp.open("GET","displayInterestStats.php?match=1",true);
            xmlhttp.send();
        }


    </script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
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
                <li><a href="courses.php">Courses</a></li>
                <li><a href="meetups.php">Meetups</a>
                <li class="active"><a href="connect.php">Connect</a></li>
                <li><a href="compareClasses.php">Compare</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a class="glyphicon glyphicon-comment" style="font-size:20px;" href="messages.php"></a></li>

                <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <br>
    <table>
        <tr>
            <td width="15%"><div class="glyphicon glyphicon-list-alt" style="font-size:20px;"></div></td>
            <td><h4>Find people with same:<h4></td>
        </tr>
    </table>
    <div id="sameInterests">
        <?php require ('displayCommonInterests.php');?>
        <?php require ('displayInterestStats.php');?>
    </div>
    <form method="post" action="" onsubmit="findPeople(); return false;">
        <div class="form-group">
            <br>
            <select name="course" id="int" value="course">
                <option value="-1">Select</option>
                <option value="csinterest">CS interest</option>
                <option value="tutors">Tutors</option>
                <option value="leisure">Leisure activity</option>
                <option value="door">Indoor/Outdoor</option>
                <option value="look">Looking for</option>
            </select>
        </div>
        <br>
        <input class="btn btn-primary btn-lg" name="find" type="submit" value="Find!" />
        <input class="btn btn-primary btn-lg" name="match" type="submit" onclick="getStat(); return false;" value="Get Stat!" />
        <a class="btn btn-large" href="sameInterests.php">Back</a>
    </form>

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