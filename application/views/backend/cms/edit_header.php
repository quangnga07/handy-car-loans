
<div id="content">
	<div id="content-header">
		<h1>Edit Header</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>/admin/cms" class="">CMS</a>
		<a href="#" class="current">Edit Header</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-edit"></i></span> <h5>Header</h5>
					</div>
					<div class="widget-content nopadding">
						<form  enctype="multipart/form-data" action="#" method="post" class="form-horizontal">
							<?php 
								$count = 1;
								foreach($header as $item):?>

										<div class="control-group">
											<label class="control-label"><?php echo ( ( $count == 1 ) ? 'Phone' : 'Logo' ); ?></label>
											<div class="controls">
												<input type="hidden" name="<?php echo $item->item_type.'_id'?>" value="<?php echo $item->id?>"/>
												<?php if($item->inputtype=='textarea'):?>
												<textarea name="<?php echo $item->item_type?>"><?php echo $item->content ?></textarea>
												<?php endif;?>
												<?php if($item->inputtype=='text'):?>
												<input type="text" name="<?php echo $item->item_type?>" value="<?php echo $item->content ?>"/>
												<?php endif;?>
												<?php if($item->inputtype=='password'):?>
												<input type="password" name="<?php echo $item->item_type?>" value="<?php echo $item->content ?>"/>
												<?php endif;?>

												<?php if($item->inputtype=='file'):?>
												<!-- <input type="file" name="<?php echo $item->item_type?>" value="<?php echo $item->content ?>"/> -->
												<input id="<?php echo $item->item_type?>" name="<?php echo $item->item_type?>" type="text" value="<?php echo $item->content ?>"/>
												<input class="btn" type="button" value="Browse Server" onclick="<?php echo $item->item_type?>BrowseServer();" />

												<?php endif;?>
											</div>
										</div>

							<?php
								$count++; 
								endforeach;?>

										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			function logo_imageBrowseServer()
			{
				// You can use the "CKFinder" class to render CKFinder in a page:
				var finder = new CKFinder();
				finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
				finder.selectActionFunction = logo_imageSetFileField;
				finder.popup();
			}

			// This is a sample function which is called when a file is selected in CKFinder.
			function logo_imageSetFileField( fileUrl )
			{
				document.getElementById( 'logo_image' ).value = fileUrl;
			}
		</script>
		<div class="row-fluid">
			<div id="footer" class="span12">

			</div>
		</div>
	</div>
</div>


