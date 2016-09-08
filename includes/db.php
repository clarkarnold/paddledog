<?php
// This is where the database connection will be.
// $db['db_host'] = "localhost";
// $db['db_user'] = "root";
// $db['db_pass'] = "";
// $db['db_name'] = "paddledog";

// foreach($db as $key => $value){
//     define(strtoupper($key), $value);
// }

// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if(!$connection) {
//     die($connection);
// }



try {
	$conn = new PDO('mysql:host=localhost;dbname=paddledog', 'root', '');
	// return new PDO(
	// 	$config['connection'] . "dbname=" . $config['name'],
	// 	$config['username'],
	// 	$config['password'],
	// 	$config['options']
	// 	);
	} catch (PDOException $e) {
	die($e->getMessage());
}





?>