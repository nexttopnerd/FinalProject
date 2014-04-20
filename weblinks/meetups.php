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
         * ajax function to insert comments into the database asynchronously
         *
         * @param content, name of the assignment
         * @param mwhen, name of file in the assignment
         * @param mwhere, name of the user who posted the comment
         */
        function insertContent(content, mwhen, mwhere)
        {

            // jQuery AJAX Get Error Handler
            //$.get("insertIntoDb.php");

            var cnt = document.getElementById("activity").value;
            var mwh = document.getElementById("when").value;
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
            alert("insertMeetupContent.php?content="+cnt+"&mwhen="+mwh+"&mwhere="+mwhr);
            xmlhttp.open("POST","insertMeetupContent.php?content="+cnt+"&mwhen="+mwh+"&mwhere="+mwhr,false);
            xmlhttp.send();


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
    <?php

    require '../resources/database.php';

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM meetups";

    foreach($pdo->query($sql) as $row){
        echo '<h4><a href="meetupDetail.php?cntid='.$row['id'].'">'.$row['content'].'</a></h4>';

    }

    Database::disconnect();

    ?>
    <hr>
    <p></p>
    <form method="post" action="" onsubmit="insertContent('<?php echo $_POST['activity']; ?>', '<?php echo $_POST['mwhen']; ?>',
        '<?php echo $_POST['mwhere']; ?>'); return false;">
        <div class="form-group">
        <textarea style="width: 500px;" name="activity" id="activity" value="activity" placeholder="Password" class="form-control">Add an activity, find study groups, hangout...</textarea>
        </div>
        <div class="form-group">
        <textarea style="width: 300px;" id="where" name="mwhere"  class="form-control">Where</textarea>
        </div>
        <div class="form-group">
        <input style="width: 300px;" type="date" id="when" name="mwhen" class="form-control">
        </div>
        <input class="btn btn-primary btn-lg" name="submit" type="submit" value="submit" />
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