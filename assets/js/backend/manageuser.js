jQuery(function($){
//---------
	//--------- init 
	var user_form    = $('#user_form');
	var successAlert = $('.alert-success');
	var errorAlert   = $('.alert-error');
	var btnEdit      = $('.btn-edt');
	var btnDelete    = $('.btn-del');
	var sidebarMenu  = $('#sidebar ul li a');
	var accountTable = $('.account-user-table');

	accountTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aaSorting": [[ 6, "asc" ]]
	});

	//---------
	user_form.validate({
		rules: {
			username: {
				required: true
			},
			passwrd: {
				required: true
			},
			password: {
				required: true,
				equalTo: "#password1"
			},
			email: {
				required: true,
				email: true
			},
			user: {
				required: true
			}
		}
	})

	//---------
	btnDelete.live('click', function(){
		var userId      = $(this).attr('id');
		var parentTr    = $(this).parent().parent().parent();
		var confirmtext = ("Deleting data, are you sure?");

		if( confirm(confirmtext) ) { 
			$.ajax({
				url     : 'users/remove_user',
				type    : 'POST',
				data    : { id: userId },
				success : function( response ) {
					if( response == 'ok' ) {
						parentTr.remove();
						successAlert.removeClass('hide');	
					} else {
						errorAlert.removeClass('hide');
					}
				}
			});
		}	
	});

	//---------
	sidebarMenu.each(function(){
		var url = window.location.href;

		if(url == (this.href)) {
			$(this).closest("li").addClass("active");
		}
	});

//---------
});