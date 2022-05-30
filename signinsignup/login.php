<!DOCTYPE html>
<html lang="en">
<head>
	<title>QP Login</title>
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

				<form class="login100-form validate-form" action="../backend/signup/login.check.php" method="POST">
					<span class="login100-form-title">
						Member Login
					</span>

					
					<div id="errorMessage" class="text-center p-b-10 text-danger font-weight-bold">
							<?php
								if(isset($_GET['error'])){
									if($_GET['error']=="101"){
										echo "Invalid Phone Number.";
									}else if($_GET['error']=="103"){
										echo "Password contains illegal characters";
									}else if($_GET['error']=="102"){
										echo "Phone Number does not exists";
									}else if($_GET['error']=="104"){
										echo "Incorrect Password";
									}else if($_GET['error']=="999"){
										echo "Fatal Error";
									}else if($_GET['error']=="990"){
										echo "Unauthorized Entry";
									}else if($_GET['error']=="1000"){
									echo "<span class='text-center p-b-10 text-success font-weight-bold'>Password Change Successful</span>";
								}
								}
							?>
					 </div>

					<div class="wrap-input100 validate-input" data-validate = "Valid Phone Number Needed">
						<input class="input100" type="Number" name="phone" placeholder="Phone Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
				
				
					
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button name="submit" id="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="font-weight-bold text-center p-t-12 text-light">
							<a class="txt1" href="./forgotPwd.php">Forgot Password</a>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-b-10">
						<a class="txt1" style="color:skyblue" href="signup.php">
							Create New Account?
							<i class="fa fa-long-arrow-left mt-5 m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<!-- <form action="">
					<div class="text-center p-t-136">
						<a class="txt2" href="signup.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form> -->

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