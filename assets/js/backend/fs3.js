$(document).ready(function(){
   
    
    $("#expenses_button").live('click',function(){
        var rent_payment_status = $('#rent_payment_status_on').attr('checked') ? 1 : 0;
        var rent_month_status = $('#rent_month_status_on').attr('checked') ? 1 : 0;
        var living_expenses_status = $('#living_expenses_status_on').attr('checked') ? 1 : 0;
        var loans_month_status = $('#loans_month_status_on').attr('checked') ? 1 : 0;
        var credit_cards_status = $('#credit_cards_status_on').attr('checked') ? 1 : 0;
        var debits_month_status = $('#debits_month_status_on').attr('checked') ? 1 : 0;
       
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'expenses',
                rent_payment_status: rent_payment_status,
                rent_month_status: rent_month_status,
                living_expenses_status: living_expenses_status,
                loans_month_status: loans_month_status,
                credit_cards_status: credit_cards_status,
                debits_month_status: debits_month_status,
                
                rent_payment_order: $("#rent_payment_order").val(),
                rent_month_order: $("#rent_month_order").val(),
                living_expenses_order: $("#living_expenses_order").val(),
                loans_month_order: $("#loans_month_order").val(),
                credit_cards_order: $("#credit_cards_order").val(),
                debits_month_order: $("#debits_month_order").val()
            },
            success: function(response){
                if(response.success){
                    $("#expenses_message_panel").show();
                }
            }
        });
       
    });
    
    
    $("#bank_button").live('click',function(){
       
        var bank_name_status = $('#bank_name_status_on').attr('checked') ? 1 : 0;
        var account_name_status = $('#account_name_status_on').attr('checked') ? 1 : 0;
        var bsb_status = $('#bsb_status_on').attr('checked') ? 1 : 0;
        var account_number_status = $('#account_number_status_on').attr('checked') ? 1 : 0;
        
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'bank',
                bank_name_status: bank_name_status,
                account_name_status: account_name_status,
                bsb_status: bsb_status,
                account_number_status: account_number_status,
                
                bank_name_order: $("#bank_name_order").val(),
                account_name_order: $("#account_name_order").val(),
                bsb_order: $("#bsb_order").val(),
                account_number_order: $("#account_number_order").val()
            },
            success: function(response){
                if(response.success){
                    $("#bank_message_panel").show();
                }
            }
        });
       
    });
    
    
});