		<div id="middle">
			<div class="container">
				<div class="row">
					<div class="span12">
						<h1 id="middle-title"><?php echo $page_content->title;?></h1>
						<h2 id="middle-title-caption"><?php echo $page_content->sub_title;?></h2>

						<div id="homepage-img"></div>
						<div id="car-big"></div>
						<div id="signup-container">
							<form id="signup-form" method="post" action="<?php echo site_url('registration/process_registration');?>">
								<h3>Start your application now</h3>
								<div id="titles" data-error="Please provide your title" class="clearfix">
									<span class="title-field">
										<label>
											<input class="mini-form" type="checkbox" name="title" value="Mr" /> Mr
										</label>
									</span>
									<span class="title-field">
										<label>
											<input class="mini-form" type="checkbox" name="title" value="Mrs" /> Mrs
										</label>
									</span>
									<span class="title-field">
										<label>
											<input class="mini-form" type="checkbox" name="title" value="Ms" /> Ms
										</label>
									</span>
									<span class="title-field">
										<label>
											<input class="mini-form" type="checkbox" name="title" value="Miss" /> Miss
										</label>
									</span>
								</div>

								<div id="input-container">
									<input type="hidden" name="dup_url" value="<?php echo site_url('registration/duplicate_check'); ?>" />
									<div class="input-field clearfix">
										<input type="text" name="fname" id="fn" placeholder="First Name" data-placement='right' data-error='Please provide your first name' />
										<input type="text" name="lname" id="ln" placeholder="Last Name" data-placement='right' data-error='Please provide your surname' />
									</div>
									<div class="input-field clearfix">
										<input type="text" name="phone" id="phone" maxlength='10' size='10' placeholder="Mobile" data-placement='right' data-error='Please provide your mobile phone number' />
										<input type="text" name="email" id="eml" placeholder="Email" data-placement='right' data-error='A valid email address is required' />
									</div>
									<div id="agreement">
										<label>
											<input type="checkbox" name="agree" data-error='You must agree to continue' /> I agree to
                                            <!-- Button to trigger modal -->
											<a href="#myModal" role="button" data-toggle="modal">Terms of Use</a>
										</label>
                                        <input type="hidden" id="term_version" name="term_version" value="<?php if(isset($term_of_use[0]['id'])) echo $term_of_use[0]['id']?>"/>
									</div>
									<button id="apply-now" type="submit" class="btn btn-success btn-large btn-automargin">Apply Now</button>
									<span class="more"><a href="<?php echo base_url(); ?>how-it-works">Find out more</a></span>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="preloader-home" style="display: none;">
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
		

		<div id="content">
			<div class="container">
				<div class="row">
					<div class="span12">
						<?php echo $page_content->content;?>
						<div id="content-divider"></div>
					</div>
				</div>
				
				<div class="row">
				<?php foreach($page_widgets as $widget):
						if($widget->area=='middle'):
						?>

						<div class="<?php echo $widget->widget_class;?>">
								<?php echo $widget->widget_content;?>
						</div>

				 <?php
					    endif;
					    endforeach;?>
				</div>
			</div>
		</div>