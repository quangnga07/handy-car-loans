<div id="content">
	<div id="content-header">
		<h1>Menu Control</h1>
		<div class="btn-group">

		</div>
	</div>
	
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="">CMS</a>
		<a href="<?php echo site_url('admin/cms/widget_control');?>" class="current">Menu Control</a>
	</div>

	<div class="container-fluid">
		
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url();?>admin/cms/add_navigation">
					<button class="btn">Add Menu</button>
				</a>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-random"></i>
						</span>
						<h5>Menus</h5>
					</div>
					
					<div class="widget-content nopadding">
							<ul class="sortable_navigation">
							<?php foreach($navigations as $navigation):
							if($navigation->parent!=''){$style='style="margin-left:25px;"';}else{$style='';}
							?>
								<li <?php echo $style;?>   id="order_id_<?php echo $navigation->id;?>" class="nav_slide">
											<label><?php echo $navigation->title?></label>
											<a class="btn btn-success btn-mini navigation_edit_button" href="<?php echo base_url(); ?>/admin/cms/add_navigation/<?php echo @$navigation->id;?>">Edit</a>
											<?php if($navigation->parent==''):?>
											<a class="btn btn-info btn-mini navigation_edit_button" href="<?php echo base_url(); ?>/admin/cms/add_navigation/parent/<?php echo $navigation->uri;?>">Add Child</a>
											<?php endif;?>
											<a class="btn btn-danger btn-mini" href="<?php echo site_url('admin/cms/delete_navigation/'.$navigation->id); ?>">Delete</a>
								</li>
						  <?php endforeach;?>
						  	</ul>
					</div>
				</div>
			</div>
		</div>

		<style>
			.nav_slide { 
				background: #eee;
				padding: 5px;
				min-height:60px;
				border:1px dashed #ccc;
				margin:5px;
			}
		</style>

		<div class="row-fluid">
			<div id="footer" class="span12">

			</div>
		</div>
	</div>
</div>


