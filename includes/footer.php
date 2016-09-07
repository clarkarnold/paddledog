    <footer class="footer">
        <div class="container">
            <nav class="pull-left">
 
            </nav>
            <div class="copyright pull-right">
                &copy; 2016, made with <i class="fa fa-heart heart"></i> by <a href="http://www.clarnold.com" target="_blank">Clark</a>
            </div>
        </div>
    </footer>
</div>
</body>

	<!--   Core JS Files   -->
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script src="js/nouislider.min.js" type="text/javascript"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="js/bootstrap-datepicker.js" type="text/javascript"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="js/material-kit.js" type="text/javascript"></script>
	
	

<script>
    $(document).ready(function(){
        if($(window).width() < 788){
            $('#navbar').addClass("navbar-info");
            $('#navbar').removeClass("navbar-transparent");
        } else {
            $('#navbar').addClass("navbar-transparent");
            $('#navbar').removeClass("navbar-info");
        }
    });
</script>

</html>