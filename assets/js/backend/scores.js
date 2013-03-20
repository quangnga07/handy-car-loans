jQuery(function($){
//---------
	//--------- init 
	var inputFields = $('input[name="score"]');

	$('#save-score').on('click', function(){
		$.each(inputFields, function(i, v){
			var hasValue = true;
			var field    = $(this).attr('name');
			var fieldId  = $(this).attr('id');
			var value    = $(this).val();
			var pattern  = new RegExp('\D');

			if( value == '' || value == null ) {
				$(this).addClass('error');
				hasValue = false;
			} else {
				if( pattern.test(value) ) {
					$(this).addClass('error');
					hasValue = false;
				} else {
					$(this).removeClass('error');	
				}
			}

			if( hasValue ) {
				$.ajax({
					url     : 'scores/autosave',
					type    : 'POST',
					data    : { fields: field, values: value, id: fieldId },
					success : function( data ) {
					}
				});
			}

			if( i == inputFields.length-1 ) {
				alert("Save Successful");
			}
		});
	});

	/* inputFields.live('focusout', function(){
		var hasValue = true;
		var field    = $(this).attr('name');
		var fieldId  = $(this).attr('id');
		var value    = $(this).val();
		var pattern  = new RegExp('\D');

		if( value == '' || value == null ) {
			$(this).addClass('error');
			hasValue = false;
		} else {
			if( pattern.test(value) ) {
				$(this).addClass('error');
				hasValue = false;
			} else {
				$(this).removeClass('error');	
			}
		}

		if( hasValue ) {
			$.ajax({
				url     : 'scores/autosave',
				type    : 'POST',
				data    : { fields: field, values: value, id: fieldId },
				success : function( data ) {
					console.log( data );
				}
			});
		}
	}); */


//---------
});