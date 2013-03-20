
<div id="content">
	<div id="content-header">
		<h1>Scores &amp; Rank Settings</h1>
		<div class="btn-group">
			
		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="#" class="tip-bottom">Setting</a>
		<a href="#" class="current">Scores &amp; Rank Settings</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-calendar"></i>
						</span>
						<h5>Date of Birth</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'DB') {
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="3" class="taskOptions"> Date of birth </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>					

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-home"></i>
						</span>
						<h5>Residential Status</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'RS') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="5" valign="middle" class="taskOptions"> Residential Status </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-time"></i>
						</span>
						<h5>Time at Current Address</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'TCA') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="5" valign="middle" class="taskOptions"> Time a Current Address </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-folder-open"></i>
						</span>
						<h5>Loan Purpose</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'LP') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="2" valign="middle" class="taskOptions"> Loan Purpose </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-user"></i>
						</span>
						<h5>Employment Status</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'ES') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="11" valign="middle" class="taskOptions"> Employment Status </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-time"></i>
						</span>
						<h5>Employment Length</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'EL') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="5" valign="middle" class="taskOptions"> Employment Length </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-lock"></i>
						</span>
						<h5>Salary paid directly into bank account</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'BA') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="2" valign="middle" class="taskOptions"> Salary paid directly into bank account </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-briefcase"></i>
						</span>
						<h5>Disponsble Income</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="30%">Score Field</th>
									<th width="40%">Option</th>
									<th>Set Score</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$row = 1;
									foreach($scores as $item) {
										if($item->score_id == 'DI') {											
											echo '<tr>';
												if( $row == 1 ) {
													echo '<td rowspan="3" valign="middle" class="taskOptions"> Disponsble Income </td>';
												}
												echo '<td class="taskOptions">'. $item->option .'</td>';
												echo '<td class="taskOptions"><input type="text" value="'.$item->score.'" id="'.$item->id.'" name="score" /></td>';
											echo '</tr>';
											$row++;
										}
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-list"></i>
						</span>
						<h5>Ranking</h5>
					</div>
					<div class="widget-content nopadding">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="40%" colspan="2">Score Range</th>
									<th width="40%" rowspan="2">Rank</th>
								</tr>
								<tr>
									<th>Minimum</th>
									<th>Maximum</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($ranks as $item) {
										echo '<tr>';
											echo '<td class="taskOptions"><input type="text" value="'.$item->min.'" id="'.$item->id.'" name="min" /></td>';
											echo '<td class="taskOptions"><input type="text" value="'.$item->max.'" id="'.$item->id.'" name="max" /></td>';
											echo '<td class="taskOptions">'. $item->rank .'</td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>	
					</div>
				</div>

				<a id="save-score" class="btn pull-right">Save Changes</a>
			</div>
		</div>

		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/backend/scores.js"</script>    

		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>