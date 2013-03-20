
<div id="content">
	<div id="content-header">
		<h1><?php echo $text; ?> Widget</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms">CMS</a>
		<a href="<?php echo base_url(); ?>admin/cms/widget_control">Widget Control</a>
		<a href="#" class="current"><?php echo $text; ?> Widget</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url(); ?>admin/cms/widget_control">
					<button class="btn">Widget Control</button>
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
						<h5><?php echo $text; ?> Widget</h5>
					</div>

					<div class="widget-content nopadding">
						<form action="<?php echo base_url(); ?>/admin/cms/add_widget/<?php echo @$id;?>" method="post" class="form-horizontal">
							<div style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">			
								<div class="widgetform">
									<div class="form">
										<div class="control-group">
											<label class="control-label">Title</label>
											<div class="controls">
												<input type="text" name="widget_title" value="<?php echo @$widget->widget_title;?>" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Content html</label>
											<div class="controls">
												<textarea name="widget_content"><?php echo @$widget->widget_content;?></textarea>
												<?php echo display_ckeditor($ckeditor); ?>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Wrapper class</label>
											<div class="controls">
												<input type="text" name="widget_class" value="<?php echo @$widget->widget_class;?>" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
								</div>
							</div>
							<!--
							<div class="form-actions">
								<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
							</div>
							-->
						</form>
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


