<div id="middle">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div id="middle-content">
                    <div id="smallcar-img"></div>
                    <h1><?php echo $page_content->title;?><!-- Contact Us --></h1>
                    <h2><?php echo $page_content->sub_title;?><!--  Subtext Header. For supporting text --></h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="main">
    <div class="container">
        <div class="row">
            <div class="span9">
            	<?php echo $page_content->content;?>
                <!-- <h2>Need Assistance?</h2> -->

                <div class="well">
                    <div id="contact-form" class="clearfix">
                        <h3>How can we help?</h3>
                        <div id="msg-panel"><?php echo $message; ?></div>
                        <form id="contact-us" action="<?php echo site_url('send-message');?>" method="post" enctype="multipart/form-data" >
                            <div id="left-form">
                                <textarea name="msg" placeholder="Enter you message here"></textarea>
                                <p>Do you need to attach a document?</p>
                                <div class="contact-doc-uploader">
                                    <p>JPEG, PDF, DOC accepted. Maximum file size 1mb.</p>
                                    <ul id="attachment-list">
                                    </ul>
                                    <input class="input-file multi" accept="png|jpg|jpeg|doc|docx" id="attachment-list" type="file" name="myfiles[]" />
                                </div>
                            </div>
                            <div id="right-form">
                                    <input type="text" name="fname" placeholder="First Name" />
                                    <input type="text" name="lname" placeholder="Last Name" />
                                    <input type="text" name="phone" placeholder="Phone" />
                                    <input type="text" name="email" placeholder="Email" />

                                    <label>Best contact method</label>
                                    <select name="contact_method">
                                        <option value="" >Select</option>
                                        <option value="Phone" >Phone</option>
                                        <option value="Email" >Email</option>
                                    </select>

                                    <label>Topic</label>
                                    <select name="topic">
                                        <option value="" >Select</option>
                                        <option value="Pre sales enquiry" >Pre sales enquiry</option>
                                        <option value="Problem completing my online application" >Problem completing my online application</option>
                                        <option value="Getting another loan" >Getting another loan</option>
                                        <option value="How to pay out my load" >How to pay out my loan</option>
                                        <option value="I would like to make a complain" >I would like to make a complaint</option>
                                        <option value="Feedback" >Feedback</option>
                                        <option value="Other" >Other</option>
                                    </select>

                                    <p class="captcha"><span id="num1"><?php echo $num1; ?></span>&nbsp;&nbsp;<span id="operator"><?php echo $operator; ?></span>&nbsp;&nbsp;<span id="num2"><?php echo $num2; ?></span> = <input id="captcha" name="captcha" type="text" placeholder="Answer" /></p>

                                    <button class="btn btn-primary btn-large">Submit</button>

                            </div>
                        </form>
                    </div>
                </div>

                <h3>Other ways to contacting us...</h3>
                <div class="clearfix">
                    <div class="widget-contact well">
                        <div class="widget-contact-img">
                            <img src="<?php echo base_url(); ?>assets/img/phone-icon.png" />
                        </div>
                        <h5>Phone</h5>
                        <p>1800 002 002<br/>M-F 7am - 6pm</p>
                    </div>
                    <div class="widget-contact well">
                        <div class="widget-contact-img">
                            <img src="<?php echo base_url(); ?>assets/img/fax-icon.png" />
                        </div>
                        <h5>Fax</h5>
                        <p>1800 002 002 Please include cover sheet</p>
                    </div>
                    <div class="widget-contact well">
                        <div class="widget-contact-img">
                            <img src="<?php echo base_url(); ?>assets/img/box-icon.png" />
                        </div>
                        <h5>Post</h5>
                        <p>PO Box 900 Kirwan QLD 4215 Australia</p>
                    </div>
                    <div class="widget-contact well no-margin">
                        <div class="widget-contact-img">
                            <img src="<?php echo base_url(); ?>assets/img/helpdesk-icon.png" />
                        </div>
                        <h5>Help Desk</h5>
                        <p>support@ handycarloans .com.au</p>
                    </div>
                </div>

                <div id="info" class="well">
                    <p>Handy Car Loans is owned by Finance One Pty Ltd, ABN 02 000 000 000. <br> Australian Credit Licence Number:  000000</p>
                </div>
            </div>

            <div class="span3">
            	<?php foreach($page_widgets as $widget):?>
				<div class="well">
					<div class="right-widget">
					<?php echo $widget->widget_content;?>
					</div>
				</div>
                <?php endforeach;?>
                <!--
                <div class="well">
                    <div class="right-widget">
                        <h5>This is a well</h5>
                        <h6>Lorem ipsum dolor sit amet, consetct</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolgna aliqua. <p>
                            <img style="margin-bottom: -30px;" src="<?php echo base_url(); ?>assets/img/widget-person.png" />
                    </div>
                </div>

                <div class="well">
                    <div class="right-widget">
                        <form>
                            <h5>Apply Today</h5>
                            <p>Our application process is quick and easy, and you can have a response within 24 hours</p>
                            <input type="text" name="fname" placeholder="First Name" />
                            <input type="text" name="lname" placeholder="Last Name" />
                            <input type="text" name="lname" placeholder="Phone" />
                            <input type="text" name="lname" placeholder="Email" />
                            <label><input type="checkbox" /> <span>I have read and agree to <a href="#myModal" role="button" data-toggle="modal">Terms of Use</a></span></label>
                            <button class="btn btn-success btn-large">Apply</button>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var captcha_validate_url='<?php echo site_url('validate-captcha'); ?>';
    var base_url='<?php echo base_url(); ?>';
</script>