<?php 
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('login.php');
	}

	if(empty($message['text']) && !empty($app->getSession('message'))) {
		$message = $app->getSession('message');
		$app->removeSession('message');
	}

	$searchWith = '';
	if(!empty($_GET['filter_keyword'])) {
		$searchWith = trim($_GET['filter_keyword']);
	}
	if(!empty($_GET['delete_id'])) {
		deleteAccount($_GET['delete_id']);
		$message = json_encode(array('text' => 'Account successfully deleted. You can add more Account.','icon' => 'fa-check','type' => 'danger'));
		$app->setSession('message',$message);
		$app->redirect('account_details.php');
	}

	$dummy_account_details = get_dummy_account_details(false,NULL,NULL,$searchWith);
	$rec_count = count($dummy_account_details);
	include_once('layouts/pagination-top.php');
	$dummy_account_details = get_dummy_account_details(true,$offset,$rec_limit,$searchWith);

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<div class="row">
							<div class="col-sm-9">
								<h4 class="title">Account Details</h4>
								<p class="category">Account details list</p>
							</div>
							<div class="col-sm-3 pull-right">
								<a href="add_dummy_account_details.php" class="btn btn-fill btn-primary pull-right"><span><i class="fa fa-plus"></i></span>&nbsp; Add New Account </a>
							</div>
						</div>
					</div>
					<div class="content table-responsive table-full-width">
						<div class="row">
							<form method="" action="">
								<div class="col-md-3 ml-1">
									<input type="text" class="form-control border-input" name="filter_keyword" value="<?php if(!empty($_GET['filter_keyword'])) { echo $_GET['filter_keyword']; } else { echo ''; } ?>" placeholder="Filter by email" />
								</div>
								<div class="col-md-3">
									<div class="form-grooup">
										<input type="submit" name="btnFilter" value="Search" class="btn btn-success" />
									</div>
								</div>
							</form>
						</div>
						<table class="table table-striped mt-2">
							<thead>
								<th>Email</th>
								<th>Password</th>
								<th>Running Status</th>
								<th>Account Live Status</th>
								<th>Matched Template</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
								if(count($dummy_account_details) == 0) {
									?>
										<tr>
											<td colspan="6">No records found</td>
										</tr>
									<?php
								}
								else {
									foreach ($dummy_account_details as $key => $dummy_account_detail) {
										?>
											<tr>
												<td>
													<?php echo $dummy_account_detail->email; ?>
												</td>
												<td>
													<?php echo $dummy_account_detail->password; ?>
												</td>
												<td>
													<?php echo get_status_text($dummy_account_detail->running_status); ?>
												</td>
												<td>
													<?php echo get_status_text($dummy_account_detail->active_dummy_account_status); ?>
												</td>
												<td>
													<?php 
														$template = getMatchedTemplate($dummy_account_detail->id);
														if(!empty($template)) {
															?>
																<img src="data:image/png;base64,<?php echo $template->image ?>" height="100" width="100" />
															<?php	
														}
														else {
															?>
																N/A		
															<?php
														}
													?>
												</td>
												<td>
													<button <?php if($dummy_account_detail->running_status == 1) { echo "disabled='disabled'"; } ?> class="btn btn-success start-api" data-email="<?php echo $dummy_account_detail->email; ?>" data-password="<?php echo $dummy_account_detail->password; ?>" data-id="<?php echo $dummy_account_detail->id; ?>" >Start</button>
													<a href="?delete_id=<?php echo $dummy_account_detail->id; ?>" class="btn btn-danger confirm">Delete</a>
												</td>
											</tr>
										<?php
									}
								}
								?>
							</tbody>
						</table>
					</div>
					<?php include_once('layouts/pagination-links.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include_once('layouts/footer.php'); // Include header
?>