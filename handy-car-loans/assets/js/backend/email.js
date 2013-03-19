(function($) {
	var emailForm = $('#email-management-form');

	emailForm.on('submit', function(e) {
		var _this = $(this);

		var url  = $(this).attr('action');
		var data = $(this).serialize();

		$.ajax({
			url 	: url,
			type 	: 'POST',
			data    : data,
			success : function( response ) {
				alert("Message Sent");
				_this.find('input[type="text"]').val('');
				_this.find('textarea').val('');
			} 
		});

		return false;
	});

	var requestForm = $('#email-request-document');

	requestForm.on('submit', function(e) {
		var url  = $(this).attr('action');
		var data = $(this).serialize();

		if( $(this).find('input[name="doc[]"]').is(':checked') ) {
			$.ajax({
				url : url,
				type : 'POST',
				data : data,
				success : function( response )  {
					console.log(response);
					if(response == 'success'){
						$.gritter.add({
							title:	'Successful',
							text:	'Document Request Sent.',
							sticky: false
						});	
						window.location.reload();
					}
				}
			})
		} else {
			$.gritter.add({
				title:	'Error',
				text:	'Please Select from checkboxes.',
				sticky: false
			});	
		}

		e.preventDefault();
		return false;
	});
})(jQuery);
