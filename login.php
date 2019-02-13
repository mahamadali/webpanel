<?php

include(dirname(__FILE__).'/include.php');

if(!empty($app->getSession('loggedin'))) {
	header('Location:index.php');
}

$loginerror = 0;
if(isset($_POST['login'])) {
	extract($_POST);
	$loginResponse = login($_POST);
	if(!empty($loginResponse) && $loginResponse != 'false') {
		$app->setSession('loggedin',$loginResponse->id);
	}
	else {
		$loginerror = 1;
	}
}
?>

<html>
<head>
	<title><?php echo SITE_TITLE." - Login"; ?></title>
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
		height: 350px;
		border: 1px solid #9C9C9C;
		background-color: #EAEAEA;
	}
	#login .container #login-row #login-column #login-box #login-form {
		padding: 20px;
	}
	#login .container #login-row #login-column #login-box #login-form #register-link {
		margin-top: -54px;
	}
	.text-white {
		color: #fff;
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
						<form id="login-form" class="form" action="" method="post">
							<h3 class="text-center text-info">Login</h3>
							<?php
							if($loginerror == 1) {
								?>
								<div class="alert alert-danger">
									<strong>Email or Password Invalid!</strong>
								</div>
								<?php
							}
							?>
							<div class="form-group">
								<label for="username" class="text-info">Email:</label><br>
								<input type="email" name="username" id="username" class="form-control" required="">
							</div>
							<div class="form-group">
								<label for="password" class="text-info">Password:</label><br>
								<input type="password" name="password" id="password" class="form-control" required="">
							</div>
							<div class="form-group">
								<input type="submit" name="login" class="btn btn-info btn-md" value="Submit">
								<a href="register.php" class="pull-right">Click here to register</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>