(function($) {

	var dashboardTables = $('.data-required-table');
	var IncompleteTable = $('.data-incomplete-table');
	var ArchiveTable   = $('.data-archived-table, .data-supervisor-table');
	var staffTable = $('.data-staff-table');
	var marketTable = $('.data-marketing-table');
	var cmsTable = $('.data-cms-table');
	
	dashboardTables.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 5
	});

	IncompleteTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 5,
		"aaSorting": [[ 0, "desc" ]]
	});

	ArchiveTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 5,
		"aaSorting": [[ 10, "asc" ]]
	});

	staffTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 5,
		"aaSorting": [[ 10, "asc" ]]
	});

	marketTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 5,
		"aaSorting": [[ 9, "asc" ]]
	});

	cmsTable.dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
		"iDisplayLength": 10,
		"aLengthMenu": [[10, 25, 50], [10, 25, 50]]
	});	

	//Pagination for Notification Tab


})(jQuery);
