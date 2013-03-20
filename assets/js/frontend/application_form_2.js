jQuery(function($){
    //---------
    //--------- init
    var waterPayday  = $('#payday');

    var waterIncome  = $('#income');
    var waterUnit    = $('#unit');
    var waterStreet  = $('#street');
    var waterPost    = $('#post-code');
    var message      = $('.message');
    var formTwo      = $('#form-2');
    var inputFields  = $('#form-2 input[type=text]');
    var radioFields  = $('#form-2 input[type=radio]');
    var selectFields = $('#form-2 select');
    var url          = $('#form-2').attr('action');
    var waterDate    = $('#birth_date');
    var waterMonth   = $('#birth_month');
    var waterYear    = $('#birth_year');
    var paydayDate;
    var el = [
        {
            name : 'employment-status',
            message : 'Please advise your employment status',
            type : 'select'
        },
        {
            name : 'employment-length',
            message : 'Please advise the length of your employment',
            type : 'select'
        },
        {
            name : 'monthly_income',
            message : 'Please advise your monthly income',
            type : 'input'
        },
        {
            name : 'payday-frequency',
            message : 'Please advise how often are you paid',
            type : 'select'
        },
        {
            name : 'business-name',
            message : 'Please provide the business name of your employer',
            type : 'input'
        },
        {
            name : 'employer_phone',
            message : 'Please provide your employers phone number',
            type : 'input'
        },
        {
            name : 'employer-state',
            message : 'Select your state',
            type : 'select'
        },
        {
            name : 'employer-street-num',
            message : 'Please advise your Street number',
            type : 'input'
        },
        {
            name : 'employer-street-name',
            message : 'Please advise your street name',
            type : 'input'
        },
        {
            name : 'employer-city-suburb',
            message : 'Please advise your suburb',
            type : 'input'
        },
        {
            name : 'employer-postcode',
            message : 'Select your postcode',
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

    var dates = waterPayday.val();
    dates = dates.split('-');
        
    ( (dates[0] == '0000') ? waterYear.watermark('YYYY')  : waterYear.val(dates[0]) );
    ( (dates[1] == '00') ?   waterMonth.watermark('MM')  : waterMonth.val(dates[1]) );
    ( (dates[2] == '00') ?   waterDate.watermark('DD')  : waterDate.val(dates[2]) );

    //--------- sumbit the data into the database and saves it
    var autoSave = function( field, value ) {
        $.ajax({
            url     : url,
            type    : 'POST',
            data    : {
                fields: field, 
                values: value, 
                id: $('#form-2 input[name="applicant_id"]').val()
            },
            success : function( data ) {
                console.log( data );
            }
        });
    }

    waterYear.on('change', function() {
        paydayDate = waterYear.val()+'-'+waterMonth.val()+'-'+waterDate.val();
        waterPayday.val(paydayDate);

        var todayDate = new Date();
        var todayDay  = todayDate.getDate();
        var todayMon  = todayDate.getMonth() + 1;
        var todayYear = todayDate.getFullYear();
        var dateText  = $('#payday').val();
        var nextPay   = dateText.split('-');
        var flagCount = 0;

        console.log( nextPay[0]+" "+nextPay[1]+" "+nextPay[2]);
            
        var day   = nextPay[2] - todayDay;
        var month = nextPay[1] - todayMon;
        var year  = nextPay[0] - todayYear;

        var payField = $('#birth_date, #birth_month, #birth_year');

        console.log( day+" "+month+" "+year);

        if( month == 0 && year == 0 ) {
            if( day >= 0 ) {
                payField.removeClass('error');
                autoSave(waterPayday.attr('name'), waterPayday.val());
            } else {
                payField.addClass('error');
            }
        }
        else if( month > 0 && year >= 0 ) {
            payField.removeClass('error');
            autoSave(waterPayday.attr('name'), waterPayday.val());
        }
        else if( year > 0 ) {
            payField.removeClass('error');
            autoSave(waterPayday.attr('name'), waterPayday.val());
        } else {
            payField.addClass('error');
        }

        //autoSave(waterPayday.attr('name'), waterPayday.val());
    });
    waterMonth.on('change', function() {
        paydayDate = waterYear.val()+'-'+waterMonth.val()+'-'+waterDate.val();
        waterPayday.val(paydayDate);
        autoSave(waterPayday.attr('name'), waterPayday.val());
    });
    waterDate.on('change', function() {
        paydayDate = waterYear.val()+'-'+waterMonth.val()+'-'+waterDate.val();
        waterPayday.val(paydayDate);
        autoSave(waterPayday.attr('name'), waterPayday.val());
    });

    //--------- employement & employer details is not required when employment status is unemployed & retired
    /*$('select[name=employment-status]').on('change', function(){
        var empVal = $(this).val();

        if( empVal == 'Unemployed' || empVal == 'Retired' ) {
            $('#form-2 input').each(function(){
                //$(this).removeAttr('required');
            });

            $('#form-2 select').each(function(){
                //$(this).removeAttr('required');
            });
        } else {
            $('#form-2 input').each(function(){
                //$(this).attr('required', 'required');
            });

            $('#form-2 select').each(function(){
                //$(this).attr('required', 'required');
            });
        }
    });*/

    inputFields.live('focusin', function(){
        $(this).removeClass('error');
    });

    //--------- auto saves the values on the input html element. Event trigger focusout
    inputFields.live('focusout', function(){
        var _this = $(this);
        var field  = $(this).attr('name');
        var field2 = $(this).attr('id');
        var value  = $(this).val();
        var tooltip = $(this).next();

        _this.removeClass('error');
        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }

        //----------- dont submit when field name is 'next-payday'
        if( field2 != 'birth_date' && field2 != 'birth_month' && field2 != 'birth_year' ) {
            autoSave( field, value );
        }

        //$(this).removeClass('error');
    });

    //--------- auto saves the values on the radio html element. Event trigger focusout
    radioFields.live('click', function(){
        var field = $(this).attr('name');
        var value = $(this).val();
        var _this = $(this);
        var tooltip = $(this).next();

        _this.removeClass('error');
        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }

        autoSave( field, value );
    });

    //--------- auto saves the values on the select html element. Event trigger focusout
    selectFields.live('change', function(){
        var _this = $(this);
        var field = $(this).attr('name');
        var value = $(this).val();
        var tooltip = $(this).next();

        _this.removeClass('error');
        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }

        autoSave( field, value );

        $(this).removeClass('error');
    });

    //---------
    formTwo.find('button[type="submit"]').on('click', function(e){
        var hasValue = true;
        var radio = formTwo.find('input[type="radio"]');
        var emp_status = $("select[name=employment-status]").val();

        console.log( emp_status );

        if( emp_status == 'Unemployed' || 
            emp_status == 'Retired' ||
            emp_status == 'A Student' ||
            emp_status == 'A home maker' ||
            emp_status == 'Government benefits' ||
            emp_status == 'Disability') { 
            hasValue = true;
        } else {
            $.each(formTwo.find('select'), function() {
                if($(this).val() == '') {
                    hasValue = false;
                    $(this).addClass('error');
                }
            });

            $.each(formTwo.find('input[type="text"]'), function() {
                if($(this).attr('id') != 'unit') {
                    if($(this).val() == '') {
                        hasValue = false;
                        $(this).addClass('error');
                    }
                }
            });

            if( !radio.parent().hasClass('checked') ) {
                hasValue = false;
                radio.parent().parent().addClass('error');
                $(radio.parent().parent()[0]).HCLTooltipValidation({
                    'text' : 'Please advise if your salary is paid by direct deposit to your bank account',
                    'disablePos' : true,
                    'css' : {
                        'margin-left' : '-6px',
                        'margin-top' : '0px',
                        'width' : '400px',
                        'text-align' : 'left'
                    }
                });
            }

            inputFields.each(function() {
                var _this = $(this);

                if(_this.val() == '' && 
                    _this.attr('name') != 'employer-unit-num') {
                    hasValue = false;

                    _this.addClass('error');
                    if(_this.attr('id') != 'birth_month' && _this.attr('id') != 'birth_year') {
                        var settings = {
                            'disablePos' : true
                        };

                        if(_this.attr('id') == 'birth_date') {
                            settings['text'] = 'The date must be after todays date';
                        }

                        _this.HCLTooltipValidation(settings);
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
        }

        if( hasValue ) {
            window.location.href = $('.submit-btn').data('url');
        }

        e.preventDefault();
        return false;
    });

    radioFields.parent().parent().on('click', function() {
        radioFields.parent().parent().removeClass('error');
        var _this   = $(this);
        var tooltip = $(this).next();

        if(tooltip.hasClass('HCLtooltip')) {
            tooltip.remove();
        }
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

    //---------
    $('#form-2 select[name="employment-status"]').val( $('#employment_status').val() );
    $('#form-2 select[name="employment-length"]').val( $('#employment_length').val() );
    $('#form-2 select[name="payday-frequency"]').val( $('#payday_frequency').val() );
    $('#form-2 select[name="employer-state"]').val( $('#employer_state').val() );

    $('#form-2 input[type="radio"]').each(function(){
        var value = $(this).val();

        if( value == $("#direct_to_bank").val() ) {
            $(this).attr('checked', 'checked');
            $(this).parent().addClass('checked');
        }
    });
//---------
});