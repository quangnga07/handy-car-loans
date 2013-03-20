<div id="content">
	<div id="content-header">
        <h1>Min-It API Settings</h1>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="tip-bottom">APIs</a>
		<a href="<?php echo site_url('admin/min_it');?>" class="current">Min-It API</a>
	</div>
	<div class="container-fluid">
        <form action="<?php echo site_url('admin/min_it'); ?>" method="POST">
    		<div class="row-fluid">
    			<div class="span12">
                    <?php if($this->session->flashdata('success_message')): ?>
                    <div class="alert alert-success">
                        <strong>Save Successful</strong>
                    </div>
                    <?php endif; ?>
    				<div class="widget-box incomplete-box">
                    	<div class="widget-title incomplete-title">
    						<span class="icon">
    							<i class="icon-user"></i>
    						</span>
    						<h5>Account Details</h5>
    					</div>
                        <div class="widget-content nopadding">
                        	<div class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Username</label>
                                    <div class="controls">
                                        <input type="text" name="username" value="<?php echo $settings->username; ?>" style="width:40%"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password</label>
                                    <div class="controls">
                                        <input type="text" name="password" value="<?php echo $settings->password; ?>" style="width:40%" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        		</div>
    		</div>
            <div class="row-fluid">
    			<div id="footer" class="span2">
    				<p style="padding:10px 10px 10px 0px;"> 
                        <button type="submit" class="btn" data-loading-text="Savin changes..." onclick="return submit_sms_setting()">Save Changes</button>
                    </p>
    			</div>
    		</div>
        </form>
	</div>
</div>   