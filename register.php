<?php

include(dirname(__FILE__).'/include.php');

if(!empty($app->getSession('loggedin'))) {
	header('Location:index.php');
}

$registererror = 0;
$old = array();
if(isset($_POST['register'])) {
	extract($_POST);
	$registerResponse = register($_POST);
	if(!empty($registerResponse) && $registerResponse['status'] != 'failed') {
		$app->setSession('loggedin',$registerResponse['id']);
		$app->redirect('index.php');
	}
	else {
		$old = $registerResponse['old'];
		$registererror = 1;
	}
}
?>

<html>
<head>
	<title><?php echo SITE_TITLE." - Register"; ?></title>
	<script src="assets/js/jquery.min.js"></script>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="assets/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<!------ Include the above in your HEAD tag ---------->
	<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		background-color: #17a2b8;
		height: 100vh;
		font-family: 'Montserrat', sans-serif;
	}
	#login .container #login-row #login-column #login-box {
		margin-top: 120px;
		max-width: 600px;
		height: 450px;
		border: 1px solid #9C9C9C;
		background-color: #EAEAEA;
	}
	#login .container #login-row #login-column #login-box #register-form {
		padding: 20px;
	}
	#login .container #login-row #login-column #login-box #register-form #register-link {
		margin-top: -54px;
	}
	.text-white {
		color: #fff;
	}
	.error {
		color: red;
		font-weight: 800;
	}
</style>	
</head>

<body>
	<div id="login">
		<h3 class="text-center text-white pt-5"><?php echo SITE_TITLE; ?></h3>
		<div class="container">
			<div id="login-row" class="row justify-content-center align-items-center">
				<div id="login-column" class="col-md-6 col-md-offset-3">
					<div id="login-box" class="col-md-12">
						<form id="register-form" class="form" action="" method="post">
							<h3 class="text-center text-info">Register</h3>
							<?php
							if($registererror == 1) {
								?>
								<div class="alert alert-danger">
									<strong>Email already exists</strong>
								</div>
								<?php
							}
							?>
							<div class="form-group">
								<label for="username" class="text-info">Email:</label><br>
								<input type="email" name="username" id="username" class="form-control" required="" value="<?php if(!empty($old) && !empty($old['username'])) { echo $old['username']; } else { echo ''; } ?>">
							</div>
							<div class="form-group">
								<label for="password" class="text-info">Password:</label><br>
								<input type="password" name="password" id="password" class="form-control" required="">
							</div>
							<div class="form-group">
								<label for="cpassword" class="text-info">Confirm Password:</label><br>
								<input type="password" name="cpassword" id="cpassword" class="form-control">
								<span class="error password-error">Password and confirm password must be same.</span>
							</div>
							<div class="form-group">
								<input type="submit" name="register" class="btn btn-info btn-md" value="Submit">
								<a href="login.php" class="pull-right">Click here to login</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".error").hide();
			$("#password-error,#cpassword").on('blur',function() {
				var password = $("#password").val();
				var cpassword = $("#cpassword").val();
				if(password != cpassword) {
					$(".password-error").show();
				}
				else {
					$(".password-error").hide();
				}
			});
			$("#register-form").on("submit",function() {
				var password = $("#password").val();
				var cpassword = $("#cpassword").val();
				if(password != cpassword) {
					$(".password-error").show();
					return false;
				}
				else {
					$(".password-error").hide();
				}
			});
		});
	</script>
</body>
</html>