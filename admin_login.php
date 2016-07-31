

<?php 

session_start();

if (isset($_SESSION["manager"])) {

    header("location: index.php"); 
    exit();

}
?>

<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	  $manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters

    // Connect to the MySQL database  
    include "dbConnect.php"; 
    $sql = mysql_query("SELECT id FROM admin WHERE username='$manager' AND password='$password' LIMIT 1"); // query the person

    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysql_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
		 }

		 $_SESSION["id"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 header("location: index.php");
     exit();

    } else {
      echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
      exit();
	}
}

?>


<!DOCTYPE>
<html>
  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Administrator Login | ORCA BOX</title>

  </head>

<body>




<div align="center" id="mainWrapper">
  <div id="pageContent"><br/>
    <div align="left" style="margin-left:24px;">
      <h2>Please Log In To Manage the Store</h2>
      <form id="form1" name="form1" method="post" action="admin_login.php">
        User Name:<br/>
          <input name="username" type="text" id="username" size="40"/>
        <br /><br/>
        Password:<br/>
       <input name="password" type="password" id="password" size="40"/>
       <br/>
       <br/>
       <br/>
       
         <input type="submit" name="button" id="button" value="Log In"/>
       
      </form>
      <p>&nbsp; </p>
    </div>
    <br/>
  <br/>
  <br/>
 
</body>
</html>