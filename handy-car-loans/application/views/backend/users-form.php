
<div id="content">
	<div id="content-header">
		<h1>Users Form</h1>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/users'); ?>" title="Go to Users" class="tip-bottom">Configure Users Accounts</a>
		<a href="#" class="current">Users From</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-align-justify"></i>									
						</span>
					</div>
					<div class="widget-content nopadding">
						<form id="user_form" action="<?php echo site_url('admin/users/save_user');?>" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input type="text" name="username" id="username">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                	<input type="password" name="passwrd" id="password1">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Re-type Password</label>
                                <div class="controls">
                                	<input type="password" name="password" id="password2">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                	<input type="text" name="email" id="email">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">User Level</label>
                                <div class="controls">
                                	<select name="user">
                                		<option value=''>Select</otpion>
										<option value="1">Administrator</option>
										<option value="2">Supervisor</option>
										<option value="3">Staff</option>
									</select>
                                </div>
                            </div>
                            <div class="form-actions">
                            	<input type="submit" value="Submit" class="btn btn-primary">
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