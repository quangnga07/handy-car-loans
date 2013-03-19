<?php 
$arr_function = array(
	'Can push a client record back in process',
	'Can Approve / Decline / Send Back on Supervisor Approval Tank',
	'Can create New User accounts',
	'Can change Access Controls',
	'Can view Access Log',
	'Can access Field Control',
	'Can access Score and Rank settings',
	'Can access Pre-Set Messages',
	'Can access Email Templates',
	'Can access T&C Version Control',
	'Can access APIs',
	'Can access CMS System',
	'Can access Blog',
	'Can access Web Stats',
	'Can delete Client Record'
);
?>
<div id="content">
	<div id="content-header">
		<h1>Access Controls</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-bottom">Users</a>
		<a href="#" class="current">Access Controls</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box incomplete-box">
					<div class="widget-title incomplete-title">
						<span class="icon">
                        	<i class="icon-user"></i>
						</span>
						<h5>Access Controls</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
                                	<th width="40%" rowspan="2">FUNCTION</th>
									<th width="40%" colspan="2">USER LEVEL</th>
								</tr>
								<tr>
									<th style="width:20%">STAFF</th>
									<th style="width:20%">SUPERVISOR</th>
								</tr>
							</thead>
							<tbody>
                            	<?php
									$str = '';
                                	for($i = 0; $i < count($arr_function); $i++){
											$str_check_staff = '';
											$str_check_supervisor = '';
											if(isset($access_controls[$i]->staff)) if($access_controls[$i]->staff == 1) $str_check_staff = 'checked="checked"';
											if(isset($access_controls[$i]->supervisor)) if($access_controls[$i]->supervisor == 1) $str_check_supervisor = 'checked="checked"';
											
											if( $i == 0 ) {
												$str .= '<tr style="display: none;">';
											} else {
												$str .= '<tr>';
											}

											$str .= '	<td class="taskAccessControl">'.$arr_function[$i].'</td>';
											$str .= '	<td class="taskOptions"><input type="checkbox" id="staff_f_'.$i.'" '.$str_check_staff.'/></td>';
											$str .= '	<td class="taskOptions"><input type="checkbox" id="supervisor_f_'.$i.'" '.$str_check_supervisor.'/></td>';
											$str .= '</tr>';
									}
									echo $str;
								?>
							</tbody>
						</table>
                    </div>
				</div>
			</div>
            <a id="" style="float:right" class="btn" onclick="update_control()">Save Changes</a>
		</div>

		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function update_control(){
	var access_staff = [];
	var access_supervisor = [];
	var length_f = <?php echo count($arr_function);?>;
	for(var i = 0; i < length_f; i++){
		if(document.getElementById("staff_f_"+i).checked == true) access_staff[access_staff.length] = 1;
		else access_staff[access_staff.length] = 0;
		
		if(document.getElementById("supervisor_f_"+i).checked == true) access_supervisor[access_supervisor.length] = 1;
		else access_supervisor[access_supervisor.length] = 0;
	}
	$.post("<?php echo site_url('admin/update_access_controls'); ?>",{
		update_control:'yes',
		staff:access_staff,
		supervisor:access_supervisor
	},function(data){
		if(data == ''){
			alert('Success');	
		}else{
			alert('Error');	
		}
	});
	return false;
}
</script>