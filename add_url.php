<?php
include_once('layouts/header.php'); // Include header

if(empty($app->getSession('loggedin'))) {
	$app->redirect('login.php');
}

if(!empty($_POST['btnSubmitAddURL'])) {
	addUrl($_POST);
	$message = json_encode(array('text' => 'URL successfully added. You can add more URLs.','icon' => 'fa-check','type' => 'success'));
	$app->setSession('message',$message);
	$app->redirect('urls.php');
}

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Add URLs</h4>
						<p class="category"><?php echo SITE_TITLE; ?></p>
					</div>
					<div class="content">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="URL">URLs</label>
										<textarea class="form-control border-input" placeholder="URL1\nURL2\nURL3" name="url" id="URL" required="" rows="5"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitAddURL" value="btnSubmitAddURL" class="btn btn-info btn-fill btn-wd">Add URL</button>
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