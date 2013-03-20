
		<div id="hello_logo">
			<img src="<?php echo base_url() ?>assets/img/hello_logo.png" />
		</div>
		<!--
		<script src="<?php //echo site_url('admin/get_all_js'); ?>"></script>
		-->
		
		<script src="<?php echo base_url();?>assets/js/excanvas.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/manageuser.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.peity.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/unicorn.js"></script>
		<script src="<?php echo base_url();?>assets/js/unicorn.dashboard.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.gritter.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.uniform.js"></script>
		<script src="<?php echo base_url();?>assets/js/convert_to_excel.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/email.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/client.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/dashboard.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/tank-pages.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/search.js"></script>
        <script src="<?php echo base_url();?>assets/js/backend/terms.js"></script>
        <script src="<?php echo base_url();?>assets/js/backend/preset_message.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/colorbox/jquery.colorbox-min.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/cms_onload.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/media_library.js"></script>
		
        <script type="text/javascript">
		$(document).ready(function() {
			$("li[class = 'active']").parent().parent().addClass('active open');
		});

		$(document).ready(function() {
			var obj_term = <?php if(isset($terms)) echo json_encode($terms); else echo '[]' ?>;
			var term_current = <?php if(isset($term_current['value'])) echo $term_current['value']; else echo '[]' ?>;
		});
		

		</script>

		 <script>
			   $(document).ready(function() {

				    $('.activity-list li a').on('click', function(e) {
				        var url  = $(this).data('url');
				        var id   = $(this).data('id');
				        var type = $(this).data('type');
				        var href = $(this).attr('href');

				        $.ajax({
				        	url     : url,
				        	type    : 'POST',
				        	data    : { id : id, type : type },
				        	success : function( response ) {
				        		window.location.href = href;
				        	}
				        })

				        e.preventDefault();
				        return false;
				    });
					
					$( ".sortable_widget" ).sortable({
						connectWith: "div#garbageCollector",
						 update: function( event, ui ) {console.log(ui.item);},
						 opacity: 0.5
					});
	
					$( ".sortable_navigation" ).sortable({
						  update : function () {
							var order = $(this).sortable('serialize'); 
							
							$.ajax({
								type   : "POST",
								url    : "<?php echo site_url('admin/cms/navigation_update_order'); ?>",
								data   : order,
								success: function(response){
									if( response == 'ok' ) {
										alert( 'Successful, Menu order was saved.' );
									}
								}			
							});
						} ,
						opacity: 0.5
					});
	
					$(".mycolorbox").colorbox({iframe:true, width:"80%", height:"80%"});
					$(".mycolorboxImage").colorbox({maxWidth:'600px',maxHeight:'600px',scalePhotos:true});

					//----- javascript for saving widget on the page area
					$(".btn-left-right-middle").live('click', function(){
						var parent   = $(this).parent('div.form');
						var wId      = $(this).parents('div.widgetform').find('input[type=hidden]').val();
						var wTitle   = parent.find('input[type=text]').val();
						var wContent = parent.find('textarea').val();

						$.ajax({
							url     : '<?php echo site_url("admin/cms/edit_page_widget");?>',
							type    : 'POST',
							data    : { id: wId, title: wTitle, content: wContent },
							success : function( response ) {
								if( response == 'ok' ) {
									window.location.reload();
								} else {
									// alert('Error.');
								}
							}
						});
					});	
					//-----

					//----- deleting of page under CMS Index page
					$(".delete-page").live('click', function(){
						var pageId = $(this).attr('id');
						var confirmtext = ("Deleting page, are you sure?");

						if( confirm(confirmtext) ) { 
							$.ajax({
								url     : 'cms/remove_page',
								type    : 'POST',
								data    : { id: pageId },
								success : function( response ) {
									if( response == 'ok' ) {
										window.location.reload();
									} else {
										alert('Error in deleting the page.');
									}
								}
							});
						}
					});
					//-----

					//----- declaration submit
					$("#dec_submit").live('click', function(e){
						//var value = $("#dec_form").serialize();
						var path       = $("#dec_url").val();
						var pageId     = $("input[name=page_id]").val();
						var decId      = $("input[name=dec_id]").val();
						var decHeading = $("input[name=dec_heading]").val();
						var decText    = $("#text-dec").val();

						$.ajax({
							url     : path,
							type    : 'POST',
							data    : { page_id: pageId, dec_id: decId, dec_heading: decHeading, dec_text: decText },
							success : function( response ) {
								if( response == 'ok' ) {
									alert('Success, Data was saved.');
									//window.location.reload();
								} else {
									alert('Error in updating.');
								}
							}
						});

						e.preventDefault();
						return false;
					});
					//-----
				});
	
				$(document).ready(function(){
						$(".objectDrag").draggable({helper:'clone'});
	
						$(".sortable_widget").droppable({
							accept: ".objectDrag",
							drop: function(event,ui){
									console.log("Item was Dropped");
									cloned_widget = $(ui.draggable).clone();
									cloned_widget.removeClass('objectDrag');
									cloned_widget.addClass('objectDropped');
									cloned_widget.find('button.btn-danger').show();
									$(this).append(cloned_widget);
	
								}
						});
	
				});
		</script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/ckfinder/ckfinder.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/ckeditor/ckeditor.js"></script>

	</body>
</html>
