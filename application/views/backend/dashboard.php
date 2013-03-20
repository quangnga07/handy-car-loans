
<div id="content">
	<div id="content-header">
		<h1>Dashboard</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin');?>" class="current">Dashboard</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: center;">
				<ul class="stat-boxes">
					<li>
						<div class="center">
							<strong><?php echo count($tank1_applicants_unread); ?></strong><br/>
							New <br />Applications
						</div>
					</li>
					<li>
						<div class="center">
							<strong><?php echo count($tank1); ?></strong><br/>
							Incomplete Applications
						</div>
					</li>
					<li>
						<div class="center">
							<strong><?php echo count($tank2); ?></strong><br/>
							Requiring Documents
						</div>
					</li>
					<li>
						<div class="center">
							<strong><?php echo count($tank3); ?></strong><br/>
							in Staff<br/>Processing
						</div>
					</li>
					<li>
						<div class="center">
							<strong><?php echo count($tank4); ?></strong><br/>
							Require <br>Supervisor Approval
						</div>
					</li>
					<li>
						<div class="center">
							<strong>
								<?php
								$row = 0;
								foreach( $tank5 as $applicants ) {
									$status = ( $applicants->has_approved == 1 ) ? $row++ : '' ;
								}
								echo $row;
								?>
							</strong><br/>
							All time<br/>Approved
						</div>
					</li>
					<li>
						<div class="center">
							<strong>
							<?php
							$row = 0;
							foreach( $tank5 as $applicants ) {
								$status = ( $applicants->has_approved == 2 ) ? $row++ : '' ;
							}
							echo $row;
							?>
							</strong><br/>
							All time<br/>Declined
						</div>
					</li>
				</ul>
			</div>	
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box dashboard-box">
					<div class="widget-title dashboard-title">
						<span class="icon">
							(1)
						</span>
						<h5>Incomplete Application (Abandoned)</h5>
					</div>
					<div class="widget-content dashboard-content nopadding">
						<table class="table dashboard-table table-bordered table-striped data-incomplete-table">
							<thead>
								<tr>
									<th class='incomplete-id' id="sort_date">Application ID</th>
									<th class='incomplete-name'>Applicant Name</th>
									<th class='incomplete-mobile'>Applicant Mobile</th>
									<th class='incomplete-website'>Received from Website (Brand)</th>
									<th class='incomplete-datetime'>Date/Time Last Seen</th>
									<th class='incomplete-days'>Number of days since abandonded</th>
									<th class='incomplete-auto-sms'>SMS Reminder Sent</th>
									<th class='incomplete-auto-email'>EMAIL Reminder Sent</th>
									<th class='incomplete-broker-id'>Broker ID</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach( $tank1_applicants as $applicant ) :
									$sernd = '0000-00-00 00:00:00';
									$row   = $applicant;
									$id    = 'HCL'.$row->id;
									$name  = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
									$date  = date( 'd-m-Y @ g:ia', strtotime( $row->date_submitted) );
									$now   = new DateTime();
									$ref   = new DateTime($row->date_submitted);
									$diff  = $now->diff($ref);
									$sms   = ( $applicant->datetime_sms != $sernd ) ? date( 'd-m-Y @ g:ia', strtotime( $row->datetime_sms) ) : "N/A" ;
                                    $email = ( $applicant->datetime_emailed != $sernd ) ? date( 'd-m-Y @ g:ia', strtotime( $row->datetime_emailed) ) : "N/A" ;
								?>
								<tr>
									<td class='incomplete-id'> <a <?php if($applicant->has_read == 0) echo 'style="color: red"'; ?> href="<?php echo site_url('admin/client/record/' . $this->urlparser->encode($row->id)) ?>"><?php echo $id; ?></a> </td>
									<td class='incomplete-name'> <?php echo $name; ?> </td>
									<td class='incomplete-mobile'> <?php echo $row->user_mobile_phone; ?> </td>
									<td class='incomplete-website'> Handy Car Loans </td>
									<td class='incomplete-datetime'> <?php echo $date; ?></td>
									<td class="taskOptions incomplete-days" ><?php echo $diff->d; ?></td>
									<td class='incomplete-auto-sms'><?php echo $sms; ?></td>
                                    <td class='incomplete-auto-email'><?php echo $email; ?></td>
									<td class="taskOptions incomplete-broker-id" >  </td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>			
					</div>
				</div>
				
				<div class="widget-box dashboard-box">
					<div class="widget-title dashboard-title">
						<span class="icon">
							(2)
						</span>
						<h5>Require Documents</h5>
					</div>
					<div class="widget-content dashboard-content nopadding">
						<table class="table dashboard-table table-bordered table-striped data-required-table">
							<thead>
								<tr>
									<th class='required-id'>Application ID</th>
									<th class='required-name'>Applicant Name</th>
									<th class='required-mobile'>Applicant Mobile</th>
									<th class='required-loan'>Loan Amount</th>
									<th class='required-website'>Received from Website (Brand)</th>
									<th class='required-datetime'>Date/Time Application Received</th>
									<th class='required-days'>Number of days since submitted</th>
									<th class='required-docs'>Have submitted Documents</th>
									<th class='required-rank'>Rank</th>
									<th class='required-broker-id'>Broker ID</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach( $tank2_applicants as $applicant ) :
									$row  = $applicant;
									$id   = 'HCL'.$row->id;
									$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
									$date = date( 'd-m-Y @ g:ia', strtotime( $row->date_submitted) );
									
									$now  = new DateTime();
									$ref  = new DateTime($row->date_submitted);
									$diff = $now->diff($ref);
									
									foreach( $ranking as $ranks ) {
										if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
											$rank = $ranks->rank;
										}
									}
								?>
								<tr>
									<td class='required-id'> <a <?php if($applicant->has_read == 0) echo 'style="color: red"'; ?> href="<?php echo site_url('admin/client/record/' . $this->urlparser->encode($row->id)) ?>"><?php echo $id; ?></a> </td>
									<td class='required-name'> <?php echo $name; ?> </td>
									<td class='required-mobile'> <?php echo $row->user_mobile_phone; ?> </td>
									<td class='required-loan'> <?php echo '$ '.$row->loan_amount; ?> </td>
									<td class='required-website'> Handy Car Loans </td>
									<td class="taskOptions required-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions required-days"> <?php echo $diff->d; ?> </td>
									<td class="taskOptions required-docs"> <?php echo $row->has_docs; ?> </td>
									<td class="taskOptions required-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions required-broker-id"> </td>
								</tr>
								<?php 
								endforeach;
								?>
							</tbody>
						</table>			
					</div>
				</div>
				
				<div class="widget-box dashboard-box">
					<div class="widget-title dashboard-title">
						<span class="icon">
							(3)
						</span>
						<h5>Staff Processing</h5>
					</div>
					<div class="widget-content dashboard-content nopadding">
						<table class="table dashboard-table table-bordered table-striped data-staff-table">
							<thead>
								<tr>
									<th class='staff-id'>Application ID</th>
									<th class='staff-name'>Applicant Name</th>
									<th class='staff-mobile'>Applicant Mobile</th>
									<th class='staff-loan'>Loan Amount</th>
									<th class='staff-website'>Received from Website (Brand)</th>
									<th class='staff-datetime'>Date/Time Application Received</th>
									<th class='staff-days'>Number of days since submitted</th>
									<th class='staff-viewed'>Last viewed By</th>
									<th class='staff-rank'>Rank</th>
									<th class='staff-broker-id'>Broker ID</th>
									<th style="display: none; "></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								foreach( $tank3_applicants as $applicant ) :
									$row  = $applicant;
									$id   = 'HCL'.$row->id;
									$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
									$date = date( 'd-m-Y @ g:ia', strtotime( $row->date_submitted) );
									
									$now  = new DateTime();
									$ref  = new DateTime($row->date_submitted);
									$diff = $now->diff($ref);
									
									foreach( $ranking as $ranks ) {
										if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
											$rank = $ranks->rank;
										}
									}
								?>
								<tr>
									<td class='staff-id'> <a href="<?php echo site_url('admin/client/record/' . $this->urlparser->encode($row->id)) ?>"><?php echo $id; ?></a> </td>
									<td class='staff-name'> <?php echo $name; ?> </td>
									<td class='staff-mobile'> <?php echo $row->user_mobile_phone; ?> </td>
									<td class='staff-loan'> <?php echo '$ '.$row->loan_amount; ?> </td>
									<td class='staff-website'> Handy Car Loans </td>
									<td class="taskOptions staff-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions staff-days"> <?php echo $diff->d; ?> </td>
									<td class="taskOptions staff-viewed"> <?php echo ucwords( $row->last_viewed ); ?> </td>
									<td class="taskOptions staff-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions staff-broker-id"> </td>
									<td style="display: none;"> <?php echo $count; ?> </td>
								</tr>
								<?php
								$count++;
								endforeach;
								?>
							</tbody>
						</table>			
					</div>
				</div>

				<div class="widget-box dashboard-box">
					<div class="widget-title dashboard-title">
						<span class="icon">
							(4)
						</span>
						<h5>Supervisor Approval</h5>
					</div>
					<div class="widget-content dashboard-content nopadding">
						<table class="table dashboard-table table-bordered table-striped data-supervisor-table">
							<thead>
								<tr>
									<th class='supervisor-id'>Application ID</th>
									<th class='supervisor-name'>Applicant Name</th>
									<th class='supervisor-mobile'>Applicant Mobile</th>
									<th class='supervisor-loan'>Loan Amount</th>
									<th class='supervisor-website'>Received from Website (Brand)</th>
									<th class='supervisor-datetime'>Date/Time Application Received</th>
									<th class='supervisor-days'>Number of days since submitted</th>
									<th class='supervisor-viewed'>Last viewed By</th>
									<th class='supervisor-rank'>Rank</th>
									<th class='supervisor-broker-id'>Broker ID</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								foreach( $tank4_applicants as $applicant ) :
									$row  = $applicant;
									$id   = 'HCL'.$row->id;
									$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
									$date = date( 'd-m-Y @ g:ia', strtotime( $row->date_submitted) );
									
									$now  = new DateTime();
									$ref  = new DateTime($row->date_submitted);
									$diff = $now->diff($ref);
									
									foreach( $ranking as $ranks ) {
										if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
											$rank = $ranks->rank;
										}
									}
								?>
								<tr>
									<td class='supervisor-id'> <a href="<?php echo site_url('admin/client/record/' . $this->urlparser->encode($row->id)) ?>"><?php echo $id; ?></a> </td>
									<td class='supervisor-name'> <?php echo $name; ?> </td>
									<td class='supervisor-mobile'> <?php echo $row->user_mobile_phone; ?> </td>
									<td class='supervisor-loan'> <?php echo '$ '.$row->loan_amount; ?> </td>
									<td class='supervisor-website'> Handy Car Loans </td>
									<td class="taskOptions supervisor-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions supervisor-days"> <?php echo $diff->d; ?> </td>
									<td class="taskOptions supervisor-viewed"> <?php echo ucwords( $row->last_viewed ); ?> </td>
									<td class="taskOptions supervisor-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions supervisor-broker-id"> </td>
									<td class="taskOptions" style="display: none;"> <?php echo $count; ?> </td>
								</tr>
								<?php 
								$count++;
								endforeach;
								?>
							</tbody>
						</table>			
					</div>
				</div>

				<div class="widget-box dashboard-box5">
					<div class="widget-title dashboard-title5">
						<span class="icon">
							(5)
						</span>
						<h5>Archived</h5>
					</div>
					<div class="widget-content dashboard-content5 nopadding">
						<table class="table dashboard-table table-bordered table-striped data-archived-table">
							<thead>
								<tr>
									<th class='supervisor-id'>Application ID</th>
									<th class='supervisor-name'>Applicant Name</th>
									<th class='supervisor-mobile'>Applicant Mobile</th>
									<th class='supervisor-loan'>Loan Amount</th>
									<th class='supervisor-website'>Received from Website (Brand)</th>
									<th class='supervisor-days'>Status</th>
									<th class='supervisor-datetime'>Status Date/Time</th>
									<th class='supervisor-viewed'>Approved by</th>
									<th class='supervisor-rank'>Rank</th>
									<th class='supervisor-broker-id'>Broker ID</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								foreach( $tank5_applicants as $applicant ) :
									$row  = $applicant;
									$id   = 'HCL'.$row->id;
									$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
									$date = date( 'd-m-Y @ g:ia', strtotime( $row->date_status) );

									$status = ( $row->has_approved == 1 ) ? 'Approved' : 'Declined' ;
									
									foreach( $ranking as $ranks ) {
										if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
											$rank = $ranks->rank;
										}
									}
								?>
								<tr>
									<td class='supervisor-id'> <a href="<?php echo site_url('admin/client/record/' . $this->urlparser->encode($row->id)) ?>"><?php echo $id; ?></a> </td>
									<td class='supervisor-name'> <?php echo $name; ?> </td>
									<td class='supervisor-mobile'> <?php echo $row->user_mobile_phone; ?> </td>
									<td class='supervisor-loan'> <?php echo '$ '.$row->loan_amount; ?> </td>
									<td class="supervisor-website"> Handy Car Loans </td>
									<td class="taskOptions supervisor-days"> <?php echo $status; ?> </td>
									<td class="taskOptions supervisor-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions supervisor-viewed"> <?php echo ucwords( $row->last_viewed ); ?> </td>
									<td class="taskOptions supervisor-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions supervisor-broker-id"> </td>
									<td class="taskOptions" style="display: none;"> <?php echo $count; ?> </td>
								</tr>
								<?php 
								$count++;
								endforeach;
								?>
							</tbody>
						</table>			
					</div>
				</div>

				<div class="widget-box dashboard-box5">
					<div class="widget-title dashboard-title5">
						<span class="icon">
							(6)
						</span>
						<h5>Marketing Queue</h5>
					</div>
					<div class="widget-content dashboard-content5 nopadding">
						<table class="table dashboard-table table-bordered table-striped data-marketing-table">
							<thead>
								<tr>
									<th class='market-id'>Application ID</th>
									<th class='market-name'>Applicant Name</th>
									<th class='market-mobile'>Applicant Mobile</th>
									<th class='market-loan'>Loan Amount</th>
									<th class='market-website'>Received from Website (Brand)</th>
									<th class='market-status'>Status</th>
									<th class='market-datetime'>Status Date/Time</th>
									<th class='market-rank'>Rank</th>
									<th class='market-broker-id'>Broker ID</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 0;
								foreach( $tank6_applicants as $applicant ) :
									$row  = $applicant;
									$id   = 'HCL'.$row->id;
									$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
									$date = date( 'd-m-Y @ g:ia', strtotime( $row->date_status) );
									
									if( $row->has_approved == 1 ) {
										$status = 'Approved';
									} 
									elseif( $row->has_approved == 2 ) {
										if( $row->cancelled_by == "finone" || $row->cancelled_by == "customer" ) {
											$status = 'Cancelled';
										} else {
											$status = 'Declined';
										}
									} else {
										$status = 'Abandoned';
									}

									foreach( $ranking as $ranks ) {
										if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
											$rank = $ranks->rank;
										}
									}
								?>
								<tr>
									<td class='market-id'> <a href="<?php echo site_url('admin/client/record/' . $this->urlparser->encode($row->id)) ?>"><?php echo $id; ?></a> </td>
									<td class='market-name'> <?php echo $name; ?> </td>
									<td class='market-mobile'> <?php echo $row->user_mobile_phone; ?> </td>
									<td class='market-loan'> <?php echo '$ '.$row->loan_amount; ?> </td>
									<td class='market-website'> Handy Car Loans </td>
									<td class="taskOptions market-status"> <?php echo $status; ?> </td>
									<td class="taskOptions market-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions market-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions market-broker-id"> </td>
									<td class="taskOptions" style="display: none;"> <?php echo $count; ?> </td>
								</tr>
								<?php 
								$count++;
								endforeach;
								?>
							</tbody>
						</table>			
					</div>
				</div>
						
			</div>
		</div>

		<div class="row-fluid">
			<div id="footer" class="span12">

			</div>
		</div>
	</div>
</div>


