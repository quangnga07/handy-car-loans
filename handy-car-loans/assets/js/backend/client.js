(function($) {
    var url          = $('input[name=url]').val();
    var selectStatus = $('#app_status');
    var emailDocForm = $('#email-request-document');
    var inputFields  = emailDocForm.find('input[type="text"]');
    var inputFields1  = $('#form-1 input[type=text]');
    var selectFields1 = $('#form-1 select');
    var waterDate    = $('#p_date');
    var waterMonth   = $('#p_month');
    var waterYear    = $('#p_year');
    var waterPayday  = $('#payday');
    var settings     = $('form.fill-select');

    var changed = false;

    var dates = waterPayday.val();
    dates = dates.split('-');
    waterYear.val(dates[0]);
    waterMonth.val(dates[1]);
    waterDate.val(dates[2]);

    selectStatus.on('change', function(){
        var value       = $(this).val();
        var appId       = $('input[name=id]').val();
        var appFill     = $('input[name=has_fill]').val();
        var confirmText = ('Changing Status, Are you sure?');

        if( confirm(confirmText) ) {
            $.ajax({
                url     : url,
                type    : 'POST',
                data    : { status: value, id: appId, has_fill: appFill },
                success : function( response ) {
                    window.location.href = '';
                }
            });

        }
    });

    inputFields1.on('change', function(){
        changed = true;
    });
    selectFields1.on('change', function(){
        changed = true;
    });

    inputFields.on('change', function(){
        //$(this).prev().find('input[type="checkbox"]').val($(this).val());
        $(this).parent().prev().find('input[type="checkbox"]').val($(this).val());
    });

    $('#form-1').on('submit', function(e) {
        var urlForm = $(this).attr('action');        

        if( changed ) {
            $.gritter.add({
                title:	'Successful',
                text:	'Record Saved.',
                sticky: false,
                time: 2000
            });

            $.ajax({
                url     : urlForm,
                type    : 'POST',
                data    : $(this).serialize(),
                success : function( data ) {
                    console.log( data );
                }
            });
        }

        e.preventDefault();
        return false;
    });

    $('#form-1 select[name="title"]').val( $('#title').val() );
    $('#form-1 select[name="state"]').val( $('#state').val() );
    $('#form-1 select[name="residential-status"]').val( $('#residential_status').val() );
    $('#form-1 select[name="time-address"]').val( $('#time_address').val() );
    $('#form-1 select[name="loan-purpose"]').val( $('#loan_purpose').val() );

    //---------
    $('#form-1 select[name="employment-status"]').val( $('#employment_status').val() );
    $('#form-1 select[name="employment-length"]').val( $('#employment_length').val() );
    $('#form-1 select[name="payday-frequency"]').val( $('#payday_frequency').val() );
    $('#form-1 select[name="employer-state"]').val( $('#employer_state').val() );

    $('#form-1 select[name="payment-frequency"]').val( $('#payment_frequency').val() );

    $('#form-1 input[type="radio"]').each(function(){
        var value = $(this).val();

        if( value == $("#direct_to_bank").val() ) {
            $(this).attr('checked', 'checked');
        }
    });

    //---------
    $.each($('#form-1 select, .fill-select select'), function() {
        var value = $(this).prev().val();

        if( value )
            $(this).val( value );
    });

    //---------- notification when success on uploading the manual added documents
    var hasValue = $('#uploaded').val();

    if( hasValue ) {
        $.gritter.add({
            title:	'Successful',
            text:	'Document was uploaded.',
            sticky: false
        });	
    }

    //binds to onchange event of your input field
    $('input[name=myfiles]').bind('change', function() {

        //this.files[0].size gets the size of your file.
        var fileSize = this.files[0].size;
	
        // 2097152 B
        // 2048 KB
        // 2 MB
        if( fileSize > 2097152 ) {
            $.gritter.add({
                title:	'Warning',
                text:	'File size over 2MB is not allowed.',
                sticky: false
            });	
            $('.doc_btn').attr('disabled', 'disabled');
        } else {
            $('.doc_btn').removeAttr('disabled', 'disabled');
        }
    });

    $('#manual_upload').on('submit', function(e){
        var value = $('input[name=myfiles]').val();
        var type  = /[^.]+$/.exec(value);
        var patt  = /(png|jpg|jpeg|doc|pdf|bmp|docx)/i;

        if( value == '' || value == null ){
            $.gritter.add({
                title:	'Warning',
                text:	'Please select a file.',
                sticky: false
            });	

            e.preventDefault();
            return false;
        }

        if( type[0].match(patt) ) {
			
        } else {
            $.gritter.add({
                title:	'Warning',
                text:	'Please select a valid file.',
                sticky: false
            });	

            e.preventDefault();
            return false;
        }
    });

    var doc_id;
    var doc_name;
    var num_files;
    var str_id;
        
    $(".remove-docs").click(function(){
        doc_id = $(this).attr('data-doc-id');
        doc_name = $(this).attr('data-doc-name');
        num_files = $(this).attr('data-num-files');
        str_id = $(this).attr('doc-str-id');
        $('#delete-dialog').modal('toggle');
    });
        
        
    $("#delete-yes").click(function(){
            
        $.ajax({
            url: delete_document_url , 
            type: 'post',
            dataType: 'json',
            data:{
                doc_id : doc_id,
                doc_name : doc_name,
                num_files: num_files
            },
            success: function(response){
                $("#"+str_id).fadeOut('slow');
            }
        });
           
    });

	$("#delete_record").click(function(){
		if(confirm('Sure you want to delete this Client Record?')){
			$.post(delete_client_record,{
				delete_record:'yes',
				client_record_id:client_record_id
			},function(data){
				if(data == ''){
					alert('Delete success.');	
					window.location = base_url;
				}else{
					alert('Can not delete.');	
				}
			});
		}
		return false;
	});

    // sends back the client to staff processing
    $('#send_back_form').on('submit', function(e){
        var formAction  = $(this).attr('action');
        var formMethod  = $(this).attr('method');
        var confirmText = ('Moving back to Staff Processing, Are you sure?');

        if( confirm(confirmText) ){
            $.ajax({
                url     : formAction,
                type    : formMethod,
                data    : $(this).serialize(),
                success : function( response ) {
                    console.log( response );  
                    if( response == 'ok' ) {
                        alert('Successful, Application is back to staff processing.');
                        window.location.reload();    
                    } else {
                        alert('Error, Cannot moved back to staff processing.');
                    }
                }
            });
        }

        e.preventDefault();
        return false;
    });

    $('.cancel_form').on('submit',function(e) {
        var cancel_url = $(this).attr('action');
        var method = $(this).attr('method');

        $.ajax({
            url : cancel_url,
            type : method,
            data : $(this).serialize(),
            success : function( response ) {
                window.location.href = '';
            }
        });

        e.preventDefault();
        return false;
    });

    // checks for partial match on Name & Account Name to notify users
    var fname       = $("input[name=fname]").val();
    var lname       = $("input[name=lname]").val();
    var accountName = $("input[name=account-name]").val();
    fname           = fname.toLowerCase();
    lname           = lname.toLowerCase();
    accountName     = accountName.toLowerCase();

    var found  = accountName.search(fname);
    var found2 = accountName.search(lname);

    if( found >= 0 && found2 >= 0 ) {
        
    } else {
        $("#partial").css("display", "inline-block");
    }
	
})(jQuery);