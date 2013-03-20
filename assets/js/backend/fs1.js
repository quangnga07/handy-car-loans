$(document).ready(function(){
    
    $("#personal_button").live('click',function(){
       
        var title_status = $('#title_status_on').attr('checked') ? 1 : 0;
        var first_name_status = $('#first_name_status_on').attr('checked') ? 1 : 0;
        var last_name_status = $('#last_name_status_on').attr('checked') ? 1 : 0;
        var middle_name_status = $('#middle_name_status_on').attr('checked') ? 1 : 0;
        var date_of_birth_status = $('#date_of_birth_status_on').attr('checked') ? 1 : 0;
        var drivers_license_status = $('#drivers_license_status_on').attr('checked') ? 1 : 0;
       
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'personal',
                title_status: title_status,
                first_name_status: first_name_status,
                last_name_status: last_name_status,
                middle_name_status: middle_name_status,
                date_of_birth_status: date_of_birth_status,
                drivers_license_status: drivers_license_status,
                
                title_order: $("#title_order").val(),
                first_name_order: $("#first_name_order").val(),
                last_name_order: $("#last_name_order").val(),
                middle_name_order: $("#middle_name_order").val(),
                date_of_birth_order: $("#date_of_birth_order").val(),
                drivers_license_order: $("#drivers_license_order").val()
            },
            success: function(response){
                if(response.success){
                   $("#personal_message_panel").show();
                }
            }
        });
       
    });
    
    
    $("#address_button").live('click',function(){
       
        var street_no_status = $('#street_no_status_on').attr('checked') ? 1 : 0;
        var street_name_status = $('#street_name_status_on').attr('checked') ? 1 : 0;
        var city_status = $('#city_status_on').attr('checked') ? 1 : 0;
        var state_postcode_status = $('#state_postcode_status_on').attr('checked') ? 1 : 0;
        var residential_status = $('#residential_status_on').attr('checked') ? 1 : 0;
        var time_at_address_status = $('#time_at_address_status_on').attr('checked') ? 1 : 0;
        
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'address',
                street_no_status: street_no_status,
                street_name_status: street_name_status,
                city_status: city_status,
                state_postcode_status: state_postcode_status,
                residential_status: residential_status,
                time_at_address_status: time_at_address_status,
                
                street_no_order: $("#street_no_order").val(),
                street_name_order: $("#street_name_order").val(),
                city_order: $("#city_order").val(),
                state_postcode_order: $("#state_postcode_order").val(),
                residential_order: $("#residential_order").val(),
                time_at_address_order: $("#time_at_address_order").val()
            },
            success: function(response){
                if(response.success){
                   $("#address_message_panel").show();
                }
            }
        });
       
    });
    
    
    $("#contact_button").live('click',function(){
       
        var email_status = $('#email_status_on').attr('checked') ? 1 : 0;
        var confirm_email_status = $('#confirm_email_status_on').attr('checked') ? 1 : 0;
        var mobile_phone_status = $('#mobile_phone_status_on').attr('checked') ? 1 : 0;
        var home_phone_status = $('#home_phone_status_on').attr('checked') ? 1 : 0;
        
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'contact',
                email_status: email_status,
                confirm_email_status: confirm_email_status,
                mobile_phone_status: mobile_phone_status,
                home_phone_status: home_phone_status,
                
                email_order: $("#email_order").val(),
                confirm_email_order: $("#confirm_email_order").val(),
                mobile_phone_order: $("#mobile_phone_order").val(),
                home_phone_order: $("#home_phone_order").val()
            },
            success: function(response){
                if(response.success){
                   $("#contact_message_panel").show();
                }
            }
        });
       
    });
    
    
    
    $("#loan_button").live('click',function(){
       
        var amount_status = $('#amount_status_on').attr('checked') ? 1 : 0;
        var purpose_status = $('#purpose_status_on').attr('checked') ? 1 : 0;
        
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'loan',
                amount_status: amount_status,
                purpose_status: purpose_status,
                
                amount_order: $("#amount_order").val(),
                purpose_order: $("#purpose_order").val()
            },
            success: function(response){
                if(response.success){
                   $("#loan_message_panel").show();
                }
            }
        });
       
    });
    
    
    
});