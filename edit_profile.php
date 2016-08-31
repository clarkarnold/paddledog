<?php include "includes/header.php"; ?>
<?php

if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 

if(isset($_GET['u_id'])){
    $user_id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    $user_data = mysqli_query($connection, $query);
    confirm($user_data);
    
    while($row=mysqli_fetch_assoc($user_data)){

        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_image = $row['user_image'];
    }
    
}


if(isset($_POST['edit_user'])){
    $user_email = trim($_POST['user_email']);
   $user_email = strip_tags($user_email);
   $user_email = htmlspecialchars($user_email);
    
    $user_name = trim($_POST['user_name']);
    $user_name = strip_tags($user_name);
    $user_name = htmlspecialchars($user_name);
    

    
    if(!empty($_POST['user_password'])){
        $user_password = trim($_POST['user_password']);
        $user_password = strip_tags($user_password);
        $user_password = htmlspecialchars($user_password);
        
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    }
    
    $user_image_edit = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    if(empty($user_image_temp)){
        $user_image_edit = $user_image;
    } else {
        move_uploaded_file($user_image_temp, "images/$user_image_edit");
    }
    
    $query = "UPDATE users SET user_name = '{$user_name}', user_email = '{$user_email}', user_password = '{$hashed_password}', ";
    $query .= "user_image = '{$user_image_edit}' WHERE user_id = {$user_id}";
    
    $update_profile_query = mysqli_query($connection, $query);
    confirm($update_profile_query);
    
    header("Location: profile.php");
}








?>
<body class="profile-page">
<?php include "includes/navigation.php"; ?>
<div class="wrapper">
		<div class="header header-filter" style="background-image: url('https://hd.unsplash.com/photo-1428534302776-5c6a2dca0380');"></div>

		<div class="main main-raised">
			<div class="profile-content">
	            <div class="container">
	                <div class="row">
	                    <div class="profile">
	                        <div class="avatar">
	                            <img src="images/<?php echo $user_image; ?>" alt="Circle Image" class="img-circle img-responsive img-raised">
	                        </div>
	                        <div class="name">
	                            <h3 class="title">Welcome <?php echo $user_name; ?></h3>
	
	                        </div>
	                    </div>
	                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="content">
                                <div class="input-group">
                                
										<span class="input-group-addon">
											<i class="material-icons">email</i>
										</span>
										<input name="user_email" type="email" class="form-control" value="<?php echo $user_email; ?>">
									</div>
                                <span class="text-danger"></span>
                                <div class="input-group">
								<span class="input-group-addon">
										<i class="material-icons">face</i>
									</span>
									<input name="user_name" type="text" class="form-control" value="<?php echo $user_name; ?>">
								</div>
                                <span class="text-danger"></span>
                                <div class="input-group">
								<span class="input-group-addon">
										<i class="material-icons">lock</i>
									</span>
									<input name="user_password" type="password" class="form-control" value="" placeholder="Enter new password">
								</div>
                                <span class="text-danger"></span>
                                <div class="input-group">
                                  <span class="input-group-addon">
										<i class="material-icons">insert_photo</i>
									</span>
                                   <label for="user_image">Change Image</label>
                                    <input class="" type="file" name="user_image" value="<?php echo $user_image ?>">
                                </div>
                                <div class="row"></div>
                                <div class="col-sm-8 col-sm-offset-2">
                                    <input  type="reset" value="Reset" class="btn btn-danger">
                                    <input  type="submit" value="Submit" class="btn btn-success" name="edit_user">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>





	            </div>
	        </div>
		</div>

<script>
  
</script>

<?php include "includes/footer.php"; ?>