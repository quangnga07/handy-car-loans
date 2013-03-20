(function($) {

	var uploadBtn = $('#upload-form-media');
	var button    = $('.upload-btn-media');
	var action    = $('#action_upload');

	uploadBtn.on('submit', function(e){
		var flag = 0;

		if( action.val() == 'Add' ) {
			$('.form input').each(function(){
				if( $(this).val() == '' || $(this).val() == null ) {
					flag = 1;
					$(this).addClass('error');
				} else {
					$(this).removeClass('error');
				}
			});

			if( flag != 0 ) {
				e.preventDefault();
				return false;
			}
		}
	});

})(jQuery);