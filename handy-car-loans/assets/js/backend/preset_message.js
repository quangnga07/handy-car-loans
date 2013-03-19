(function($) {

	var button     = $("form.presetform");

	var loadData = function( radio, input ) {
		var _flag = 0;
		radio.each(function(){
			var value = $(this).val();

			input.each(function(){
				var hidden = $(this).val();

				if( value == hidden && _flag == 0 ) {
					$(this).attr('checked','checked');
					$(this).parent().addClass('checked');
					_flag = 1;
				}
			});
		});
	}

	// for tab 1 preload data on radio buttons
	loadData( $(".radio_tab1_one"),   $("input[name=type_tab1_one]")   );
	loadData( $(".radio_tab1_two"),   $("input[name=type_tab1_two]")   );
	loadData( $(".radio_tab1_three"), $("input[name=type_tab1_three]") );
	loadData( $(".radio_tab1_four"),  $("input[name=type_tab1_four]")  );

	// for tab 2 preload data on radio buttons
	loadData( $(".radio_tab2_one"),   $("input[name=type_tab2_one]")   );
	loadData( $(".radio_tab2_two"),   $("input[name=type_tab2_two]")   );
	loadData( $(".radio_tab2_three"), $("input[name=type_tab2_three]") );
	loadData( $(".radio_tab2_four"),  $("input[name=type_tab2_four]")  );

	// for tab 3 preload data on radio buttons
	loadData( $(".radio_tab3_one"),   $("input[name=type_tab3_one]")   );
	loadData( $(".radio_tab3_two"),   $("input[name=type_tab3_two]")   );
	loadData( $(".radio_tab3_three"), $("input[name=type_tab3_three]") );
	loadData( $(".radio_tab3_four"),  $("input[name=type_tab3_four]")  );


	button.on('submit', function(e){
		var values = $(this).serialize();

		$.ajax({
			url     : $(this).attr('action'),
			type    : 'POST',
			data    : values,
			success : function( response ){
				if( response == 'ok' ) {
					$.gritter.add({
						title:	'Successful',
						text:	'Changes was saved.',
						sticky: false
					});
				} else {
					$.gritter.add({
						title:	'Error',
						text:	'Changes was not saved.',
						sticky: false
					});
				}
			}
		});
		e.preventDefault();
		return false;
	});

})(jQuery);