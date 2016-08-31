<?php include "includes/header.php"; ?>
<body class="signup-page">
<?php include "includes/navigation.php"; ?>
<?php
    
    if(isset($_SESSION['user_name'])) {
        header("Location: profile.php");
    }
    
    
$emailError=""; $passError=""; $errMsg = "";
   if (isset($_POST['sign_in'])){

       $user_email = trim($_POST['user_email']);
       $user_email = strip_tags($user_email);
       $user_email = htmlspecialchars($user_email);

       $user_password = trim($_POST['user_password']);
       $user_password = strip_tags($user_password);
       $user_password = htmlspecialchars($user_password);

       $error = false;



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
           
           $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
           $query = "SELECT * FROM users WHERE user_email = '{$user_email}'";
           
           $get_user_query = mysqli_query($connection,$query);
           while($row=mysqli_fetch_assoc($get_user_query)){
               $db_name = $row['user_name'];
               $db_password = $row['user_password'];
               $db_id = $row['user_id'];
               $db_email = $row['user_email'];
           }

           
           
           if (password_verify($user_password, $db_password)){
               $_SESSION['user_id'] = $db_id;
               header("Location: profile.php");
           } else {
               $errMsg = "Invalid email/password, try again.";
           }
           
           
       
       }
   }
   ?>
<div class="wrapper">
<div class="header header-filter" style="background-image: url('https://hd.unsplash.com/photo-1428534302776-5c6a2dca0380'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<div class="header header-info text-center">
									<h4>Sign In</h4>

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
                                    
                                    
                                    
									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input name="user_email" type="text" class="form-control" placeholder="Email...">
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
									    <button name="sign_in" type="submit" class="btn btn-info">
									        <i class="fa fa-sign-in"></i>
									        Sign In
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
    </div>


<?php include "includes/footer.php"; ?>
<?php ob_end_flush(); ?>