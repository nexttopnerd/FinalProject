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
        function joinMeetup(course)
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

            xmlhttp.open("POST","addCourse.php?course="+course_id,false);
            xmlhttp.send();

            //loading the new set of comments after a new comment has been posted
            //loadComments(assign, file);
            window.location.reload();
        }
    </script>


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
                <li><a href="courses.php">Courses</a></li>
                <li><a href="meetups.php">Meetups</a>
                <li><a href="connect.php">Connect</a></li>
                <li><a href="compareClasses.php">Compare</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a class="glyphicon glyphicon-comment" style="font-size:20px;" href="messages.php"></a></li>

                <li><a href="#"> Hello <?php echo $_SESSION["username"];?>!</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <?php
    //provides the detailed information regarding the meet ups
    require '../resources/database.php';
    $cntid = $_GET["cntid"];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM meetups WHERE id = '$cntid'";

    foreach($pdo->query($sql) as $row){
        echo '<h3>'.$row['content'].'</h3>';
        echo '<p>By: '.$row['user'].'<p>';
        echo '<p>Where: '.$row['mwhere'].'<p>';
        echo '<p>When: '.$row['mwhen'].'<p>';
        echo '<p>Till: '.$row['mtill'].'<p>';
        echo"<br>";
    }

    Database::disconnect();

    ?>
    <p></p>

    <br>
    <div>
        <?php
        //tells how many people have joined the current meetup
        $joined = 0;
        $cntid = $_GET["cntid"];
        $pdo = Database::connect();
        $cid = $_SESSION["sid"];
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM messages WHERE id = '$cntid'";

        foreach($pdo->query($sql) as $row){
            echo '<h3>'.$row['content'].'</h3>';

            $read = 1;
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE messages SET readby=? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($read, $cntid));
        }

        Database::disconnect();
        ?>
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