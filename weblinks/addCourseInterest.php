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
         * ajax function to insert course into the database asynchronously
         *
         * @param sid, student ID
         * @param course, course ID
         */
        function insertCourse(course)
        {
            var course_id = document.getElementById("course").value;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            course_id = "CS "+course_id;
            alert(course_id);
            xmlhttp.open("POST","addCourse.php?course="+course_id,false);
            xmlhttp.send();

            //loading the new set of comments after a new comment has been posted
            //loadComments(assign, file);
            window.location.reload();
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
                <li><a href="#">About us</a></li>
                <li><a href="courses.php">Courses</a></li>
                <li><a href="meetups.php">Meetups</a>
                <li><a href="connect.php">Connect</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <br>
    <h4>Courses you are taking:<h4>
            <div>
                <?php
                require ("../resources/database.php");

                $courses = array();
                $pdo = Database::connect();

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stid = $_SESSION["sid"];
                $sql = "SELECT * FROM enrollment WHERE studentID = '$stid'";

                foreach($pdo->query($sql) as $row){
                    echo $row['courseID'];
                    echo"<br>";
                }

                Database::disconnect();
                ?>
            </div>
            <form method="post" action="" onsubmit="insertCourse('<?php echo $_POST['course']; ?>'); return false;">
                <div class="form-group">
                    <br>
                    <select name="course" id="course" value="course">
                        <?php


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
                </div>
                <input class="btn btn-primary btn-lg" name="add_course" type="submit" value="Add Course" />
            </form>

    <hr>


</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>