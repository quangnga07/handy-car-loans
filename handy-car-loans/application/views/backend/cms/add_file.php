<div id="content">
	<div id="content-header">
		<h1><?php echo $text; ?> File</h1>
		<div class="btn-group">

		</div>
	</div>

	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>/admin/cms" class="">CMS</a>
		<a href="<?php echo base_url(); ?>admin/cms/manage_files">Media Library</a>
		<a href="#" class="current"><?php echo $text; ?> File</a>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url(); ?>admin/cms/manage_files">
					<button class="btn">Manage Media Library</button>
				</a>
			</div>
		</div>

		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box dashboard-box">
					<div class="widget-title dashboard-title">
						<span class="icon">
							<i class="icon-picture"></i>
						</span>
						<h5><?php echo $text; ?> File</h5>
					</div>

					<div class="widget-content nopadding">
						<form action="<?php echo base_url(); ?>/admin/cms/add_file/<?php echo @$id;?>" id="upload-form-media" method="post" class="form-horizontal" enctype="multipart/form-data" >

						  	<div style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
								<div class="widgetform">
									<div class="form">
										<div class="control-group">
											<label class="control-label">Name</label>
											<div class="controls">
												<input type="text" name="name" value="<?php echo @$file->name;?>" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Alternative Text</label>
											<div class="controls">
												<input type="text" name="alt_text" value="<?php echo @$file->alt_text;?>" />
											</div>
										</div>
													
										<div class="control-group">
											<label class="control-label">Upload</label>
											<div class="controls">
												<input type="file" name="filename" value="<?php echo @$file->filename;?>" />
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="control-group">
								<div class="controls">
									<input type="hidden" value="<?php echo $text; ?>" id="action_upload" />
									<button type="submit" name="save_exit" class="btn btn-primary upload-btn-media">Upload</button>
									<?php if( $text == 'Edit' ): ?>
									<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
									<?php endif; ?>
								</div>
							</div>
							<!--
							<div class="form-actions">
								<button type="submit" name="save_exit" class="btn btn-primary">Upload</button>
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


