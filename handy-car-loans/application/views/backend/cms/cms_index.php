
<div id="content">
	<div id="content-header">
		<h1>CMS Dashboard</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="">CMS</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="current">Dashboard</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: center;">
				<a href="<?php echo base_url(); ?>admin/cms/add_page">
					<button class="btn">Add Page</button>
				</a> &nbsp;
				<a href="<?php echo base_url(); ?>admin/cms/edit_header">
					<button class="btn">Edit Header</button>
				</a> &nbsp;
				<a href="<?php echo base_url(); ?>admin/cms/edit_footer">
					<button class="btn">Edit Footer</button>
				</a> &nbsp;
				<a href="<?php echo base_url(); ?>admin/cms/widget_control">
					<button class="btn">Widget Control</button>
				</a> &nbsp;
				<a href="<?php echo base_url(); ?>admin/cms/menu_control">
					<button class="btn">Menu Control</button>
				</a> &nbsp;
				<!--<a href="<?php //echo base_url(); ?>admin/cms/manage_applicationpages">
					<button class="btn">Manage Application Pages</button>
				</a> &nbsp;-->
				<a href="<?php echo base_url(); ?>admin/cms/manage_files">
					<button class="btn">Media Library</button>
				</a>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
                            <i class="icon-list-alt"></i>
                        </span>
						<h5>Pages</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped data-cms-table">
							<thead>
								<tr>
									<th>Page ID</th>
									<th>Slug</th>
									<th>Title</th>
									<th>Created</th>
									<th>Status</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 0;
								foreach( $pages as $page ) :
									$row    = $page;
									$id     = $row->id;
									$slug   = $row->slug;
									$title  = $row->title;
									$date   = date( 'd-m-Y @ H:i', $row->created_on );
									$status = $row->status;
								?>
								<tr>
									<td class="taskOptions"> <a href="<?php echo site_url('admin/cms/add_page/' .$row->id) ?>"> <?php echo $id; ?> </a></td>
									<td> <?php echo $slug; ?> </td>
									<td> <?php echo $title; ?> </td>
									<td> <?php echo $date; ?> </td>
									<td class="taskOptions"> <?php echo ucfirst( $status ); ?> </td>
									<td class="taskOptions">
										<a href="<?php echo site_url('admin/cms/add_page/' .$row->id) ?>"> <i class="icon-edit"></i> </a> 
									</td>
									<td class="taskOptions">
										<i class="icon-remove delete-page" id="<?php echo $row->id; ?>" style="cursor: pointer;"></i> 
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
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
                            <i class="icon-list-alt"></i>
                        </span>
						<h5>Main Application Form Pages</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped data-cms-table main-app-table">
							<thead>
								<tr>
									<th width="79px">Page ID</th>
									<!--<th>Slug</th>-->
									<th>Title</th>
									<th>Created</th>
									<th>Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $app_pages as $page ) :
									$row  = $page;
									$id   = $row->id;
									$slug = $row->slug;
									$title= $row->title;
									$date = date( 'd-m-Y @ H:i', $row->created_on );
								?>
								<tr>
									<td class="taskOptions"> <a  href="<?php echo site_url('admin/cms/add_applicationpage/' .$row->id) ?>"><?php echo $id; ?></a> </td>
									<!--<td> <?php //echo $slug; ?> </td>-->
									<td> <?php echo $title; ?> </td>
									<td> <?php echo $date; ?> </td>
									<td class="taskOptions">
										<a href="<?php echo site_url('admin/cms/add_applicationpage/' .$row->id) ?>"><i class="icon-edit"></i></a> 
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


