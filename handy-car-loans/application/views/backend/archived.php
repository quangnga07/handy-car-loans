<div id="content">
	<div id="content-header">
		<h1>Archived</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/archived');?>" class="current">Archived</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: left;">					
				<ul class="stat-boxes">
					<li>
						<div class="center">
							<strong><?php echo count($total_count); ?></strong><br/>
							Archived
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
							(5)
						</span>
						<h5>Archived</h5>
					</div>
					<div class="widget-content incomplete-content nopadding">
						<table class="table incomplete-table table-bordered table-striped data-5-table">
							<thead>
								<tr>
									<th class='supervisor-id' id="sort_date">Application ID</th>
									<th class='supervisor-name'>Applicant Name</th>
									<th class='supervisor-mobile'>Applicant Mobile</th>
									<th class='supervisor-loan'>Loan Amount</th>
									<th class='supervisor-website'>Received form Website (Brand)</th>
									<th class='supervisor-days'>Status</th>
									<th class='supervisor-datetime'>Status Date/Time</th>
									<th class='supervisor-viewed'>Approved by</th>
									<th class='supervisor-rank'>Rank</th>
									<th class='supervisor-broker-id'>Broker ID</th>
								</tr>
							</thead>
							<tbody id="result">
								<?php
								foreach( $archived as $applicant ) :
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
									<td class="supervisor-website"> <?php echo $row->brand; ?> </td>
									<td class="taskOptions supervisor-days"> <?php echo $status; ?> </td>
									<td class="taskOptions supervisor-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions supervisor-viewed"> <?php echo ucwords( $row->last_viewed ); ?> </td>
									<td class="taskOptions supervisor-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions supervisor-broker-id"> </td>
								</tr>
								<?php endforeach; ?>
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
                            <div class="span2">
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
                                        <label><input type="checkbox" name="loan[]" onclick="submit_search()" value="1" /> Approved </label>
                                        <label><input type="checkbox" name="loan[]" onclick="submit_search()" value="2" /> Declined</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Cancelled by</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="cancelled[]" onclick="submit_search()" value="1" /> Customer</label>
                                        <label><input type="checkbox" name="cancelled[]" onclick="submit_search()" value="2" /> Finone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span1">
                                <div class="control-group">
                                    <label class="control-label">State</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="QLD" /> QLD</label>
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="NSW" /> NSW</label>
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="ACT" /> ACT</label>
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="VIC" /> VIC</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">&nbsp;</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="WA" /> WA</label>
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="TAS" /> TAS</label>
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="SA" /> SA</label>
                                        <label><input type="checkbox" name="state[]" onclick="submit_search()" value="NT" /> NT</label>
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
	
	var state_arr = [];
	var state = document.getElementsByName("state[]");
	for (var i = 0; i < state.length; i++){
		if(state[i].checked == true){
			state_arr[state_arr.length] = state[i].value;	
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
		url: '<?php echo site_url('admin/search/search_tank_5'); ?>',
		type: 'post',
		dataType: 'json',
		data:{
			searchTank_5:'yes',
			loan:loan_arr,
			cancelled:cancelled_arr,
			state:state_arr,
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
		url      : '<?php echo site_url('admin/search/search_tank_5'); ?>',
		type     : 'post',
		dataType : 'json',
		data     : { searchTank_5: 'yes' },
		success  : function(response){
			$("#result").empty().append(response);	
		}
	});
	return false;
}
</script>