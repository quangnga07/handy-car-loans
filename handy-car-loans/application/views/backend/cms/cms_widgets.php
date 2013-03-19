<div id="content">
	<div id="content-header">
		<h1>Widget Control</h1>
		<div class="btn-group">

		</div>
	</div>
	
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="">CMS</a>
		<a href="#" class="current">Widget Control</a>
	</div>
	
	<div class="container-fluid">	
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url(); ?>admin/cms/add_widget">
					<button class="btn">Add Widget</button>
				</a>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-th-large"></i>
						</span>
						<h5>Widgets</h5>
					</div>

					<div class="widget-content nopadding">
							<?php foreach($widgets as $widget):?>
								<div style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
											<label><?php echo $widget->widget_title?></label>
											<a class="btn btn-success btn-mini widget_edit_button" href="<?php echo base_url(); ?>/admin/cms/add_widget/<?php echo @$widget->id;?>">Edit</a>
								</div>
						  <?php endforeach;?>
					</div>
				</div>
			</div>
		</div>


		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>


