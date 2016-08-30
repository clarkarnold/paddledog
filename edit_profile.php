<?php include "includes/header.php"; ?>
<?php

//if(!isset($_SESSION['user_name'])){
//    header("Location: signup.php");
//} else {

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
									<input name="user_password" type="password" class="form-control" value="<?php echo $user_password; ?>">
								</div>
                                <span class="text-danger"></span>
                                <div class="input-group">
                                   <label for="user_image">Change Image</label>
                                    <input class="" type="file" name="user_image" value="<?php echo $user_image ?>">
                                </div>
                                <div class="input-group">
                                    <input type="button" type="reset" value="Reset" class="btn btn-danger">
                                    <input type="button" type="submit" value="Submit" class="btn btn-success" name="edit_user">
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