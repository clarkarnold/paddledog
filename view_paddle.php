<?php include "includes/header.php"; ?>
<body class="profile-page">
<?php include "includes/navigation.php"; ?>
<?php
    if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 
    
    
    if (isset($_GET['p_id'])){
        $paddle_id = $_GET['p_id'];
        $query = "SELECT * FROM paddles WHERE paddle_id = {$paddle_id}";
        
        $all_paddles = mysqli_query($connection, $query);
        confirm($all_paddles);
        
        while($row = mysqli_fetch_assoc($all_paddles)){
            $paddle_date = date("m-d-Y", strtotime($row['paddle_date']));
            $paddle_location = $row['paddle_location'];
            $paddle_distance = $row['paddle_distance'];
            $paddle_duration = $row['paddle_duration'];
            $paddle_image    = $row['paddle_image'];
            $paddle_notes    = $row['paddle_notes'];
        }
    }
    
    
    ?>
<div class="wrapper">
		<div class="header header-filter" style="background-image: url('https://hd.unsplash.com/photo-1428534302776-5c6a2dca0380');"></div>

		<div class="main main-raised">
			<div class="profile-content">
	            <div class="container">
	                <div class="row">
	                    <div class="profile">
	                        <div class="avatar">
                               
                                <img src="images/<?php echo $paddle_image; ?>" alt="Circle Image" class="img-rounded img-responsive img-raised">
                                

                            
                            
                            </div>
                            <div class="name">
                                <h1 class="">Paddle on: <?php echo $paddle_date; ?></h1>
                            </div>
                            <div class="row text-info">
                                <div class="col-sm-4"><h2>Location</h2></div>
                                <div class="col-sm-4"><h2>Distance</h2></div>
                                <div class="col-sm-4"><h2>Duration</h2></div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-4"><h3><?php echo $paddle_location; ?></h3></div>
                                <div class="col-sm-4"><h3><?php echo $paddle_distance; ?></h3></div>
                                <div class="col-sm-4"><h3><?php echo $paddle_duration; ?></h3></div>
                                
                            </div>
                            <div class="row">
                                <h2 class="text-info">Notes</h2>
                            </div>
                            <div class="row">
                                <h3><?php echo $paddle_notes; ?></h3>
                            </div>
                            <div class="" style="height: 50px;"></div>
                            <div class="row"
                               <div class="">
                                <div class="col-sm-3 col-sm-offset-3"><a href="edit_paddle.php?p_id=<?php echo $paddle_id; ?>" class="btn btn-info">Edit Paddle</a></div>
                                <div class="col-sm-3"><a href="profile.php?delete=<?php echo $paddle_id; ?>" class="btn btn-danger">Delete Paddle</a></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
    </div>

</body>
    
<?php include "includes/footer.php"; ?>