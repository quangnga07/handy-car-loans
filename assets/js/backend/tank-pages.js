(function($) {

	var tankTables = $('.data-2-table, .data-4-table');
	var tankTable1 = $('.data-1-table');
	var ArchiveTbl = $('.data-5-table');
	var staffTbl   = $('.data-3-table,');
	var marketTbl  = $('.data-6-table');
	var AccessLog  = $('.access-log-table');
	var btnBoth    = $('#smsemail-btn');
	var btnSms     = $('#sms-btn');
	var btnEmail   = $('#email-btn');
	var batchUrl   = $('#batch-url').val();

	tankTables.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>'
	});

	tankTable1.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aaSorting": [[ 0, "desc" ]]
	});

	ArchiveTbl.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aaSorting": [[ 6, "desc" ]]
	});

	staffTbl.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aaSorting": [[ 10, "asc" ]]
	});

	marketTbl.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aaSorting": [[ 9, "asc" ]]
	});

	AccessLog.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"aaSorting": [[ 0, "desc" ]]
	});

	$('#start_date').datepicker();
	$('#finish_date').datepicker();	

	btnBoth.live('click', function(){
		$.ajax({
			url     : batchUrl+"/sms_email_reminder",
			type    : "POST",
			data    : { },
			success : function( response ){
				if( response == 'ok' ) {
					$.gritter.add({
						title :	'Successful',
						text  :	'Message & Email are Sent. Applications moved to Marketing Queue',
						sticky: false,
						time  : 2000
					});
					setTimeout(function(){ window.location.reload(); }, 2100);
				} else {
					$.gritter.add({
						title :	'Error',
						text  :	'Please Try Again Later.',
						sticky: false,
						time  : 2000
					});
				}
			}
		});
	});

	btnSms.live('click', function(){
		$.ajax({
			url     : batchUrl+"/sms_reminder",
			type    : "POST",
			data    : { },
			success : function( response ){
				if( response == 'ok' ) {
					$.gritter.add({
						title :	'Successful',
						text  :	'Message Sent. Applications moved to Marketing Queue',
						sticky: false,
						time  : 2000
					});
					setTimeout(function(){ window.location.reload(); }, 2100);
				} else {
					$.gritter.add({
						title :	'Error',
						text  :	'Please Try Again Later.',
						sticky: false,
						time  : 2000
					});
				}
			}
		});
	});
	
	btnEmail.live('click', function(){
		$.ajax({
			url     : batchUrl+"/email_reminder",
			type    : "POST",
			data    : { },
			success : function( response ){
				if( response == 'ok' ) {
					$.gritter.add({
						title :	'Successful',
						text  :	'Email Sent. Applications moved to Marketing Queue',
						sticky: false,
						time  : 2000
					});
					setTimeout(function(){ window.location.reload(); }, 2100);
				} else {
					$.gritter.add({
						title :	'Error',
						text  :	'Please Try Again Later.',
						sticky: false,
						time  : 2000
					});
				}
			}
		});
	});
})(jQuery);
