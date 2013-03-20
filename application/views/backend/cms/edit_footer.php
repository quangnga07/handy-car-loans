
<div id="content">
	<div id="content-header">
		<h1>Edit Footer</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>/admin/cms" class="">CMS</a>
		<a href="#" class="current">Edit Footer</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon"><i class="icon-edit"></i></span> <h5>Footer</h5>
					</div>
					<div class="widget-content nopadding">
						<form enctype="multipart/form-data" action="#" method="post" class="form-horizontal">
							<?php $idx = 1; foreach($footer as $item):?>
									<div class="control-group">
										<label class="control-label">
										<?php 
											if( $item->item_type == 'helpline' ) {
												echo 'Contact Details';
											} elseif( $item->item_type == 'twitter-username' ) {
												echo 'Twitter Account';
											} elseif( $item->item_type == 'no-of-twits' ) {
												echo 'Number of Tweets';
											} elseif( $item->item_type == 'footer_image') {
												echo 'Logo ' . $idx;
											} elseif( $item->item_type == 'footer_image_link') {
												echo 'Logo ' . $idx++ . ' Link';
											} elseif( $item->item_type == 'footer2_image') {
												echo 'Logo ' . $idx;
											} elseif( $item->item_type == 'footer2_image_link') {
												echo 'Logo ' . $idx++ . ' Link';
											} elseif( $item->item_type == 'footer3_image') {
												echo 'Logo ' . $idx;
											} elseif( $item->item_type == 'footer3_image_link') {
												echo 'Logo ' . $idx++ . ' Link';
											} elseif( $item->item_type == 'footer_image2' ) {
												echo 'Girl Image';
											} elseif( $item->item_type == 'footer_text' ) {
												echo 'Disclaimer Bar';
											} elseif( $item->item_type == 'footer_navigation' ) {
												echo 'Navigation';
											} elseif( $item->item_type == 'facebook_link' ) {
												echo 'Facebook Page';
											} elseif( $item->item_type == 'twitter_link' ) {
												echo 'Twitter Page';
											} elseif( $item->item_type == 'youtube_link' ) {
												echo 'YouTube Page';
											}
										?>
										</label>
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
											<input id="<?php echo $item->item_type?>" name="<?php echo $item->item_type?>" type="text" value="<?php echo $item->content ?>"/>
											<input type="button" class="btn" value="Browse Server" onclick="<?php echo $item->item_type?>BrowseServer();" />
											<?php endif;?>
										</div>
									</div>
							<?php endforeach;?>

										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Save</button>
										</div>

						</form>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">

				function footer_imageBrowseServer()
				{
					// You can use the "CKFinder" class to render CKFinder in a page:
					var finder = new CKFinder();
					finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
					finder.selectActionFunction = setFooterImage;
					finder.popup();
				}

				function footer2_imageBrowseServer()
				{
					// You can use the "CKFinder" class to render CKFinder in a page:
					var finder = new CKFinder();
					finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
					finder.selectActionFunction = setFooter2Image;
					finder.popup();
				}

				function footer3_imageBrowseServer()
				{
					// You can use the "CKFinder" class to render CKFinder in a page:
					var finder = new CKFinder();
					finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
					finder.selectActionFunction = setFooter3Image;
					finder.popup();
				}

				//Girl Image
				function footer_image2BrowseServer()
				{
					// You can use the "CKFinder" class to render CKFinder in a page:
					var finder = new CKFinder();
					finder.basePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
					finder.selectActionFunction = setFooterImage2;
					finder.popup();
				}

				function setFooterImage( fileUrl )
				{
					//fileUrl = removeBasePath( fileUrl );
					//alert(fileUrl);
					document.getElementById( 'footer_image' ).value = fileUrl;
				}

				function setFooter2Image( fileUrl )
				{
					//fileUrl = removeBasePath( fileUrl );
					document.getElementById( 'footer2_image' ).value = fileUrl;
				}

				function setFooter3Image( fileUrl )
				{
					//fileUrl = removeBasePath( fileUrl );
					document.getElementById( 'footer3_image' ).value = fileUrl;
				}

				function setFooterImage2( fileUrl )
				{
					//fileUrl = removeBasePath( fileUrl );
					document.getElementById( 'footer_image2' ).value = fileUrl;
				}

				function removeBasePath( fileUrl )
				{
					var shortenFilePath = fileUrl;
					//^.*(.com|.org|.com.ph|.com.au)/

					var patt1 = /^.*(.com|.org|.com.ph|.com.au)/;
					//var patt = new RegExp(^.*(.com|.org|.com.ph|.com.au)/,g);
					path = shortenFilePath.match(patt1)[1];

					//shortenFilePath     = patt.shortenFilePath;

					return path;

					return path;
				}
		</script>
		<div class="row-fluid">
			<div id="footer" class="span12">

			</div>
		</div>
	</div>
</div>


