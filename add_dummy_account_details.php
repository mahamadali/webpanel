<?php
include_once('layouts/header.php'); // Include header

if(empty($app->getSession('loggedin'))) {
	$app->redirect('login.php');
}

if(!empty($_POST['btnSubmitAddDummyAccountDetails'])) {
	addDummyAccountDetails($_POST);
	$message = json_encode(array('text' => 'Dummy account details successfully added. You can add more account details.','icon' => 'fa-check','type' => 'success'));
	$app->setSession('message',$message);
	$app->redirect('account_details.php');
}

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Add account details</h4>
						<p class="category"><?php echo SITE_TITLE; ?></p>
					</div>
					<div class="content">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="Username">Email</label>
										<input type="email" class="form-control border-input" placeholder="Email" name="email" value="" id="Email" required="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" class="form-control border-input" placeholder="Password" name="password" id="password" value="" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitAddDummyAccountDetails" value="btnSubmitAddDummyAccountDetails" class="btn btn-info btn-fill btn-wd">Add account</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include_once('layouts/footer.php'); // Include header
	?>