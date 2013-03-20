<div id="content">
	<div id="content-header">
        <h1>Account Setup</h1>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="tip-bottom">Users</a>
		<a href="<?php echo site_url('admin/create_user');?>" class="current">Account Setup</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-user"></i>
						</span>
						<h5>Setup User Account</h5>
					</div>
                    <div class="widget-content nopadding">
                        <div class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Username</label>
                                <div class="controls">
                                    <input value="" type='text' name='user_name' id='user_name' autocomplete="off" style="width:400px" data-placement='right' />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">User Level</label>
                                <div class="controls">
                                	<label style="float:left; margin-bottom:10px; margin-top:6px"><input type="radio" name="user_level[]" onclick="submit_search()" value="1" /> Admin</label>
                                    <label style="float:left; margin-left:25px; margin-top:6px; margin-bottom:10px;"><input type="radio" name="user_level[]" onclick="submit_search()" value="2" /> Supervisor</label>
                                    <label style="float:left; margin-left:25px; margin-top:6px; margin-bottom:10px;"><input type="radio" name="user_level[]" onclick="submit_search()" value="3" /> Staff</label>
                                    
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Staff Email Address</label>
                                <div class="controls">
                                    <input style="width:400px" type='text' name='user_email' autocomplete="off" id='user_email' />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input style="width:400px" type='text' name='user_password' value="<?php echo $create_pass; ?>" autocomplete="off" id='user_password'/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">ON/OFF</label>
                                <div class="controls">
                                    <span style="float: left; margin-bottom:10px; margin-top:6px"><label><input type='radio' name='direct_to_bank[]' value='1' checked="checked" />ON</label></span>
                                    <span style="float: left; margin-left:20px; margin-bottom:10px; margin-top:6px"><label><input type='radio' name='direct_to_bank[]' value='0' />OFF</label></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <input type="submit" name="save" value="Save" class="btn btn-primary" onclick="return check_value(0)">
                                <input type="submit" name="save_email" value="Save & Email To User" class="btn btn-primary" onclick="return check_value(1)">
                            </div>
                        </div>
                    </div>
                </div>
    		</div>
		</div>
        <div class="row-fluid">
			<div class="span12">
				<div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-user"></i>
						</span>
						<h5>User Accounts</h5>
					</div>
                    <div class="widget-content nopadding">
                    	<table class="table required-table table-bordered table-striped account-user-table">
							<thead>
								<tr>
									<th id="sort_date">Date Account Created</th>
									<th style="width:15%">Level</th>
									<th style="width:15%">Name</th>
									<th style="width:15%">Active</th>
									<th style="width:15%">Edit</th>
									<th style="width:15%">Delete</th>
									<th style="display:none;"></th>
								</tr>
							</thead>
                            <tbody>
								<?php
								$count = 0;
								foreach( $accounts as $account ) :
									$row  = $account;
									$date = date( 'd-m-Y g:ia', strtotime( $row->date_created) );
									$level = '';
									switch($row->user_level){
										case 1:
											$level = 'Admin';
											break;
										case 2:
											$level = 'Supervisor';
											break;
										case 3:
											$level = 'Staff';
											break;	
									}
									$str_active = '';
									if($row->status == 1){
										$str_active .= '<span>ON</span>';
									}else{
										$str_active .= '<span>OFF</span>';
									}
								?>
								<tr>
									<td class="taskOptions"> <?php echo $date;?> </td>
									<td class="taskOptions"> <?php echo $level; ?> </td>
									<td class="taskOptions"> <?php echo $row->username; ?> </td>
									<td class="taskOptions"> <?php echo $str_active; ?> </td>
									<td class="taskOptions"><a id="edit_modal" data-toggle="modal" role="button" href="#editModal"><?php echo '<span class="icon" style="cursor:pointer" onclick="edit_account(\''.$row->id.'\',\''.$row->username.'\',\''.$row->user_level.'\',\''.$row->email.'\',\''.$row->status.'\')"><i class="icon-edit"></i></span>'; ?> </a></td>
									<td class="taskOptions"> <?php echo '<span class="icon" style="cursor:pointer" onclick="delete_account(\''.$row->id.'\')"><i class="icon-remove"></i></span>'; ?> </td>
									<td class="taskOptions" style="display:none;"> <?php echo $count; ?> </td>
								</tr>
								<?php 
									$count++;
									endforeach;
								?>
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
<!-- Modal -->
<div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Edit Account</h3>
    </div>
    <div class="modal-body">
        <div id="edit_content"></div>
    </div>
    <div class="modal-footer">
    	<span style="float:left; margin-top:6px" onclick="resend_pass()"><a href="javascript:void(0)" >Send New Password</a></span>
    	<button class="btn" aria-hidden="true" onclick="return save_edit()">Save Change</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function resend_pass(){
	$.post("<?php echo site_url('admin/send_new_pass');?>",{
		sendnew_pass:'yes',
		email:$("#email_edit").val(),
		uid:$("#id_edit").val()
	},function(data){
		if(data == '') alert('Sent.');
		else alert('Can not send');
	});	
}

