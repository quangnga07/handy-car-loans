<div id="content">
	<div id="content-header">
		<h1>Documents Required</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/required_documents');?>" class="current">Documents Required</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: left;">					
				<ul class="stat-boxes">
					<li>
						<div class="center">
							<strong><?php echo count($total_count); ?></strong><br/>
							Documents Requiring
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box required-box">
					<div class="widget-title required-title">
						<span class="icon">
							(2)
						</span>
						<h5>Documents Required</h5>
					</div>
					<div class="widget-content required-content nopadding">
						<table class="table required-table table-bordered table-striped data-2-table">
							<thead>
								<tr>
									<th class='required-id'>Application ID</th>
									<th class='required-name'>Applicant Name</th>
									<th class='required-mobile'>Applicant Mobile</th>
									<th class='required-loan'>Loan Amount</th>
									<th class='required-website'>Received form Website (Brand)</th>
									<th class='required-datetime'>Date/Time Application Received</th>
									<th class='required-days'>Number of days since submitted</th>
									<th class='required-docs'>Have submitted Documents</th>
									<th class='required-rank'>Rank</th>
									<th class='required-broker-id'>Broker ID</th>
								</tr>
							</thead>
							<tbody id="result">
								<?php
								foreach( $required_docs as $applicant ) :
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
									<td class='required-website'> <?php echo $row->brand; ?> </td>
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
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label">Brand</label>
                                    <div class="controls">
                                        <label><input type="checkbox"  name="brand[]" onclick="submit_search()" value="Handy Car Loans" /> Handy Car Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Handy Cash Loans" /> Handy Cash Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Real Car Loans" /> Real Car Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="Real Cash Loans" /> Real Cash Loans</label>
                                        <label><input type="checkbox" name="brand[]" onclick="submit_search()" value="YFD" /> YFD</label>
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
                            <div class="span3">
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
		url: '<?php echo site_url('admin/search/search_tank_2'); ?>',
		type: 'post',
		dataType: 'json',
		data:{
			searchTank_2:'yes',
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
		url      : '<?php echo site_url('admin/search/search_tank_2')?>',
		type     : 'post',
		dataType : 'json',
		data     : { searchTank_2: 'yes' },
		success  : function( response ) {
			$("#result").empty().append(response)
		}
	});
	return false;
}
</script>