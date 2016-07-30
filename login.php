

<?php
 ob_start();
 session_start();
 require_once 'dbConnect.php';
 
 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: main.php");
  exit;
 }
 
 if( isset($_POST['btn-login']) ) { 
  
  $userEmail = $_POST['userEmail'];
  $userPassword = $_POST['userPassword'];
  
  $userEmail = strip_tags(trim($userEmail));
  $userPassword = strip_tags(trim($userPassword));
  
  $userPassword = hash('sha256', $userPassword); // password hashing using SHA256
  
  $res=mysql_query("SELECT userId, userName, userPassword FROM Users WHERE userEmail='$userEmail'");
  
  $row=mysql_fetch_array($res);
  
  $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
  
  if( $count == 1 && $row['userPassword']==$userPassword ) {
   $_SESSION['user'] = $row['userId'];
   header("Location: main.php");
  } else {
   $errMSG = "Wrong Credentials, Try again...";
  }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="login_style.css" type="text/css" />
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign In.</h2>
            </div>
        
         <div class="form-group">
            <hr/>
         </div>
            
            <?php
                if ( isset($errMSG) ) {
                    
                    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="userEmail" class="form-control" placeholder="Your Email" required />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="userPassword" class="form-control" placeholder="Your Password" required />
                </div>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="register.php">Sign Up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

</body>
</html>