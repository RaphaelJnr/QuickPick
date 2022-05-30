<!DOCTYPE html>
<html lang="en">
<head>
	<title>QP Dashboard</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="../backend/signup/logout.inc.php" method="POST">

				<p class="login100-form-title" style="font-size:0.8rem; color:Gainsboro;text-transform: capitalize;">

						<?php 
							session_start(); 
							if(!isset($_SESSION['name']) && !isset($_SESSION['verify_status'])){
								echo "COULDNT FIND SESSION";
								header('location: ./login.php?error=990');
							} else{
								
								$name =  $_SESSION['name'];
								$ver  =  $_SESSION['verification_status'];

								if($ver==false){
									echo "<b>$name</b><i class='fa fa-window-close ml-1' style='font-size:0.6rem; color:red'>unverified</i>";
								}else{
									echo "<b>$name</b><i class='fa fa-certificate ml-1' style='font-size:0.6rem; color:lime'>verified</i>";
								}
							}

							
						?>
				</p>
				
					<p class="login100-form-title">
						DOWNLOAD OUR APP TO PROCEED 
					</p>

					<div style="justify-content:center;">
						<i class="fa fa-mobile-phone" style="font-size:10rem; color:skyblue"></i>
					</div>


					<div class="container-login100-form-btn">
					<button id="submit" name="submit" class="login100-form-btn">
						LogOut
					</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->

	<!-- REMOVING AUTHENTICATION JAVASCRIPT -->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>