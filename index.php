<?php 
	include_once('layouts/header.php'); // Include header
	if(empty($app->getSession('loggedin'))) {
		$app->redirect('login.php');
	}
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title">Hello <?php echo ucfirst(get_user_meta($app->getSession('loggedin'), 'username')); ?></h4>
						<p class="category">Adminstration panel</p>
					</div>
					<div class="content">
						<div class="">
							<br />
							<p class="text-success">Welcome to our <?php echo SITE_TITLE; ?></p>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	include_once('layouts/footer.php'); // Include header
?>