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
		deleteProxy($_GET['delete_id']);
		$message = json_encode(array('text' => 'Proxy successfully deleted. You can add more proxies.','icon' => 'fa-check','type' => 'danger'));
		$app->setSession('message',$message);
		$app->redirect('proxies.php');
	}
	$proxies = get_proxies(false,NULL,NULL,$searchWith);
	$rec_count = count($proxies);
	include_once('layouts/pagination-top.php');
	$proxies = get_proxies(true,$offset,$rec_limit,$searchWith);

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<div class="row">
							<div class="col-sm-9">
								<h4 class="title">proxies</h4>
								<p class="category">Proxy list</p>
							</div>
							<div class="col-sm-3 pull-right">
								<a href="add_proxy.php" class="btn btn-fill btn-primary pull-right"><span><i class="fa fa-plus"></i></span>&nbsp; Add new Proxy </a>
							</div>
						</div>
					</div>
					<div class="content table-responsive table-full-width">
						<div class="row">
							<form method="" action="">
								<div class="col-md-3 ml-1">
									<input type="text" class="form-control border-input" name="filter_keyword" value="<?php if(!empty($_GET['filter_keyword'])) { echo $_GET['filter_keyword']; } else { echo ''; } ?>" placeholder="Filter by proxy" />
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
								<th>Proxy</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
								if(count($proxies) == 0) {
									?>
										<tr>
											<td colspan="6">No records found</td>
										</tr>
									<?php
								}
								else {
									foreach ($proxies as $key => $proxy) {
										?>
											<tr>
												<td>
													<?php echo $proxy->proxy; ?>
												</td>
												<td>
													<a href="?delete_id=<?php echo $proxy->id; ?>" class="btn btn-danger confirm">Delete</a>
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