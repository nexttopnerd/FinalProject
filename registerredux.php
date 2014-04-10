<?php

require 'database.php';

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
    $age = $_POST["age"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

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

    if (empty($age)){
        $ageError = 'Please enter your age';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    if (empty($phone)){
        $phone_db = NULL;
    }
    else $phone_db = $phone;

    if ($valid){
        $salt = "8dC_9Kl?";
        $encrypted_password = md5($password . $salt);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username, password, email_address, phone_number, age) values(?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $encrypted_password, $email, $phone_db, $age));
        Database::disconnect();
        header("Location: indexredux.php");
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

        /*.form-signin {
            max-width: 300px;
            padding: 19px 29px 29px;
            margin: 0 auto 20px;
            background-color: #fff;
            border: 1px solid #e5e5e5;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }*/
        .form-signin input[type="text"],
        .form-signin input[type="password"] {
            font-size: 16px;
            height: auto;
            margin-bottom: 15px;
            padding: 7px 9px;
            width:300px;
        }

    </style>
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
                                                                                                                                                                                          <form class="navbar-form pull-right">
    <input class="span2" type="text" placeholder="Email">
    <input class="span2" type="password" placeholder="Password">
    <button type="submit" class="btn">Sign in</button>
                                               </form><!--/.nav-collapse -->
        </div>
    </div>
</div>

<div class="container">

    </br>
    <form class="form-horizontal" action="registerredux.php" method="post">
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

                                                                                                      <div class="control-group <?php echo !empty($ageError)?'error':'';?>">
    <label class="control-label">Age</label>
                                      <div class="controls">
    <input name="age" type="text"  placeholder="Age" value="<?php echo !empty($age)?$age:'';?>">
    <?php if (!empty($ageError)): ?>
    <span class="help-inline"><?php echo $ageError;?></span>
                                                       <?php endif;?>
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

       <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
            <label class="control-label">Phone Number</label>
            <div class="controls">
                <input name="phone" type="text"  placeholder="Phone Number (Optional)" value="<?php echo !empty($phone)?$phone:'';?>">
                <?php if (!empty($phoneError)): ?>
                    <span class="help-inline"><?php echo $phoneError;?></span>
                <?php endif;?>
            </div>
       </div>


                                                                                                <div class="form-actions">
    <button type="submit" class="btn btn-large btn-primary">Register!</button>
    <a class="btn btn-large" href="indexredux.php">Back</a>

                                                                                                                </div>
    </form>

  </div>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap-transition.js"></script>
<script src="../assets/js/bootstrap-alert.js"></script>
<script src="../assets/js/bootstrap-modal.js"></script>
<script src="../assets/js/bootstrap-dropdown.js"></script>
<script src="../assets/js/bootstrap-scrollspy.js"></script>
<script src="../assets/js/bootstrap-tab.js"></script>
<script src="../assets/js/bootstrap-tooltip.js"></script>
<script src="../assets/js/bootstrap-popover.js"></script>
<script src="../assets/js/bootstrap-button.js"></script>
<script src="../assets/js/bootstrap-collapse.js"></script>
<script src="../assets/js/bootstrap-carousel.js"></script>
<script src="../assets/js/bootstrap-typeahead.js"></script>

</body>
</html>