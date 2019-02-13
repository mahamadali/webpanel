<?php
include_once('layouts/header.php'); // Include header

if(empty($app->getSession('loggedin'))) {
	$app->redirect('login.php');
}

$old = array();
if(!empty($_POST['btnSubmitAddDummyAccountDetails'])) {
	$templateResponse = addTemplateDetails($_POST,$_FILES);
	if(!empty($templateResponse) && $templateResponse['status'] == 'failed') {
		$message = json_encode(array('text' => $templateResponse['msg'],'icon' => 'fa-check','type' => 'danger'));
		$old = $templateResponse['old'];
	}
	else {
		$message = json_encode(array('text' => 'Template details successfully added. You can add more template details.','icon' => 'fa-check','type' => 'success'));
		$app->setSession('message',$message);
		$app->redirect('template_details.php');
	}
}

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Add template details</h4>
						<p class="category"><?php echo SITE_TITLE; ?></p>
					</div>
					<div class="content">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="Username">Image</label>
										<input type="file" class="form-control border-input" placeholder="Select image" name="image" value="" id="image" required="" accept="image/*">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<div class="form-group">
										<label for="password">Text</label>
										<textarea class="form-control border-input" name="text" placeholder="Enter text" rows="5" required=""><?php if(!empty($old) && !empty($old['text'])) { echo $old['text']; } else { echo ''; } ?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<button type="submit" name="btnSubmitAddDummyAccountDetails" value="btnSubmitAddDummyAccountDetails" class="btn btn-info btn-fill btn-wd">Add Template</button>
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