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
							<a class="active" href="<?php echo site_url('apply/3'); ?>">
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
						<form method='POST' id='form-3' action="<?php echo site_url('registration/autosave'); ?>">
							<input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>" />
							<fieldset>
								<legend>Your Expenses</legend>
								<table>
									<tr>
										<td>Mortgage/Rent Payment Frequency</td>
										<td>
											<input type='hidden' value='<?php echo $applicant_data->payment_frequency ?>' id='payment_frequency' > 
											<select class="select-dollar" name='payment-frequency' required="required" data-placement='right' data-original-title='How many times do you pay for the Mortgage/Rent within a month?'>
												<option value=''>Select</option>
												<option value='Monthly'>Monthly</option>
												<option value='Fortnightly'>Fortnightly</option>
												<option value='Weekly'>Weekly</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Mortgage/Rent per month</td>
										<td>
											<span class='loan-dollar'>$</span>
											<input class="input-dollar" value="<?php echo $applicant_data->mortgage_rent_month; ?>" type='text' name='mortgage_rent_month' required="required" class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
										</td>
									</tr>
									<tr>
										<td>Living Expenses per month</td>
										<td>
											<span class='loan-dollar'>$</span>
											<input class="input-dollar" value="<?php echo $applicant_data->expenses_month; ?>" type='text' name='expenses_month' required="required" class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
										</td>
									</tr>
									<tr>
										<td>Loans per month</td>
										<td>
											<span class='loan-dollar'>$</span>
											<input class="input-dollar" value="<?php echo $applicant_data->loans_month; ?>" type='text' name='loans_month' required="required" class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
										</td>
									</tr>
									<tr>
										<td>Credit Cards per month</td>
										<td>
											<span class='loan-dollar'>$</span>
											<input class="input-dollar" value="<?php echo $applicant_data->credit_card_month; ?>" type='text' name='credit_card_month' required="required" class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
										</td>
									</tr>
									<tr>
										<td>Other Debits per month</td>
										<td>
											<span class='loan-dollar'>$</span>
											<input class="input-dollar" value="<?php echo $applicant_data->debit_months; ?>" type='text' name='debit_months' required="required" class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
										</td>
									</tr>
								</table>
							</fieldset>

							<fieldset>
								<legend>Your Bank Account Details</legend>
								<table>
									<tr>
										<td>Bank Name</td>
										<td>
											<input value="<?php echo $applicant_data->bank_name; ?>" type='text' required="required" name='bank-name' data-placement='right' data-original-title='Name of the bank.' />
										</td>
									</tr>
									<tr>
										<td>Name on Account</td>
										<td>
											<input value="<?php echo $applicant_data->account_name; ?>" type='text' required="required" name='account-name' data-placement='right' data-original-title='Name of the bank account.' />
										</td>
									</tr>
									<tr>
										<td>BSB</td>
										<td>
											<input value="<?php echo $applicant_data->bsb; ?>" maxlength='6' size='6' type='text' required="required" name='bsb' data-placement='right' data-original-title='Only numbers are allowed and 6 digit max.' />
										</td>
									</tr>
									<tr>
										<td>Account Number</td>
										<td>
											<input  value="<?php echo $applicant_data->account_num; ?>" maxlength='10' size='10' type='text' required="required" name='account_num' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
										</td>
									</tr>
								</table>
							</fieldset>

							<button type="submit" class="submit-btn btn btn-success btn-large btn-automargin" data-url="<?php echo site_url('apply/4') ?>">Continue <i class="icon-chevron-right"></i></button>
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
