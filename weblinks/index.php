<?php
@ob_start();
session_start();
?>
<?php

require '../resources/database.php';

//$data=null;
if (isset($_POST['logout'])){
    $_SESSION["username"]="";
}
else if (!empty($_POST)){

    if(isset($_SESSION)):
        session_destroy();
    endif;

    $nameError = null;
    $passwordError = null;


    $name = $_POST["name"];
    $password = $_POST["password"];


    $valid = true;
    if (empty($name)){
        $nameError = 'Please enter a valid email';
        $valid = false;
    }

    if (empty($password)){
        $passwordError = 'Please enter a password';
        $valid = false;
    }


    if ($valid){
        $salt = "8dC_9Kl?";
        $encrypted_password = md5($password . $salt);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $encrypted_password));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        //ini_set('session.save_path', '/home/projectnull/public_html/financialactivity/sessions');

        if($data == null){
            $passwordError = 'Either password or email is wrong';
        }
        else{
        session_start();
        $_SESSION["username"] = $data['username'];
        $_SESSION["userid"] = $data['user_id'];
        $_SESSION["name"] = $name;
        $_SESSION["sid"] = $data['user_id'];
        header("Location: courses.php");

        //setName($name);
        }
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

    <style>

        .jumbotron {
            height: 50em;
            padding-top: 9em;
            margin-bottom: 2em;
            background-image: url("http://static2.businessinsider.com/image/522605d1eab8ea512da49b20/a-university-of-illinois-student-has-been-arrested-for-allegedly-making-terrorist-like-threats.jpg");
            background-size: cover;
            color: #fff;
            text-align: center;
        }

    </style>

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
            <a class="navbar-brand" href="#">Home</a>
        </div>
        <div class="navbar-collapse collapse" id="test">
            <?php if (isset($_SESSION["username"]) && $_SESSION["username"]!=""){
                echo '<div class="navbar-form navbar-right">';
                echo "<h4>"."Welcome ". $_SESSION["username"]."!</h4>";
                ?>
                <form action="index.php" method="post">
                    <input type="submit" name="logout" value="Log out!" class="btn btn-default">
                </form> <?
                echo '</div>';
            } else{?>
            <form class="navbar-form navbar-right" action="" method="post">
                <div class="form-group <?php echo !empty($nameError)?'error':'';?>">
                    <div class="controls">
                        <input name="name" type="text"  placeholder="Email" class="form-control" value="<?php echo !empty($name)?$name:'';?>">
                        <?php if (!empty($nameError)): ?>
                            <span class="help-inline"><?php echo $nameError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group <?php echo !empty($passwordError)?'error':'';?>">
                    <div class="controls">
                        <input name="password" type="password"  placeholder="Password" class="form-control" value="<?php echo !empty($password)?$password:'';?>">
                        <?php if (!empty($passwordError)): ?>
                            <span class="help-inline"><?php echo $passwordError;?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
            <? } ?>
        </div><!--/.navbar-collapse -->
    </div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Welcome to Port Illinois<?php function setName($nm){ echo $nm;}?></h1>
        <p>Port Illinois is a unique website for University of Illinois students to provide course evaluations, create meetups and connect to other University of Illinois students</p>
        <? if(($_SESSION["username"]=="")):?>
            <p><a href="register.php" class="btn btn-primary btn-lg" role="button">Register Now!</a></p>
        <? endif; ?>
    </div>
</div>

<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2>Courses</h2>
            <p>Browse and review the classes offered in the Department of Computer Science. Get course information and reviews posted by your peers to get feedbacks on the course. Don't forget to add your own reviews!!! </p>
            <p><a class="btn btn-default" href="courses.php" role="button">View courses &raquo;</a></p>
            <p><a class="btn btn-default" href="../resources/HTMLparser.php" role="button">Update courses &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Meetups</h2>
            <p> Get updates of all the activites, academic or entertainment, which your peers are doing and would like you to join. Find and explore new people, take part in fun activities and learn at the same time. </p>
            <p><a class="btn btn-default" href="meetups.php" role="button">Meet now &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Connect</h2>
            <p>Find and connect to University of Illinois students who are taking same course as you or share same interests as you. Make new friends and get to know people who share the same interests and passion as you</p>
            <p><a class="btn btn-default" href="connect.php" role="button">Connect now &raquo;</a></p>
            <p><a class="btn btn-default" href="addCourseInterest.php" role="button">Add Courses &raquo;</a></p>
        </div>
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