jQuery(function($){
	var form        = $('#doc-form form');
	var print_cover = $('.submit-other')
	var cancelFile  = $('.cancel-file');
	var removePath  = $('#removepath').val();
	var dbSavePath  = $('#dbsavepath').val();
	var uploadBox   = $('.jq-uploader');
	var uploadList  = $('.files-to-upload ul');
	var uploadUrl   = $('#url').val();
	var uploadPath  = $('#path').val();
	var uploadId    = $('#user_id').val();
	var errors      = "";

	var submitDoc  = $("#sumbit_doc");
	var templateId = $("#template");
	var supplyBox  = $("#doc-form form input[type=checkbox].supply");
	var docBox     = $("#doc-form form input[type=checkbox].doc");
	var otherBox   = $("#doc-form form input[type=checkbox].other");

	$('.doc-steps-container input[type=text]').on('change', function(){
	    $(this).parent().prev().find('input[type="checkbox"]').val($(this).val());
	});

	//---- allow only one checkbox to be check on supply
	supplyBox.click(function(){
		var group = supplyBox;
		$.each(group, function() {
			$(this).parent().removeClass('checked');
			$(this).removeAttr('checked');
		});
		$(this).parent().addClass('checked');
        $(this).attr('checked','checked');
	});

	print_cover.on('click', function(e){
		var url     = $(this).attr('href');
		var uId     = $(this).attr('id');
		var values  = '';

		$('.print-doc-request :checkbox:checked').each(function(i){
			if( i == 0 ) {
				values += $(this).val();
			} else {
				values += '%2C'+$(this).val();
			}
		});

		url += '/'+uId+'/'+values;

		window.open(url, 'Print Document', 'resizable=1,scrollbars=1,width=850, height=600');

		e.preventDefault();
		return false;
	});

	submitDoc.live('click', function(e){
		var flag    = 0;
		var files   = '';
		var files2  = [];
		var status  = '';
		var isEmpty = false;
		var box1    = supplyBox.parent();

		if( !box1.hasClass('checked') ){
			isEmpty = true;
			box1.parent().addClass('error');
		}
		
		box1.each(function(){
			if( $(this).hasClass('checked') ) {
				status = $(this).find('input').val();
			}
		});

		if( templateId.val() == 4 ) {
			var box2  = docBox.parent();

			if( !box2.hasClass('checked') ){
				isEmpty = true;
				box2.parent().addClass('error');
				$('.doc-text').addClass('error');
			}
		}

		if( !isEmpty ) {
			var values = form.serialize();

			$('.filename').each(function(){
				if( flag != 0 ) {
					files += ',';	
				}
				files += $(this).text();
				flag++;
			});

			$('#doc_request li').each(function(){
				files2  = $(this).html();
				values += '&doc_type[]='+files2;
			});

			if( files == '' && status == 'Upload' ) {
				alert( 'You need to upload your files.' );
			} else {

				values += '&id='+uploadId+'&files='+files;
			
				$.ajax({
					url     : dbSavePath,
					type    : 'POST',
					data    : values,
					success : function( response ) {
						alert('Thank you for advising us.')
						window.location = $('#base_url').val();
					}
				});
			}
		}

		e.preventDefault();
		return false;
	});

	supplyBox.parent().parent().on('click', function() {
		supplyBox.parent().parent().removeClass('error');
	});

	docBox.parent().parent().on('click', function() {
		docBox.parent().parent().removeClass('error');
		$('.doc-text').removeClass('error');
	});

	cancelFile.live('click', function(e){
		var _this    = $(this);
		var filename = _this.parent().find('.filename').text();
		var confirmtext = ("Removing file, are you sure?");

		if( confirm(confirmtext) ) {
			$.ajax({
				url     : removePath,
				type    : 'POST',
				data    : { id: uploadId, fname: filename, path: $('#filepath').val() },
				success : function( response ) {
					if( response == 1 ) {
						_this.parent().parent().remove();
						alert('File has been removed.');
					} else {
						alert('File has not been removed.');	
					}	
				}
			});
		}

		e.preventDefault();
		return false;
	});

	$('#select-file').on('click', function(e) {
		var flag = 0;
		console.log(flag);

		if( flag == 0 ) {
			$('#mf_file_upload').click();
			flag = 1;
		}
		console.log(flag);
	    
	    e.preventDefault();
	    return false;
	});

	uploadBox.mfupload({
		type		: 'pdf,jpg,jpeg,png,gif,doc,docx,bmp',	
		maxsize		: 2,
		post_upload	: uploadUrl,
		folder		: uploadPath,
		ini_text	: "<br/><br/><br/><br/>Click here or drag & drop your file to here (max: 2MB each)",
		over_text	: "<br/><br/><br/><br/>Drop Here",
		over_col	: '#000000',
		over_bkcol	: '#e7fae2',
		user_id     : uploadId,
        
		init		: function(){		
			//uploadBox.empty();
		},
		
		start		: function(result){		
			var contentHtml = '<li class="clearfix" id="FILE'+result.fileno+'" >';
				    contentHtml  += '<span class="file-'+result.ftype+'"></span>';
				    contentHtml  += '<p class="filename">'+result.filename+'</p>';
				    contentHtml  += '<div class="input-progress">';
				    	contentHtml  += '<div class="progress" id="PRO'+result.fileno+'">';
				    	contentHtml  += '</div>';
				    contentHtml  += '</div>';
				    contentHtml  += '<span class="filesize"></span>';
				    contentHtml  += '<a class="cancel-file" href="">X</a>';
			    contentHtml  += '</li>';
			
			uploadList.append(contentHtml);
		},

		loaded		: function(result){
			$("#PRO"+result.fileno).remove();
			var uploadHtml = '<li class="clearfix" id="FILE'+result.fileno+'" >';
				    uploadHtml  += '<span class="file-'+result.filetype+'"></span>';
				    uploadHtml  += '<p class="filename">'+result.filename+'</p>';
				    	uploadHtml  += '<div class="input-progress">';
				    	uploadHtml  += '</div>';
				    uploadHtml  += '<span class="filesize">'+result.size+'</span>';
				    uploadHtml  += '<a class="cancel-file" href="">X</a>';
			    uploadHtml  += '</li>';
			
			$("#FILE"+result.fileno).html(uploadHtml);
			$('#filepath').val(result.path);
		},

		progress	: function(result){
			$("#PRO"+result.fileno).css("width", result.perc+"%");
		},

		error		: function(error){
			errors += error.filename+": "+error.err_des+"\n";
		},

		completed	: function(){
			if (errors != "") {
				alert(errors);
				errors = "";
			}
		}
	});	

});
