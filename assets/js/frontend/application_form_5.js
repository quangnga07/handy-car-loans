jQuery(function($){
//---------
	//--------- init
	var formFive = $('#form-5');
	var url      = $('#form-5').attr('action');
	var checkBox = $('#form-5 input[type="checkbox"]');

	checkBox.parent().parent().on('click', function() {
		checkBox.parent().parent().removeClass('error');
		$(this).HCLTooltipValidation('hide');
	});

	//---------
	formFive.live('submit', function(e){
		var hasValue  = true;
		/*var emailUrl  = $(this).find('input[name="send_to_url"]').val();
		var emailData = {
			applicant_id : $(this).find('input[name="applicant_id"]').val(),
			client_email : $(this).find('input[name="applicant_email"]').val(),
			template_id  : 4,
			
		}*/

		var box = checkBox.parent();
		if( !box.hasClass('checked') ){
			hasValue = false;
			box.parent().addClass('error');
			box.parent().HCLTooltipValidation({
				'disablePos' : true,
				'text' : 'You must agree to terms in order to submit your application',
				'css' : {
					'margin-left' : '4px',
					'margin-top' : '0px',
					'max-width' : '300px'
 				}
			})
		}

		if( hasValue ) {

			$.ajax({
				url : $(this).find('input[name="dup_url"]').val(),
				type : 'POST',
				data : { id: $('#form-5 input[name="applicant_id"]').val() },
				beforeSend: function() {
					$.blockUI({ message: $('#preloader'), css: { width: '66px', background: 'none', top:'30%', border: 'none', left: '49%' } }); 
				},
				success : function( response ) {
					if(response == 'Exist') {
						window.location.href = $('#submit-btn-application').data('url');
					} else {
						$.ajax({
							url     : url,
							type    : 'POST',
							data    : { fields: 'has_fill', values: 'Yes', id: $('#form-5 input[name="applicant_id"]').val() },
							success : function( data ) {
								console.log(data);
								if( data == 'true' ) {
									window.location.href = $('#submit-btn-application').data('url');
								}
							}
						});

						/*$.ajax({
							url : emailUrl,
							type : 'POST',
							data : emailData,
							success : function( response ) {
								console.log( response );
								$.unblockUI();
								if( response == 'success' ) {
									window.location.href = $('#submit-btn-application').data('url');
								}
							}
						});*/
					}
				}
			})

			
		}

		e.preventDefault();
		return false;
	});
//---------
});