<div id="content">
	<div id="content-header">
		<h1>Staff Processing</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/staff_processing');?>" class="current">Staff Processing</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: left;">					
				<ul class="stat-boxes">
					<li>
						<div class="center">
							<strong><?php echo count($total_count); ?></strong><br/>
							in Staff<br/>Processing
						</div>
					</li>
				</ul>
			</div>	
		</div>
		<div class="row-fluid">
			<div class="span12">	
				<div class="widget-box staff-box">
					<div class="widget-title staff-title">
						<span class="icon">
							(3)
						</span>
						<h5>Staff Processing</h5>
					</div>
					<div class="widget-content staff-content nopadding">
						<table class="table staff-table table-bordered table-striped data-3-table">
							<thead>
								<tr>
									<th class='staff-id'>Application ID</th>
									<th class='staff-name'>Applicant Name</th>
									<th class='staff-mobile'>Applicant Mobile</th>
									<th class='staff-loan'>Loan Amount</th>
									<th class='staff-website'>Received form Website (Brand)</th>
									<th class='staff-datetime'>Date/Time Application Received</th>
									<th class='staff-days'>Number of days since submitted</th>
									<th class='staff-viewed'>Last viewed By</th>
									<th class='staff-rank'>Rank</th>
									<th class='staff-broker-id'>Broker ID</th>
									<th style="display: none;"></th>
								</tr>
							</thead>
							<tbody id="result">
								<?php
								$count = 0;
								foreach( $staff_process as $applicant ) :
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
									<td class='staff-website'> <?php echo $row->brand; ?> </td>
									<td class="taskOptions staff-datetime"> <?php echo $date; ?> </td>
									<td class="taskOptions staff-days"> <?php echo $diff->d; ?> </td>
									<td class="taskOptions staff-viewed"> <?php echo ucwords( $row->last_viewed ); ?> </td>
									<td class="taskOptions staff-rank"> <?php echo $rank; ?> </td>
									<td class="taskOptions staff-broker-id"> </td>
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
                            <div class="span2" style="margin-left:-5px">
                                <div class="control-group">
                                    <label class="control-label">Product</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="product[]" onclick="submit_search()" value="Finone 29" /> Finone 29</label>
                                        <label><input type="checkbox" name="product[]" onclick="submit_search()" value="Finone 24" /> Finone 24</label>
                                        <label><input type="checkbox" name="product[]" onclick="submit_search()" value="Finone 19" /> Finone 19</label>
                                        <label><input type="checkbox" name="product[]" onclick="submit_search()" value="YFD secured" /> YFD secured</label>
                                        <label><input type="checkbox" name="product[]" onclick="submit_search()" value="YFD unsecured" /> YFD unsecured</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Brand</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Handy Car Loans" /> Handy Car Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Handy Cash Loans" /> Handy Cash Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Real Car Loans" /> Real Car Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Real Cash Loans" /> Real Cash Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="YFD" /> YFD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="span1" style="margin-left:-30px">
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
                            <div class="span2"  style="margin-left:-30px">
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
	
	var product_arr = [];
	var product = document.getElementsByName("product[]");
	for (var i = 0; i < product.length; i++){
		if(product[i].checked == true){
			product_arr[product_arr.length] = product[i].value;	
		}
	}
	
	var brand_arr = [];
	var brand = document.getElementsByName("brand[]");
	for (var i = 0; i < brand.length; i++){
		if(brand[i].checked == true){
			brand_arr[brand_arr.length] = brand[i].value;	
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
		url: '<?php echo site_url('admin/search/search_tank_3'); ?>',
		type: 'post',
		dataType: 'json',
		data:{
			searchTank_3:'yes',
			product:product_arr,
			brand:brand_arr,
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
		url      : '<?php echo site_url('admin/search/search_tank_3')?>',
		type     : 'post',
		dataType : 'json',
		data     : { searchTank_3: 'yes' },
		success  : function( response ) {
			$("#result").empty().append(response)
		}
	});
	return false;
}
</script>