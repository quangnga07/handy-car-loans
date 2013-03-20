		<div id="upper-footer">
			<div class="container">
				<?php 
					$image  = explode( '/', $footer_contents['footer_image'] );
					$image2 = explode( '/', $footer_contents['footer2_image'] );
					$image3 = explode( '/', $footer_contents['footer3_image'] );
					$image4 = explode( '/', $footer_contents['footer_image2'] );

					foreach ($footer_alt_text as $key => $value) {
						if( in_array( $value, $image ) ) {
							$alt_text = $key;
							break;
						}
					}

					foreach ($footer_alt_text as $key => $value) {
						if( in_array( $value, $image2 ) ) {
							$alt_text2 = $key;
							break;
						}
					}

					foreach ($footer_alt_text as $key => $value) {
						if( in_array( $value, $image3 ) ) {
							$alt_text3 = $key;
							break;
						}
					}

					foreach ($footer_alt_text as $key => $value) {
						if( in_array( $value, $image4 ) ) {
							$alt_text4 = $key;
							break;
						}
					}
				?>
				<div class="row">
					<div class="span4">
						<div class="footer-content">
							<a href="<?php echo $footer_contents['footer_image_link']; ?>"><img style="float:left; " src="<?php echo $footer_contents['footer_image']; ?>" alt="<?php echo $alt_text;?>" /></a>
							<a href="<?php echo $footer_contents['footer2_image_link']; ?>"><img style="float:left; margin-left:25px; margin-top:10px;" src="<?php echo $footer_contents['footer2_image']; ?>" alt="<?php echo $alt_text2;?>" /></a>
							<a href="<?php echo $footer_contents['footer3_image_link']; ?>"><img style="float:left; margin-left:25px;" src="<?php echo $footer_contents['footer3_image']; ?>" alt="<?php echo $alt_text3;?>" /></a>
						</div>
					</div>
					<div class="span4">
						<div class="footer-content">
							<?php
								$this->load->helper('twitter');
							 	echo render_twitter($footer_contents['twitter-username'],$footer_contents['no-of-twits']);
							 ?>
						</div>
					</div>
					<div class="span4">
						<div class="footer-content">
							<span id="customer-support">
								<a href="<?php echo $footer_contents['footer3_image_link']; ?>"><img style="float:right; margin-top: -48px; margin-right: -5px;" src="<?php echo $footer_contents['footer_image2']; ?>" alt="<?php echo $alt_text4; ?>" /></a>
								<span style="float: left;">
									<?php echo $footer_contents['helpline'];?>
									<ul id="social-media">
										<?php if(@$footer_contents['facebook_link']!=''):?>
											<li><a id="fb" target="_blank" href="<?php echo $footer_contents['facebook_link'];?>"></a></li>
										<?php endif;?>
										<?php if(@$footer_contents['twitter_link']!=''):?>
											<li><a id="tw" target="_blank" href="<?php echo $footer_contents['twitter_link'];?>"></a></li>
										<?php endif;?>
										<?php if(@$footer_contents['youtube_link']!=''):?>
											<li><a id="yt" target="_blank" href="<?php echo $footer_contents['youtube_link'];?>"></a></li>
										<?php endif;?> 
									</ul>
								</span>
							</span>
							
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="span12">
						<span class="copyright pull-left"><?php echo $footer_contents['footer_text'];?></span>

						<ul id="footer-nav" class="pull-right">
							<?php echo $footer_contents['footer_navigation'];?>
							<!-- <li><a href="">About Us</a></li>
							<li><a href="">Brokers</a></li>
							<li><a href="">Privacy Policy</a></li>
							<li><a href="">Sitemap</a></li>
							<li><a href="">Contact Us</a></li> -->
						</div>
					</div>
				</div>
			</div>
		</div>

        <!-- Modal -->
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 id="myModalLabel">Terms of Use</h3>
            </div>
            <div class="modal-body">
                <p><?php if(isset($term_of_use[0]['content'])) echo $term_of_use[0]['content']; ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>

        <div id="dup_check" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3>Contact Support</h3>
            </div>
            <div class="modal-body">
                <p>It appears that you already exist within our system.</p>
			    <p>Please contact our support desk on 1800 346 663</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>

        <!-- Expired url -->
        <div id="expired" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3>Contact Support</h3>
            </div>
            <div class="modal-body">
                <p>Your unique link has expired.</p>
			    <p>Please contact our support desk on 1800 346 663</p>
            </div>
            <div class="modal-footer">
                <button class="btn close" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>

		<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery-ui-1.9.1.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.watermark.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.uniform.js"></script>
		<script src="<?php echo base_url();?>assets/js/mfupload.js"></script>		
        <script src="<?php echo base_url();?>assets/js/custom-tooltip.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
                <?php if(is_array($js_file)): ?>
                    <?php foreach ($js_file as $a): ?>
                        <script src="<?php echo base_url();?>assets/js/<?php echo $a; ?>"></script>
                    <?php endforeach; ?>
                <?php else: ?>
		<script src="<?php echo base_url();?>assets/js/<?php echo $js_file; ?>"></script>
                <?php endif; ?>
        <script>
        (function($) {
        	var watermarkHolder = $('[placeholder]');
        	$.each(watermarkHolder, function(){ 
        		$(this).watermark($(this).attr('placeholder'));
        	});

			$('#submit-later').on('click', function(e) {
				$.ajax({
					url : '<?php echo base_url(); ?>/apply/6',
					type : 'POST',
					data : { 'submit_later': 'true'},
					success: function() {
						window.location.href = '';
					}
				});

				e.preventDefault();
				return false;
			});

        	$("input[name*='phone'],input[name='bsb']").keydown(function(event) {
		        // Allow: backspace, delete, tab, escape, and enter
		        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
		             // Allow: Ctrl+A
		            (event.keyCode == 65 && event.ctrlKey === true) || 
		             // Allow: home, end, left, right
		            (event.keyCode >= 35 && event.keyCode <= 39)) {
		                 // let it happen, don't do anything
		                 return;
		        } else {
		            // Ensure that it is a number and stop the keypress
		            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
		                event.preventDefault(); 
		            }   
		        }
		    });
        	
        	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
        	$('.mini-form').click(function(){
			    var group = $(".mini-form");
			    $.each(group, function() {
			    	$(this).parent().removeClass('checked');
			    	$(this).removeAttr('checked');
			    });
			    $(this).parent().addClass('checked');
        		$(this).attr('checked','checked');
			});

        	<?php if($this->session->flashdata('minit_check')): ?>
        	$('#dup_check').modal();

        	$('#dup_check').find('.close').on('click', function() {
        		$('#dup_check').modal('hide');
        	});
        	<?php endif; ?>

        	<?php if($this->session->flashdata('expired_url')): ?>
        	$('#expired').modal();

        	$('#expired').find('.close').on('click', function() {
        		$('#expired').modal('hide');
        	});
        	<?php endif; ?>

        	//------------- hover on dropdown menus
        	$('li.dropdown').hover(
        		function() {
        			$(this).addClass('open');
        		},
        		function() {
        			//$(this).removeClass('open');
        		}
        	);

        	$('li ul.dropdown-menu').hover(
        		function() {
        			$(this).parent('li.dropdown').addClass('open');
        		},
        		function() {
        			$(this).parent('li.dropdown').removeClass('open');
        		}
        	);
        	//-------------

        	var applyTodayForm = $('.MultiFile-intercepted');
        	var term = $('.MultiFile-intercepted input[type="checkbox"]');

        	applyTodayForm.find('button').on('click', function(e) {
        		var _this = applyTodayForm;
        		var fields = applyTodayForm.find('input[type="text"]');
        		var isFilled = true;
        		var formURL = "<?php echo site_url('registration/process_registration'); ?>";
        		var addHidden = '<input type="hidden" id="term_version" name="term_version" value="<?php if(isset($term_of_use[0]['id'])) echo $term_of_use[0]['id']?>"/>'

        		$.each(fields, function() {
        			if($(this).val() == '') {
        				isFilled = false;
        				$(this).addClass('error');
        			}
        		});

        		if( !term.parent().hasClass('checked') ) {
					isFilled = false;
					term.parent().parent().addClass('error');
				}

        		if(isFilled) {
        			applyTodayForm.attr('action', formURL);
        			applyTodayForm.attr('method', 'POST');
        			applyTodayForm.append(addHidden);
        			
        			$.ajax({
						url : '<?php echo base_url(); ?>registration/duplicate_check',
						type : 'POST',
						data : applyTodayForm.serialize(),
						success : function( response ) {
							if(response == 'success') {
								$('#dup_check').modal();
							} else {
								applyTodayForm.submit();
							}
						}
					});
        		}
 
        		e.preventDefault();
        		return false;
        	});

			term.parent().parent().on('click', function() {
				term.parent().parent().removeClass('error');
			});
        })(jQuery);
        </script>
	</body>
</html>