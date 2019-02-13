<?php 
	include_once('include.php'); // Include all included files
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo SITE_TITLE; ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>" class="simple-text">
                    <?php echo SITE_TITLE; ?>
                </a>
            </div>

            <ul class="nav">
                <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('dashboard','index'))) { echo "active"; } ?>">
                    <a href="index.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('users','account_details','add_dummy_account_details'))) { echo "active"; } ?>">
                    <a href="account_details.php">
                        <i class="ti-user"></i>
                        <p>Account Details</p>
                    </a>
                </li>
                <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('template_details','add_template_details'))) { echo "active"; } ?>">
                    <a href="template_details.php">
                        <i class="ti-calendar"></i>
                        <p>Template Details</p>
                    </a>
                </li>
                <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('acount_template_matching'))) { echo "active"; } ?>">
                    <a href="acount_template_matching.php">
                        <i class="ti-settings"></i>
                        <p>Account -> Template Matching</p>
                    </a>
                </li>
                <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('urls'))) { echo "active"; } ?>">
                    <a href="urls.php">
                        <i class="ti-list"></i>
                        <p>URLs</p>
                    </a>
                </li>
                 <li class="<?php if(showTabActive($_SERVER['REQUEST_URI'],array('proxies'))) { echo "active"; } ?>">
                    <a href="proxies.php">
                        <i class="ti-list"></i>
                        <p>proxies</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="ti-settings"></i>
								<p>Settings</p>
                                <ul class="dropdown-menu">
                                <li><a href="logout.php">Logout</a></li>
                              </ul>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>