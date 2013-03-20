<div id="content">
	<div id="content-header">
		<h1>Add Menu</h1>
		<div class="btn-group">

		</div>
	</div>
	
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="">CMS</a>
		<a href="<?php echo base_url(); ?>admin/cms/menu_control" class="">Menu Control</a>
		<a href="#" class="current">Add Menu</a>
	</div>

	<div class="container-fluid">
		
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url(); ?>admin/cms/menu_control">
					<button class="btn">Menu Control</button>
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
						<h5>Add Menu</h5>
					</div>
					
					<div class="widget-content nopadding">
						<form action="<?php echo base_url(); ?>/admin/cms/add_navigation/<?php echo @$id;?>" method="post" class="form-horizontal">

						  	<div style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">						  				
								<div class="widgetform">
									<div class="form">
										<div class="control-group">
											<label class="control-label">Menu Title</label>
											<div class="controls">
												<input type="text" name="title" value="<?php echo @$navigation->title;?>" />
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Page</label>
											<div class="controls">
												<select name="uri">
													<option value="">Select</option>
													<?php foreach($pages as $page):?>
													<option value="<?php echo $page->slug; ?>" <?php if (@$page->slug==@$navigation->uri){echo 'selected';}?>><?php echo $page->title;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label">Or Add Link</label>
											<div class="controls">
												<input type="text" name="link" value="<?php echo @$navigation->link;?>" />
											</div>
										</div>

										<!--
										<div class="control-group">
											<label class="control-label">Class Name</label>
											<div class="controls">
												<input type="text" name="class" value="<?php //echo @$navigation->class;?>" />
											</div>
										</div>
										-->

										<div class="control-group">
											<label class="control-label">Parent Page</label>
											<div class="controls">
												<select name="parent">
													<option value="">Select</option>
													<?php foreach($pages as $page):?>
													<option value="<?php echo $page->slug; ?>" <?php if (@$page->slug==@$navigation->parent){echo 'selected';}?>><?php echo $page->title;?></option>
													<?php endforeach;?>
												</select>
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


