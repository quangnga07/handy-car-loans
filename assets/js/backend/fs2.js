$(document).ready(function(){
   
    
    $("#employment_button").live('click',function(){
        var employment_status_status = $('#employment_status_status_on').attr('checked') ? 1 : 0;
        var employment_length_status = $('#employment_length_status_on').attr('checked') ? 1 : 0;
        var monthly_income_status = $('#monthly_income_status_on').attr('checked') ? 1 : 0;
        var payday_frequency_status = $('#payday_frequency_status_on').attr('checked') ? 1 : 0;
        var next_payday_status = $('#next_payday_status_on').attr('checked') ? 1 : 0;
        var paid_to_bank_status = $('#paid_to_bank_status_on').attr('checked') ? 1 : 0;
       
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'employment',
                employment_status_status: employment_status_status,
                employment_length_status: employment_length_status,
                monthly_income_status: monthly_income_status,
                payday_frequency_status: payday_frequency_status,
                next_payday_status: next_payday_status,
                paid_to_bank_status: paid_to_bank_status,
                
                employment_status_order: $("#employment_status_order").val(),
                employment_length_order: $("#employment_length_order").val(),
                monthly_income_order: $("#monthly_income_order").val(),
                payday_frequency_order: $("#payday_frequency_order").val(),
                next_payday_order: $("#next_payday_order").val(),
                paid_to_bank_order: $("#paid_to_bank_order").val()
            },
            success: function(response){
                if(response.success){
                    $("#employment_message_panel").show();
                }
            }
        });
       
    });
    
    
    $("#employer_button").live('click',function(){
       
        var business_name_status = $('#business_name_status_on').attr('checked') ? 1 : 0;
        var employer_phone_status = $('#employer_phone_status_on').attr('checked') ? 1 : 0;
        var employer_street_no_status = $('#employer_street_no_status_on').attr('checked') ? 1 : 0;
        var employer_street_name_status = $('#employer_street_name_status_on').attr('checked') ? 1 : 0;
        var employer_city_status = $('#employer_city_status_on').attr('checked') ? 1 : 0;
        var employer_state_postcode_status = $('#employer_state_postcode_status_on').attr('checked') ? 1 : 0;
        
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'employer',
                business_name_status: business_name_status,
                employer_phone_status: employer_phone_status,
                employer_street_no_status: employer_street_no_status,
                employer_street_name_status: employer_street_name_status,
                employer_city_status: employer_city_status,
                employer_state_postcode_status: employer_state_postcode_status,
                
                business_name_order: $("#business_name_order").val(),
                employer_phone_order: $("#employer_phone_order").val(),
                employer_street_no_order: $("#employer_street_no_order").val(),
                employer_street_name_order: $("#employer_street_name_order").val(),
                employer_city_order: $("#employer_city_order").val(),
                employer_state_postcode_order: $("#employer_state_postcode_order").val()
            },
            success: function(response){
                if(response.success){
                    $("#employer_message_panel").show();
                }
            }
        });
       
    });
    
    
});