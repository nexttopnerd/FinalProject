<?php
@ob_start();
session_start();
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
         * ajax function to update the interest details of the user
         *
         */
        function updateInterest()
        {

            // jQuery AJAX Get Error Handler
            //$.get("insertIntoDb.php");

            var int = document.getElementById("interest").value;
            var tone = document.getElementById("tutorOne").value;
            var ttwo = document.getElementById("tutorTwo").value;
            var leis = document.getElementById("leisure").value;
            var dor = document.getElementById("door").value;
            var lok = document.getElementById("look").value;


            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            //opening the xml http request

            xmlhttp.open("POST","storeInterests.php?interest="+int+"&tone="+tone+"&ttwo="+ttwo+"&leis="+leis+"&dor="
                +dor+"&lok="+lok,false);
            xmlhttp.send();

            window.location.href = "sameInterests.php";
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
        <hr>
    <form class="form-horizontal" action="" method="post" onsubmit="updateInterest(); return false;">
        <table>
            <tr>
                <td width="20%"><div class="glyphicon glyphicon-book"></div></td>
                <td><h4><i>Academia</i><h4></td>
            </tr>
        </table>

        <label class="control-label">What field of CS intrigues you the most?</label>
        <br>
        <select name="interest" id="interest" form="interestform">
            <option value="Artificial Intelligence">Artificial Intelligence</option>
            <option value="Systems programming">Systems programming</option>
            <option value="Theoretical computer science">Theoretical computer science</option>
            <option value="Computer architecture and engineering">Computer architecture and engineering</option>
            <option value="Computer graphics and visualization">Computer graphics and visualization</option>
            <option value="Computer security and cryptography">Computer security and cryptography</option>
            <option value="Computational science">Computational science</option>
            <option value="Databases">Databases</option>
            <option value="Health informatics">Health informatics</option>
            <option value="Sofware engineering">Sofware engineering</option>

        </select>
        <br><br>

        <label class="control-label">Which course can you tutor for?</label>
        <br>
        <select name="tutorOne" id="tutorOne" form="tutorOneform">
            <option value="-1">Select</option>
            <?php
            //list of all the courses offered in the department
            require('../resources/database.php');
            $courses = array();
            $pdo = Database::connect();

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Courses";

            foreach($pdo->query($sql) as $row){
                $token = $row['Code'];
                $first_token  = strtok($token, ' ');
                $second_token = strtok(' ');
                echo '<option value='.$second_token.' id="crs">'.$row['Code'].'</option>';
            }

            Database::disconnect();
            ?>
        </select>
        <br><br>

        <label class="control-label">Is there a secondary course you wish to tutor for?</label>
        <br>
        <select name="tutorTwo" id="tutorTwo" form="tutorTwoform">
            <option value="-1">Select</option>
            <?php
            //list of all the courses offered in the department
            $courses = array();
            $pdo = Database::connect();

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Courses";

            foreach($pdo->query($sql) as $row){
                $token = $row['Code'];
                $first_token  = strtok($token, ' ');
                $second_token = strtok(' ');
                echo '<option value='.$second_token.' id="crs">'.$row['Code'].'</option>';
            }

            Database::disconnect();
            ?>
        </select>
        <br><br>
        <hr>

        <table>
            <tr>
                <td width="15%"><div class="glyphicon glyphicon-globe"></div></td>
                <td><h4><i>Extra Curricular</i><h4></td>
            </tr>
        </table>



            <label class="control-label">What do you like to do in your leisure time?</label>
            <br>
            <select name="leisure" id="leisure" form="leisureform">
                <option value="Read books">Read books</option>
                <option value="Play videogames">Play videogames</option>
                <option value="Hang out with friends">Hang out with friends</option>
                <option value="Sports">Sports</option>
                <option value="Partying">Partying</option>
                <option value="Movies/TV shows">Movies/TV shows</option>
                <option value="Explore CS beyond classes">Explore CS beyond classes</option>
            </select>
            <br><br>


        <label class="control-label">Do you prefer indoors or outdoors?</label>
        <br>
        <select name="door" id="door" form="doorform">
            <option value="Indoors">Indoors</option>
            <option value="Outdoors">Outdoors</option>
        </select>
        <br><br>

        <label class="control-label">What are you looking for?</label>
        <br>
        <select name="look" id="look" form="look">
            <option value="Study group">Study group</option>
            <option value="Hang out group">Hang out group</option>
            <option value="Special interest group">Special interest group</option>
            <option value="Interview practice group">Interview practice group</option>
        </select>
        <br><br>

        <hr>
            <input class="btn btn-primary btn-lg" name="drop_course" type="submit" value="Update" />
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