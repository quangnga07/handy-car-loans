<div id="content">
	<div id="content-header">
        <h1>Reachtel API Settings</h1>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="">APIs</a>
		<a href="<?php echo site_url('admin/sms_config');?>" class="current">ReachTel SMS</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-comment"></i>
						</span>
						<h5>Account Details</h5>
					</div>
                    <div class="widget-content nopadding">
                    	<div class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Registered User Name</label>
                                <div class="controls">
                                    <input type="text" id="usr_name" value="<?php if(isset($sms_config[0]['usrname'])) echo $sms_config[0]['usrname']?>" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input type="password" id="passw" value="<?php if(isset($sms_config[0]['password'])) echo $sms_config[0]['password']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    		</div>
		</div>
        <!--
        <div class="row-fluid">
        	<div class="span12">            
                <div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-comment"></i>
						</span>
						<h5>Delay Setting for Message No1</h5>
					</div>
                    <div class="widget-content nopadding">
                    	<div class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Minutes</label>
                                <div class="controls">
                                    <input type="text" id="delay_min" value="<?php if(isset($sms_config[0]['delaymin'])) echo $sms_config[0]['delaymin']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
    	-->
        <div class="row-fluid">
        	<div class="span12">        
            	<div class="widget-box incomplete-box">
                	<div class="widget-title incomplete-title">
						<span class="icon">
							<i class="icon-comment"></i>
						</span>
						<h5>Message Settings</h5>
					</div>
                    <div class="widget-content nopadding">
	                    <div class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">MESSAGE No1</label>
                                <div class="controls">
                                	<div style="width:80%" align="right"><span class="label label-warning">(Maximum 459)</span>&nbsp;&nbsp;&nbsp;<span class="label label-info">Character <span id="count_msg_1">0</span></span></div>
                                    <div style="width:80%; height:5px"></div>
                                    <textarea id="message_1" spellcheck="false" onkeydown="return keypress(event, 1);" onkeyup="return keypress(event, 1);"><?php if(isset($sms_config[0]['message_1'])) echo $sms_config[0]['message_1']?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">MESSAGE No2</label>
                                <div class="controls">
                                	<div style="width:80%" align="right"><span class="label label-warning">(Maximum 459)</span>&nbsp;&nbsp;&nbsp;<span class="label label-info">Character <span id="count_msg_2">0</span></span></div>
                                    <div style="width:80%; height:5px"></div>
                                    <textarea id="message_2" spellcheck="false" onkeydown="return keypress(event, 2);" onkeyup="return keypress(event, 2);"><?php if(isset($sms_config[0]['message_2'])) echo $sms_config[0]['message_2']?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">MESSAGE No3</label>
                                <div class="controls">
                                	<div style="width:80%" align="right"><span class="label label-warning">(Maximum 459)</span>&nbsp;&nbsp;&nbsp;<span class="label label-info">Character <span id="count_msg_3">0</span></span></div>
                                    <div style="width:80%; height:5px"></div>
                                    <textarea id="message_3" spellcheck="false" onkeydown="return keypress(event, 3);" onkeyup="return keypress(event, 3);" ><?php if(isset($sms_config[0]['message_3'])) echo $sms_config[0]['message_3']?></textarea>
                                </div>
                            </div>
						</div>
                   	</div>
              	</div>  
                <p style="padding:10px 10px 10px 0px;"> 
                    <button type="button" class="btn" data-loading-text="Savin changes..." onclick="return submit_sms_setting()">Save Changes</button>
                </p>
			</div>
		</div>
        <div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
function keypress(e , message){
	if (window.event){
		keypressed = window.event.keyCode; //IE
	}else{ 
		keypressed = e.which; //NON-IE, Standard
	}
	var str_msg = $("#message_"+message).val();
	str_msg = remove_char(str_msg);
	$("#count_msg_"+message).empty().append(str_msg.length);
	if(keypressed != 8)
		if(str_msg.length >= 459) return false;
}
function remove_char(str){
	str = str.split(" ").join("");
	return str;
}
function IsNumeric(sText)
{
   var ValidChars = "0123456789.";
   var IsNumber=true;
   var Char;
   for (i = 0; i < sText.length && IsNumber == true; i++) 
   { 
      Char = sText.charAt(i); 
      if (ValidChars.indexOf(Char) == -1) 
         IsNumber = false;
   }
   return IsNumber;
}
function submit_sms_setting(){
	if(document.getElementById("usr_name")){
		if(document.getElementById("usr_name").value == ''){
			alert('Input Registered User Name.');
			document.getElementById("usr_name").focus();
			return false;
		}	
	}
	if(document.getElementById("passw")){
		if(document.getElementById("passw").value == ''){
			alert('Input Password.');
			document.getElementById("passw").focus();	
			return false;
		}	
	}
	if(document.getElementById("delay_min")){
		if(document.getElementById("delay_min").value != ''){
			if(!IsNumeric(document.getElementById("delay_min").value)){
				alert('Minutes must be a number.');
				document.getElementById("delay_min").focus();	
				return false;
			}
		}	
	}
	$.post("<?php echo site_url('admin/update_sms_config');?>",{
		update_sms_cf:'yes',
		usr_name:$("#usr_name").val(),
		passw:$("#passw").val(),
		delay_min:$("#delay_min").val(),
		message_1:$("#message_1").val(),
		message_2:$("#message_2").val(),
		message_3:$("#message_3").val()
	},function(data){
		if(data == ''){
			alert('Save success.');
		}else{
			alert('Save error.');	
		}
	});
}
function count_character(message){
	var str_msg = $("#message_"+message).val();
	str_msg = remove_char(str_msg);
	$("#count_msg_"+message).empty().append(str_msg.length);	
}
$(function(){
	count_character(1);	
	count_character(2);	
	count_character(3);	
})
</script>   