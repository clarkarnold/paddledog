<?php

return [
	'database' => [
		'name' => 'paddledog',
		'username' => 'root',
		'password' => '',
		'connection' => 'mysql:host=localhost',
		'options' => [
			PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
		]
	]
];