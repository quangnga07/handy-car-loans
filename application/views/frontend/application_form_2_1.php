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
				<span class="pull-right">Application Number: <span style="font-weight: bold; font-size: 18px; color: #529be7;">HCL<?php echo $applicant_data->id ?></span></span>
				<div id="application-form" class="clearfix">
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
							<a class="active" href="<?php echo site_url('apply/2'); ?>">
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
							<a href="">
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
							<a href="">
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
						<form method='POST' id='form-2' action="<?php echo site_url('registration/autosave'); ?>">
							<input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>" />
							<fieldset>
								<legend>Employment</legend>
								<table>
									<tr>
										<td>Employment Status</td>
										<td>
											<input type='hidden' value='<?php echo $applicant_data->employment_status ?>' id='employment_status' > 
											<select name='employment-status' required="required" data-placement='right' data-original-title='Your employement status or position on the company.' >
												<option value=''>Select</option>
												<?php foreach($score_es as $data): ?>
													<option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
												<?php endforeach; ?>	
											</select>
										</td>
									</tr>
									<tr>
										<td>Employment Length</td>
										<td>
											<input type='hidden' value='<?php echo $applicant_data->employment_length ?>' id='employment_length' > 
											<select name='employment-length' required="required" data-placement='right' data-original-title='Your employement length on the company.'>
												<option value=''>Select</option>
												<?php foreach($score_el as $data): ?>
													<option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
												<?php endforeach; ?>	
											</select>
										</td>
									</tr>
									<tr>
										<td>Monthly Income</td>
										<td>
											<span class='loan-dollar'>$</span>
											<input class="input-match-select" value="<?php echo $applicant_data->monthly_income; ?>" type='text' name='monthly_income' id='income' required="required" data-placement='right' data-original-title='Your monthly salary. Only numbers are allowed.' />
										</td>
									</tr>
									<tr>
										<td>Payday Frequency</td>
										<td> 
											<input type='hidden' value='<?php echo $applicant_data->payday_frequency ?>' id='payday_frequency' > 
											<select name='payday-frequency' required="required" data-placement='right' data-original-title='How many times do you get you salary within a month?'>
												<option value=''>Select</option>
												<option value='Monthy'>Monthy</option>
												<option value='Four-weekly'>Four-weekly</option>
												<option value='Fortnightly'>Fortnightly</option>
												<option value='Weekly'>Weekly</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Next Payday</td>
										<td>
											<input value="<?php echo $applicant_data->next_payday; ?>" type='hidden' name='next-payday' required="required" id='payday' data-placement='right' data-original-title='When is your next payday? Before date is not allowed.' />
				                            <input value='' type='text' id='birth_date' maxlength='2' required='required' class='required input-small' data-placement='right' data-original-title='The date of your birthday and you must be 18 and above.' />
				                            <span>/</span>
				                            <input value='' type='text' id='birth_month' maxlength='2' required='required' class='required input-small' data-placement='right' data-original-title='The month of your birthday and you must be 18 and above.' />
				                            <span>/</span>
				                            <input value='' type='text' id='birth_year' maxlength='4' required='required' class='required input-medium' data-placement='right' data-original-title='The year of your birthday and you must be 18 and above.' />
				                        </td>
									</tr>
									<tr>
										<td colspan='2'>Is your salary paid directly into your bank account?</td>
									</tr>
									<tr>
										<td colspan='2' align='center'>
											<input type='hidden' value='<?php echo $applicant_data->direct_to_bank ?>' id='direct_to_bank' > 
											<span style="margin: 0 0 0 150px; float: left;"><label><input type='radio' name='direct-to-bank' value='Yes' /> Yes</label></span>
											<span style="float: left;"><label><input type='radio' name='direct-to-bank' value='No' /> No</label></span>
										</td>
									</tr>
								</table>
							</fieldset>

							<fieldset>
								<legend>Employer Details</legend>
								<table>
									<tr>
										<td>Business Name</td>
										<td>
											<input value="<?php echo $applicant_data->business_name; ?>" type='text' name='business-name' required="required" data-placement='right' data-original-title='Business name of the employer.' />
										</td>
									</tr>
									<tr>
										<td>Employer Phone</td>
										<td>
											<input value="<?php echo $applicant_data->employer_phone; ?>" maxlength='11' size='11' type='text' name='employer_phone' required="required" data-placement='right' data-original-title='Phone number of the employer. Only number are allowed and 11 digit max.' />
										</td>
									</tr>
									<tr>
										<td>Unit No. / Street No.</td>
										<td>
											<input value="<?php echo $applicant_data->employer_unit_num; ?>" type='text' class="input-small" name='employer-unit-num' id='unit' data-placement='right' data-original-title='Unit number of the employer.' /> <span>/</span> <input value="<?php echo $applicant_data->employer_street_num; ?>" type='text' class="input-small" name='employer-street-num' id='street' required="required" data-placement='right' data-original-title='Street number of the employer.' />
										</td>
									</tr>
									<tr>
										<td>Street Name</td>
										<td>
											<input value="<?php echo $applicant_data->employer_street_name; ?>" type='text' name='employer-street-name' required="required" id='employer-street-name' data-placement='right' data-original-title='Street Name of the employer.' />
										</td>
									</tr>
									<tr>
										<td>City / Suburb</td>
										<td>
											<input value="<?php echo $applicant_data->employer_city_suburb; ?>" type='text' name='employer-city-suburb' required="required" data-placement='right' data-original-title='City or Suburb of the employer.' />
										</td>
									</tr>
									<tr>
										<td>State &amp; Postcode</td>
										<td>
											<input type='hidden' value='<?php echo $applicant_data->employer_state ?>' id='employer_state' > 
											<select name='employer-state' required="required" class="required auto-width" data-placement='right' data-original-title='State of the employer'>
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
											<input type='text'class="input-postcode" value="<?php echo $applicant_data->employer_postcode ?>" name='employer-postcode' required="required" id='post-code' data-placement='right' data-original-title='Postcode of the employer.' />
										</td>
									</tr>
								</table>
							</fieldset>

							<button type="submit" class="submit-btn btn btn-success btn-large btn-automargin" data-url="<?php echo site_url('apply/3') ?>">Continue <i class="icon-chevron-right"></i></button>
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