<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" type='text/css' href="<?php echo base_url();?>assets/css/uniform.css" />
<title><?php echo ( ($method == 'fax') ? 'Fax Cover Sheet' : 'Post Cover Sheet'); ?></title>
<style type="text/css">

body{
	font-family:'Open Sans', sans-serif;	
}
.fax-wrap{
	width:794px; height:1000px; margin:30px auto;
}
.fax-content{
	float:left; width:640px; min-height:1000px; margin:0 70px;	
}
.fax-header-bt{
	float:left; width:100%; height:40px; padding:20px 0px;	
}
.fax-header-title{
	float:left; clear:both; width:100%; border-top:1px solid #000; border-bottom:1px solid #000;
}
.fax-header-left{
	width:350px; float:left; margin-top:10px; margin-bottom:20px;	
}
.fax-header-left h1{
	font-size:40px; font-weight:100;
}
.fax-header-left h3{
	clear:both; font-size:26px; font-weight:100;
}
.fax-header-right{
	width:150px; float:right; padding-top:20px;
}
.fax-header-right .fax-label{
	float:left; font-size:11px;
}
.fax-header-right .fax-label-1{
	float:left; clear:both; font-size:26px; font-weight:100;	
}
.fax-middle{
	float:left; clear:both; width:100%; font-weight:100;	
}
.fax-middle-block{
	float:left; width:100%; padding-top:30px;	
}
.fax-lable-title{
	float:left; clear:both; width:80px;	
}
.fax-desc{
	float:left; clear:both	
}
@media print{
.fax-wrap{
	border:none;	
	margin:0px;
}
}
</style>

<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript">
    function close_window() {
        window.close();
    }

    function print_page() {
        $('.fax-header-bt button').hide();
        window.print();
        window.close();
    }
</script>
</head>

<body>
<div class="fax-wrap">
	<div class="fax-content">
    	<div class="fax-header-bt">
        	<button id="print_bt" onclick="print_page();return false;" class="btn btn-primary">Print</button>
            <button id="cancel_bt" onclick="close_window();return false;" class="btn">Cancel</button>
        </div>
        <div class="fax-header-title">
        	<div class="fax-header-left">
                <?php if( $method == 'fax'): ?>
            	    <h1>Fax Cover Sheet</h1>
                    <h3>Fax To:	&nbsp;&nbsp;&nbsp;(07) 4723 5044</h3>
                <?php else: ?>
                    <h1>Post Cover Sheet</h1>
                    <h3>Post To:  &nbsp;&nbsp;&nbsp;Handy Car Loans PO Box 900 Kirwan QLD 4215</h3>
                <?php endif; ?>
            </div>
            <div class="fax-header-right">
            	<div class="fax-label">Application ID:</div>
                <div class="fax-label-1">HCL<?php echo $user[0]->id?></div>
            </div>
        </div>
        <div class="fax-middle">
        	<div class="fax-middle-block">
            	<div class="fax-lable-title">
                	From:
                </div>
                <div style="float:left">
                	<?php echo ucfirst( $user[0]->fname )." ". ucfirst( $user[0]->lname ); ?>
                </div>
                <div class="fax-lable-title">
                	Ph:
                </div>
                <div style="float:left">
                	<?php echo $user[0]->user_mobile_phone; ?>
                </div>
                <div class="fax-lable-title">
                	Email: 
                </div>
                <div style="float:left">
                	<?php echo $user[0]->user_email; ?>
                </div>
            </div>
            <div class="fax-middle-block">
            	<div class="fax-lable-title">
                	To: 
                </div>
                <div style="float:left">

                	<div class="fax-desc">
	                	The Loans Manager, Handy Car Loans
                    </div>
                    <div style="float:left; clear:both; margin-top:35px; margin-bottom:5px">
                    	Find attached:
                    </div>
                    <?php foreach($doc_log as $doc): ?>
                        <div class="fax-desc">
                            - &nbsp;<?php echo urldecode($doc); ?>
                        </div>
                    <?php endforeach; ?>

                    <div style="float:left; clear:both; margin-top:35px">
                    	Declaration:
                    </div>
                    <div style="float:left; clear:both;">
                    	I declare these documents to be true and honest copies of originals. 
                        <br />
                        I can present originals if and when required. 
                    </div>
                    <div style="float:left; clear:both; margin-top:75px">
                    	Signed: _______________________________________  (<?php echo ucfirst( $user[0]->fname )." ". ucfirst( $user[0]->lname ); ?>, the applicant)
                    </div>
                    <div style="float:left; clear:both; margin-top:25px">
                    	Date: <?php echo date( 'jS F Y'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
