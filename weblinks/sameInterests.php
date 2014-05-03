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
    <p></p>
    <form method="post">
        <div>

            <h3> Your Interests.</h3>

            <?php
            require ("../resources/database.php");
            //list of courses the user is enrolled in
            $courses = array();
            $pdo = Database::connect();
            $exists = 0;

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stid = $_SESSION["sid"];
            $sql = "SELECT * FROM interests WHERE user_id = '$stid'";

            foreach($pdo->query($sql) as $row){
                echo '<hr>';
                echo '<table>
                        <tr>
                        <td width="20%"><div class="glyphicon glyphicon-book"></div></td>
                        <td><h4><i>Academia</i><h4></td>
                    </tr>
                </table>';
                echo '<p style="font-size: 16px;"><b>CS interest: </b>'.$row['csinterest'].'</p>';
                if($row['tutorone'] != -1)
                    echo '<p style="font-size: 16px;"><b>Tutor for: </b> CS '.$row['tutorone'].'</p>';
                if($row['tutortwo'] != -1)
                    echo '<p style="font-size: 16px;"><b>Tutor for: </b> CS '.$row['tutortwo'].'</p>';

                echo '<hr>';
                echo '<table>
                        <tr>
                            <td width="15%"><div class="glyphicon glyphicon-globe"></div></td>
                            <td><h4><i>Extra Curricular</i><h4></td>
                        </tr>
                    </table>';
                echo '<p style="font-size: 16px;"><b>Leisure time activity: </b>'.$row['leisure'].'</p>';
                echo '<p style="font-size: 16px;"><b>Indoor/Outdoor: </b>'.$row['door'].'</p>';
                echo '<p style="font-size: 16px;"><b>Looking for: </b>'.$row['look'].'</p>';
                echo '<hr>';

                $exists = 1;
            }

            if($exists == 0){
                echo '<p style="font-size: 16px;"><b>You have not updated your interests yet. Do now and connect with your peers. </b></p>';
            }

            Database::disconnect();
            ?>
        </div>
        <div class="form-group">

            <a class="btn btn-primary btn-lg" href="updateInterests.php" role="button">Update Interests</a>
            <a class="btn btn-primary btn-lg" href="findPeople.php" role="button">Find people</a>
            <a class="btn btn-large" href="connect.php">Back</a>
        </div>
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