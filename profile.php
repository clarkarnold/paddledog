<?php include "includes/header.php"; ?>
<?php

if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 

    $user_id = $_SESSION['user_id'];

    $access_profile = select_users($user_id);

    

while($row = mysqli_fetch_assoc($access_profile)){
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_id    = $row['user_id'];
    $user_image = $row['user_image'];
}

$query = "SELECT * FROM paddles WHERE paddle_user = {$user_id}";
$get_paddle_query = mysqli_query($connection,$query);
confirm($get_paddle_query);


$total_distance = 0;
$total_duration = 0;
$total_paddles = 0;
while($row = mysqli_fetch_assoc($get_paddle_query)){
    $total_paddles++ ;
    $total_distance += $row['paddle_distance'];
    $total_duration += $row['paddle_duration'];
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
	                            
								<a href="add_paddle.php?u_id=<?php echo $user_id; ?>" class="btn btn-primary btn-large">Add Paddle</a>
                        <a href="edit_profile.php?u_id=<?php echo $user_id; ?>" class="btn btn-info btn-large">Edit Profile</a>
	                        </div>
	                    </div>
	                </div>


					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h2>All Time Totals</h2>
                            
                            <table class="table">
							    <thead>
                                    <tr>
                                        
                                        <th>Outings</th>
                                        <th>Distance</th>
                                        <th>Duration</th>
                                     </tr>
							    </thead>
							    <tbody>
                                   <!--Add loop here-->
                                    
                                    <tr>
                                        
                                        <td><?php echo $total_paddles; ?></td>
                                        <td><?php echo $total_distance; ?> miles</td>
                                        <td><?php echo $total_duration; ?> minutes</td>
                                    </tr>
                                        
							    </tbody>
							</table>
							<!-- End Profile Tabs -->
						</div>
	                </div>

	                <div class="row">
	                    <div class="col-md-6 col-md-offset-3">
                            <h3>Recent Paddles</h3>
	                        <table class="table table-hover">
							    <thead>
							        <tr>
							        <th>Image</th>
							        <th>Date</th>
							        <th>Location</th>
							        <th>Distance</th>
							        <th>Duration</th>
							         <th class="td-actions text-right">Actions</th>
							         </tr>
							         
							    </thead>
							    <tbody>
                                
                                   
                                   <?php
                                    
                                    view_all_paddles($user_id);
                                    
                                  ?> 

							    </tbody>
							    
							</table>
	                    </div>
	                </div>

	            </div>
	        </div>
		</div>

<script>
  
</script>
<?php
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM paddles WHERE paddle_id = {$id}";
    $delete_paddle = mysqli_query($connection,$query);
    confirm($delete_paddle);
    header("Location: profile.php");
}

?>
<?php include "includes/footer.php"; ?>