<div id="content">
	<div id="content-header">
		<h1>Application Page</h1>
		<div class="btn-group">

		</div>
	</div>

	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo base_url(); ?>admin/cms" class="">CMS</a>
		<a href="#" class="current">Application Page</a>
	</div>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center">
				<a href="<?php echo base_url(); ?>admin/cms/add_applicationpage">
					<button class="btn">Add Application Page</button>
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
									<!--<th>Slug</th>-->
									<th>Title</th>
									<th>Created</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach( $pages as $page ) :
									$row  = $page;
									$id   = $row->id;
									$slug = $row->slug;
									$title= $row->title;
									$date = date( 'd-m-Y @ H:i', $row->created_on );
								?>
								<tr>
									<td> <a  href="<?php echo site_url('admin/cms/add_applicationpage/' .$row->id) ?>"><?php echo $id; ?></a> </td>
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


