				<?php echo $page_content->content; ?>
				<div id="application-form" class="clearfix">
					<div id="steps-container">
						<div class="step-field">
							<div id="round-sq">
								<div>
									<h3>Thank you</h3>
									<p>Your application has been recieved.</p>
								</div>
							</div>
						</div>
					</div>
					<div id="main-form">
						<?php if($this->session->flashdata('submit_later')): ?>
						<div style="width: 415px; margin-left: 30px;margin-top: 30px;text-align:center;">
						    <?php
						    	foreach( $messages as $msg ){
						    		if( $msg->type == 'error' ) {
						    			echo '<h4>'.$msg->heading.'</h4>';
						    			echo '<p style="font-size: 28px; margin: 20px 0 30px; line-height: 1.25; font-weight: 300 !important;">'.$msg->message.'</p>';
						    		}
						    	}
						    ?>
						    <input type="hidden" id="app_id" name="applicant_id" value="<?php echo $applicant_id ?>" />
							<input type="hidden" id="app_email" name="applicant_email" value="<?php echo $applicant_data->user_email; ?>" />
							<input type="hidden" id="app_url" name="send_to_url" value="<?php echo site_url('admin/email/send_templated_email'); ?>" />
					    </div>
				    	<?php elseif(!$this->session->flashdata('existing_on_system')): ?>
						<div style="width: 415px; margin-left: 30px;margin-top: 30px;text-align:center;">
						    <?php
						    	foreach( $messages as $msg ){
						    		if( $msg->type == 'success' ) {
						    			echo '<h4>'.$msg->heading.'</h4>';
						    			echo '<p style="font-size: 28px; margin: 20px 0 30px; line-height: 1.25; font-weight: 300 !important;">'.$msg->message.'</p>';
						    		}
						    	}
						    ?>
						    <a href="<?php echo base_url().'documentuploader/'.$this->urlparser->encode($this->session->userdata('applicant_id')).'/4/1'; ?>" class="btn btn-primary btn-large">Submit Documents Now</a>
						    <span class="more" style="color:#9D9D9D;">or <a id="submit-later" href="">submit later</a></span>
					    </div>
						<?php else: ?>
					    <div style="width: 415px; margin-left: 30px;margin-top: 30px;text-align:center;">
						    <?php
						    	foreach( $messages as $msg ){
						    		if( $msg->type == 'notice' ) {
						    			echo '<h4>'.$msg->heading.'</h4>';
						    			echo '<p style="font-size: 28px; margin: 20px 0 30px; line-height: 1.25; font-weight: 300 !important;">'.$msg->message.'</p>';
						    		}
						    	}
						    ?>
						    <span class="more" style="color:#9D9D9D;">or <a href="mailto:support@handycarloans.com.au?subject=HCL<?php echo $this->session->userdata('applicant_id'); ?>">email support</a></span>
					    </div>
						<?php endif; ?>				    
					</div>
				</div>

				<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
				<script type="text/javascript">
					<?php if($this->session->flashdata('submit_later')): ?>
						jQuery(function($){
							var emailUrl  = $('#app_url').val();
							var emailData = {
								applicant_id : $('#app_id').val(),
								client_email : $('#app_email').val(),
								template_id  : 4,
								
							}

							$.ajax({
								url : emailUrl,
								type : 'POST',
								data : emailData,
								success : function( response ) {
									if( response == 'success' ) {
										window.location = "<?php echo base_url(); ?>"
									}
								}
							});
						});
					<?php endif; ?>
				</script>