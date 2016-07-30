<?php

 // this will avoid mysql_connect() deprecation error, 
 error_reporting( ~E_ALL & ~E_DEPRECATED &  ~E_NOTICE );
 
 define('dbHost', 'localhost');
 define('dbUser', 'joung1');
 define('dbPassword', 'joung1');
 define('dbName', 'joung1');
 
 $connect = mysql_connect(dbHost,dbUser,dbPassword);
 $dbConnect = mysql_select_db(dbName);
 
 if ( !$connect ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbConnect ) {
  die("Database Connection failed : " . mysql_error());
 }

?>
