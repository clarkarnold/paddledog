<?php include "includes/header.php"; ?>
<body>

<div class="wrapper">
   <div class="jumbotron">
   <div class="container">
    <h1>Creating your profile...</h1>
    <h3>Please wait.</h3>
    <?php
       if (isset($_POST['create_user'])){
           $user_name = trim($_POST['user_name']);
           $user_name = strip_tags($user_name);
           $user_name = htmlspecialchars($user_name);
           
           $user_email = trim($_POST['user_email']);
           $user_email = strip_tags($user_email);
           $user_email = htmlspecialchars($user_email);
           
           $user_password = trim($_POST['user_password']);
           $user_password = strip_tags($user_password);
           $user_password = htmlspecialchars($user_password);
           
           $error = false;
           
           
           // name validation
           if(empty($user_name)){
               $error = true;
               $nameError = "Please enter your full name.";
           } else if (strlen($user_name) < 3) {
               $error = true;
               $nameError = "Name must have at least 3 characters.";
           } else if (!preg_match('/^[a-zA-Z ]+$/'),$name){
               $error = true;
               $nameError = "Name must contain letters and spaces.";
           }
           
           //email validation
           if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
               $error = true;
               $emailError = "Please enter valid email address.";
            } else {
               // check email exist or not
               $query = "SELECT user_email FROM users WHERE user_email='$user_email'";
               $result = mysql_query($query);
               $count = mysql_num_rows($result);
               if($count!=0){
                $error = true;
                $emailError = "Provided Email is already in use.";
               }
              }
           
           // password validation
           if(empty($user_password)){
               $error = true;
               $passError = "Please enter a password";
           } else if (strlen($user_password) < 6){
               $error = true;
               $passError = "Password must have at least 6 characters.";
           }
           
           // encrypt password
           $user_password = password_hash($user_password);
           
           if(!error){
          
           $query = "INSERT INTO users(user_name, user_email, user_password) ";
       
           $query .= "VALUES('{$user_name}', '{$user_email}', '{$user_password}')";
           
           $create_user_query = mysqli_query($connection, $query);
           confirm($create_user_query);
           
           header("Location: profile.php");
           }
       }
       ?>
    </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>