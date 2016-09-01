<?php include "includes/header.php"; ?>
<?php 

if(isset($_SESSION['user_id'])){
    header("Location: profile.php");
}

?>
<body class="landing-page">

<!-- Navbar will come here -->
<?php include "includes/navigation.php"; ?>
<!-- end navbar -->

<div class="wrapper">
	<div class="header header-filter" style="background-image: url('https://hd.unsplash.com/photo-1416163162639-640c3319ea9c');">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<h1 class="title">PaddleDog</h1>
	                    <h4>Your personal paddle board tracker.</h4>
	                    <br />
	                    <a href="signup.php" class="btn btn-primary btn-raised btn-lg">
							 Sign Up
						</a>
						<a href="signin.php" class="btn btn-info btn-raised btn-lg">
							 Sign In
						</a>
					</div>
                </div>
            </div>
        </div>
	<!-- you can use the class main-raised if you want the main area to be as a page with shadows -->
	<div class="main">
		<div class="container">

			<!-- here you can add your content -->
			
		</div>
	</div>
</div>


<?php include "includes/footer.php"; ?>
