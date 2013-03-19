
<div id="content">
    <div id="content-header">
        <h1>Field Control</h1>
        <div class="btn-group">

        </div>
    </div>
    <div id="breadcrumb">
        <a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-bottom">Setting</a>
        <a href="#" class="current">Field Control</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#fs1">Personal Details</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#fs2">Employment Details</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#fs3">Financial Details</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#fs4">References</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="fs1">
                        <?php echo $fs1; ?>
                    </div>
                    <div class="tab-pane" id="fs2">
                        <?php echo $fs2; ?>
                    </div>
                    <div class="tab-pane" id="fs3">
                        <?php echo $fs3; ?>
                    </div>
                    <div class="tab-pane" id="fs4">
                        <?php echo $fs4; ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var url = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/backend/fs2.js"></script>    
        <script src="<?php echo base_url(); ?>assets/js/backend/fs1.js"></script>    
        <script src="<?php echo base_url(); ?>assets/js/backend/fs3.js"></script>    
        <script src="<?php echo base_url(); ?>assets/js/backend/fs4.js"></script>   
        
        <div class="row-fluid">
			<div id="footer" class="span12">
				
			</div>
                        </div>
                        </div>
                        </div>