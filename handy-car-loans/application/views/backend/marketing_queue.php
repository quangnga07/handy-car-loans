<div id="content">
	<div id="content-header">
		<h1>Marketing Queue</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/marketing_queue');?>" class="current">Marketing Queue</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: left;">					
				<ul class="stat-boxes">
					<li>
						<div class="center">
							<strong><?php echo count($total_count); ?></strong><br/>
							Marketing Queue
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box incomplete-box">
					<div class="widget-title incomplete-title">
						<span class="icon">
							(6)
						</span>
						<h5>Marketing Queue</h5>
					</div>
					<div class="widget-content incomplete-content nopadding">
						<table class="table incomplete-table table-bordered table-striped data-6-table">
							<thead>
								<tr>
									<th class='market-id'>Application ID</th>
									<th class='market-name'>Applicant Name</th>
									<th class='market-mobile'>Applicant Mobile</th>
									<th class='market-loan'>Loan Amount</th>
									<th class='market-website'>Received form Website (Brand)</th>
									<th class='market-status'>Status</th>
									<th class='market-datetime'>Status Date/Time</th>
									<th class='market-rank'>Rank</th>
									<th class='market-broker-id'>Broker ID</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
							<tbody id="result">
								<?php
								$count = 0;
								foreach( $marketing_queue as $applicant ) :
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
									<td class='market-website'> <?php $row->brand; ?> </td>
									<td class="taskOptions market-status"> <?php echo $status; ?> </td>
									<td class="taskOptions market-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions market-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions market-broker-id"> </td>
									<td style="display: none"> <?php echo $count; ?> </td>
								</tr>
								<?php 
								$count++;
								endforeach;
								?>
							</tbody>
						</table>			
					</div>
				</div>

				<div class="widget-box">
					<form onsubmit="return submit_search();">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-filter"></i>
						</span>
						<h5>Filter</h5>
					</div>
					<div class="widget-content">
						<div class="row-fluid">
                            <div class="span2" style="margin-left:20px">
                                <div class="control-group">
                                    <label class="control-label">Show Past</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="date_range[]" onclick="submit_search()" value="1" /> Week</label>
                                        <label><input type="checkbox" name="date_range[]" onclick="submit_search()" value="2" /> Fortnight</label>
                                        <label><input type="checkbox" name="date_range[]" onclick="submit_search()" value="3" /> Month</label>
                                        <label><input type="checkbox" name="date_range[]" onclick="submit_search()" value="4" /> Year</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Loan</label>
                                    <div class="controls">
                                        <label><input type="checkbox"  name="loan[]" onclick="submit_search()" value="1" /> Approved </label>
                                        <label><input type="checkbox" name="loan[]" onclick="submit_search()" value="2" /> Declined</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Cancelled by</label>
                                    <div class="controls">
                                        <label><input type="checkbox"  name="cancelled[]" onclick="submit_search()" value="1" /> Customer</label>
                                        <label><input type="checkbox" name="cancelled[]" onclick="submit_search()" value="2" /> Finone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">From</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="from[]" onclick="submit_search()" value="1" /> Incomplete / Abandonded</label>
                                        <label><input type="checkbox" name="from[]" onclick="submit_search()" value="2" /> Archived</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span2" style="margin-left:-10px">
                                <div class="control-group">
                                    <label class="control-label">Amount</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="amount[]" onclick="submit_search()" value="1" /> $0 - $4999</label>
                                        <label><input type="checkbox" name="amount[]" onclick="submit_search()" value="2" /> $5000 – $9999</label>
                                        <label><input type="checkbox" name="amount[]" onclick="submit_search()" value="3" /> $10000 – $19999</label>
                                        <label><input type="checkbox" name="amount[]" onclick="submit_search()" value="4" /> $20000 +</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span1">
                                <div class="control-group">
                                    <label class="control-label">Rank</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="rank[]" onclick="submit_search()" value="A" /> A</label>
                                        <label><input type="checkbox" name="rank[]" onclick="submit_search()" value="B" /> B</label>
                                        <label><input type="checkbox" name="rank[]" onclick="submit_search()" value="C" /> C</label>
                                        <label><input type="checkbox" name="rank[]" onclick="submit_search()" value="X" /> X</label>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                   	<div class="row-fluid" style="border-bottom:1px solid #D9D9D9">
                    	<div id="search-button" class="form-actions" style="margin-top:0px; margin-bottom:0px">
                            <button type="reset" id="reset" class="btn btn-primary" onclick="reset_search()">Reset</button>
                        </div>
                    </div>	
				</form>
				</div>
						
			</div>
		</div>

		<div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
		</div>
	</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
var obj_data = [];
function submit_search(){
	var date_range_arr = 0;
	var date_range = document.getElementsByName("date_range[]");
	for (var i = 0; i < date_range.length; i++){
		if(date_range[i].checked == true){
			if(date_range[i].value > date_range_arr)	
				date_range_arr = date_range[i].value;	
		}
	}
	
	var loan_arr = [];
	var loan = document.getElementsByName("loan[]");
	for (var i = 0; i < loan.length; i++){
		if(loan[i].checked == true){
			loan_arr[loan_arr.length] = loan[i].value;	
		}
	}
	
	var cancelled_arr = [];
	var cancelled = document.getElementsByName("cancelled[]");
	for (var i = 0; i < cancelled.length; i++){
		if(cancelled[i].checked == true){
			cancelled_arr[cancelled_arr.length] = cancelled[i].value;	
		}
	}
	
	var from_arr = [];
	var from = document.getElementsByName("from[]");
	for (var i = 0; i < from.length; i++){
		if(from[i].checked == true){
			from_arr[from_arr.length] = from[i].value;	
		}
	}
	
	var amount_arr = [];
	var amount = document.getElementsByName("amount[]");
	for (var i = 0; i < amount.length; i++){
		if(amount[i].checked == true){
			amount_arr[amount_arr.length] = amount[i].value;	
		}
	}
	
	var rank_arr = [];
	var rank = document.getElementsByName("rank[]");
	for (var i = 0; i < rank.length; i++){
		if(rank[i].checked == true){
			rank_arr[rank_arr.length] = rank[i].value;	
		}
	}
	
	$.ajax({
		url: '<?php echo site_url('admin/search/search_tank_6'); ?>',
		type: 'post',
		dataType: 'json',
		data:{
			searchTank_6:'yes',
			loan:loan_arr,
			cancelled:cancelled_arr,
			from:from_arr,
			amount:amount_arr,
			rank:rank_arr,
			date_range:date_range_arr
		},success: function(response){
			$("#result").empty().append(response);	
		}
	});
	return false;
}

function reset_search() {
	$.ajax({
		url      : '<?php echo site_url('admin/search/search_tank_6'); ?>',
		type     : 'post',
		dataType : 'json',
		data     : { searchTank_6: 'yes' },
		success  : function(response){
			$("#result").empty().append(response);	
		}
	});
	return false;
}
</script>