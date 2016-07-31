
<?php

 ob_start();
 session_start();

 require_once 'dbConnect.php';
 
 if( !isset($_SESSION['user']) ) {
    header("Location: login.php");
    exit;
 }

 // select loggedin users detail
 $res=mysql_query("SELECT * FROM Users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);

?>


<!DOCTYPE>
<html>

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Welcome - <?php echo $userRow['userEmail']; ?></title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="main_style.css" type="text/css" />

  </head>

  <body>

      <div id="products_page">
        <a href="productTab.php">Products</a>
      </div>

      <ul class="nav navbar-nav navbar-right">
              
        <li class="dropdown">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-user"></span>&nbsp;Hello, <?php echo $userRow['userEmail']; ?>!&nbsp;<span class="caret"></span></a>

                <ul class="dropdown-menu">
                    <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                </ul>

        </li>

      </ul>

      
      <script src="assets/jquery-1.11.3-jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>
