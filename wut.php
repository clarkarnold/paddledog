<!DOCTYPE html>
<?php
include "includes/header.php";


$user_email = trim("'or '1' = '1");
       $user_email = strip_tags($user_email);
       $user_email = htmlspecialchars($user_email);
echo "<h1>" . $user_email . "</h1>";

echo mysqli_real_escape_string($connection,$user_email);

?>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>