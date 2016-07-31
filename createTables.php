
<?php

$sshName = "localhost";
$userName = "joung1";
$passWord = "joung1";
$dbName = "joung1";


// create connection
$connect = mysqli_connect($sshName, $userName, $passWord, $dbName);


// check connection
if(!$connect){

	die("Connection failed:" . mysqli_connect_error());

}

// http://www.w3schools.com/php/php_mysql_create_table.asp

// Iptional Attributes for each column:

// 		NOT NULL - Each row must contain a value for that column, null values are not allowed
// 		DEFAULT value - Set a default value that is added when no other value is passed
// 		UNSIGNED - Used for number types, limits the stored data to positive numbers and zero
// 		AUTO INCREMENT - MySQL automatically increases the value of the field by 1 each time a new record is added
// 		PRIMARY KEY - Used to uniquely identify the rows in a table. The column with PRIMARY KEY setting is often an ID number, and is often used with AUTO_INCREMENT


// sql to create table

$sql = "CREATE TABLE Music(
	
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	artist VARCHAR(30) NOT NULL,
	album VARCHAR(30) NOT NULL,
	reg_
	date TIMESTAMP
	)";


// $sql = "INSERT INTO MyGuests (firstname, lastname, email)
// VALUES ('John', 'Doe', 'john@example.com')";


if (mysqli_query($connect, $sql)){

	echo "Table Music created successfully";

} else {

	echo "Error creating table: " . mysqli_error($connect);
	
}



mysqli_close($connect);

?>


