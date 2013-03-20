<!DOCTYPE html>
<html>
	<head>
		<title><?php echo ( (!empty($header_data['pagetitle']) ? $header_data['pagetitle'] : 'Documents Required') ); echo ( (!empty($header_data['pagesubtitle']) ? ' | '.$header_data['pagesubtitle'] : '') ); ?></title>
		<meta charset="UTF-8" />
		<meta name="description" content="<?php echo @$meta_description;?>">
		<meta name="keywords" content="<?php echo @str_replace('"','',$meta_keywords);?>">
		<meta name="title" content="<?php echo @$meta_title;?>">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,300italic,600' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/flick/jquery-ui-1.9.1.custom.min.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/font-awesome.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/main.css" />
		<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/uniform.css" />
        <link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/uploadify.css" />
        <link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/custom-tooltip.css" />
	</head>

	<body>
		<div id="header">
			<div class="container">
				<div class="row">
					<div class="span12">
						<?php 
							$logo = explode( '/', $header_contents['logo_image'] );
							
							foreach ($header_alt_text as $key => $value) {
								
								if( in_array( $value, $logo ) ) {
									$alt_text_logo = $key;
									break;
								}
							}
						?>
						<h1>
							<a id="logo" href="<?php echo base_url(); ?>"> <img src="<?php echo $header_contents['logo_image']?>" alt="<?php echo $alt_text_logo; ?>" /> </a>
						</h1>

						<ul id="navigation">
							<?php 
							$navigations = $this->cms_frontend_model->get_navigations();
							foreach($navigations as $nav):
								if($nav->parent!='') continue;
								
								$childs = $this->cms_frontend_model->get_child_navigations($nav->uri);
								$class_li = '';
								$class_li_a = '';

								if(count($childs)>0){
								 	$class_li = 'class="dropdown" data-toggle="dropdown"';
								 	$class_li_a = 'class="dropdown-toggle" data-toggle="dropdown"';
								} else {
								 	$class_li = '';
									$class_li_a = '';
								} ?>
								
								<?php if($nav->link != ''):?>
									<li <?php echo $class_li;?>><a <?php echo $class_li_a;?> href="<?php echo base_url().$nav->link;?>"><?php echo $nav->title;?></a>
								<?php elseif($nav->link == '' && $nav->uri != ''): ?>
									<li <?php echo $class_li;?>><a <?php echo $class_li_a;?> href="<?php echo base_url().$nav->uri;?>"><?php echo $nav->title;?></a>
								<?php elseif($nav->link == '' && $nav->uri == ''): ?>
									<li <?php echo $class_li;?>><a <?php echo $class_li_a;?> href=""><?php echo $nav->title;?></a>
								<?php endif; ?>

								<?php if(count($childs)>0) { ?>
									<ul class="dropdown-menu" role="menu" aria-labelledby="loans">
										<?php foreach($childs as $child){?>
												<?php if($child->link!=''):?>
													<li ><a onclick="location.href=this.href;" href="<?php echo base_url().$child->link;?>"><?php echo $child->title;?></a>
												<?php endif;?>
												<?php if($child->link==''&&$child->uri!=''):?>
													<li><a onclick="location.href=this.href;" href="<?php echo base_url().$child->uri;?>"><?php echo $child->title;?></a>
												<?php endif;?>
										<?php } ?>
									</ul>
								<?php } ?>
							</li>
							<?php endforeach; ?>
						</ul>

						<div id="toll">
							<?php echo $header_contents['toll'];?>
						</div>
					</div>
				</div>
			</div>
		</div>