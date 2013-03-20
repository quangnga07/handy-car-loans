
<div id="content">
	<div id="content-header">
		<h1>Configure Users Accounts</h1>
		<div class="btn-group">
			<a href="<?php echo site_url('admin/users/manage_action_users');?>" class="btn btn-large tip-bottom" title="Add Users"><i class="icon-plus-sign"></i></a>
		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="current">Configure Users Accounts</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="alert alert-success hide">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Successful!</strong> User has been removed.
			    </div>
			    <div class="alert alert-error hide">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Error,</strong> Please try again later.
			    </div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-user"></i>
						</span>
						<h5>List of users</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>User ID</th>
									<th>Username</th>
									<th>Email Address</th>
									<th>User Level</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $users as $user ): 
									if( $user->user_level == 1 ) $user_lvl = 'Administrator';
									elseif ( $user->user_level == 2 ) $user_lvl = 'Supervisor';
									else $user_lvl = 'Staff';
								?>
								<tr>
									<td> <?php echo $user->id; ?> </td>
									<td> <?php echo $user->username; ?> </td>
									<td> <?php echo $user->email; ?> </td>
									<td> <?php echo $user_lvl; ?> </td>
									<td class="taskOptions">
										<div class="btn-group">
											<a class="btn btn-small tip-bottom btn-edt" id="<?php echo $user->id; ?>" title="Edit User"><i class="icon-edit"></i></a>
											<a class="btn btn-small tip-bottom btn-del" id="<?php echo $user->id; ?>" title="Delete User"><i class="icon-remove-circle"></i></a>
										</div>
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