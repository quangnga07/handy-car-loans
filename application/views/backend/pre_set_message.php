<div id="content">
    <div id="content-header">
        <h1>Pre-Set Messages</h1>
        <div class="btn-group">

        </div>
    </div>
    <div id="breadcrumb">
        <a href="<?php echo site_url('admin');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <a href="#" class="tip-bottom">Setting</a>
        <a href="#" class="current">Pre-Set Messages</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab1">Main Form Submit</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab2">Welcome Back</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab3">Contact Form Confirmation</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <?php echo $tab1; ?>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <?php echo $tab2; ?>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <?php echo $tab3; ?>
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