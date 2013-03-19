<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Handy Car Loans</title>
		<meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/flick/jquery-ui-1.9.2.custom.min.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/fullcalendar.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/unicorn.main.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/unicorn.grey.css" class="skin-color" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/datepicker.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/uniform.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/jquery.gritter.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/backend/admin.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/backend/validate.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/colorbox/colorbox.css" />
	</head>
	<body>


		<div id="header">
			<h1><a href="./dashboard.html">Unicorn Admin</a></h1>
		</div>

        <form action="<?php echo site_url('admin/search/result'); ?>" method="post" id="form-search-top">
            <div id="search">
                <input type="text" placeholder="Search here..." name="search-for-top"/><button type="submit" class="tip-right" title="Search"><i class="icon-search icon-white"></i></button>
            </div>
        </form>

		<div id="user-nav" class="navbar navbar-inverse">
			<span id="header-welcome">
				Welcome back <?php echo ucfirst($this->session->userdata('user')); ?>
			</span>
            <ul class="nav btn-group">
                <li class="btn btn-inverse"><a title="" href="<?php echo site_url('admin/logout'); ?>"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
            </ul>
        </div>