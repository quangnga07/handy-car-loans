(function($) {

	var searchTable = $('.data-search-table');
	var searchThead = $('.DataTables_sort_wrapper, .data-search-table thead th');
	var filePath    = $('#filepath').val();
	var url         = $('#url').val();
	var resetBtn    = $('#reset');

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	$('#date_from').datepicker();
	$('#date_to').datepicker();

	searchTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 25
	});

	searchThead.live('click', function(){
		var headIndex = $(this).parent().index();

		$('.data-search-table tr td').css( 'background', '#fff' );
		$('.data-search-table tr td:nth-child('+ (headIndex + 1) +')').css( 'background', '#eaeaea' );
	});

	resetBtn.live('click', function(){
		var content = '';

		content += '<tr class="odd">';
			content += '<td class="dataTables_empty" valign="top" colspan="15">No data available in table</td>';
		content += '</tr>';
		$('.data-search-table tbody').replaceWith( content );
		
		$('span.checked').removeClass('checked');
	});

})(jQuery);
