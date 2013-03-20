jQuery(function($){
//---------
	//--------- init
	var waterUnit    = $('input[name="ref2-unit-num"], input[name="ref1-unit-num"]');
	var waterStreet  = $('input[name="ref2-street-num"], input[name="ref1-street-num"]');
	var waterPost    = $('input[name="ref2-postcode"], input[name="ref1-postcode"]');
	var message      = $('.message');
	var formFour     = $('#form-4');
	var inputFields  = $('#form-4 input[type=text]');
	var selectFields = $('#form-4 select');
	var url          = $('#form-4').attr('action');
	var el = [
        {
            name : 'ref1-name',
            message : 'Please advise the full name of a referee',
            type : 'input'
        },
        {
            name : 'ref1-relationship',
            message : 'Please advise your relationship to the referee',
            type : 'input'
        },
        {
            name : 'ref1_mobile_phone',
            message : 'Please advise the mobile phone number for your referee',
            type : 'input'
        },
        {
            name : 'ref1-street-num',
            message : 'Please advise the street number for your referee',
            type : 'input'
        },
        {
            name : 'ref1-street-name',
            message : 'Please advise the street name for your referee',
            type : 'input'
        },
        {
            name : 'ref1-city-suburb',
            message : 'Please advise the suburb for your referee',
            type : 'input'
        },
        {
            name : 'ref1-state',
            message : 'Select the state',
            type : 'select'
        },
        {
            name : 'ref1-postcode',
            message : 'Select advise the postcode',
            type : 'input'
        },

        {
            name : 'ref2-name',
            message : 'Please advise the full name of a referee',
            type : 'input'
        },
        {
            name : 'ref2-relationship',
            message : 'Please advise your relationship to the referee',
            type : 'input'
        },
        {
            name : 'ref2_mobile_phone',
            message : 'Please advise the mobile phone number for your referee',
            type : 'input'
        },
        {
            name : 'ref2-street-num',
            message : 'Please advise the street number for your referee',
            type : 'input'
        },
        {
            name : 'ref2-street-name',
            message : 'Please advise the street name for your referee',
            type : 'input'
        },
        {
            name : 'ref2-city-suburb',
            message : 'Please advise the suburb for your referee',
            type : 'input'
        },
        {
            name : 'ref2-state',
            message : 'Select the state',
            type : 'select'
        },
        {
            name : 'ref2-postcode',
            message : 'Select advise the postcode',
            type : 'input'
        }
    ];

    for(var data in el) {
        $(el[data].type+'[name="'+el[data].name+'"]').data('error', el[data].message);
    }
	
	//---------
	waterUnit.watermark('Unit');
	waterStreet.watermark('No');
	waterPost.watermark('Postcode');

	inputFields.live('focusin', function(){
		$(this).removeClass('error');
	});

	//--------- auto saves the values on the input html element. Event trigger focusout
	inputFields.live('change', function(){
		var field = $(this).attr('name');
		var value = $(this).val();
		var flag  = 0;

		console.log(field);

		if( field == 'ref1_mobile_phone' || field == 'ref2_mobile_phone' ) {
			console.log(value.length);
			if( value.length < 10 ) {
				$(this).addClass('error');
				flag = 1;
			} else {
				$(this).removeClass('error');
			}
		}

		if( flag == 0 ) {
			$.ajax({
				url     : url,
				type    : 'POST',
				data    : { fields: field, values: value, id: $('#form-4 input[name="applicant_id"]').val() },
				success : function( data ) {
					console.log( data );
				}
			});	

			$(this).removeClass('error'); 
		}
	});

	//--------- auto saves the values on the select html element. Event trigger focusout
	selectFields.live('change', function(){
		var field = $(this).attr('name');
		var value = $(this).val();

		$.ajax({
			url     : url,
			type    : 'POST',
			data    : { fields: field, values: value, id: $('#form-4 input[name="applicant_id"]').val() },
			success : function( data ) {
				console.log( data );
			}
		});

		$(this).removeClass('error');
	});

	//---------
	formFour.live('submit', function(e){
		var hasValue = true;

		$.each(formFour.find('select'), function() {
			var _this = $(this);
            if($(this).val() == '') {
                hasValue = false;

                _this.addClass('error');
                if(_this.attr('id') != 'birth_month' && _this.attr('id') != 'birth_year') {
                    var settings = {
                        'disablePos' : true
                    };

                    _this.HCLTooltipValidation(settings);
                }
            }
        });

        $.each(formFour.find('input[type="text"]'), function() {
        	var _this = $(this);
            if($(this).attr('name') != 'ref1-unit-num' && $(this).attr('name') != 'ref2-unit-num') {
                if($(this).val() == '') {
                    hasValue = false;

                    _this.addClass('error');
	                if(_this.attr('id') != 'birth_month' && _this.attr('id') != 'birth_year') {
	                    var settings = {
	                        'disablePos' : true
	                    };

	                    _this.HCLTooltipValidation(settings);
	                }
	            }
            }

            if( $(this).attr('name') == 'ref1_mobile_phone' || $(this).attr('name') == 'ref2_mobile_phone' ) {
            	if($(this).val() == ''){
            		hasValue = false;

                    _this.addClass('error');
	                if(_this.attr('id') != 'birth_month' && _this.attr('id') != 'birth_year') {
	                    var settings = {
	                        'disablePos' : true
	                    };

	                    _this.HCLTooltipValidation(settings);
	                }
            	} else if( $(this).val().length < 10 ) {
					hasValue = false;
					$(this).addClass('error');

                    var settings = {
                        'disablePos' : true,
                        'text' : 'Mobile number must be 10 digits'
                    }

                    _this.HCLTooltipValidation(settings);
				} else { 
					if($(this).val()[0] != '0' || $(this).val()[1] != '4') {
						hasValue = false;
						$(this).addClass('error');

						var settings = {
	                        'disablePos' : true,
	                    	'text' : 'Mobile number must begin with 04'
	                    }

	                    _this.HCLTooltipValidation(settings);
	                }
				}
			}
        });

		if( hasValue ) {
			window.location.href = $('.submit-btn').data('url');
		}

		e.preventDefault();
		return false;
	});

	//---------
	$('#form-4 select[name="ref1-state"]').val( $('#ref1_state').val() );
	$('#form-4 select[name="ref2-state"]').val( $('#ref2_state').val() );
	$('#form-4 input[name*="mobile_phone"]').attr({
		'size': 10,
		'maxlength': 10
	})

	inputFields.on('focus', function() {
        var _this   = $(this);
        var tooltip = $(this).next();

        _this.removeClass('error');
        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }
    });

    selectFields.on('focus', function() {
        var _this   = $(this);
        var tooltip = $(this).next();

        _this.removeClass('error');
        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }
    })

	//---------
	//$('#form-4 input, #form-4 select').tooltip();

	//---------
	/*formFour.validate({
		rules: {
			ref1_home_phone: {
				required: true,
				number: true,
				maxlength: 10,
			},
			ref1_mobile_phone: {
				required: true,
				number: true,
				maxlength: 11
			},
			ref2_home_phone: {
				required: true,
				number: true,
				maxlength: 10
			},
			ref2_mobile_phone: {
				required: true,
				number: true,
				maxlength: 11
			}
		}
	});*/
	
//---------
});