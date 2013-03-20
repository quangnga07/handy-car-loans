<div id="content">
	<div id="content-header">
		<h1>Access Log</h1>
	</div>
	<div id="breadcrumb">
		<a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-bottom">Users</a>
		<a href="#" class="current">Access Log</a>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="widget-box">
					<div class="widget-title">
						<span class="icon">
                        	<i class="icon-user"></i>
						</span>
						<h5>User Access Record</h5>
					</div>
					<div class="widget-content nopadding">
						<table id="acc_log_table" class="table table-bordered table-striped access-log-table">
							<thead>
								<tr>
                                	<th id="sort_date" style="width:10px !important">Id</th>
									<th>Date</th>
									<th>Level</th>
									<th>Name</th>
									<th>IP</th>
								</tr>
							</thead>
                            <tbody id="result">
                                <?php
                                foreach( $access_log as $applicant ) :
                                    $row  = $applicant;
									$level = '';
									switch($row->level){
										case 1:
											$level = 'Admin';
											break;
										case 2:
											$level = 'Supervisor';
											break;
										case 3:
											$level = 'Staff';
											break;
									}
                                ?>
                                <tr>
                                	<td><?php echo $row->id ?></td>
                                    <td style="width:140px !important"><?php echo date('d-m-Y: g.ia', strtotime($row->date)); ?></td>
                                    <td><?php echo $level ?></td>
                                    <td> <?php echo $row->name; ?> </td>
                                    <td style="width:140px !important;"><?php echo $row->ip; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>			
					</div>
				</div>
                <a id="" style="float:right" class="btn btn-primary" onclick="export_log()">Export CSV</a>
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
function export_log(){
	var url = '<?php echo site_url('admin/export_log');?>';
	window.open(url);
	return false;
}
</script>
