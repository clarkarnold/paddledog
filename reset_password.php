<?php include "includes/header.php"; ?>
<body class="signup-page">
<?php include "includes/navigation.php"; ?>
<?php
    
    if(isset($_SESSION['user_id'])) {
        header("Location: profile.php");
    }
    
    
$emailError=""; $passError=""; $errMsg = "";
   if (isset($_POST['reset'])){
       
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
       
       
       //name validation
       if(empty($user_name)){
           $error = true;
           $nameError = "Please enter your full name.";
       } else if (strlen($user_name) < 3) {
           $error = true;
           $nameError = "Name must have at least 3 characters.";
       } else if (!preg_match('/^[a-zA-Z ]+$/',$user_name)){
           $error = true;
           $nameError = "Name must contain letters and spaces.";
       }



       //email validation
       if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
           $error = true;
           $emailError = "Please enter valid email address.";
        } else if (empty($user_email)){
           $error = true;
           $emailError = "Please enter your email address.";
       }

       // password validation
       if(empty($user_password)){
           $error = true;
           $passError = "Please enter your password";
       }

       // encrypt password
       

       if(!$error){
           
           echo $user_email . "<br>" . $user_name;
           
           $query = "SELECT * FROM users WHERE user_email = '{$user_email}' AND user_name = '{$user_name}'";
           
           $get_user_query = mysqli_query($connection,$query);
           confirm($get_user_query);
           while($row=mysqli_fetch_assoc($get_user_query)){
               $db_id = $row['user_id'];
           }

           
           $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
           
           $query = "UPDATE users SET user_password = '{$hashed_password}' WHERE user_id = {$db_id}";
           $reset_password = mysqli_query($connection, $query);
           confirm($reset_password);
           $_SESSION['user_id'] = $db_id;
            header("Location: profile.php");
           
           
           
       
       }
   }
   ?>
<div class="wrapper">
<div class="header header-filter" style="background-image: url('https://hd.unsplash.com/photo-1428534302776-5c6a2dca0380'); background-size: cover; background-position: bottom center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<div class="header header-success text-center">
									<h4>Reset your Password</h4>

								</div>
<?php
                                        if(!empty($errMsg)){
                                            echo "<div class='alert alert-danger center-block'>
                                        <div class='container-fluid'>
                                            <div class='alert-icon'>
                                                <i class='material-icons'>error_outline</i>
                                            </div>
                                            <button type='button' class='close' data-dismiss='alert' aria-label='close'>
                                                <span aria-hidden='true'>
                                                    <i class='material-icons'>clear</i>
                                                </span>
                                            </button>
                                            <b>ERROR:</b> $errMsg
                                        </div>
                                    </div>";
                                        }
                                    ?>
                            
                            
								<div class="content">
                                    
                                    
                                    
                                        <h5 class="text-center text-muted">Enter info used at sign up</h5>
                                    <div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input name="user_name" type="text" class="form-control" placeholder="Full Name">
									</div>
									
									
									
									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input name="user_email" type="text" class="form-control" placeholder="Email Address">
									</div>
									<span class="text-danger"><?php if($emailError){echo $emailError;} ?></span>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input name="user_password" type="password" placeholder="Password..." class="form-control" />
									</div>
									<span class="text-danger"><?php if($passError){echo $passError;} ?></span>

								</div>
								<div class="footer text-center">
								    <div class="row">   
									    <button name="reset" type="submit" class="btn btn-success">
									        <i class="fa fa-sign-in"></i>
									        Reset
									    </button>
								    </div>
								    <div class="row">
								        <small>Don't have an account?</small><a href="signup.php" class="btn btn-simple btn-primary btn-small">Sign Up</a>
								    </div>
								    
							</form>
						</div>
					</div>
				</div>
			</div>
    </div>


<?php include "includes/footer.php"; ?>
<?php ob_end_flush(); ?>