
<?php 

if(isset($_SESSION['user_id'])){
    header("Location: profile.php");
}



	$db_conn = require 'core/bootstrap.php';

	require Router::load('routes.php')
		->direct(Request::uri(), Request::method());	


?>

