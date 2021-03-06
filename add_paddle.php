<?php include "includes/header.php"; ?>
<body class="index-page">
<?php include "includes/navigation.php"; ?>
<?php
    if(!isset($_SESSION['user_id'])){
    header("Location: signup.php");
} 
    
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
    
    if(isset($_POST['add_paddle'])){
        $paddle_date     = $_POST['paddle_date'];
        $paddle_location = $_POST['paddle_location'];
        $paddle_distance = $_POST['paddle_distance'];
        $paddle_duration = $_POST['paddle_duration'];
        $paddle_notes    = $_POST['paddle_notes'];

        // all image files
 
        $paddle_image = $_FILES['image']['name'];
        $paddle_image_temp = $_FILES['image']['tmp_name'];

        $allowed_filetypes = array('jpg', 'png');
        $file_ext = explode('.', $paddle_image);
        if( in_array(strtolower(end($file_ext)), $allowed_filetypes)){
            move_uploaded_file($paddle_image_temp, "images/$paddle_image");
        } else {
            $paddle_image = "paddle_default.jpg";
        }

        if(empty($paddle_image)){
            $paddle_image = 'paddle_default.jpg';
        }




        $sql = "INSERT INTO paddles(paddle_date, paddle_distance, paddle_duration, paddle_location, paddle_user, paddle_image, paddle_notes) VALUES(STR_TO_DATE('$paddle_date','%m/%d/%Y'), :distance, :duration, :location, :user, :image, :notes)";
        $stmt = $conn->prepare($sql);
        if(!$stmt){
            echo "no stmt<br>";
            print_r($conn->errorInfo());
        }

        $stmt->bindparam(":distance", $paddle_distance);
        $stmt->bindparam(":duration", $paddle_duration);
        $stmt->bindparam(":location", $paddle_location);
        $stmt->bindparam(":user", $user_id);
        $stmt->bindparam(":image", $paddle_image);
        $stmt->bindparam(":notes", $paddle_notes);

        try {
            if($stmt->execute()){
                header("Location: profile.php");
            }

        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        
        // $add_paddle_query = mysqli_query($connection, $query);
        // confirm($add_paddle_query);
        // header("Location: profile.php");
        
    }
    
    
    ?>
<div class="wrapper">
    <div class="header " style="background-image: url('images/guyanddog.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1>Add a Paddle</h1>
						
					</div>
				</div>
			</div>

		</div>
	</div>
		<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
	    	    <div class="row">
                <h3 class="text-center">Enter Information</h3>
	    	        <div class="col-md-6 col-md-offset-3">
	    	            <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Date</label>
                                        <input id="dates" name="paddle_date" class="datepicker form-control" type="text" value="<?php echo date("m/d/Y"); ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Location</label>
                                        <input name="paddle_location" type="text" value="" placeholder="Rudee's" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Distance <small>(miles)</small></label>
                                        <input name="paddle_distance" type="number" step="any" value="" placeholder="4.2" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Duration <small>(minutes)</small></label>
                                        <input name="paddle_duration" type="number" value="" placeholder="112" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-md-6">
                                  
                                   <textarea name="paddle_notes" id="" cols="30" rows="2" class="form-control" placeholder="Notes..."></textarea>
                               </div>
                                <div class="col-md-6">
                                        <div class="">
                                            <label for="paddle_image">Paddle Image</label>
                                            <input type="file" name="image" accept="image/jpg, image/png">
                                        </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <input name="add_paddle" class="btn btn-info" type="submit" value="Submit">
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










 