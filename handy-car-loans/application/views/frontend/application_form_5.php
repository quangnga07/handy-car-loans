				<?php echo $page_content->content; ?>
				<div id="application-form" class="clearfix">
					<div id="steps-container">
						<div class="step-field">
							<div id="round-sq">
								<div>
									<h3>Ready to submit?</h3>
									<p>Please review our terms and conditions and submit your application.</p>
								</div>
							</div>
						</div>
					</div>
					<div id="main-form">
						<div class="terms">
							<div class="term-header">
								<h4>Terms and Conditions</h4>
							</div>
							<div class="term-content">
								<?php echo $terms[0]['content']; ?>
							</div>
						</div>

						<div class="terms">
							<div class="term-header">
								<h4><?php echo $dec[0]->dec_heading; ?></h4>
							</div>
							<div class="dec-content">
								<?php echo $dec[0]->dec_title; ?>
							</div>
						
							<form method='POST' id='form-5' action="<?php echo site_url('scores'); ?>" class="well" style="padding-left: 10px; padding-right: 10px; width: 388px;">
								<label>
									<input type="checkbox"/> <span style="font-size: 13px;">I have read and agree with 'Terms and Conditions' above</span>
								</label>
								<input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>" />
								<input type="hidden" name="applicant_email" value="<?php echo $applicant_data->user_email; ?>" />
								<input type="hidden" name="applicant_name" value="<?php echo $applicant_data->fname . ' ' . $applicant_data->lname; ?>" />
								<input type="hidden" name="send_to_url" value="<?php echo site_url('admin/email/send_templated_email'); ?>" />
								<input type="hidden" name="dup_url" value="<?php echo site_url('registration/second_duplicate_check'); ?>" />
								<button id="submit-btn-application" type="submit" class="btn btn-success btn-large" style="height: 65px; width: 295px; font-size: 26px; margin-top: 10px;" data-url="<?php echo site_url('apply/6') ?>">Submit Application</button>
								<span class="more"><a href="<?php echo site_url('apply/1'); ?>">Go Back</a></span>
							</form>
						</div>
					    <div style="width: 361px; margin-left: 30px;" class="alert alert-error alert-block <?php if(!$missing_field): ?>hide<?php endif;?>">
						    <button type="button" class="close" data-dismiss="alert">×</button>
						    <h4>Error!</h4>
						    <p>Go back and complete fields:</p>
						    <?php if($missing_field): ?>
						    <ul>
						    	<?php foreach($missing_field as $field): ?>
						    	<li><?php echo $field; ?></li>
						    	<?php endforeach; ?>
						    </ul>
							<?php endif;?>
					    </div>
					</div>

					<div id="preloader" style="display: none;">
						<div id="circularG">
							<div id="circularG_1" class="circularG"> </div>
							<div id="circularG_2" class="circularG"> </div>
							<div id="circularG_3" class="circularG"> </div>
							<div id="circularG_4" class="circularG"> </div>
							<div id="circularG_5" class="circularG"> </div>
							<div id="circularG_6" class="circularG"> </div>
							<div id="circularG_7" class="circularG"> </div>
							<div id="circularG_8" class="circularG"> </div>
						</div>
					</div>

				</div>