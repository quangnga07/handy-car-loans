                <h2>4 Easy Steps...</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                <div id="application-form" class="clearfix">
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
                                <div class="step-desc">
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
                                    <tr>
                                        <td>Title</td>
                                        <td>
                                            <input type='hidden' value='<?php echo $applicant_data->title ?>' id='title' >
                                            <select name='title' class='required' required="required" data-placement='right' data-original-title='Your title or status in life.' >
                                                <option value=''>Select</option>
                                                <option value='Mr'>Mr</option>
                                                <option value='Mrs'>Mrs</option>
                                                <option value='Ms'>Ms</option>
                                                <option value='Miss'>Miss</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >First Name</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->fname; ?>" type='text' name='fname' required="required" class='required' data-placement='right' data-original-title='Your first name. If do you have a second name, you can place it here.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Last Name</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->lname; ?>" type='text' name='lname' required="required" class='required' data-placement='right' data-original-title='Your surname or last name.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Middle Name</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->mname; ?>" type='text' name='mname' data-placement='right' data-original-title='Your middle name.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Date of Birth</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->birth_date; ?>" type='text' name='birth_date' id='birth_date' maxlength='2' required="required" class='required input-small' data-placement='right' data-original-title='The date of your birthday and you must be 18 and above.' />
                                            <span>/</span>
                                            <input value="<?php echo $applicant_data->birth_month; ?>" type='text' name='birth_month' id='birth_month' maxlength='2' required="required" class='required input-small' data-placement='right' data-original-title='The month of your birthday and you must be 18 and above.' />
                                            <span>/</span>
                                            <input value="<?php echo $applicant_data->birth_year; ?>" type='text' name='birth_year' id='birth_year' maxlength='4' required="required" class='required input-medium' data-placement='right' data-original-title='The year of your birthday and you must be 18 and above.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Drivers License No.</td>
                                        <td>
                                            <input type='text' value="<?php echo $applicant_data->license_num; ?>"  name='license-num' required="required" class='required' data-placement='right' data-original-title='Your drivers license number.' />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Address Details</legend>
                                <table>
                                    <tr>
                                        <td>Unit No. / Street No.</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->unit_num; ?>" class="input-small" type='text' name='unit-num' id='unit' data-placement='right' data-original-title='Your Unit number.' /> <span>/</span> <input value="<?php echo $applicant_data->street_num; ?>"class="input-small"  type='text' name='street-num' id='street' required="required" class='required' data-placement='right' data-original-title='Your Street number.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Street Name</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->street_name; ?>" type='text' name='street-name' required="required" class='required' data-placement='right' data-original-title='Your Street name.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>City / Suburb</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->city_suburb; ?>"type='text' name='city-suburb' required="required" class='required' data-placement='right' data-original-title='Your City or Suburb.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>State &amp; Postcode</td>
                                        <td>
                                            <input type='hidden' value='<?php echo $applicant_data->state ?>' id='state' >
                                            <select name='state' class='required auto-width' required="required" data-placement='right' data-original-title='Your state.' >
                                                <option value=''>State</option>
                                                <option value='ACT'>ACT</option>
                                                <option value='NT'>NT</option>
                                                <option value='NSW'>NSW</option>
                                                <option value='QLD'>QLD</option>
                                                <option value='SA'>SA</option>
                                                <option value='TAS'>TAS</option>
                                                <option value='VIC'>VIC</option>
                                                <option value='WA'>WA</option>
                                            </select>
                                            <input value="<?php echo $applicant_data->postcode; ?>" type='text' name='postcode' id='post-code' required="required" class='input-postcode required' data-placement='right' data-original-title='Your postcode.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Residential Status</td>
                                        <td>
                                            <input type='hidden' value='<?php echo $applicant_data->residential_status ?>' id='residential_status' >
                                            <select name='residential-status' required="required" data-placement='right' data-original-title='Your permanent address.' >
                                                <option value=''>Select</option>
                                                <?php foreach ($score_rs as $data): ?>
                                                    <option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Time at Address</td>
                                        <td>
                                            <input type='hidden' value='<?php echo $applicant_data->time_address ?>' id='time_address' >
                                            <select name='time-address' class='required' required="required" data-placement='right' data-original-title='How long do live on the specified address.' >
                                                <option value=''>Select</option>
                                                <?php foreach ($score_tca as $data): ?>
                                                    <option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                            <fieldset>
                                <legend>Contact Details</legend>
                                <table>
                                    <tr>
                                        <td>Email Address</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->user_email; ?>" type='text' name='email' id='email-address' required="required" data-placement='right' data-original-title='Your email address.' onpaste="return false;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Confirm Email</td>
                                        <td>
                                            <input type='text' name='user_email' id='email-confirm' required="required" data-placement='right' data-original-title='Confirm your email. It should be the same on what you have entered above.' onpaste="return false;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Phone</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->user_mobile_phone; ?>" maxlength='11' size='11' type='text' size='11' name='user_mobile_phone' required="required" data-placement='right' data-original-title='Only numbers are allowed and 11 digit max.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Home Phone</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->user_home_phone; ?>" maxlength='10' size='10' type='text' name='user_home_phone' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>

                            <fieldset>
                                <legend>Proposed Loan</legend>
                                <table>
                                    <tr>
                                        <td>Loan Amount</td>
                                        <td>
                                            <input value="<?php echo $applicant_data->loan_amount; ?>" type='text' size='11' name='loan_amount' required="required" id='loan' data-placement='right' data-original-title='The amount of money you want to borrow and only numbers are allowed.' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Loan Purpose</td>
                                        <td>
                                            <input type='hidden' value='<?php echo $applicant_data->loan_purpose ?>' id='loan_purpose' >
                                            <select name='loan-purpose' class='required' required="required" data-placement='right' data-original-title='Your intention for applying a loan.'>
                                                <option value=''>Select</option>
                                                <?php foreach ($score_lp as $data): ?>
                                                    <option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>

                            <button type="submit" class="submit-btn" data-url="<?php echo site_url('apply/2'); ?>">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
