<?php

/*
To configure the database connection:

- Create a file called db.php inside the includes folder

Create a new PDO object with your database information

Set the instance of the PDO object equal to $conn

IE:
*/
try {
	$conn = new PDO('mysql:host=host_name;dbname=database_name', 'user_name', 'user_password');
} catch (PDOException $e){
	die($e->getMessage());
}