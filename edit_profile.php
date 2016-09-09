<?php include "includes/header.php"; ?>
<?php

if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_image = $row['user_image'];
        }
    }

    // $query = "SELECT * FROM users WHERE user_id = {$user_id}";
    // $user_data = mysqli_query($connection, $query);
    // confirm($user_data);
    
    // while($row=mysqli_fetch_assoc($user_data)){

    //     $user_name = $row['user_name'];
    //     $user_email = $row['user_email'];
    //     $user_password = $row['user_password'];
    //     $user_image = $row['user_image'];
    // }
    
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
        
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
    }
    
    $user_image_edit = $_FILES['user_image']['name'];
    $user_file_type  = $_FILES['user_image']['type'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    if(empty($user_image_temp)){
        $user_image_edit = $user_image;
    }

    $allowed_filetypes = array("jpg, png");
    $image_ext = explode(".", $user_image_edit);
        if( in_array(strtolower(end($image_ext)), $allowed_filetypes)){
            move_uploaded_file($user_image_temp, "images/$user_image_edit");
        } else {
            $image_error = "Only images allowed.";
        }
    

    $sql = "UPDATE users SET 
                user_name = :user, 
                user_email = :email, 
                user_password = :password, 
                user_image = '{$user_image_edit}' 
                WHERE user_id = $user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindparam(":user", $user_name);
    $stmt->bindparam(":email", $user_email);
    $stmt->bindparam(":password", $user_password);
    if($stmt->execute()){
        header("Location: profile.php");
    }


    // $query = "UPDATE users SET user_name = '{$user_name}', user_email = '{$user_email}', user_password = '{$user_password}', ";
    // $query .= "user_image = '{$user_image_edit}' WHERE user_id = {$user_id}";
    
    // $update_profile_query = mysqli_query($connection, $query);
    // confirm($update_profile_query);
    
    // header("Location: profile.php");
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
                                    <?php
                                        
                                        ?>    
                                </div>
                                <div class="row"></div>
                                <div class="text-center">
                                    <input  type="reset" value="Reset" class="btn btn-danger btn-simple">
                                    <input  type="submit" value="Submit" class="btn btn-success" name="edit_user">
                                </div>
                                <div class="row text-center">
                                    <p class="text-warning"><a href="edit_profile.php?deleteuser=<?php echo $user_id; ?>" class="text-danger">Delete Profile </a> (Warning: This cannot be undone.)</p>
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
<?php
    if(isset($_GET['deleteuser'])){
         $_GET['deleteuser'];
    }
    
    ?>

<?php include "includes/footer.php"; ?>