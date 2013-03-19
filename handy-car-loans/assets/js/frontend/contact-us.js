

jQuery(function($){
    //---------
    //--------- init
    var contactForm  = $('#contact-us');
    var fields       = $('#contact-us input[type="text"]');

    //---------
    /*contactForm.validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                maxlength: 11
            },
            msg: {
                required: true
            },
            contact_method:{
                required: true
            },
            topic:{
                required: true
            },
            captcha: {
                required: true
            }
        }
    });*/
    //---------
    contactForm.on('submit',function(e){
        var hasValue    = true;
        var inputFields = $(this).find('input[type="text"]');

        $.each(inputFields, function() {
            if($(this).val() == '') {
                hasValue = false;
                $(this).addClass('error');
            }
        });

        $.ajax({
            url: captcha_validate_url,
            dataType: 'json',
            type: 'post',
            data:{
                captcha: $("#captcha").val()
            },
            async: false,
            success: function(captcha){
                console.log( hasValue );
                if(captcha.valid == false){
                    $("#num1").text(captcha.captcha.num1);
                    $("#num2").text(captcha.captcha.num2);
                    $("#operator").text(captcha.captcha.operator);
                    $("#msg-panel").html('<div class="alert alert-error">Please enter the correct answer...</div>');
                    $("#captcha").val('');
                    e.preventDefault();
                    return false;
                } else {
                    if( !hasValue ) {
                        e.preventDefault();
                        return false;
                    }
                }
            }
        });
    });

    fields.focus(function(){
        $(this).removeClass('error');
    });
});