<?php include "includes/header.php"; ?>
<body class="index-page">
<?php include "includes/navigation.php"; ?>
<div class="wrapper">
    <div class="header " style="background-image: url('https://hd.unsplash.com/photo-1466840787022-48e0ec048c8a');">
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
	    	            <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Date</label>
                                        <input class="datepicker form-control" type="text" value="<?php echo date("m/d/Y"); ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Location</label>
                                        <input type="text" value="" placeholder="Rudee's" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Distance <small>(miles)</small></label>
                                        <input type="number" value="" placeholder="4.2" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="">Duration <small>(minutes)</small></label>
                                        <input type="number" value="" placeholder="112" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                       <input name="" class="btn btn-info" type="submit" value="Submit">
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