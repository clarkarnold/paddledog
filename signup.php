<?php include "includes/header.php"; ?>
<body class="signup-page">
<?php include "includes/navigation.php"; ?>
<?php
    
if(isset($_SESSION['user_id'])){
    header("Location: profile.php");
} 
    
    
    $nameError = ""; $emailError=""; $passError="";
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
       } else if (!preg_match('/^[a-zA-Z ]+$/',$user_name)){
           $error = true;
           $nameError = "Name must contain letters and spaces.";
       }

       //email validation
       if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
           $error = true;
           $emailError = "Please enter valid email address.";
        } else {
           // check email exist or not
           
           $query = $conn->prepare("SELECT user_email FROM users WHERE user_email = :email");
           $query->bindparam(":email", $user_email);
           $query->execute();
           $count = $query->rowCount();
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
       $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

       if(!$error){

       $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password, user_image) 
                        VALUES(:name, :email, :password, 'user_default.png')");
       $stmt->bindparam(":name", $user_name);
       $stmt->bindparam(":email", $user_email);
       $stmt->bindparam(":password", $hashed_password);

       if($stmt->execute()){
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = :email");
        $stmt->bindparam(":email", $user_email);
        if($stmt->execute()){
          while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user_id = $row['user_id'];
          }
          $_SESSION['user_id'] = $user_id;
          header("Location: profile.php");
        }

       }

       
       }
   }
   ?>
<div class="header header-filter" style="background-image: url('https://hd.unsplash.com/photo-1428534302776-5c6a2dca0380'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<div class="header header-primary text-center">
									<h4>Sign Up</h4>

								</div>

								<div class="content">

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
										<input name="user_name" type="text" class="form-control" placeholder="Enter Name...">
										
									</div>
									<span class="text-danger"><?php if($nameError){ echo $nameError; } ?></span>
									


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

									<!-- If you want to add a checkbox to this form, uncomment this code

									<div class="checkbox">
										<label>
											<input type="checkbox" name="optionsCheckboxes" checked>
											Subscribe to newsletter
										</label>
									</div> -->
								</div>
								<div class="footer text-center">
								    <div class="row">
                                        <button class="btn btn-primary btn-large" type="submit" name="create_user">
                                            <i class="material-icons">person_add</i>
                                            Sign Up
                                        </button>
                                    </div>
                                    <div class="row">
                                        <small>Already have an account?</small><a href="signin.php" class="btn btn-simple btn-info btn-small">Sign In</a>
                                    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
    </div>


<?php include "includes/footer.php"; ?>
<?php ob_end_flush(); ?>