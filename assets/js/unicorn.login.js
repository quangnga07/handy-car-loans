$(document).ready(function(){

	var login = $('#loginform');
	var recover = $('#recoverform');
	var speed = 400;

	$('#to-recover').click(function(){
		login.fadeTo(speed,0.01).css('z-index','100');
		recover.fadeTo(speed,1).css('z-index','200');
	});

	$('#to-login').click(function(){
		recover.fadeTo(speed,0.01).css('z-index','100');
		login.fadeTo(speed,1).css('z-index','200');
	});
    
    if($.browser.msie == true && $.browser.version.slice(0,3) < 10) {
        $('input[placeholder]').each(function(){ 
       
        var input = $(this);       
       
        $(input).val(input.attr('placeholder'));
               
        $(input).focus(function(){
             if (input.val() == input.attr('placeholder')) {
                 input.val('');
             }
        });
       
        $(input).blur(function(){
            if (input.val() == '' || input.val() == input.attr('placeholder')) {
                input.val(input.attr('placeholder'));
            }
        });
    });
	 
    }
});

function recover_password(){
	var user_email = document.getElementById("recover_email").value;
	var url_link = document.getElementById("url_link").value;
	if(trim(user_email) == ''){
		alert('Please input Email');
		document.getElementById("recover_email").style.backgroundColor = '#FFC';
		document.getElementById("recover_email").focus();
		return false;	
	}
	if(!check_email()){
		document.getElementById("recover_email").focus();
		return false;	
	}
	$.post(url_link,{
		recover_password:'yes',
		user_email:user_email
	},function(data){
		if(data.error == ''){
			alert('An email has been sent.');
			//window.location.reload();
		}else{
			alert(data.error);
		}
	},'json');
	return false;
	
}
function check_email() {
    email = trim(document.getElementById("recover_email").value);
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