function check_value(type){
	var usrname = document.getElementById("user_name").value;
	var passwrd = document.getElementById("user_password").value;
	var user_email = document.getElementById("user_email").value;
	
	var user_level_arr = 0;
	var user_level = document.getElementsByName("user_level[]");
	for (var i = 0; i < user_level.length; i++){
		if(user_level[i].checked == true){	
			user_level_arr = user_level[i].value;	
		}
	}
	var direct_to_bank = 0;
	var arr_direct_to_bank = document.getElementsByName("direct_to_bank[]");
	for(var i = 0; i < arr_direct_to_bank.length; i++){
		if(arr_direct_to_bank[i].checked == true){
			direct_to_bank = arr_direct_to_bank[i].value;
		}
	}
	if(trim(usrname) == ''){
		alert('Please input Username');
		document.getElementById("user_name").style.backgroundColor = '#FFC';
		document.getElementById("user_name").focus();
		return false;	
	}
	if(user_level_arr == 0){
		alert('Please Select User Level');
		return false;	
	}
	if(trim(user_email) == ''){
		alert('Please input Email');
		document.getElementById("user_email").style.backgroundColor = '#FFC';
		document.getElementById("user_email").focus();
		return false;	
	}
	if(!check_email()){
		document.getElementById("user_email").focus();
		return false;	
	}
	if(trim(passwrd) == ''){
		alert('Please input Password');
		document.getElementById("user_password").style.backgroundColor = '#FFC';
		document.getElementById("user_password").focus();
		return false;	
	}
	if(trim(passwrd).length < 6){
		alert('Password is too short (must be 6 character at least)');
		document.getElementById("user_password").style.backgroundColor = '#FFC';
		document.getElementById("user_password").focus();
		return false;
	}
	$.post("<?php echo site_url('admin/add_user');?>",{
		create_user:'yes',
		type:type,
		usrname:usrname,
		passwrd:passwrd,
		user_email:user_email,
		user_level:user_level_arr,
		direct_to_bank:direct_to_bank
	},function(data){
		if(data.error == ''){
			alert('Add new user success.');	
			window.location = '';
		}else{
			alert(data.error);
		}
	},'json');
	return false;
}
function edit_account(id,username,level,email,status){
	var check_level_admin = '';
	var check_level_super = '';
	var check_level_staff = '';
	
	if(level == 1) check_level_admin = 'checked="checked"';
	else if(level == 2) check_level_super = 'checked="checked"';
	else if(level == 3) check_level_staff = 'checked="checked"';
	
	var check_on = '';
	var check_off = '';
	if(status == 1) check_on = 'checked="checked"';
	else check_off = 'checked="checked"';
	
	var str = '';
	str += '<div class = "span5">';
	str += '	<div class = "widget-box incomplete-box">';
	str += '		<div class="widget-content nopadding">';
    str += '        	<div class="form-horizontal">';
	str += '				<div class="control-group">';
	str += '					<label class="control-label" style="width:80">Username</label>';
	str += '					<div class="controls">';
	str += '						<input type="text" name="user_name_'+id+'" id="user_name_'+id+'" value="'+username+'" autocomplete="off" data-placement="right" disabled="disabled"/>';
	str += '					</div>';
	str += '				</div>';
	str += '				<div class="control-group">';
	str += '					<label class="control-label">User Level</label>';
	str += '					<div class="controls">';
	str += '						<label style="float:left; margin-bottom:10px; margin-top:6px"><input type="radio" style="margin-top:-3px" name="user_level_'+id+'[]" onclick="submit_search()" value="1" '+check_level_admin+'/> Admin</label>';
	str += '						<label style="float:left; margin-left:15px; margin-top:6px; margin-bottom:10px;"><input style="margin-top:-3px" type="radio" name="user_level_'+id+'[]" onclick="submit_search()" value="2" '+check_level_super+'/> Supervisor</label>';
	str += '						<label style="float:left; margin-left:15px; margin-top:6px; margin-bottom:10px;"><input style="margin-top:-3px" type="radio" name="user_level_'+id+'[]" onclick="submit_search()" value="3" '+check_level_staff+' /> Staff</label>';	
	str += '					</div>';
	str += '				</div>';
	str += '				<div class="control-group">';
	str += '					<label class="control-label">Email Address</label>';
	str += '					<div class="controls">';
	str += '					<input type="text" name="user_email_'+id+'" autocomplete="off" id="user_email_'+id+'" value="'+email+'"/>';
	str += '				</div>';
	str += '			</div>';
	str += '			<div class="control-group">';
	str += '				<label class="control-label">ON/OFF</label>';
	str += '				<div class="controls">';
	str += '					<span style="float: left; margin-bottom:10px; margin-top:6px"><label><input style="margin-top:-3px" type="radio" name="direct_to_bank_'+id+'[]" value="1" '+check_on+' /> ON</label></span>';
	str += '					<span style="float: left; margin-left:20px; margin-bottom:10px; margin-top:6px"><label><input style="margin-top:-3px" type="radio" name="direct_to_bank_'+id+'[]" value="0" '+check_off+' /> OFF</label></span>';
	str += '				</div>';
	str += '			</div>';
	str += '		</div>';
	str += '	</div>';
	str += '</div>';
	str += '<input type="hidden" value="'+id+'" id="id_edit" />';
	str += '<input type="hidden" value="'+email+'" id="email_edit" />';
	$("#edit_content").empty().append(str);
	
	//document.getElementById("edit_modal").click();

}

