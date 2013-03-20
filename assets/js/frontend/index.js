jQuery(function($){
//---------
	//--------- init
	var applyForm  = $('#signup-form');
	var fields     = $('#signup-form input[type="text"]');
	var checkBox   = $('#signup-form input[type="checkbox"].mini-form');
	var term       = $('#signup-form input[name="agree"]');
	var nameField  = $('#fn, #ln');
	var isEmpty    = false;
	var tempField  = [];

	//---------

	//---------
	$('#apply-now').on('click', function(e) {
		var isEmpty = false;
		var _this   = $(this);

		nameField.each(function(){
			var str    = $(this).val();
			var patt   = /[0-9]/g;
			var isTrue = patt.test(str);

			if( isTrue == true ) {
				$(this).addClass('error');
				isEmpty = true;
			}
		});

		$.each(fields, function() {
			if( $(this).val() == '' ) {
				isEmpty = true;
				$(this).addClass('error');
				$(this).HCLTooltipValidation();

				tempField.push($(this));
			}
		});

    	var textlength = $('input[name="phone"]').val().length;

    	if(textlength < 10 || textlength > 10) {
    		isEmpty = true;
			$('input[name="phone"]').addClass('error');
			$('input[name="phone"]').HCLTooltipValidation({
				'text' : 'Your number must be 10 digits'
			})

			tempField.push($('input[name="phone"]'));
    	}

    	console.log($('input[name="phone"]').val()[1] != '4');

    	if(textlength == 10 && ($('input[name="phone"]').val()[0] != '0' || $('input[name="phone"]').val()[1] != '4') ) {
    		isEmpty = true;
    		$('input[name="phone"]').addClass('error');
			$('input[name="phone"]').HCLTooltipValidation({
				'text' : 'Your number must begin with 04'
			})

			tempField.push($('input[name="phone"]'));
    	}

		var box = checkBox.parent();

		if( !box.hasClass('checked') ){
			isEmpty = true;
			box.parent().addClass('error');
			$('#titles').HCLTooltipValidation({
				'type' : 'checkbox'
			});
			$('#titles').next().css('margin-left','-51px');
		}

		if( !term.parent().hasClass('checked') ) {
			isEmpty = true;
			term.parent().parent().addClass('error');
			term.parent().parent().HCLTooltipValidation({
				'type' : 'single',
				'text' : 'You must agree to continue'
			});
		}

		if(isEmpty) {
			tempField.push($(this).parent().parent());
		}

		if(!isValidEmailAddress($('input[name="email"]').val()) && $('input[name="email"]').val() != '') {
			$('input[name="email"]').addClass('error');
			$('input[name="email"]').HCLTooltipValidation();
			tempField.push($('input[name="email"]'));
		}

		if(!isEmpty) {
			$.ajax({
				url : applyForm.find('input[name="dup_url"]').val(),
				type : 'POST',
				data : applyForm.serialize(),
				beforeSend: function() {
					$.blockUI({ message: $('#preloader-home'), css: { width: '66px', background: 'none', top:'30%', border: 'none', left: '49%' } }); 
				},
				success : function( response ) {
					$.unblockUI();
					if(response == 'success') {
						$('#dup_check').modal();
					} else {
						applyForm.submit();
					}
				}
			});
			$('#dup_check').on('hidden', function(){
				$.each(fields, function() {
					if($(this).attr('name') != 'dup_url')
						$(this).val('');
				});
			});
		}

		e.preventDefault();
		return false;
	});

	fields.focus(function() {
		$.each(tempField, function() {
			$(this).removeClass('error');

			$(this).HCLTooltipValidation('hide');
			$('#titles').HCLTooltipValidation('hide');
			term.parent().parent().HCLTooltipValidation('hide');
		});
		checkBox.parent().parent().removeClass('error');
		term.parent().parent().removeClass('error');

		isEmpty = false;
	});

	checkBox.parent().parent().on('click', function() {
		checkBox.parent().parent().removeClass('error');
		$('#titles').HCLTooltipValidation('hide');
	})

	term.parent().parent().on('click', function() {
		term.parent().parent().removeClass('error');
		$(this).HCLTooltipValidation('hide');
	})

	function isValidEmailAddress(emailAddress) {
	    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
	    return pattern.test(emailAddress);
	};

//---------
});