<?php

    ob_start();
    session_start();

    if( isset($_SESSION['user'])!="" ) {
        header("Location: main.php");
    }

    include_once 'dbConnect.php';

    if(isset($_POST['btn-signup'])) {
    
        $userName = trim($_POST['userName']);
        $userEmail = trim($_POST['userEmail']);
        $userPassword = trim($_POST['userPassword']);
        
        $userName = strip_tags($userName);
        $userEmail = strip_tags($userEmail);
        $userPassword = strip_tags($userPassword);
        
        // password encrypt using SHA256();
        $userPassword = hash('sha256', $userPassword);
        
        // check email exist or not
        $query = "SELECT userEmail FROM Users WHERE userEmail='$userEmail'";
        $result = mysql_query($query);
        
        $count = mysql_num_rows($result); // if email not found then proceed
    
    if ($count==0) {
    
        $query = "INSERT INTO Users(userName,userEmail,userPassword) VALUES('$userName','$userEmail','$userPassword')";
        $res = mysql_query($query);
    
    if ($res) {
        $errTyp = "success";
        $errMSG = "successfully registered, you may login now";

    } else {
        $errTyp = "danger";
        $errMSG = "Something went wrong, try again later..."; 
    } 
    
    } else {
        $errTyp = "warning";
        $errMSG = "Sorry Email already in use ...";
    }
    
    }
?>

<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Create an account | ORCA BOX</title>

        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
        <link rel="stylesheet" href="register_style.css" type="text/css" />
    </head>

    <body>

    <div class="container">

    <div id="login-form">
        <form method="post" autocomplete="off">
        
        <div class="col-md-12">
            
            <div class="form-group">
                <h2 class="">Create an account</h2>
            </div>
            
            <div class="form-group">
            </div>
                
            <?php
                if ( isset($errMSG) ) {
        
            ?>

        <div class="form-group">
        <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
        </div>

    </div>

    <?php
    }
    ?>
                
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" name="userName" class="form-control" placeholder="Enter Username" required />
            </div>
        </div>
                
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                <input type="email" name="userEmail" class="form-control" placeholder="Enter Your Email" required />
            </div>
        </div>
                
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input type="password" name="userPassword" class="form-control" placeholder="Enter Password" required />
            </div>
        </div>
                
        <div class="form-group">     
        </div>
                
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Confirm</button>
        </div>
                
        <div class="form-group">
        </div>
                
        <div class="form-group">
            <a href="login.php">Already have an account? Log in.</a>
        </div>
            
        </div>
    
        </form>
        </div> 

    </div>

    </body>
</html>