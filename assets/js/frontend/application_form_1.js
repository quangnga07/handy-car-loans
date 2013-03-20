jQuery(function($){
//---------
	//--------- init
	var url        = $('#form-1').attr('action');
	var waterDate  = $('#birth_date');
	var waterMonth = $('#birth_month');
	var waterYear  = $('#birth_year');
	var unitNo     = $('#unit');
	var streetNo   = $('#street');
	var postCode   = $('#post-code');
	var loanAmount = $('#loan');

	var formOne      = $('#form-1');
	var inputFields  = $('#form-1 input[type=text]');
	var selectFields = $('#form-1 select');
	var emailAddress = $('#email-address');
	var emailConfirm = $('#email-confirm');

	var elToDisable = $('#form-1 select[name="title"], #form-1 input[name="fname"], #form-1 input[name="lname"], #form-1 input[name="email"], #form-1 input[name="user_mobile_phone"]');

	elToDisable.prop('disabled', true);

	//--------- 
	waterDate.watermark('DD');
	waterMonth.watermark('MM');
	waterYear.watermark('YYYY');
	unitNo.watermark('Unit');
	streetNo.watermark('No');
	postCode.watermark('Postcode');

	var el = [
		{
			name : 'city-suburb', 
			message : 'Please advise your suburb',
			type : 'input'
		},
		{
			name : 'license-num',
			message : 'You must hold a valid Drivers Licence',
			type : 'input'
		},
		{
			name : 'street-name',
			message : 'Please advise your street name',
			type : 'input'
		},
		{
			name : 'birth_date',
			message : 'You must be over 18 years of age',
			type : 'input'
		},
		{
			name : 'street-num',
			message: 'Please advise your Street number',
			type : 'input'
		},
		{
			name : 'state',
			message : 'Select your state',
			type : 'select'
		},
		{
			name : 'postcode',
			message : 'Select your postcode',
			type : 'input'
		},
		{
			name : 'residential-status',
			message : 'Please advise your residential status',
			type : 'select'
		},
		{
			name : 'time-address',
			message : 'How long have you resided at this address?',
			type : 'select'
		},
		{
			name : 'user_email',
			message : 'Please confirm your email',
			type : 'input'
		},
		{
			name : 'loan_amount',
			message : 'How much do you wish to borrow?',
			type : 'input'
		},
		{
			name : 'loan-purpose',
			message : 'Please advise the purpose of the loan',
			type : 'select'
		}
	];

	for(var data in el) {
		$(el[data].type+'[name="'+el[data].name+'"]').data('error', el[data].message);
	}


    var validateEmail = function() {
		if( emailAddress.val() != emailConfirm.val() ) {
			return false;
		} else {
			return true;
		}
	}

	//--------- auto saves the values on the input html element. Event trigger focusout
	inputFields.live('focusout', function(){
		var check = true;
		var field = $(this).attr('name');
		var value = $(this).val();

		//--------- checks for email confirmation
        if( field == 'user_email' ) {
            check = validateEmail();
        }

        //--------- don't send if email is the field value
        if( field == 'email' ) {
            check = false;
        }
        
        //--------- checks your age it must 18 above
        if( field == 'birth_year' ) {
        	var day     = $('#birth_date').val();
        	var month   = $('#birth_month').val() - 1;
        	var date1   = new Date(value, month, day, 0, 0, 0, 0)
        	var date2   = new Date()
		    var ONE_DAY = 1000 * 60 * 60 * 24

		    var date1_ms = date1.getTime()
		    var date2_ms = date2.getTime()

		    var difference_ms = Math.abs(date1_ms - date2_ms)
		    
		    var result =  Math.round(difference_ms/ONE_DAY)
		    var age    = result/365.242;

        	if( value.length == 4 ) {
	            console.log( age );
	            if( age >= 18 ) {
	                $("#birth_year, #birth_month, #birth_date").removeClass('error');
	                check = true;
	            } else {
	                $("#birth_year, #birth_month, #birth_date").addClass('error');
	                check = false;
	            }
            } else {
            	$(this).addClass('error');
	            check = false;
            }
        }

		if( check ) {
			$.ajax({
				url     : url,
				type    : 'POST',
				data    : { fields: field, values: value, id: $('#form-1 input[name="applicant_id"]').val() },
				success : function( data ) {
					console.log( data );
				}
			});	
		}
	});

	//--------- auto saves the values on the select html element. Event trigger focusout
	selectFields.live('change', function(){
		var field = $(this).attr('name');
		var value = $(this).val();

		$.ajax({
			url     : url,
			type    : 'POST',
			data    : { fields: field, values: value, id: $('#form-1 input[name="applicant_id"]').val() },
			success : function( data ) {
				console.log( data );
			}
		});
	});

	//---------
	formOne.live('submit', function(e){
		var hasValue = true;

		inputFields.each(function() {
			var _this = $(this);

			if( _this.val() == '' && 
				_this.attr('name') != 'mname' &&
				_this.attr('name') != 'unit-num') {
				hasValue = false;

				_this.addClass('error');
				if(_this.attr('name') != 'birth_month' && _this.attr('name') != 'birth_year') {
					_this.HCLTooltipValidation({
						'disablePos' : true
					});
				}
			}
		});

		selectFields.each(function() {
			var _this = $(this);

			if( _this.val() == '' ) {
				hasValue = false;

				_this.addClass('error');
				_this.HCLTooltipValidation({
					'disablePos' : true
				});
			}
		});

		if( hasValue ) {
			window.location.href = $('.submit-btn').data('url');
		}

		e.preventDefault();
		return false;
	});

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
	});

	//--------- loads the existing value on the dropdown fields
	$('#form-1 select[name="title"]').val( $('#title').val() );
	$('#form-1 select[name="state"]').val( $('#state').val() );
	$('#form-1 select[name="residential-status"]').val( $('#residential_status').val() );
	$('#form-1 select[name="time-address"]').val( $('#time_address').val() );
	$('#form-1 select[name="loan-purpose"]').val( $('#loan_purpose').val() );
	$('#form-1 input[name="user_mobile_phone"]').attr({
		'size': 10,
		'maxlength': 10
	})
//---------
});