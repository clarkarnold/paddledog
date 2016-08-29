<?php include "includes/header.php"; ?>
<?php

if(!isset($_SESSION['user_name'])){
    header("Location: signup.php");
} else {
    $name = $_SESSION['user_name'];
    $email = $_SESSION['user_email'];
    
    $query = "SELECT * FROM users WHERE user_name = '{$name}'";
    $access_profile = mysqli_query($connection, $query);
    confirm($access_profile);
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
	                            <img src="http://demos.creative-tim.com/material-kit/assets/img/christian.jpg" alt="Circle Image" class="img-circle img-responsive img-raised">
	                        </div>
	                        <div class="name">
	                            <h3 class="title"><?php echo $name; ?></h3>
								<a href="add_paddle.php" class="btn btn-primary btn-large">Add Paddle</a>
	                        </div>
	                    </div>
	                </div>


					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h2>All Time Totals</h2>
                            
                            <table class="table">
							    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Location</th>
                                        <th>Distance</th>
                                        <th>Duration</th>
                                     </tr>
							    </thead>
							    <tbody>
                                    <tr>
                                        <td>6.1.16</td>
                                        <td>First Landing</td>
                                        <td>4.3 mi</td>
                                        <td>96 min</td>
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
                                    <tr>
                                       <td><img src="http://www.nextrollout.com/wp-content/uploads/2014/11/Cool-Whatsapp-DP.jpg" alt="" class="img-rounded img-raised" height="50px"></td>
                                        <td>6.1.16</td>
                                        <td>First Landing</td>
                                        <td>4.3 mi</td>
                                        <td>96 min</td>
                                        <td class="text-right">
                                            <button type="button" rel="tooltip" title="Edit Entry" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Delete Entry" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                       <td><img src="http://www.nextrollout.com/wp-content/uploads/2014/11/Cool-Whatsapp-DP.jpg" alt="" class="" height="50px"></td>
                                        <td>6.1.16</td>
                                        <td>First Landing</td>
                                        <td>4.3 mi</td>
                                        <td>96 min</td>
                                        <td class="text-right">
                                            <button type="button" rel="tooltip" title="Edit Entry" class="btn btn-info btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" rel="tooltip" title="Delete Entry" class="btn btn-danger btn-simple btn-xs">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
							    </tbody>
							</table>
	                    </div>
	                </div>

	            </div>
	        </div>
		</div>





<?php include "includes/footer.php"; ?>