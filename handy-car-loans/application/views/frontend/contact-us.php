<?php echo $page_content->content;?>

<div class="well">
    <div id="contact-form" class="clearfix">
        <h3>How can we help?</h3>
        <div id="msg-panel" style="margin-top: -5px;"><?php echo $message; ?></div>
        <form id="contact-us" action="<?php echo site_url('send-message');?>" method="post" enctype="multipart/form-data" >
            <div id="left-form">
                <textarea name="msg" placeholder="Enter you message here"></textarea>
                <p>Do you need to attach a document?</p>
                <div class="contact-doc-uploader">
                    <p>JPEG, PDF, DOC accepted. Maximum file size 1mb.</p>
                    <input class="multi" accept="png|jpg|jpeg|doc|docx" id="attachment" type="file" name="myfiles[]" />
                    <div id="attachment_wrap_list" class="file_list"> </div>
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

<script type="text/javascript">
    var captcha_validate_url='<?php echo site_url('validate-captcha'); ?>';
    var base_url='<?php echo base_url(); ?>';
</script>