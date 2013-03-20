jQuery(function($){
//---------
	//--------- init
	var waterIncome  = $('.per-month');
	var message      = $('.message');
	var formThree    = $('#form-3');
	var inputFields  = $('#form-3 input[name="expenses_month"], #form-3 input[name="bank-name"], #form-3 input[name="account-name"], #form-3 input[name="bsb"], #form-3 input[name="account_num"]');
	var selectFields = $('#form-3 select');
	var url          = $('#form-3').attr('action');
	var textlength   = $('input[name="bsb"]').val().length;
	var el = [
        {
            name : 'expenses_month',
            message : 'Please advise your monthly living expenses',
            type : 'input'
        },
        {
            name : 'bank-name',
            message : 'Please advise your bank',
            type : 'input'
        },
        {
            name : 'account-name',
            message : 'Please advise the name on your bank account',
            type : 'input'
        },
        {
            name : 'bsb',
            message : 'Please advise your bank account BSB number',
            type : 'input'
        },
        {
            name : 'account_num',
            message : 'Please advise your bank account number',
            type : 'input'
        }
    ];

    for(var data in el) {
        $(el[data].type+'[name="'+el[data].name+'"]').data('error', el[data].message);
    }

	//---------
	waterIncome.watermark('$');		

	inputFields.live('focusin', function(){
		$(this).removeClass('error');
	});

	//--------- auto saves the values on the input html element. Event trigger focusout
	inputFields.live('change', function(){
		var field = $(this).attr('name');
		var value = $(this).val();

		$.ajax({
			url     : url,
			type    : 'POST',
			data    : { fields: field, values: value, id: $('#form-3 input[name="applicant_id"]').val() },
			success : function( data ) {
				console.log( data );
			}
		});	

		$(this).removeClass('error');
	});

	//--------- auto saves the values on the select html element. Event trigger focusout
	selectFields.live('change', function(){
		var field = $(this).attr('name');
		var value = $(this).val();

		$.ajax({
			url     : url,
			type    : 'POST',
			data    : { fields: field, values: value, id: $('#form-3 input[name="applicant_id"]').val() },
			success : function( data ) {
				console.log( data );
			}
		});

		$(this).removeClass('error');
	});

	//---------
	formThree.live('submit', function(e){
		var hasValue = true;

        $.each(inputFields, function() {
        	var _this = $(this);

            if(_this.val() == '') {
                hasValue = false;
                
                if(_this.attr('name') == 'mortgage_rent_month' ||
                _this.attr('name') == 'loans_month' ||
                _this.attr('name') == 'credit_card_month' ||
                _this.attr('name') == 'debit_months') {
                	_this.val('0');
                }

                _this.addClass('error');
                if(_this.attr('id') != 'birth_month' && _this.attr('id') != 'birth_year') {
                    var settings = {
                        'disablePos' : true
                    };

                    _this.HCLTooltipValidation(settings);
                }
            } else if($(this).attr('name') == 'bsb') {
            	var txtlen = $(this).val().length;

            	if(_this.val() == ''){
            		hasValue = false;
					$(this).addClass('error');
					$(this).HCLTooltipValidation({
                        'disablePos' : true
                    });
            	} else if(txtlen < 6) {
            		hasValue = false;
					$(this).addClass('error');
					$(this).HCLTooltipValidation({ 'text' : 'Your BSB must be 6 digits', 'disablePos' : true});
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
	$('#form-3 select[name="payment-frequency"]').val( $('#payment_frequency').val() );
	
	inputFields.on('focus', function() {
        var _this   = $(this);
        var tooltip = $(this).next();

        _this.removeClass('error');
        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }
    });

//---------
});