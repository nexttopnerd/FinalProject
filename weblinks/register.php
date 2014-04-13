<?php
@ob_start();
session_start();
?>
<?php

require '../resources/database.php';

if (!empty($_POST)){
    $nameError = null;
    $passwordError = null;
    $repasswordError = null;
    $ageError = null;
    $emailError = null;
    $phoneError = null;

    $name = $_POST["name"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $email = $_POST["email"];

    $valid = true;
    if (empty($name)){
        $nameError = 'Please enter a valid username';
        $valid = false;
    }

    if (empty($password)){
        $passwordError = 'Please enter a password';
        $valid = false;
    }

    if (empty($repassword)){
        $repasswordError = 'Please reenter the password';
        $valid = false;
    }

    if (!empty($password) && !empty($repassword) && $password != $repassword){
        $repasswordError = "Passwords don't match";
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    //check if the user already exists
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT email FROM users WHERE email='$email'";

    foreach($pdo->query($sql) as $row)
        if($row['email'] == $email){
            $emailError = 'User already exists';
            $valid = false;
        }
    Database::disconnect();

    if ($valid){
        $salt = "8dC_9Kl?";
        $encrypted_password = md5($password . $salt);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username, password, email) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $encrypted_password, $email));
        Database::disconnect();
        header("Location: index.php");
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
            <a class="navbar-brand" href="#">Registeration</a>
        </div>
    </div>
</div>

<div class="container">

    <form class="form-horizontal" action="register.php" method="post">
        <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">Username</label>
            <div class="controls">
                <input name="name" type="text"  placeholder="Username" value="<?php echo !empty($name)?$name:'';?>">
                <?php if (!empty($nameError)): ?>
                    <span class="help-inline"><?php echo $nameError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
            <label class="control-label">Password</label>
            <div class="controls">
                <input name="password" type="password"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>">
                <?php if (!empty($passwordError)): ?>
                    <span class="help-inline"><?php echo $passwordError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group <?php echo !empty($repasswordError)?'error':'';?>">
            <label class="control-label">Re-enter Password</label>
            <div class="controls">
                <input name="repassword" type="password"  placeholder="Re-enter Password" value="<?php echo !empty($repassword)?$repassword:'';?>">
                <?php if (!empty($repasswordError)): ?>
                    <span class="help-inline"><?php echo $repasswordError;?></span>
                <?php endif; ?>
            </div>
        </div>


        <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
            <label class="control-label">Email Address</label>
            <div class="controls">
                <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                <?php if (!empty($emailError)): ?>
                    <span class="help-inline"><?php echo $emailError;?></span>
                <?php endif;?>
            </div>
        </div>

        <br>

        <div class="form-actions">
            <button type="submit" class="btn btn-large btn-primary">Register!</button>
            <a class="btn btn-large" href="index.php">Back</a>

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