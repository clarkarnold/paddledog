<?php include "includes/header.php"; ?>
<?php

if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 

    $user_id = $_SESSION['user_id'];

    //$access_profile = select_users($user_id);
    $access_profile = $pdo->selectStmt($user_id, 'users');

    while($row = $access_profile->fetch(PDO::FETCH_ASSOC)){
    	$user_name = $row['user_name'];
    	$user_email = $row['user_email'];
    	$user_id = $row['user_id'];
    	$user_image = $row['user_image'];
    }

    

// while($row = mysqli_fetch_assoc($access_profile)){
//     $user_name = $row['user_name'];
//     $user_email = $row['user_email'];
//     $user_id    = $row['user_id'];
//     $user_image = $row['user_image'];
// }
    $users_paddles = $pdo->selectPaddlesByUser($user_id);

    $total_distance = 0;
	$total_duration = 0;
	$total_paddles = 0;

    while($row = $users_paddles->fetch(PDO::FETCH_ASSOC)){
    	$total_paddles++;
    	$total_distance += $row["paddle_distance"];
    	$total_duration += $row["paddle_duration"];
    }


// $query = "SELECT * FROM paddles WHERE paddle_user = {$user_id}";
// $get_paddle_query = mysqli_query($connection,$query);
// confirm($get_paddle_query);



// while($row = mysqli_fetch_assoc($get_paddle_query)){
//     $total_paddles++ ;
//     $total_distance += $row['paddle_distance'];
//     $total_duration += $row['paddle_duration'];
// }

?>
<body class="profile-page">
<?php include "includes/navigation.php"; ?>
<div class="wrapper">
		<div class="header header-filter" style="background-image: url('images/wave.jpg'); background-position: bottom;"></div>

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
	                            
								<a href="add_paddle.php" class="btn btn-primary btn-large">Add Paddle</a>
                        <a href="edit_profile.php" class="btn btn-info btn-large">Edit Profile</a>
	                        </div>
	                    </div>
	                </div>


					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h2>All Time Totals</h2>
                            <div class="table-responsive">
                            <table class="table">
							    <thead class="">
                                    <tr class="">
                                        
                                        <th>Outings</th>
                                        <th>Distance</th>
                                        <th>Duration</th>
                                     </tr>
							    </thead>
							    <tbody>
                                   
                                    
                                    <tr>
                                        
                                        <td><?php echo $total_paddles; ?></td>
                                        <td><?php echo $total_distance; ?> miles</td>
                                        <td><?php echo $total_duration; ?> minutes</td>
                                    </tr>
                                        
							    </tbody>
							</table>
							</div>
							<!-- End Profile Tabs -->
						</div>
	                </div>

	                <div class="row">
	                    <div class="col-md-6 col-md-offset-3">
                            <h3>Recent Paddles</h3>
                            <div class="table-responsive">
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

                                   $users_paddles = $pdo->selectPaddlesByUser($user_id);

                                   if(count($users_paddles) > 0){

	                                   while($row = $users_paddles->fetch(PDO::FETCH_ASSOC)){
											$paddle_id       = $row['paddle_id'];
											$paddle_date     = date("m/d/Y", strtotime($row['paddle_date']));
											$paddle_location = $row['paddle_location'];
											$paddle_distance = $row['paddle_distance'];
											$paddle_duration = $row['paddle_duration'];
											$paddle_image    = $row['paddle_image'];

											if(empty($paddle_image)){
												$paddle_image = "paddle_default.jpg";
											}
										
	                                    
										echo "<tr >";
										echo "<td><a href='view_paddle.php?p_id={$paddle_id}' rel='tooltip' title='View Paddle'><img src='images/$paddle_image'' alt='' class='img-rounded img-raised' height='50px'></a></td>";
										echo "<td>$paddle_date</td>";
										echo "<td>$paddle_location</td>";
										echo "<td>$paddle_distance mi</td>";
										echo "<td>$paddle_duration min</td>";
										echo  "<td class='text-right'>
										<a rel='tooptip' title='Edit Paddle' href='edit_paddle.php?p_id={$paddle_id}' class='btn btn-info btn-simple btn-xs'>
										<i class='fa fa-edit'></i>
										</a>
										<a rel='tooltip' title='Delete Paddle' href='profile.php?delete={$paddle_id}' class='btn btn-danger btn-simple btn-xs'><i class='fa fa-times'></i></a>
										</td>";
										echo "</tr>";
									}
								}
                                    
                                  ?> 

							    </tbody>
							    
							</table>
                            </div>
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
    $query = "DELETE FROM paddles WHERE paddle_id = {$id} AND paddle_user = $user_id";
    $delete_paddle = mysqli_query($connection,$query);
    confirm($delete_paddle);
    header("Location: profile.php");
}

?>
<?php include "includes/footer.php"; ?>