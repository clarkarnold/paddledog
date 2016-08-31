<?php include "includes/header.php"; ?>
<body class="index-page">
<?php include "includes/navigation.php"; ?>
<?php
    
    if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 
    
    if(isset($_GET['p_id'])){
        $paddle_id = $_GET['p_id'];
        
        $query = "SELECT * FROM paddles WHERE paddle_id = {$paddle_id}";
        $get_paddle = mysqli_query($connection, $query);
        confirm($get_paddle);
        
        while($row = mysqli_fetch_assoc($get_paddle)){
            $paddle_date = date("m-d-Y", strtotime($row['paddle_date']));
            $paddle_location = $row['paddle_location'];
            $paddle_distance = $row['paddle_distance'];
            $paddle_duration = $row['paddle_duration'];
            $paddle_notes    = $row['paddle_notes'];
            $paddle_image    = $row['paddle_image'];
        }
    }
    
    
    if(isset($_POST['update_paddle'])){
        $paddle_date     = $_POST['paddle_date'];
        
        $paddle_location = $_POST['paddle_location'];
        $paddle_distance = $_POST['paddle_distance'];
        $paddle_duration = $_POST['paddle_duration'];
        $paddle_notes    = $_POST['paddle_notes'];
        
        $paddle_image_edit    = $_FILES['image']['name'];
        $paddle_image_temp = $_FILES['image']['tmp_name'];
        
        if(empty($paddle_image_temp)){
            $paddle_image_edit = $paddle_image;
        }
        
        move_uploaded_file($paddle_image_temp, "images/$paddle_image_edit");
        
        $query = "UPDATE paddles SET paddle_date = STR_TO_DATE('$paddle_date', '%m-%d-%Y'), paddle_location = '{$paddle_location}', ";
        $query .= "paddle_distance = {$paddle_distance}, paddle_duration = {$paddle_duration}, paddle_image = '{$paddle_image_edit}', paddle_notes = '{$paddle_notes}' WHERE paddle_id = {$paddle_id}";
        
        $edit_paddle_query = mysqli_query($connection, $query);
        confirm($edit_paddle_query);
        
    }
    ?>
<div class="wrapper">
    <div class="header " style="background-image: url('https://hd.unsplash.com/photo-1466840787022-48e0ec048c8a');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1>Edit Paddle</h1>
						
					</div>
				</div>
			</div>

		</div>
	</div>

		<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
	    	    <div class="row">
                <h3 class="text-center">Update Information</h3>
	    	        <div class="col-md-6 col-md-offset-3">
	    	            <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Date</label>
                                        <input name="paddle_date" class="datepicker form-control" type="text" value="<?php echo  $paddle_date; ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Location</label>
                                        <input name="paddle_location" type="text" value="<?php echo $paddle_location; ?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Distance <small>(miles)</small></label>
                                        <input name="paddle_distance" type="number" step="any" value="<?php echo $paddle_distance; ?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Duration <small>(minutes)</small></label>
                                        <input name="paddle_duration" type="number" value="<?php echo $paddle_duration; ?>" placeholder="" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6">
                                  
                                   <textarea name="paddle_notes" id="" cols="30" rows="2" class="form-control" placeholder="<?php echo $paddle_notes; ?>"></textarea>
                               </div>
                            <div class="col-md-6">
                                <div class="">
                                   <label for="">Image</label>
                                    <input type="file" name="image" value="images/<?php echo $paddle_image; ?>">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <input name="update_paddle" class="btn btn-info" type="submit" value="Submit">
                                        <input class="btn btn-danger btn-simple" type="reset" value="Reset">
                                    </div>
                                </div>
                            </div>
	    	            </form>
	    	        </div>
	    	    </div>


            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>










 