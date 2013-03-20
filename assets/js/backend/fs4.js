$(document).ready(function(){
   
    
    $("#ref1_button").live('click',function(){
        var ref1_name_status = $('#ref1_name_status_on').attr('checked') ? 1 : 0;
        var ref1_relationship_status = $('#ref1_relationship_status_on').attr('checked') ? 1 : 0;
        var ref1_home_phone_status = $('#ref1_home_phone_status_on').attr('checked') ? 1 : 0;
        var ref1_mobile_phone_status = $('#ref1_mobile_phone_status_on').attr('checked') ? 1 : 0;
        var ref1_street_no_status = $('#ref1_street_no_status_on').attr('checked') ? 1 : 0;
        var ref1_street_name_status = $('#ref1_street_name_status_on').attr('checked') ? 1 : 0;
        var ref1_city_status = $('#ref1_city_status_on').attr('checked') ? 1 : 0;
        var ref1_state_postcode_status = $('#ref1_state_postcode_status_on').attr('checked') ? 1 : 0;
       
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'ref1',
                ref1_name_status: ref1_name_status,
                ref1_relationship_status: ref1_relationship_status,
                ref1_home_phone_status: ref1_home_phone_status,
                ref1_mobile_phone_status: ref1_mobile_phone_status,
                ref1_street_no_status: ref1_street_no_status,
                ref1_street_name_status: ref1_street_name_status,
                ref1_city_status: ref1_city_status,
                ref1_state_postcode_status: ref1_state_postcode_status,
                
                ref1_name_order: $("#ref1_name_order").val(),
                ref1_relationship_order: $("#ref1_relationship_order").val(),
                ref1_home_phone_order: $("#ref1_home_phone_order").val(),
                ref1_mobile_phone_order: $("#ref1_mobile_phone_order").val(),
                ref1_street_no_order: $("#ref1_street_no_order").val(),
                ref1_street_name_order: $("#ref1_street_name_order").val(),
                ref1_city_order: $("#ref1_city_order").val(),
                ref1_state_postcode_order: $("#ref1_state_postcode_order").val()
            },
            success: function(response){
                if(response.success){
                    $("#ref1_message_panel").show();
                }
            }
        });
       
    });
    
    
    $("#ref2_button").live('click',function(){
        var ref2_name_status = $('#ref2_name_status_on').attr('checked') ? 1 : 0;
        var ref2_relationship_status = $('#ref2_relationship_status_on').attr('checked') ? 1 : 0;
        var ref2_home_phone_status = $('#ref2_home_phone_status_on').attr('checked') ? 1 : 0;
        var ref2_mobile_phone_status = $('#ref2_mobile_phone_status_on').attr('checked') ? 1 : 0;
        var ref2_street_no_status = $('#ref2_street_no_status_on').attr('checked') ? 1 : 0;
        var ref2_street_name_status = $('#ref2_street_name_status_on').attr('checked') ? 1 : 0;
        var ref2_city_status = $('#ref2_city_status_on').attr('checked') ? 1 : 0;
        var ref2_state_postcode_status = $('#ref2_state_postcode_status_on').attr('checked') ? 1 : 0;
       
        $.ajax({
            url: url+'admin/configure_fields_update',
            type: 'post',
            dataType: 'json',
            data:{
                category: 'ref2',
                ref2_name_status: ref2_name_status,
                ref2_relationship_status: ref2_relationship_status,
                ref2_home_phone_status: ref2_home_phone_status,
                ref2_mobile_phone_status: ref2_mobile_phone_status,
                ref2_street_no_status: ref2_street_no_status,
                ref2_street_name_status: ref2_street_name_status,
                ref2_city_status: ref2_city_status,
                ref2_state_postcode_status: ref2_state_postcode_status,
                
                ref2_name_order: $("#ref2_name_order").val(),
                ref2_relationship_order: $("#ref2_relationship_order").val(),
                ref2_home_phone_order: $("#ref2_home_phone_order").val(),
                ref2_mobile_phone_order: $("#ref2_mobile_phone_order").val(),
                ref2_street_no_order: $("#ref2_street_no_order").val(),
                ref2_street_name_order: $("#ref2_street_name_order").val(),
                ref2_city_order: $("#ref2_city_order").val(),
                ref2_state_postcode_order: $("#ref2_state_postcode_order").val()
            },
            success: function(response){
                if(response.success){
                    $("#ref2_message_panel").show();
                }
            }
        });
       
    });
    
    
    
    
});