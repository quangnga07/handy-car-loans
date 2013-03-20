// JavaScript Document
/*function show_term_version(){
	var version = 0;
	var str = '<select id="term_version" onchange="show_term_version()">';
	if(document.getElementById("term_version")){
		version = document.getElementById("term_version").value;
	}
	for(var i = 0; i < obj_term.length; i++){
		var str_select = '';
		var str_version = '';
		var str_version_new = '';
		
		if(version > 0){
			if(version == (obj_term.length + 1)){
				document.getElementById("term_content").value = '';
				document.getElementById("term_content").removeAttribute('disabled');
				str_version_new = 'selected="selected"';
			}else if(obj_term[i].id == version){
				str_version = 'selected="selected"';
				document.getElementById("term_content").value = obj_term[i].content;
				document.getElementById("term_content").setAttribute('disabled','disabled');
			}
		}else if(obj_term[i].id == term_current){
			str_select = 'selected="selected"';
			document.getElementById("term_content").value = obj_term[i].content;
			document.getElementById("term_content").setAttribute('disabled','disabled');
		}else{
			document.getElementById("term_content").value = obj_term[0].content;
			document.getElementById("term_content").setAttribute('disabled','disabled');
		}
		str += '<option value="'+obj_term[i].id+'" '+ str_version + str_select+'>Version '+obj_term[i].id+'</option>';
	}
	str += '<option value="'+(obj_term.length + 1)+'" '+str_version_new+' >Add new (Version '+(obj_term.length + 1)+') </option>';	
	str += '</select>';
	$("#term_version_slb").empty().append(str);
}*/
/*function open_term_popup(id){
	var str = '';
	str += '<h3>Version '+id+'</h3>';
	str += '<textarea style="width:98%; min-height:550px;" spellcheck="false" disabled="disabled">';
	str += obj_term[(id - 1)].content;
	str += '</textarea>';	
	$("#term_popup").empty().append(str);
	$("#term_popup_dlg").fadeIn(300);
}
function close_popup(){
	$("#term_popup_dlg").hide();
}*/


(function($) {
	$(".vew_term").live('click', function(e){
		var id      = $(this).attr("id");
		var content = $(this).next().html();

		$(".modal-body").empty().append(content);
		$("#term_popup_dlg").modal();

		e.preventDefault();
		return false;
	});
	
	$("#term_current").on('change', function(){
		var url   = $("#version_used").val();
		var value = $(this).val();

		$.ajax({
			url    : url,
			type   : 'POST',
			data   : { current: value },
			success: function(data){
				if( data == "ok" ) {
					$.gritter.add({
		                title:	'Successful',
		                text:	'Term and Version used was saved.',
		                sticky: false,
		                time: 2000
		            });
		            setTimeout(function(){ window.location.reload(); }, 2100);
				} else {
					$.gritter.add({
		                title:	'Error',
		                text:	'Term and Version used was not saved.',
		                sticky: false,
		                time: 2000
		            });
				}
			}
		});
	});
})(jQuery);