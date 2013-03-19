<div id="middle">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div id="middle-content">
					<div id="smallcar-img"></div>
					<h1>Application Form</h1>
					<h2>Subtext Header. For supporting text</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="main">
	<div class="container">
		<div class="row">
			<div class="span9">
				<h2>4 Easy Steps...</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
				<span class="pull-right">Application Number: <span style="font-weight: bold; font-size: 18px; color: #529be7;">HCL<?php echo $applicant_data->id ?></span></span><div id="application-form" class="clearfix">
					<div id="steps-container">
						<div class="step-field">
							<a href="<?php echo site_url('apply/1'); ?>">
								<div class="step-num">
									<span>Step</span>
									<span class="step-large-num">1</span>
								</div>
								<div class="step-desc">
									<p>Personal</p>
									<p>Details</p>
								</div>
							</a>
						</div>
						<div class="step-field">
							<a href="<?php echo site_url('apply/2'); ?>">
								<div class="step-num">
									<span>Step</span>
									<span class="step-large-num">2</span>
								</div>
								<div class="step-desc">
									<p>Employment</p>
									<p>Details</p>
								</div>
							</a>
						</div>
						<div class="step-field">
							<a href="<?php echo site_url('apply/3'); ?>">
								<div class="step-num">
									<span>Step</span>
									<span class="step-large-num">3</span>
								</div>
								<div class="step-desc">
									<p>Financial</p>
									<p>Details</p>
								</div>
							</a>
						</div>
						<div class="step-field">
							<a class="active" href="<?php echo site_url('apply/4'); ?>">
								<div class="step-num">
									<span>Step</span>
									<span class="step-large-num">4</span>
								</div>
								<div class="step-desc step-ref">
									<p>Reference</p>
								</div>
							</a>
						</div>
					</div>
					<div id="main-form">
						<form method='POST' id='form-4' action="<?php echo site_url('registration/autosave'); ?>">
							<input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>" />
							<fieldset>
								<legend>Reference No 1</legend>
								<table>
									<tr>
										<td>Name</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_name ?>" name='ref1-name' required="required" data-placement='right' data-original-title='Name of the first reference.' />
										</td>
									</tr>
									<tr>
										<td>Relationship</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_relationship ?>" name='ref1-relationship' required="required" data-placement='right' data-original-title='Your relationship on the name you have specified above.' />
										</td>
									</tr>
									<tr>
										<td>Home Phone</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_home_phone ?>" maxlength='10' size='10' name='ref1_home_phone' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
										</td>
									</tr>
									<tr>
										<td>Mobile Phone</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_mobile_phone ?>" maxlength='11' size='11'  name='ref1_mobile_phone' required="required" data-placement='right' data-original-title='Only numbers are allowed and 11 digit max.' />
										</td>
									</tr>
									<tr>
										<td>Unit No. / Street No.</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_unit_num ?>" class="input-small" name='ref1-unit-num' class='unit' data-placement='right' data-original-title='Unit number of the reference.' /> <span>/</span> <input type='text' class="input-small" value="<?php echo $applicant_data->ref1_street_num ?>" name='ref1-street-num' class='street' required="required" data-placement='right' data-original-title='Street number of the reference.' />
										</td>
									</tr>
									<tr>
										<td>Street Name</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_street_name ?>"  name='ref1-street-name' required="required" data-placement='right' data-original-title='Street Name of the reference.' />
										</td>
									</tr>
									<tr>
										<td>City / Suburb</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref1_city_suburb ?>"  name='ref1-city-suburb' required="required" data-placement='right' data-original-title='City or Suburb of the reference.' />
										</td>
									</tr>
									<tr>
										<td>State &amp; Postcode</td>
										<td>
											<input type='hidden' value='<?php echo $applicant_data->ref1_state ?>' id='ref1_state' >
											<select name='ref1-state' required="required" class="auto-width" data-placement='right' data-original-title='State of the reference.'>
												<option value=''>State</option>
												<option value='ACT'>ACT</option>
												<option value='NT'>NT</option>
												<option value='NSW'>NSW</option>
												<option value='QLD'>QLD</option>
												<option value='SA'>SA</option>
												<option value='TAS'>TAS</option>
												<option value='VIC'>VIC</option>
												<option value='WA'>WA</option>
											</select>
											<span>/</span>
											<input type='text' class="input-postcode" value="<?php echo $applicant_data->ref1_postcode ?>" name='ref1-postcode' required="required" class='post-code' data-placement='right' data-original-title='Postcode of the reference.' />
										</td>
									</tr>
								</table>
							</fieldset>

							<fieldset>
								<legend>Reference No 2</legend>
								<table>
									<tr>
										<td>Name</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref2_name ?>" name='ref2-name' required="required" data-placement='right' data-original-title='Name of the second refernce.' />
										</td>
									</tr>
									<tr>
										<td>Relationship</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref2_relationship ?>" name='ref2-relationship' required="required" data-placement='right' data-original-title='Your relationship on the name you have specified above.' />
										</td>
									</tr>
									<tr>
										<td>Home Phone</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref2_home_phone ?>" maxlength='10' size='10' name='ref2_home_phone' data-placement='right' data-original-title='Only number are allowed and 10 digit max.' />
										</td>
									</tr>
									<tr>
										<td>Mobile Phone</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref2_mobile_phone ?>" maxlength='11' size='11'  name='ref2_mobile_phone' required="required" data-placement='right' data-original-title='Only number are allowed and 11 digit max.' />
										</td>
									</tr>
									<tr>
										<td>Unit No. / Street No.</td>
										<td>
											<input type='text' class="input-small" value="<?php echo $applicant_data->ref2_unit_num ?>" name='ref2-unit-num' class='unit' data-placement='right' data-original-title='Unit number of the reference.' /> <span>/</span> <input type='text' class="input-small" value="<?php echo $applicant_data->ref2_street_num ?>" name='ref2-street-num' class='street' required="required" data-placement='right' data-original-title='Street number of the reference.' />
										</td>
									</tr>
									<tr>
										<td>Street Name</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref2_street_name ?>"  name='ref2-street-name' required="required" data-placement='right' data-original-title='Street Name of the reference.' />
										</td>
									</tr>
									<tr>
										<td>City / Suburb</td>
										<td>
											<input type='text' value="<?php echo $applicant_data->ref2_city_suburb ?>"  name='ref2-city-suburb' required="required" data-placement='right' data-original-title='City or Suburb of the reference.' />
										</td>
									</tr>
									<tr>
										<td>State &amp; Postcode</td>
										<td>
											<input type='hidden' value="<?php echo $applicant_data->ref2_state ?>" id="ref2_state" />
											<select name='ref2-state' required="required" class="auto-width" data-placement='right' data-original-title='State of the reference.'>
												<option value=''>State</option>
												<option value='ACT'>ACT</option>
												<option value='NT'>NT</option>
												<option value='NSW'>NSW</option>
												<option value='QLD'>QLD</option>
												<option value='SA'>SA</option>
												<option value='TAS'>TAS</option>
												<option value='VIC'>VIC</option>
												<option value='WA'>WA</option>
											</select>
											<span>/</span>
											<input type='text' class="input-postcode" value="<?php echo $applicant_data->ref2_postcode ?>" name='ref2-postcode' required="required" class='post-code' data-placement='right' data-original-title='Postcode of the reference.' />
										</td>
									</tr>
								</table>
							</fieldset>

							<button type="submit" class="submit-btn btn btn-success btn-large btn-automargin" data-url="<?php echo site_url('apply/5') ?>">Continue <i class="icon-chevron-right"></i></button>
						</form>
					</div>
				</div>
			</div>
			<div class="span3">
				<div class="well">
					<h5>This is a well</h5>
				</div>
			</div>
		</div>
	</div>
</div>