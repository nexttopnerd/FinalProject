<?php
@ob_start();
session_start();
?>
<?php

require '../resources/database.php';

if (!empty($_POST)){

    if(isset($_SESSION)):
        session_destroy();
    endif;

    $nameError = null;
    $passwordError = null;


    $name = $_POST["name"];
    $password = $_POST["password"];


    $valid = true;
    if (empty($name)){
        $nameError = 'Please enter a valid username';
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
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $encrypted_password));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        ini_set('session.save_path', '/home/projectnull/public_html/financialactivity/sessions');

        session_start();
        $_SESSION["userid"] = $data['userid'];
        $_SESSION["name"] = $name;
        header("Location: activityredux.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>My Financial Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>

        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
            width:300px;
        }

    </style>
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="#">My Financial Manager</a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>

<div class="container">

    </br>
    <form class="form-horizontal" action="login.php" method="post">
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

        <div class = "form-actions">
            <button type="submit" class="btn btn-primary">Login!</button>
            <a class="btn" href="indexredux.php">Back</a>
        </div>
    </form>
</div>
</body>
</html>