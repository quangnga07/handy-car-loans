				<?php echo $page_content->content;?>

                <?php if(isset($wb_message)): ?>
                <div class="alert alert-info alert-block" style="margin-top: 20px;">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <h4><?php echo $wb_message->heading; ?></h4>
                    <p><?php echo $wb_message->message; ?></p>
                </div>
                <?php endif; ?>

                <span class="pull-right">Application Number: <span style="font-weight: bold; font-size: 18px; color: #529be7;">HCL<?php echo $applicant_data->id ?></span></span>
                <div style="clear: both;"></div>
                <div id="application-form" class="clearfix" style="margin-top:10px;">
                    <div id="steps-container">
                        <div class="step-field">
                            <a class="active" href="<?php echo site_url('apply/1'); ?>">
                                <div class="step-num">
                                    <span>Step</span>
                                    <span class="step-large-num">1</span>
                                </div>
                                <div class="step-desc">
                                    <p>Personal</p>
                                    <p>Details</p>
                                </div>
                            </a>
                        </div>
                        <div class="step-field">
                            <a href="">
                                <div class="step-num">
                                    <span>Step</span>
                                    <span class="step-large-num">2</span>
                                </div>
                                <div class="step-desc">
                                    <p>Employment</p>
                                    <p>Details</p>
                                </div>
                            </a>
                        </div>
                        <div class="step-field">
                            <a href="">
                                <div class="step-num">
                                    <span>Step</span>
                                    <span class="step-large-num">3</span>
                                </div>
                                <div class="step-desc">
                                    <p>Financial</p>
                                    <p>Details</p>
                                </div>
                            </a>
                        </div>
                        <div class="step-field">
                            <a href="">
                                <div class="step-num">
                                    <span>Step</span>
                                    <span class="step-large-num">4</span>
                                </div>
                                <div class="step-desc step-ref">
                                    <p>Reference</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div id="main-form">
                        <form method="POST" id="form-1" action="<?php echo site_url('registration/autosave'); ?>">
                            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>" />
                            <fieldset>
                                <legend>Personal Information</legend>
                                <table>

                                    <?php echo $personal_fields; ?>

                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Address Details</legend>
                                <table>


                                    <?php echo $address_fields; ?>

                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Contact Details</legend>
                                <table>



                                    <?php echo $contact_fields; ?>



                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Proposed Loan</legend>
                                <table>


                                    <?php echo $loan_fields; ?>


                                </table>
                            </fieldset>

                            <button type="submit" class="submit-btn btn btn-success btn-large btn-automargin" data-url="<?php echo site_url('apply/2') ?>">Continue <i class="icon-chevron-right"></i></button>
                        </form>
                    </div>
                </div>
