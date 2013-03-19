<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Handy Car Loans</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/backend/admin.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/unicorn.login.css" />
    </head>
    <body>
        <div id="logo">
            <!--img src="<?php echo base_url();?>assets/img/logo.png" alt="" /-->
        </div>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" method="post" action="<?php echo $action;?>">
                <p>Enter username and password to continue.</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Username" name="username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="Login" /></span>
                </div>
                <input type="hidden" name="ip_address" value="<?php $ip = $_SERVER['REMOTE_ADDR']; $client_ip = GetHostByName($ip); echo $client_ip; ?>" />
            </form>
            <form id="recoverform" class="form-vertical" onSubmit="return recover_password()">
                <p>Enter your e-mail address below and we will send you instructions how to recover a password.</p>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="recover_email" name="recover_email" placeholder="E-mail address" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link" id="to-login">&lt; Back to login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-inverse" value="Recover" /></span>
                </div>
                <input type="hidden" id="url_link" value="<?php echo $action.'/lost_password';?>"/>
            </form>
        </div>
        
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>  
        <script src="<?php echo base_url();?>assets/js/unicorn.login.js"></script> 
    </body>
</html>
