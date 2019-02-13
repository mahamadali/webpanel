<?php
include_once('layouts/header.php'); // Include header

if(empty($app->getSession('loggedin'))) {
	$app->redirect('login.php');
}

if(!empty($_POST['btnSubmitAddDummyAccountDetails'])) {
	addAccountTemplateMatching($_POST);
	$message = json_encode(array('text' => 'Account - Template pair is successfully set. You can set more pairs.','icon' => 'fa-check','type' => 'success'));
	$app->setSession('message',$message);
}

$dummy_account_details = get_dummy_account_details();
$template_details = get_template_details();

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Account => Template matching</h4>
						<p class="category"><?php echo SITE_TITLE; ?></p>
					</div>
					<div class="content">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="Username">Select Account</label>
										<select class="form-control border-input" name="dummy_account_id" required="">
											<option value="">Select Account</option>
											<?php 
												foreach ($dummy_account_details as $key => $dummy_account_detail) {
													?>
														<option value="<?php echo $dummy_account_detail->id ?>"><?php echo $dummy_account_detail->email ?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="password">Select Template</label>
										<select class="form-control border-input" name="template_id" required="">
											<option value="">Select template</option>
											<?php 
												foreach ($template_details as $key => $template_detail) {
													?>
														<option value="<?php echo $template_detail->id ?>"><?php echo $template_detail->text ?></option>
													<?php
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitAddDummyAccountDetails" value="btnSubmitAddDummyAccountDetails" class="btn btn-info btn-fill btn-wd">Save Match</button>
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