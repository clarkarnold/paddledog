<?php include "includes/header.php"; ?>
<?php

//if(!isset($_SESSION['user_name'])){
//    header("Location: signup.php");
//} else {
    $name = $_SESSION['user_name'];

    $access_profile = select_users($name);

    

while($row = mysqli_fetch_assoc($access_profile)){
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
	                            <h3 class="title">Welcome <?php echo $name; ?></h3>
	                            
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
	                        <table class="table">
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
      
                                  $query = "SELECT * FROM paddles WHERE paddle_user = {$user_id}";
                                  $get_all_paddles = mysqli_query($connection,$query);
                                  confirm($get_all_paddles);
                                    
                                if(mysqli_num_rows($get_all_paddles)>0){
                                    while($row = mysqli_fetch_assoc($get_all_paddles)){
                                        $paddle_id       = $row['paddle_id'];
                                        $paddle_date     = date("m-d-Y", strtotime($row['paddle_date']));
                                        $paddle_location = $row['paddle_location'];
                                        $paddle_distance = $row['paddle_distance'];
                                        $paddle_duration = $row['paddle_duration'];
                                        $paddle_image    = $row['paddle_image'];
                                        
                                        if(empty($paddle_image)){
                                            $paddle_image = "user_default.jpg";
                                        }
                                        
                                    
                                    echo "<tr>";
                                    echo "<td><img src='images/$paddle_image'' alt='' class='img-rounded img-raised' height='50px'></td>";
                                    echo "<td>$paddle_date</td>";
                                    echo "<td>$paddle_location</td>";
                                    echo "<td>$paddle_distance mi</td>";
                                    echo "<td>$paddle_duration min</td>";
                                    echo  "<td class='text-right'>
                                            <a href='edit_paddle.php?p_id={$paddle_id}' class='btn btn-info btn-simple btn-xs'>
							                     <i class='fa fa-edit'></i>
							                 </a>
                                            <a rel='tooltip' title='Delete Entry' href='profile.php?delete={$paddle_id}' class='btn btn-danger btn-simple btn-xs'><i class='fa fa-times'></i></a>
                                        </td>";
                                    echo "</tr>";
                                     } // end while
                                } else {
                                    echo "<tr><td>Nothing here?<a href='add_paddle.php?u_id=$user_id' class='btn btn-primary btn-large text-center'>Add a Paddle!</a></td></tr>";
                                } // end else?> 

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