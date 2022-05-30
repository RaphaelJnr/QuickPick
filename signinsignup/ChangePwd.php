<!DOCTYPE html>
<html lang="en">
<head>
	<title>QP Forgot Pwd</title>
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

				<form class="login100-form validate-form" action="./../backend/signup/change.inc.php" method="POST">
					<span class="login100-form-title">
						Change Password
					</span>

					
					<div id="errorMessage" class="text-center p-b-10 text-danger font-weight-bold">
					<?php
							// 000 - UNAUTHORIZED GATEWAY
							// 10 - ILLEGAL CHARACTERS IN CODE
							// 101 - FATAL ERROR 
							// 111 - INCORRECT CODE

								if(isset($_GET['error'])){
									if($_GET['error']=="000"){
										echo "Unauthorized Gateway";
									}else if($_GET['error']=="11"){
										echo "Passswords Do not match";
									}else if($_GET['error']=="12"){
										echo "Not Accepting Password Less than 6 characters";
									}else if($_GET['error']=="111"){
										echo "Illegal characters in password";
									}
								}
							?>
					</div>
					
					
					<!-- VERIFICATION CODE -->
					<div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" name="password" type="password" name="" placeholder="Enter New Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-key" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "">
						<input class="input100" name="cpassword" type="password" name="" placeholder="Confirm Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
							
					</div>

					<!-- VERIFICATION -->
					<div class="container-login100-form-btn">
					<button id="submit" name="submit" class="login100-form-btn">
						RECOVER
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

</body>




</html>