function save_edit(){
	var id_edit = 0;
	var email_edit = '';
	var level_edit = 0;
	var status_edit = 0;
	if(document.getElementById("id_edit")){
		id_edit = document.getElementById("id_edit").value;
	}
	if(id_edit > 0){
		if(document.getElementById("user_email_"+id_edit)){
			email_edit = document.getElementById("user_email_"+id_edit).value;
		}
		var user_level = document.getElementsByName("user_level_"+id_edit+"[]");
		for (var i = 0; i < user_level.length; i++){
			if(user_level[i].checked == true){	
				level_edit = user_level[i].value;	
			}
		}
		var arr_direct_to_bank = document.getElementsByName("direct_to_bank_"+id_edit+"[]");
		for(var i = 0; i < arr_direct_to_bank.length; i++){
			if(arr_direct_to_bank[i].checked == true){
				status_edit = arr_direct_to_bank[i].value;
			}
		}
	}
	if(trim(email_edit) == ''){
		alert('Please input Email');
		document.getElementById("user_email_"+id_edit).style.backgroundColor = '#FFC';
		document.getElementById("user_email_"+id_edit).focus();
		return false;	
	}
	if(!check_email_edit(id_edit)){
		document.getElementById("user_email_"+id_edit).focus();
		return false;	
	}
	$.post("<?php echo site_url('admin/edit_user');?>",{
		edit_account:'yes',
		id_edit:id_edit,
		email_edit:email_edit,
		level_edit:level_edit,
		status_edit:status_edit
	},function(data){
		if(data == ''){
			window.location = '';	
		}else{
			alert('Error');	
		}
	});	
	return false;
}
function delete_account(id){
	if(confirm('Delete this account?')){
		$.post("<?php echo site_url('admin/delete_user');?>",{
			delete_account:'yes',
			uid:id
		},function(data){
			if(data == ''){
				window.location = '';	
			}else{
				alert('Error');	
			}
		});	
	}
	return false;
}
function check_email() {
    email = trim($("#user_email").val());
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(reg.test(email) == false) {
		alert("Email format invalid.");
	  	return false;
	}
    AtPos = email.indexOf("@");
    StopPos = 1; //email.lastIndexOf(".");
    if (AtPos == -1 || StopPos == -1)
        return false;
    else
        return true;
}
function check_email_edit(id) {
    email = trim($("#user_email_"+id).val());
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	if(reg.test(email) == false) {
		alert("Email format invalid.");
	  	return false;
	}
    AtPos = email.indexOf("@");
    StopPos = 1; //email.lastIndexOf(".");
    if (AtPos == -1 || StopPos == -1)
        return false;
    else
        return true;
}
function trim(s){ 
    var l=0; var r=s.length -1; 
    while(l < s.length && s[l] == ' ') 
         l++;  
    while(r > l && s[r] == ' ') 
         r-=1;
    return s.substring(l, r+1); 
}
</script>
