<div id="content">
	<div id="content-header">
		<h1>Incomplete Applications / Abandoned</h1>
		<div class="btn-group">

		</div>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
		<a href="<?php echo site_url('admin/incomplete_application');?>" class="current">Incomplete Applicants</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12 center" style="text-align: left;">					
				<ul class="stat-boxes">
					<li>
						<div class="center">
							<strong><?php echo count($total_count); ?></strong><br/>
							Incomplete Applications
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
							(1)
						</span>
						<h5>Incomplete Applications (Abandoned)</h5>
					</div>
					<div class="widget-content incomplete-content nopadding">
						<table class="table incomplete-table table-bordered table-striped data-1-table">
							<thead>
								<tr>
									<th class='incomplete-id' id="sort_date">Application ID</th>
									<th class='incomplete-name'>Applicant Name</th>
									<th class='incomplete-mobile'>Applicant Mobile</th>
									<th class='incomplete-website'>Received form Website (Brand)</th>
									<th class='incomplete-datetime'>Date/Time Last Seen</th>
									<th class='incomplete-days'>Number of days since abandonded</th>
									<th class='incomplete-auto-sms'>SMS Reminder Sent</th>
									<th class='incomplete-auto-email'>EMAIL Reminder Sent</th>
									<th class='incomplete-broker-id'>Broker ID</th>
								</tr>
							</thead>
                            <tbody id="result">
                                <?php
                                foreach( $incomplete_apps as $applicant ) :
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
                                    <td class='incomplete-website'> <?php echo $row->brand; ?> </td>
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

				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
							<i class="icon-wrench"></i>
						</span>
						<h5>Batch Reminder</h5>
					</div>
					<div class="widget-content">
						<button class="btn" id="smsemail-btn">Send SMS &amp; Email</button>
						<button class="btn" id="sms-btn">Send SMS</button>
						<button class="btn" id="email-btn">Send Email</button>
						<input type="hidden" id="batch-url" value="<?php echo site_url('admin/batch'); ?>">
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
                                    <label class="control-label">Abandonded</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="abandonded[]" onclick="submit_search()" value="1" /> 1 Day or less</label>
                                        <label><input type="checkbox" name="abandonded[]" onclick="submit_search()" value="2" /> 1 Week or less</label>
                                        <label><input type="checkbox" name="abandonded[]" onclick="submit_search()" value="3" /> 1 Month or less</label>
                                        <label><input type="checkbox" name="abandonded[]" onclick="submit_search()" value="4" /> 3 Months or less</label>
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
                            <div class="span2">
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
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">Batch Reminder</label>
                                    <div class="controls">
                                        <label><input type="checkbox" name="auto_sent[]" onclick="submit_search()" value="sms" /> SMS Reminder</label>
                                        <label><input type="checkbox" name="auto_sent[]" onclick="submit_search()" value="email" /> Email Reminder</label>
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
	var abandonded_arr = 0;
	var abandonded = document.getElementsByName("abandonded[]");
	for (var i = 0; i < abandonded.length; i++){
		if(abandonded[i].checked == true){
			if(abandonded[i].value > abandonded_arr)	
				abandonded_arr = abandonded[i].value;	
		}
	}
	
	var date_range_arr = 0;
	var date_range = document.getElementsByName("date_range[]");
	for (var i = 0; i < date_range.length; i++){
		if(date_range[i].checked == true){
			if(date_range[i].value > date_range_arr)	
				date_range_arr = date_range[i].value;	
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
	
	var auto_sent_arr = [];
	var auto_sent = document.getElementsByName("auto_sent[]");
	for (var i = 0; i < auto_sent.length; i++){
		if(auto_sent[i].checked == true){
			auto_sent_arr[auto_sent_arr.length] = auto_sent[i].value;	
		}
	}
	
	$.ajax({
		url: '<?php echo site_url('admin/search/search_tank_1'); ?>',
		type: 'post',
		dataType: 'json',
		data:{
			searchTank_1:'yes',
			abandonded:abandonded_arr,
			state:state_arr,
			amount:amount_arr,
			auto_sent:auto_sent_arr,
			date_range:date_range_arr
		},success: function(response){
			$("#result").empty().append(response);	
		}
	});
	return false;
}

function reset_search() {
	$.ajax({
		url      : '<?php echo site_url('admin/search/search_tank_1')?>',
		type     : 'post',
		dataType : 'json',
		data     : { searchTank_1: 'yes' },
		success  : function( response ) {
			$("#result").empty().append(response)
		}
	});
	return false;
}
</script>
