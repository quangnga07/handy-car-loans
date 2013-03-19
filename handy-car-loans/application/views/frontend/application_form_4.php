                <?php echo $page_content->content;?>
                <span class="pull-right">Application Number: <span style="font-weight: bold; font-size: 18px; color: #529be7;">HCL<?php echo $applicant_data->id ?></span></span><div id="application-form" class="clearfix">
                    <div id="steps-container">
                        <div class="step-field">
                            <a href="<?php echo site_url('apply/1'); ?>">
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
                            <a href="<?php echo site_url('apply/2'); ?>">
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
                            <a href="<?php echo site_url('apply/3'); ?>">
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
                            <a class="active" href="<?php echo site_url('apply/4'); ?>">
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
                        <form method='POST' id='form-4' action="<?php echo site_url('registration/autosave'); ?>">
                            <input type="hidden" name="applicant_id" value="<?php echo $applicant_id ?>" />
                            <fieldset>
                                <legend>Reference No 1</legend>
                                <table>

                                    <?php echo $ref1_fields; ?>

                                </table>
                            </fieldset>

                            <fieldset>
                                <legend>Reference No 2</legend>
                                <table>

                                    <?php echo $ref2_fields; ?>

                                </table>
                            </fieldset>

                            <button type="submit" class="submit-btn btn btn-success btn-large btn-automargin" data-url="<?php echo site_url('apply/5') ?>">Continue <i class="icon-chevron-right"></i></button>
                        </form>
                    </div>
                </div>

