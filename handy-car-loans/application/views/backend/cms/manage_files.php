<div id="content">
	<div id="content-header">
		<h1>Media Library</h1>
		<div class="btn-group">

		</div>
	</div>

	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="">CMS</a>
		<a href="#" class="current">Media Library</a>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url(); ?>admin/cms/add_file">
					<button class="btn">Add File</button>
				</a>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-picture"></i>
						</span>
						<h5>Media Files</h5>
					</div>

					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped  data-cms-table">
							<thead>
								<tr>
									<th>File ID</th>
									<th>Name</th>
									<th>Thumbnail</th>
									<th>Filename</th>
									<th>File Path</th>
									<th width="150px">Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach( $files as  $file ) :
									$row  = $file;
									$id   = $row->id;
									$thumbnail = $row->thumbnail;
									$name = $row->filename;
									$ext = $row->filenameExt;
									$path = $row->path;
								?>
								<tr>
									<td> <a  href="<?php echo site_url('admin/cms/add_file/' .$row->id) ?>"><?php echo $id; ?></a> </td>
									<td> <?php echo $row->name; ?> </td>
									<td> <img src="<?php echo site_url().$path; ?>thumbs/<?php echo $name.'_thumb'.$ext; ?>"/> </td>
									<td> <?php echo $name.$ext; ?> </td>
									<td> <?php echo site_url().$path; ?>full/images/<?php echo $name.$ext; ?></td>
									<td width="150px" class="taskOptions">
										<a class="mycolorboxImage" title="<?php //echo $row->name; ?>" href="<?php echo site_url().$path; ?>full/images/<?php echo $name.$ext; ?>"><i class="icon-eye-open"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
										<a  href="<?php echo site_url('admin/cms/add_file/' .$row->id) ?>"><i class="icon-pencil"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
										<a  href="<?php echo site_url('admin/cms/delete_file/' .$row->id) ?>"><i class="icon-remove"></i></a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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


