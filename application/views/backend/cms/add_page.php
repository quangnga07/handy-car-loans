<div id="content">
	<div id="content-header">
		<h1><?php echo $add_edit;?> Page</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms/" class="">CMS</a>
		<a href="#" class="current"><?php echo $add_edit;?> Page</a>
	</div>
	<div class="container-fluid">
	<form id="add_page_form" action="<?php echo base_url(); ?>admin/cms/add_<?php echo @$page_type;?>page/<?php echo $id;?>" method="post" class="form-horizontal">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-file"></i></span> <h5><?php if($id!=''){echo 'Edit';}else{echo 'Add';}?> page</h5>
					</div>
					<div class="widget-content nopadding">
							<div class="control-group">
								<label class="control-label">Status</label>
								<div class="controls">
									<select name="status">
										<option value="draft" <?php if (@$page->status=='draft'){echo 'selected';}?>>Draft</option>
										<option value="live" <?php if (@$page->status=='live'){echo 'selected';}?>>Live</option>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Page template</label>
								<div class="controls">
									<select name="layout_id">
										<option value="defaulttemplate" <?php if (@$page->layout_id=='defaulttemplate'){echo 'selected';}?>>Default</option>
										<option value="fullwidthtemplate" <?php if (@$page->layout_id=='fullwidthtemplate'){echo 'selected';}?>>Full width</option>
										<option value="leftsidebartemplate" <?php if (@$page->layout_id=='leftsidebartemplate'){echo 'selected';}?>>Left side bar template</option>
										<option value="rightsidebartemplate" <?php if (@$page->layout_id=='rightsidebartemplate'){echo 'selected';}?>>Right side bar template</option>
										<option value="homepagetemplate" <?php if (@$page->layout_id=='homepagetemplate'){echo 'selected';}?>>Home page</option>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Page title</label>
								<div class="controls">
									<input type="text" name="browser_title" value="<?php echo @$page->browser_title;?>" />
								</div>
							</div>
                            
							<div class="control-group">
								<label class="control-label">Header title</label>
								<div class="controls">
									<input type="text" name="title" value="<?php echo @$page->title;?>" />
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Header Sub title</label>
								<div class="controls">
									<input type="text" name="sub_title" value="<?php echo @$page->sub_title;?>" />
								</div>
							</div>

							<?php if( $page_type != 'application' ): ?>
							<div class="control-group">
								<label class="control-label">Page slug</label>
								<div class="controls">
									<input type="text" name="slug" value="<?php echo @$page->slug;?>" />
								</div>
							</div>
							<?php else: ?>
								<input type="hidden" name="slug" value="<?php echo @$page->slug;?>" />
							<?php endif; ?>

							<div class="control-group">
								<label class="control-label">Meta title</label>
								<div class="controls">
									<input type="text" name="meta_title" value="<?php echo @$page->meta_title;?>" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Meta keywords (Comma seperated)</label>
								<script>
								<?php
								$val = str_replace('"','',$page->meta_keywords);
								echo 'var availableTags = ['.$existing_meta_keywords.'];'
								?>
								</script>
								<div class="controls">
									<input id="meta_kewywords" type="text" name="meta_keywords" value="<?php echo $val;?>" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Meta description</label>
								<div class="controls">
									<textarea name="meta_description"><?php echo @$page->meta_description;?></textarea>
								</div>
							</div>
                            
							<div class="control-group">
								<label class="control-label">Page content</label>
								<div class="controls">
									<textarea name="content" id="page_content" ><?php echo @$page->content;?></textarea>
									<?php echo display_ckeditor($ckeditor); ?>
								</div>
							</div>

							<input type="hidden" name="page_type" value="<?php echo @$page_type;?>"/>
							<div class="form-actions">
								<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
							</div>

					</div>
				</div>
			</div>
		</div>

		<?php if( $id == 16 ): ?>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-lock"></i>
						</span> 
						<h5>Decleration</h5>
					</div>

					<div class="widget-content nopadding">
						<form id="dec_form" method="post">
							<div class="control-group">
								<label class="control-label">Heading</label>
								<div class="controls">
									<input type="hidden" name="dec_id" value="<?php echo $dec_id; ?>" />
									<input type="hidden" name="page_id" value="<?php echo $id; ?>" />
									<input type="hidden" id="dec_url" value="<?php echo site_url('admin/cms/edit_declaration'); ?>" />
									<input type="text" name="dec_heading" value="<?php echo $dec_heading; ?>" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Text</label>
								<div class="controls">
									<textarea id="text-dec" name="dec_text" style="height: 165px;"><?php echo $dec_text; ?></textarea>
								</div>
							</div>

							<div class="control-group">
								<div class="controls">
									<button type="" id="dec_submit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if(@$page->layout_id == 'rightsidebartemplate'):?>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-th-large"></i>
						</span> 
						<h5>Right Menu Widgets</h5>
					</div>

					<div class="widget-content">
						<input type="hidden" name="area" value="right"/>

						<div class="row-fluid">
							<div class="span6">
								<label class="pagination-centered"><strong>Widgets available</strong></label>
								<?php foreach($widgets as $widget):?>

									<div class="objectDrag"	style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
										<div class="widgetform">
											<input type="hidden" name="widget_id[]" value="<?php echo $widget->id;?>" />
											<label><?php echo $widget->widget_title;?></label>
											<button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();return false;">Edit</button>
											<div class="form" style="display:none;">
														<!-- <div style="border:1px solid #000;background:#fff;padding:5px;">
														<?php echo $widget->widget_content;?>
														</div> -->

												<div class="control-group">
													<label class="control-label">Title</label>
														<div class="controls">
															<input type="text" name="widget_title[]" value="<?php echo $widget->widget_title;?>" />
														</div>
													</div>
												
												<div class="control-group">
													<label class="control-label">Content html</label>
													<div class="controls">
														<textarea name="widget_content[]" class="widget-content"><?php echo $widget->widget_content;?></textarea>
													</div>
												</div>
														
												<input type="hidden" name="widget_class[]" value="<?php echo $widget->widget_class;?>" />
													
												<br>
												<button class="btn btn-success btn-mini btn-left-right-middle"
													onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Save</button>
													<button class="btn btn-primary btn-mini"
													onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Close</button>

											</div>
										</div>
									</div>

								 <?php endforeach;?>
							</div>

							<div class="span6">
								<label class="pagination-centered"><strong>Widgets In This Page</strong></label>
								<div id="garbageCollector" class="sortable_widget" style="min-height:400px; background-color:#eee;overflow:auto;">
								<?php  foreach($mywidgets as $widget):?>
									<?php if($widget->area=='right'):?>
									<div class="objectDropped" style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
											<div class="widgetform">
												<input type="hidden" name="widget_id[]" value="<?php echo $widget->id;?>" />
												<label><?php echo $widget->widget_title;?></label>
												<button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();return false;">Edit</button>
												<button class="btn btn-mini" onclick="$.colorbox({html:$(this).parents('div.widgetform').find('div.form').find('textarea').val()});return false;">Preview</button>
												<button class="btn btn-danger btn-mini" onclick="$(this).parents('div.objectDropped').remove();return false;">Delete</button>



												<div class="form" style="display:none;">
														<!-- <div style="border:1px solid #000;background:#fff;padding:5px;">
														<?php echo $widget->widget_content;?>
														</div> -->
														<div class="control-group">
															<label class="control-label">Title</label>
															<div class="controls">
																<input type="text" name="widget_title[]" value="<?php echo $widget->widget_title;?>" />
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Content html</label>
															<div class="controls">
																<textarea name="widget_content[]"><?php echo $widget->widget_content;?></textarea>
															</div>
														</div>
													<input type="hidden" name="widget_class[]" value="<?php echo $widget->widget_class;?>" />
													<br>
													<button class="btn btn-primary btn-mini"
													onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Save</button>

												</div>
											</div>
									</div>
									<?php endif;?>
								<?php endforeach;?>

								</div>
							</div>
						</div>
					
						<div class="control-group">
							<div class="controls" style="margin-left: 162px;">
								<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
							</div>
						</div>
						<!--
						<div class="form-actions">
							<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
						</div>
						-->
					</div>
				</div>
			</div>
		</div>
		<?php endif;?>


		<?php if(@$page->layout_id == 'leftsidebartemplate'):?>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-th-large"></i>
						</span>
						<h5>Left Menu Widgets</h5>
					</div>

					<div class="widget-content">
						<input type="hidden" name="area" value="left"/>
						<div class="row-fluid">
							<div class="span6">
								<label class="pagination-centered"><strong>Widgets Available</strong></label>
								<?php foreach($widgets as $widget):?>
										<div class="objectDrag"	style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
											<div class="widgetform">
												<input type="hidden" name="widget_id[]" value="<?php echo $widget->id;?>" />
												<label><?php echo $widget->widget_title;?></label>
												<button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();return false;">Edit</button>
												<div class="form" style="display:none;">
														<!-- <div style="border:1px solid #000;background:#fff;padding:5px;">
														<?php echo $widget->widget_content;?>
														</div> -->
														<div class="control-group">
															<label class="control-label">Title</label>
															<div class="controls">
																<input type="text" name="widget_title[]" value="<?php echo $widget->widget_title;?>" />
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Content html</label>
															<div class="controls">
																<textarea name="widget_content[]"><?php echo $widget->widget_content;?></textarea>
															</div>
														</div>
														<input type="hidden" name="widget_class[]" value="<?php echo $widget->widget_class;?>" />
													<br>
													<button class="btn btn-success btn-mini btn-left-right-middle" onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Save</button>
													<button class="btn btn-primary btn-mini" onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Close</button>
												</div>
											</div>
										</div>
								 <?php endforeach;?>
							</div>

							<div class="span6">
								<label class="pagination-centered"><strong>Widgets In This Page</strong></label>
								<div id="garbageCollector" class="sortable_widget" style="min-height:400px; background-color:#eee;overflow:auto;">
								<?php foreach($mywidgets as $widget):?>
									<?php if($widget->area=='left'):?>
									<div class="objectDropped" style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
											<div class="widgetform">
												<input type="hidden" name="widget_id[]" value="<?php echo $widget->id;?>" />
												<label><?php echo $widget->widget_title;?></label>
												<button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();return false;">Edit</button>
												<button class="btn btn-mini" onclick="$.colorbox({html:$(this).parents('div.widgetform').find('div.form').find('textarea').val()});return false;">Preview</button>
												<button class="btn btn-danger btn-mini" onclick="$(this).parents('div.objectDropped').remove();return false;">Delete</button>
												<div class="form" style="display:none;">
														<!-- <div style="border:1px solid #000;background:#fff;padding:5px;">
														<?php echo $widget->widget_content;?>
														</div> -->
														<div class="control-group">
															<label class="control-label">Title</label>
															<div class="controls">
																<input type="text" name="widget_title[]" value="<?php echo $widget->widget_title;?>" />
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Content html</label>
															<div class="controls">
																<textarea name="widget_content[]"><?php echo $widget->widget_content;?></textarea>
															</div>
														</div>
														<input type="hidden" name="widget_class[]" value="<?php echo $widget->widget_class;?>" />
													<br>
													<button class="btn btn-success btn-mini" onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Close</button>

												</div>
											</div>
									</div>
									<?php endif;?>
								<?php endforeach;?>

								</div>
							</div>
						</div>
					
					
					<div class="control-group">
						<div class="controls" style="margin-left: 160px;">
							<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
						</div>
					</div>
					<!--
					<div class="form-actions">
						<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
					</div>
					-->
				</div>
			</div>
		</div>
		</div>
		<?php endif;?>

		<?php if(@$page->layout_id != ''):?>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-th-large"></i>
						</span> 
						<h5>Content Bottom Widgets</h5>
					</div>

					<style>
				    #sortable1, #sortable3 { list-style-type: none; margin: 0; padding: 0;
				    	 margin-right: 10px; background: #eee; padding: 5px; width: 550px;min-height:100px;}
				    #sortable1 li,  #sortable3 li { margin: 5px; padding: 5px; font-size: 1.2em; width: 530px; cursor:move;}
				    </style>

				    <div class="widget-content">
				    	<input type="hidden" name="middle_area" value="middle"/>
				    	<div class="row-fluid">
				    		<div class="span6">
				    			<label class="pagination-centered"><strong>Widgets Available</strong></label>
				    			<?php foreach($widgets as $widget):?>
									<div class="objectDrag"	style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
											<div class="widgetform">
												<input type="hidden" name="middle_widget_id[]" value="<?php echo $widget->id;?>" />
												<label><?php echo $widget->widget_title;?></label>
												<button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();return false;">Edit</button>
												<button class="btn btn-danger btn-mini" style="display:none;" onclick="$(this).parents('div.objectDropped').remove();return false;">Delete</button>
												<div class="form" style="display:none;">
														<!-- <div style="border:1px solid #000;background:#fff;padding:5px;">
														<?php echo $widget->widget_content;?>
														</div> -->
													<div class="control-group">
															<label class="control-label">Title</label>
															<div class="controls">
																<input type="text" name="middle_widget_title[]" value="<?php echo $widget->widget_title;?>" />
															</div>
														</div>
													<div class="control-group">
														<label class="control-label">Content html</label>
														<div class="controls">
															<textarea name="middle_widget_content[]"><?php echo $widget->widget_content;?></textarea>
														</div>
													</div>
													<input type="hidden" name="middle_widget_class[]" value="<?php echo $widget->widget_class;?>" />
													<br>
													<button class="btn btn-success btn-mini btn-left-right-middle"
													onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Save</button>
													<button class="btn btn-primary btn-mini" onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Close</button>
												</div>
											</div>
									</div>
								 <?php endforeach;?>
				    		</div>

				    		<div class="span6">
				    			<label class="pagination-centered"><strong>Widgets In This Page</strong></label>
				    			<div id="garbageCollector" class="sortable_widget" style="min-height:400px; background-color:#eee;overflow:auto;">
								<?php foreach($mywidgets as $widget):?>
									<?php if($widget->area=='middle'):?>
									<div class="objectDropped" style="background: #eee;padding: 5px;min-height:60px;border:1px dashed #ccc;margin:5px;">
											<div class="widgetform">
												<input type="hidden" name="middle_widget_id[]" value="<?php echo $widget->id;?>" />
												<label><?php echo $widget->widget_title;?></label>
												<button class="btn btn-success btn-mini widget_edit_button" onclick="$(this).parents('div.widgetform').find('div.form').fadeIn();$(this).hide();return false;">Edit</button>
												<button class="btn btn-mini" onclick="$.colorbox({html:$(this).parents('div.widgetform').find('div.form').find('textarea').val(), maxWidth: '1000px'});return false;">Preview</button>
												<button class="btn btn-danger btn-mini" onclick="$(this).parents('div.objectDropped').remove();return false;">Delete</button>
												<div class="form" style="display:none;">
														<!-- <div style="border:1px solid #000;background:#fff;padding:5px;">
														<?php echo $widget->widget_content;?>
														</div> -->

													<div class="control-group">
															<label class="control-label">Title</label>
															<div class="controls">
																<input type="text" name="middle_widget_title[]" value="<?php echo $widget->widget_title;?>" />
															</div>
														</div>
													<div class="control-group">
														<label class="control-label">Content html</label>
														<div class="controls">
															<textarea name="middle_widget_content[]"><?php echo $widget->widget_content;?></textarea>
														</div>
													</div>
													<input type="hidden" name="middle_widget_class[]" value="<?php echo $widget->widget_class;?>" />
													<br>
													<button class="btn btn-primary btn-mini"
													onclick="$(this).parents('div.widgetform').find('div.form').fadeOut();$(this).parents('div.widgetform').find('.widget_edit_button').show();return false;">Close</button>

												</div>
											</div>
									</div>
									<?php endif;?>
								<?php endforeach;?>

								</div>
				    		</div>
				    	</div>

						<div class="control-group">
							<div class="controls" style="margin-left: 162px;">
								<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
							</div>
						</div>
						<!--
						<div class="form-actions">
							<button type="submit" name="save_exit" class="btn btn-primary">Save</button>
						</div>
						-->

					</div>
				</div>
			</div>
		</div>
		<?php endif;?>



		</form>
		<div class="row-fluid">
			<div id="footer" class="span12">

			</div>
		</div>
	</div>
</div>
