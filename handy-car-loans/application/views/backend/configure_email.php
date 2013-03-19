
<div id="content">
	<div id="content-header">
		<h1>Email Templates</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 
		Home</a>
		<a href="#" class="tip-bottom">Setting</a>
		<a href="#" class="current">Email Templates</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-edit"></i></span> <h5>Email #1</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo site_url('admin/configure/process_email_template'); ?>" method="POST" class="form-horizontal">
							<input type="hidden" name="id" value="<?php echo $email_4->id; ?>"/>
							<div class="control-group">
								<label class="control-label">Heading</label>
								<div class="controls">
									<input type="text" name="heading" value="<?php echo $email_4->heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sub Heading</label>
								<div class="controls">
									<input type="text" name="sub_heading" value="<?php echo $email_4->sub_heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Normal textarea</label>
								<div class="controls">
									<textarea name="content"><?php echo $email_4->content ?></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-edit"></i></span> <h5>Email #2</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo site_url('admin/configure/process_email_template'); ?>" method="POST" class="form-horizontal">
							<input type="hidden" name="id" value="<?php echo $email_1->id; ?>"/>
							<div class="control-group">
								<label class="control-label">Heading</label>
								<div class="controls">
									<input type="text" name="heading" value="<?php echo $email_1->heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sub Heading</label>
								<div class="controls">
									<input type="text" name="sub_heading" value="<?php echo $email_1->sub_heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Normal textarea</label>
								<div class="controls">
									<textarea name="content"><?php echo $email_1->content ?></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-edit"></i></span> <h5>Email #3</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo site_url('admin/configure/process_email_template'); ?>" method="POST" class="form-horizontal">
							<input type="hidden" name="id" value="<?php echo $email_2->id; ?>"/>
							<div class="control-group">
								<label class="control-label">Heading</label>
								<div class="controls">
									<input type="text" name="heading" value="<?php echo $email_2->heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sub Heading</label>
								<div class="controls">
									<input type="text" name="sub_heading" value="<?php echo $email_2->sub_heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Normal textarea</label>
								<div class="controls">
									<textarea name="content"><?php echo $email_2->content ?></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-edit"></i></span> <h5>Email #4</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo site_url('admin/configure/process_email_template'); ?>" method="POST" class="form-horizontal">
							<input type="hidden" name="id" value="<?php echo $email_3->id; ?>"/>
							<div class="control-group">
								<label class="control-label">Heading</label>
								<div class="controls">
									<input type="text" name="heading" value="<?php echo $email_3->heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Sub Heading</label>
								<div class="controls">
									<input type="text" name="sub_heading" value="<?php echo $email_3->sub_heading; ?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Normal textarea</label>
								<div class="controls">
									<textarea name="content"><?php echo $email_3->content ?></textarea>
								</div>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
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


