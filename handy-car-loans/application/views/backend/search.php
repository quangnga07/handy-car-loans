<?php

$status  = array('All', 'Application', 'Underwriting', 'Funded', 'Declined');
$stages  = array('All', 'App Incomplete', 'App Complete', 'App Declined', 'Info Requested', 'Underwriting', 'Referred', 'Unable to Contact', 'Declined Affordability', 'Client Cancelled', 'Declined Fraud/Suspicious', 'Declined Suitability', 'Decline Stability', 'Approved A', 'Approved B', 'Approved C', 'Arrears Stage 1', 'Arrears Stage 2', 'Arrears Stage 3', 'Written Off', 'Repaid', 'Settled', 'Expired');
$product = array('All', 'Finone 29', 'Finone 24', 'Finone 19', 'YFD Secured', 'YFD Unsecured', 'CCC');
$brand   = array('All', 'Handy Car Loans', 'Handy Cash Loans', 'Real Car Loans', 'Real Cash Loans', 'YFD');
$leadgen = array('All', 'The Loan Centre', 'First Stop Money');
$broker  = array('All', 'Credit Choice', 'Other');
?>

<div id="content">
	<div id="content-header">
		<h1>Search All Records</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/search');?>" class="current">Search All Records</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-search"></i>
						</span>
						<h5>Search Option</h5>
					</div>
					<div class="widget-content nopadding">
						<form action="<?php echo site_url('admin/search/result'); ?>" method="post" id="form-search" class="form-horizontal" >
							<div class="control-group">
								<label class="control-label">Search for:</label>
								<div class="controls">
									<input type="text" name="search-for" />
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Status</label>
								<div class="controls">
									<label><input type="checkbox" name="status[]" value="No" /> Incomplete Application (Abandoned)</label>
									<label><input type="checkbox" name="status[]" value="2" /> Required Documents</label>
									<label><input type="checkbox" name="status[]" value="3" /> Staff Processing</label>
									<label><input type="checkbox" name="status[]" value="4" /> Supervisor Approval</label>
									<label><input type="checkbox" name="status[]" value="5" /> Archived</label>
									<label><input type="checkbox" name="status[]" value="6" /> Marketing Queue</label>
									<label><input type="checkbox" name="status[]" value="app" /> Approved</label>
									<label><input type="checkbox" name="status[]" value="dec" /> Declined</label>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Search Period:</label>
								<div class="controls">
									<label><input type="radio" name="date" value="All Dates" /> All Dates</label>
									<label><input type="radio" name="date" value="Last Week" /> Last Week</label>
									<label><input type="radio" name="date" value="Last Two Weeks" /> Last Two Weeks</label>
									<label><input type="radio" name="date" value="Last Month" /> Last Month</label>
									<label>
										<label><input type="radio" name="date" value="Range" /> Use date range</label>
										<label>From: <input type="text" name="date-from" id="date_from" /></label>
										<label>To:<span style="padding: 11px;"></span><input type="text" name="date-to" id="date_to" /></label>
									</label>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">Manual Setting:</label>
								<div class="controls manual-label">
									<label>Status<span style="padding: 12px;"></span>
										<select name='manual-status'>
											<?php
											foreach( $status as $row ) {
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>
										</select>
									</label>

									<label>Stages<span style="padding: 10px;"></span>
										<select name='manual-stages'>
											<?php
											foreach( $stages as $row ) {
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>
										</select>
									</label>

									<label>Product<span style="padding: 7.5px;"></span>
										<select name='manual-product'>
											<?php
											foreach( $product as $row ) {
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>
										</select>
									</label>

									<label>Brand<span style="padding: 13px;"></span>
										<select name="manual-brand">
											<?php
											foreach( $brand as $row ) {
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>
										</select>
									</label>

									<label>Leadgen<span style="padding: 4px;"></span>
										<select name="manual-leadgen">
											<?php
											foreach( $leadgen as $row ) {
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>
										</select>
									</label>

									<label>Broker<span style="padding: 11px;"></span>
										<select name="manual-broker">
											<?php
											foreach( $broker as $row ) {
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>
										</select>
									</label>
								</div>
							</div>
								
							<div class="form-actions" id="search-button">
								<button class="btn btn-primary" type="submit">Search</button>
								<button class="btn btn-primary" id="reset" type="reset">Reset</button>
							</div>
						</form>
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title search-title">
						<span class="icon">
							<i class="icon-list-alt"></i>
						</span>
						<h5>Search Results</h5>
					</div>
					<div class="widget-content search-content nopadding">
						<table class="table table-bordered table-striped data-search-table">
							<thead>
								<tr>
									<th class='search-status'>Status</th>
									<th class='search-id'>Application ID</th>
									<th class='search-name'>Applicant Name</th>
									<th class='search-mobile'>Applicant Mobile</th>
									<th class='search-loan'>Loan Amount</th>
									<th class='search-appdec'>Approved or Decline</th>
									<th class='search-datetime'>Date/Time Application Approved or Rejected</th>
									<th class='search-mstatus'>Manual Status</th>
									<th class='search-stages'>Manual Stages</th>
									<th class='search-products'>Manual Products</th>
									<th class='search-brand'>Manual Brand</th>
									<th class='search-leadgen'>Manual Leadgen</th>
									<th class='search-broker'>Manual Broker</th>
									<th class='search-term'>Term Accepted</th>
									<th class='search-broker-id'>Broker ID</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//echo count( $results );
								foreach( $results as $row ):
									$tankStatus = '';
									$appStatus  = '';
									$amount     = '';

									$link = site_url('admin/client/record/' . $this->urlparser->encode($row->id));

									if( $row->application_status == 2 && $row->has_fill == 'No' ) {
										$tankStatus = 'Incomplete (Abandoned)';
									}
								    else if( $row->application_status == 2 ) {
									    $tankStatus = 'Require Documents';
								    }
								    else if( $row->application_status == 3 ) {
									    $tankStatus = 'Staff Processing';
								    }
								    else if( $row->application_status == 4 ) {
									    $tankStatus = 'Supervisor Approval';
								    } 
								    else if( $row->application_status == 5 && $row->has_approved == 2 ) {
								     	$tankStatus = 'Archived';
								     	$appStatus  = 'Declined';
								    }
								    else if( $row->application_status == 5 ) {
									    $tankStatus = 'Archived';
									    $appStatus  = 'Approved';
									}
									else if( $row->application_status == 6 && $row->has_approved == 3 ) {
								     	$tankStatus = 'Marketing Queue';
								     	$appStatus  = '';
								    }
								    else if( $row->application_status == 7 ) {				    	
									    $tankStatus = 'Incomplete (Abandoned)';
								    } else {

								    }

								    if( $row->application_status == 5 || $row->application_status == 6 ) {
								    	$date = ( $row->date_status == '0000-00-00 00:00:00' ) ? '' : date( 'd-m-Y @ g:ia', strtotime($row->date_status) ) ;
								    } else {
								    	$date = '';
								    }

								    if( !empty($row->loan_amount) ) {
								    	$amount = "$".$row->loan_amount;
								    }
								    
								    $status  = ( $row->status == null ) ? '' : $row->status;
								    $stages  = ( $row->staging == null ) ? '' : $row->staging;
								    $product = ( $row->product == null ) ? '' : $row->product;
								    $brand   = ( $row->brand == null ) ? '' : $row->brand;
								    $leadgen = ( $row->leadgen == null ) ? '' : $row->leadgen;
								    $broker  = ( $row->broker == null ) ? '' : $row->broker;
								?>
								<tr>
									<td class='search-status'><?php echo $tankStatus; ?></td>
									<td class='search-id'><a <?php if($row->has_read == 0) echo 'style="color: red"'; ?> href='<?php echo $link; ?>'><?php echo "HCL".$row->id; ?></a></td>
									<td class='search-name'><?php echo $row->fname." ".$row->lname; ?></td>
									<td class='search-mobile'><?php echo $row->user_mobile_phone; ?></td>
									<td class='search-loan'><?php echo $amount; ?></td>
									<td class='taskOptions search-appdec'><?php echo $appStatus; ?></td>
									<td class='search-datetime'><?php echo $date; ?></td>
									<td class='search-mstatus'><?php echo $status; ?></td>
									<td class='taskOptions search-stages'><?php echo $stages; ?></td>
									<td class='search-products'><?php echo $product; ?></td>
									<td class='search-brand'><?php echo $brand; ?></td>
									<td class='search-leadgen'><?php echo $leadgen; ?></td>
									<td class='search-broker'><?php echo $broker; ?></td>
									<td class='search-term'><?php echo "V".$row->term_version; ?></td>
									<td class='search-broker-id'></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<!-- used to export data from table feed-list -->
					<div class="export-form"></div>
				</div>

			</div>
		</div>
		<div class="row-fluid">
			<div id="search-footer" class="span12">
				<input type='hidden' name='url' id="search-url" value="<?php echo site_url('admin/search/export'); ?>" />
				<input type='hidden' id="filepath" value="<?php echo base_url().'assets/img/';?>" />
				<input type='hidden' id="url" value="<?php echo site_url('admin/search/result');?>" />
				<button class="btn btn-primary btn-export">Export Data</button>
			</div>
		</div>
	</div>
</div>