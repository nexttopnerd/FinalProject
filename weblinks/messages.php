<?php
@ob_start();
session_start();
require '../resources/database.php';
?>
<?php

if (!empty($_POST)){
    $contentError = null;
    $locationError = null;

    $content = $_POST["content"];
    $subject = $_POST["subject"];
    $receiver = $_POST["receiver"];

    $valid = true;

    if (empty($content)){
        $contentError = 'Please add a message';
        $valid = false;
    }

    if (empty($subject)){
        $subjectError = 'Please specify a subject';
        $valid = false;
    }

    $uid = $_SESSION["sid"];

    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT username FROM users";

    $valid_user = 0;
    foreach($pdo->query($sql) as $row){
        $row['username'] = str_replace(' ', '', $row['username']);
        $rec = str_replace(' ', '', $receiver);
        if(strcasecmp($rec, $row['username']) == 0){
            $valid_user = 1;
            break;
        }
    }

    Database::disconnect();

    if (empty($receiver)){
        $receiverError = 'Please specify the receiver';
        $valid = false;
    }

    if(!empty($receiver) && $valid_user == 0){
        $receiverError = 'Please specify an existing user';
        $valid = false;
    }

    if($valid == true){

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT user_id FROM users WHERE username = '$receiver'";

        $valid_user = 0;
        foreach($pdo->query($sql) as $row){
            $receiver = $row['user_id'];
        }

        header("Location: insertMessages.php?content=$content&receiver=$receiver&subject=$subject");

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
    <p></p>
        <div>
            <h3>Messages</h3>
            <?php require('displayMessages.php'); ?>
        </div>

    <hr>

    <form class="form-horizontal" action="messages.php" method="post">
        <div class="control-group <?php echo !empty($receiverError)?'error':'';?>">
            <label class="control-label">To: </label>
            <div class="controls">
                <textarea style="width: 200px;" id ="receiver" placeholder="Name" name="receiver" type="content"  class="form-control" value="<?php echo !empty($receiver)?$receiver:'';?>"></textarea>
                <?php if (!empty($receiverError)): ?>
                    <span class="help-inline"><?php echo $receiverError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($subjectError)?'error':'';?>">
            <label class="control-label">Subject: </label>
            <div class="controls">
                <textarea style="width: 300px;" placeholder="Subject" id="subject" name="subject"  class="form-control" value="<?php echo !empty($subject)?$subject:'';?>"></textarea>
                <?php if (!empty($subjectError)): ?>
                    <span class="help-inline"><?php echo $subjectError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($contentError)?'error':'';?>">
            <label class="control-label">Content: </label>
            <div class="controls">
                <textarea style="width: 300px; height: 100px;" placeholder="Message" id="content" name="content"  class="form-control" value="<?php echo !empty($content)?$content:'';?>"></textarea>
                <?php if (!empty($contentError)): ?>
                    <span class="help-inline"><?php echo $contentError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <br>

        <div class="form-actions">
            <button type="submit" class="btn btn-large btn-primary">Send</button>
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