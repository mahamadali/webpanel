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
		deleteURL($_GET['delete_id']);
		$message = json_encode(array('text' => 'URL successfully deleted. You can add more URLs.','icon' => 'fa-check','type' => 'danger'));
		$app->setSession('message',$message);
		$app->redirect('urls.php');
	}
	$urls = get_urls(false,NULL,NULL,$searchWith);
	$rec_count = count($urls);
	include_once('layouts/pagination-top.php');
	$urls = get_urls(true,$offset,$rec_limit,$searchWith);

?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<div class="row">
							<div class="col-sm-9">
								<h4 class="title">URLs</h4>
								<p class="category">URL list</p>
							</div>
							<div class="col-sm-3 pull-right">
								<a href="add_url.php" class="btn btn-fill btn-primary pull-right"><span><i class="fa fa-plus"></i></span>&nbsp; Add new URLs </a>
							</div>
						</div>
					</div>
					<div class="content table-responsive table-full-width">
						<div class="row">
							<form method="" action="">
								<div class="col-md-3 ml-1">
									<input type="text" class="form-control border-input" name="filter_keyword" value="<?php if(!empty($_GET['filter_keyword'])) { echo $_GET['filter_keyword']; } else { echo ''; } ?>" placeholder="Filter by url" />
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
								<th>URL</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php
								if(count($urls) == 0) {
									?>
										<tr>
											<td colspan="6">No records found</td>
										</tr>
									<?php
								}
								else {
									foreach ($urls as $key => $url) {
										?>
											<tr>
												<td>
													<?php echo $url->url; ?>
												</td>
												<td>
													<a href="?delete_id=<?php echo $url->id; ?>" class="btn btn-danger confirm">Delete</a>
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