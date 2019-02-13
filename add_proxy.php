<?php
include_once('layouts/header.php'); // Include header

if(empty($app->getSession('loggedin'))) {
	$app->redirect('login.php');
}

if(!empty($_POST['btnSubmitAddProxy'])) {
	addProxy($_POST);
	$message = json_encode(array('text' => 'Proxy successfully added. You can add more proxies.','icon' => 'fa-check','type' => 'success'));
	$app->setSession('message',$message);
	$app->redirect('proxies.php');
}

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Add proxies</h4>
						<p class="category"><?php echo SITE_TITLE; ?></p>
					</div>
					<div class="content">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="URL">proxies</label>
										<textarea class="form-control border-input" placeholder="Proxy1\nProxy2\nProxy3" name="proxy" id="proxy" required="" rows="5"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitAddProxy" value="btnSubmitAddProxy" class="btn btn-info btn-fill btn-wd">Add Proxy</button>
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