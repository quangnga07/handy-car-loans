
<div id="content">
    <div id="content-header">
        <h1>Client Record</h1>
        <div class="btn-group">
            <?php
                echo '<label>Application Status:</label>';
                echo '<input type="hidden" name="id" value="' . $applicant->id . '" />';
                echo '<input type="hidden" name="has_fill" value="' . $applicant->has_fill . '" />';
                echo '<input type="hidden" name="url" value="' . site_url('admin/client/save_status') . '" />';
                echo '<select name="application_status" id="app_status">';

                if ($applicant->application_status == 2 && $applicant->has_fill === 'No') {
                    echo '<option value="1">Incomplete Application</option>';
                    echo '<option value="2">Require Documents</option>';
                    echo '<option value="7">Marketing Queue</option>';
                } elseif ($applicant->application_status == 2) {
                    echo '<option value="2">Require Documents</option>';
                    echo '<option value="3">Staff Processing</option>';
                    echo '<option value="7">Marketing Queue</option>';
                } elseif ($applicant->application_status == 3) {
                    echo '<option value="3">Staff Processing</option>';
                    echo '<option value="2">Require Documents</option>';
                    echo '<option value="4">Supervisor Approval</option>';
                    echo '<option value="7">Marketing Queue</option>';
                } elseif ($applicant->application_status == 4) {
                    echo '<option value="4">Supervisor Approval</option>';
                    echo '<option value="3">Staff Processing</option>';
                    if ($permission_approve_loan == 'yes') {
                        echo '<option value="5">Approved</option>';
                        echo '<option value="6">Declined</option>' ;
                    }
                } elseif ($applicant->application_status == 7) {
                    echo '<option value="7">Marketing Queue</option>';
                    echo '<option value="2">Require Documents</option>';
                    echo '<option value="3">Staff Processing</option>';
                } elseif ($applicant->application_status == 5) {
                    if($applicant->cancelled_by == 'finone') {
                        echo '<option value="5">Cancelled by Finone</option>';
                    } elseif($applicant->cancelled_by == 'customer') {
                        echo '<option value="5">Cancelled by Customer</option>';
                    } elseif($applicant->has_approved == '1') {
                        echo '<option value="5">Approved</option>';
                    } elseif($applicant->has_approved == '2') {
                        echo '<option value="6">Declined</option>';
                    }
                } elseif($applicant->application_status == 6) {
                    if($applicant->cancelled_by == 'finone') {
                        echo '<option value="5">Cancelled by Finone</option>';
                        echo '<option value="2">Require Documents</option>';
                        echo '<option value="3">Staff Processing</option>';
                    } elseif($applicant->cancelled_by == 'customer') {
                        echo '<option value="5">Cancelled by Customer</option>';
                        echo '<option value="2">Require Documents</option>';
                        echo '<option value="3">Staff Processing</option>';
                    } elseif($applicant->has_approved == '3') {
                        echo '<option>Abandoned</option>';
                    } elseif($applicant->has_approved == '2') {
                        echo '<option>Approved</option>';
                    }
                }
                echo '</select>';
            ?>
        </div>
    </div>
    <div id="breadcrumb">
        <a href="<?php echo site_url('admin'); ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
        <?php
        if ($applicant->application_status == 2 && $applicant->has_fill === 'No') {
            echo '<a href="' . site_url('admin/incomplete_application') . '" class="tip-bottom">Incomplete Application</a>';
        } elseif ($applicant->application_status == 2) {
            echo '<a href="' . site_url('admin/required_documents') . '" class="tip-bottom">Require Documents</a>';
        } elseif ($applicant->application_status == 3) {
            echo '<a href="' . site_url('admin/staff_processing') . '" class="tip-bottom">Staff Processing</a>';
        } elseif ($applicant->application_status == 4) {
            echo '<a href="' . site_url('admin/supervisor_approval') . '" class="tip-bottom">Supervisor Approval</a>';
        } elseif ($applicant->application_status == 5) {
            echo '<a href="' . site_url('admin/archived') . '" class="tip-bottom">Archived</a>';
        } else if ($applicant->application_status == 6) {
            echo '<a href="' . site_url('admin/marketing_queue') . '" class="tip-bottom">Marketing Queue</a>';
        }
        ?>
        <a href="#" class="current">Client Record</a>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div id="client-heading" class="clearfix">
                    <h3 style="float: left;">APPLICANT NAME: <span style="color:#529BE7;"><?php echo $applicant->fname; ?> <?php echo $applicant->lname; ?></span></h3>
                    <span class="id-submitted">
                        <table>
                            <tr>
                                <td>ID</td>
                                <td id="id">HCL<?php echo $applicant->id ?></td>
                            </tr>
                            <tr>
                                <td>SUBMITTED</td>
                                <td class="normal"><?php echo date( 'd-m-Y h:ia', strtotime($applicant->date_submitted) ); ?></td>
                            </tr>
                            <tr>
                                <td>RANK</td>
                                <td class="normal"><?php echo $rank; ?></td>
                            </tr>
                        </table>
                    </span>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span9">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-file"></i>
                        </span>
                        <h5>Application Form</h5>
                    </div>

                    <div class="widget-content">
                        <form method="POST" id="form-1" action="<?php echo site_url('admin/client/edit_record'); ?>">
                            <input type="hidden" name="applicant_id" value="<?php echo $applicant->id ?>" />
                            <div class="accordion" id="collapse-group">
                                <div class="accordion-group widget-box">
                                    <div class="accordion-heading">
                                        <div class="widget-title">
                                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                                <span class="icon"><i class="icon-magnet"></i></span><h5>Personal Details</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse accordion-body" id="collapseGOne">
                                        <div class="widget-content">
                                            <fieldset>
                                                <legend>Personal Information</legend>
                                                <table>
                                                    <tr>
                                                        <td>Title</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->title ?>' id='title' > 
                                                            <select name='title' class='required'  data-placement='right' data-original-title='Your title or status in life.' >
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
                                                            <input value="<?php echo $applicant->fname; ?>" type='text' name='fname'  class='required' data-placement='right' data-original-title='Your first name. If do you have a second name, you can place it here.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >Last Name</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->lname; ?>" type='text' name='lname'  class='required' data-placement='right' data-original-title='Your surname or last name.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >Middle Name</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->mname; ?>" type='text' name='mname' data-placement='right' data-original-title='Your middle name.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >Date of Birth</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->birth_date; ?>" type='text' name='birth_date' id='birth_date' maxlength='2'  class='required input-small' data-placement='right' data-original-title='The date of your birthday and you must be 18 and above.' />
                                                            <span>/</span>
                                                            <input value="<?php echo $applicant->birth_month; ?>" type='text' name='birth_month' id='birth_month' maxlength='2'  class='required input-small' data-placement='right' data-original-title='The month of your birthday and you must be 18 and above.' />
                                                            <span>/</span>
                                                            <input value="<?php echo $applicant->birth_year; ?>" type='text' name='birth_year' id='birth_year' maxlength='4'  class='required input-medium' data-placement='right' data-original-title='The year of your birthday and you must be 18 and above.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td >Drivers License No.</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->license_num; ?>"  name='license-num'  class='required' data-placement='right' data-original-title='Your drivers license number.' />
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
                                                            <input value="<?php echo $applicant->unit_num; ?>" class="input-small" type='text' name='unit-num' id='unit' data-placement='right' data-original-title='Your Unit number.' /> <span>/</span> <input value="<?php echo $applicant->street_num; ?>"class="input-small"  type='text' name='street-num' id='street'  class='required' data-placement='right' data-original-title='Your Street number.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Street Name</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->street_name; ?>" type='text' name='street-name'  class='required' data-placement='right' data-original-title='Your Street name.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City / Suburb</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->city_suburb; ?>"type='text' name='city-suburb'  class='required' data-placement='right' data-original-title='Your City or Suburb.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State &amp; Postcode</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->state ?>' id='state' > 
                                                            <select name='state' class='required auto-width'  data-placement='right' data-original-title='Your state.' >
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
                                                            <input value="<?php echo $applicant->postcode; ?>" type='text' name='postcode' id='post-code'  class='input-postcode required' data-placement='right' data-original-title='Your postcode.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Residential Status</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->residential_status ?>' id='residential_status' > 
                                                            <select name='residential-status'  data-placement='right' data-original-title='Your permanent address.' >
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
                                                            <input type='hidden' value='<?php echo $applicant->time_address ?>' id='time_address' > 
                                                            <select name='time-address' class='required'  data-placement='right' data-original-title='How long do live on the specified address.' >
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
                                                            <input value="<?php echo $applicant->user_email; ?>" type='text' name='user_email' id='email-address'  data-placement='right' data-original-title='Your email address.' onpaste="return false;" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile Phone</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->user_mobile_phone; ?>" maxlength='11' size='11' type='text' size='11' name='user_mobile_phone'  data-placement='right' data-original-title='Only numbers are allowed and 11 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Home Phone</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->user_home_phone; ?>" maxlength='10' size='10' type='text' name='user_home_phone' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
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
                                                            <input value="<?php echo $applicant->loan_amount; ?>" type='text' size='11' name='loan_amount'  id='loan' data-placement='right' data-original-title='The amount of money you want to borrow and only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Loan Purpose</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->loan_purpose ?>' id='loan_purpose' > 
                                                            <select name='loan-purpose' class='required'  data-placement='right' data-original-title='Your intention for applying a loan.'>
                                                                <option value=''>Select</option>
                                                                <?php foreach ($score_lp as $data): ?>
                                                                    <option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
                                                                <?php endforeach; ?>											
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div> 
                                <div class="accordion-group widget-box">
                                    <div class="accordion-heading">
                                        <div class="widget-title">
                                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                                <span class="icon"><i class="icon-magnet"></i></span><h5>Employment Details</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse accordion-body" id="collapseGTwo">
                                        <div class="widget-content">
                                            <fieldset>
                                                <legend>Employment</legend>
                                                <table>
                                                    <tr>
                                                        <td>Employment Status</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->employment_status ?>' id='employment_status' > 
                                                            <select name='employment-status'  data-placement='right' data-original-title='Your employement status or position on the company.' >
                                                                <option value=''>Select</option>
                                                                <?php foreach ($score_es as $data): ?>
                                                                    <option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
                                                                <?php endforeach; ?>	
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employment Length</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->employment_length ?>' id='employment_length' > 
                                                            <select name='employment-length'  data-placement='right' data-original-title='Your employement length on the company.'>
                                                                <option value=''>Select</option>
                                                                <?php foreach ($score_el as $data): ?>
                                                                    <option value='<?php echo $data->option; ?>'><?php echo $data->option; ?></option>
                                                                <?php endforeach; ?>	
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Monthly Income</td>
                                                        <td>
                                                            <span class='loan-dollar'>$</span>
                                                            <input class="input-match-select" value="<?php echo $applicant->monthly_income; ?>" type='text' name='monthly_income' id='income'  data-placement='right' data-original-title='Your monthly salary. Only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payday Frequency</td>
                                                        <td> 
                                                            <input type='hidden' value='<?php echo $applicant->payday_frequency ?>' id='payday_frequency' > 
                                                            <select name='payday-frequency'  data-placement='right' data-original-title='How many times do you get you salary within a month?'>
                                                                <option value=''>Select</option>
                                                                <option value='Monthy'>Monthy</option>
                                                                <option value='Four-weekly'>Four-weekly</option>
                                                                <option value='Fortnightly'>Fortnightly</option>
                                                                <option value='Weekly'>Weekly</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Next Payday</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->next_payday; ?>" type='hidden' name='next-payday'  id='payday' data-placement='right' data-original-title='When is your next payday? Before date is not allowed.' />
                                                            <input value='' type='text' id='p_date' maxlength='2' required='required' class='required input-small' data-placement='right' data-original-title='The date of your birthday and you must be 18 and above.' />
                                                            <span>/</span>
                                                            <input value='' type='text' id='p_month' maxlength='2' required='required' class='required input-small' data-placement='right' data-original-title='The month of your birthday and you must be 18 and above.' />
                                                            <span>/</span>
                                                            <input value='' type='text' id='p_year' maxlength='4' required='required' class='required input-medium' data-placement='right' data-original-title='The year of your birthday and you must be 18 and above.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='2'>Is your salary paid directly into your bank account?</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan='2' align='center'>
                                                            <input type='hidden' value='<?php echo $applicant->direct_to_bank ?>' id='direct_to_bank' > 
                                                            <span style="margin: 0 0 0 150px; float: left;"><label><input type='radio' name='direct-to-bank' value='Yes' /> Yes</label></span>
                                                            <span style="float: left;"><label><input type='radio' name='direct-to-bank' value='No' /> No</label></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>

                                            <fieldset>
                                                <legend>Employer Details</legend>
                                                <table>
                                                    <tr>
                                                        <td>Business Name</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->business_name; ?>" type='text' name='business-name'  data-placement='right' data-original-title='Business name of the employer.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Employer Phone</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->employer_phone; ?>" maxlength='11' size='11' type='text' name='employer_phone'  data-placement='right' data-original-title='Phone number of the employer. Only number are allowed and 11 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unit No. / Street No.</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->employer_unit_num; ?>" type='text' class="input-small" name='employer-unit-num' id='unit' data-placement='right' data-original-title='Unit number of the employer.' /> <span>/</span> <input value="<?php echo $applicant->employer_street_num; ?>" type='text' class="input-small" name='employer-street-num' id='street'  data-placement='right' data-original-title='Street number of the employer.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Street Name</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->employer_street_name; ?>" type='text' name='employer-street-name'  id='employer-street-name' data-placement='right' data-original-title='Street Name of the employer.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City / Suburb</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->employer_city_suburb; ?>" type='text' name='employer-city-suburb'  data-placement='right' data-original-title='City or Suburb of the employer.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State &amp; Postcode</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->employer_state ?>' id='employer_state' > 
                                                            <select name='employer-state'  class="required auto-width" data-placement='right' data-original-title='State of the employer'>
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
                                                            <span>/</span>
                                                            <input type='text'class="input-postcode" value="<?php echo $applicant->employer_postcode ?>" name='employer-postcode'  id='post-code' data-placement='right' data-original-title='Postcode of the employer.' />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="acoordion-group widget-box">
                                    <div class="accordion-heading">
                                        <div class="widget-title">
                                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                                <span class="icon"><i class="icon-magnet"></i></span><h5>Financial Details</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse accordion-body" id="collapseGThree">
                                        <div class="widget-content">
                                            <fieldset>
                                                <legend>Your Expenses</legend>
                                                <table>
                                                    <tr>
                                                        <td>Mortgage/Rent Payment Frequency</td>
                                                        <td style="padding-left: 13px;">
                                                            <input type='hidden' value='<?php echo $applicant->payment_frequency ?>' id='payment_frequency' > 
                                                            <select class="select-dollar" name='payment-frequency'  data-placement='right' data-original-title='How many times do you pay for the Mortgage/Rent within a month?'>
                                                                <option value=''>Select</option>
                                                                <option value='Monthly'>Monthly</option>
                                                                <option value='Fortnightly'>Fortnightly</option>
                                                                <option value='Weekly'>Weekly</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mortgage/Rent per month</td>
                                                        <td>
                                                            <span class='loan-dollar'>$</span>
                                                            <input class="input-dollar" value="<?php echo $applicant->mortgage_rent_month; ?>" type='text' name='mortgage_rent_month'  class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Living Expenses per month</td>
                                                        <td>
                                                            <span class='loan-dollar'>$</span>
                                                            <input class="input-dollar" value="<?php echo $applicant->expenses_month; ?>" type='text' name='expenses_month'  class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Loans per month</td>
                                                        <td>
                                                            <span class='loan-dollar'>$</span>
                                                            <input class="input-dollar" value="<?php echo $applicant->loans_month; ?>" type='text' name='loans_month'  class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Credit Cards per month</td>
                                                        <td>
                                                            <span class='loan-dollar'>$</span>
                                                            <input class="input-dollar" value="<?php echo $applicant->credit_card_month; ?>" type='text' name='credit_card_month'  class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Other Debits per month</td>
                                                        <td>
                                                            <span class='loan-dollar'>$</span>
                                                            <input class="input-dollar" value="<?php echo $applicant->debit_months; ?>" type='text' name='debit_months'  class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>

                                            <fieldset>
                                                <legend>Your Bank Account Details</legend>
                                                <table>
                                                    <tr>
                                                        <td>Bank Name</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->bank_name; ?>" type='text'  name='bank-name' data-placement='right' data-original-title='Name of the bank.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name on Account</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->account_name; ?>" type='text'  name='account-name' data-placement='right' data-original-title='Name of the bank account.' />
                                                            <label class="partial-match" id="partial"><i>Warning: Partial Match Only</i></label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>BSB</td>
                                                        <td>
                                                            <input value="<?php echo $applicant->bsb; ?>" maxlength='6' size='6' type='text'  name='bsb' data-placement='right' data-original-title='Only numbers are allowed and 6 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Account Number</td>
                                                        <td>
                                                            <input  value="<?php echo $applicant->account_num; ?>" maxlength='10' size='10' type='text'  name='account_num' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-group widget-box">
                                    <div class="accordion-heading">
                                        <div class="widget-title">
                                            <a data-parent="#collapse-group" href="#collapseGFour" data-toggle="collapse">
                                                <span class="icon"><i class="icon-magnet"></i></span><h5>References</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="collapse accordion-body" id="collapseGFour">
                                        <div class="widget-content">
                                            <fieldset>
                                                <legend>Reference No 1</legend>
                                                <table>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_name ?>" name='ref1-name'  data-placement='right' data-original-title='Name of the first reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Relationship</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_relationship ?>" name='ref1-relationship'  data-placement='right' data-original-title='Your relationship on the name you have specified above.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Home Phone</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_home_phone ?>" maxlength='10' size='10' name='ref1_home_phone' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile Phone</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_mobile_phone ?>" maxlength='11' size='11'  name='ref1_mobile_phone'  data-placement='right' data-original-title='Only numbers are allowed and 11 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unit No. / Street No.</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_unit_num ?>" class="input-small" name='ref1-unit-num' class='unit' data-placement='right' data-original-title='Unit number of the reference.' /> <span>/</span> <input type='text' class="input-small" value="<?php echo $applicant->ref1_street_num ?>" name='ref1-street-num' class='street'  data-placement='right' data-original-title='Street number of the reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Street Name</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_street_name ?>"  name='ref1-street-name'  data-placement='right' data-original-title='Street Name of the reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City / Suburb</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref1_city_suburb ?>"  name='ref1-city-suburb'  data-placement='right' data-original-title='City or Suburb of the reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State &amp; Postcode</td>
                                                        <td>
                                                            <input type='hidden' value='<?php echo $applicant->ref1_state ?>' id='ref1_state' >
                                                            <select name='ref1-state'  class="auto-width" data-placement='right' data-original-title='State of the reference.'>
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
                                                            <span>/</span>
                                                            <input type='text' class="input-postcode" value="<?php echo $applicant->ref1_postcode ?>" name='ref1-postcode'  class='post-code' data-placement='right' data-original-title='Postcode of the reference.' />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>

                                            <fieldset>
                                                <legend>Reference No 2</legend>
                                                <table>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref2_name ?>" name='ref2-name'  data-placement='right' data-original-title='Name of the second refernce.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Relationship</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref2_relationship ?>" name='ref2-relationship'  data-placement='right' data-original-title='Your relationship on the name you have specified above.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Home Phone</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref2_home_phone ?>" maxlength='10' size='10' name='ref2_home_phone' data-placement='right' data-original-title='Only number are allowed and 10 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile Phone</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref2_mobile_phone ?>" maxlength='11' size='11'  name='ref2_mobile_phone'  data-placement='right' data-original-title='Only number are allowed and 11 digit max.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unit No. / Street No.</td>
                                                        <td>
                                                            <input type='text' class="input-small" value="<?php echo $applicant->ref2_unit_num ?>" name='ref2-unit-num' class='unit' data-placement='right' data-original-title='Unit number of the reference.' /> <span>/</span> <input type='text' class="input-small" value="<?php echo $applicant->ref2_street_num ?>" name='ref2-street-num' class='street'  data-placement='right' data-original-title='Street number of the reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Street Name</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref2_street_name ?>"  name='ref2-street-name'  data-placement='right' data-original-title='Street Name of the reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>City / Suburb</td>
                                                        <td>
                                                            <input type='text' value="<?php echo $applicant->ref2_city_suburb ?>"  name='ref2-city-suburb'  data-placement='right' data-original-title='City or Suburb of the reference.' />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>State &amp; Postcode</td>
                                                        <td>
                                                            <input type='hidden' value="<?php echo $applicant->ref2_state ?>" id="ref2_state" />
                                                            <select name='ref2-state'  class="auto-width" data-placement='right' data-original-title='State of the reference.'>
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
                                                            <span>/</span>
                                                            <input type='text' class="input-postcode" value="<?php echo $applicant->ref2_postcode ?>" name='ref2-postcode'  class='post-code' data-placement='right' data-original-title='Postcode of the reference.' />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <?php if ($applicant->term_version != ''): ?>
                                <span class="pull-right">
                                    <span >Applicant accepted: </span>
                                    <span style="color:#09F">
                                        Terms-V<?php if ($applicant->term_version) echo $applicant->term_version . ' ' . date("jS F Y", strtotime($term_date->date)); else echo '0'; ?>
                                    </span>
                                </span>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-wrench"></i></span><h5>Notes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php echo site_url('admin/client/add_notes'); ?>" method="POST" class="form-horizontal">
                            <input type="hidden" name="users_application_id" value="<?php echo $this->urlparser->encode($applicant->id); ?>" />
                            <div class="control-group">
                                <label class="control-label">Broker Notes</label>
                                <div class="controls">
                                    <textarea name="broker_notes" style="height: 100px;"><?php if ($notes) echo ($notes->broker_notes) ? ($notes->broker_notes) : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Staff Notes</label>
                                <div class="controls">
                                    <textarea name="staff_notes" style="height: 200px;"><?php if ($notes) echo ($notes->staff_notes) ? ($notes->staff_notes) : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Supervisor Notes</label>
                                <div class="controls">
                                    <textarea name="supervisor_notes" style="height: 150px;"><?php if ($notes) echo ($notes->supervisor_notes) ? ($notes->supervisor_notes) : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="form-actions" style="padding: 12px 15px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>                        
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-wrench"></i></span><h5>Manual Settings</h5>
                    </div>
                    <div class="widget-content">
                        <form class="fill-select" action="<?php echo site_url('admin/client/add_settings'); ?>" method="POST">   
                            <input type="hidden" name="users_application_id" value="<?php echo $this->urlparser->encode($applicant->id); ?>" />
                            <fieldset>
                                <legend>Extra Fields</legend>
                                <table>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <input type="hidden" value="<?php if ($settings) echo $settings->status; ?>" />
                                            <select name="status">
                                                <option value="">Select</option>
                                                <option>Application</option>
                                                <option>Underwriting</option>
                                                <option>Funded</option>
                                                <option>Declined</option>
                                            </select>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>Brand</td>
                                        <td>
                                            <input type="hidden" value="<?php if ($settings) echo $settings->brand; ?>" />
                                            <select name="brand">
                                                <option value="">Select</option>
                                                <option>Handy Car Loans</option>
                                                <option>Handy Cash Loans</option>
                                                <option>Real Car Loans</option>
                                                <option>Real Cash Loans</option>
                                                <option>YFD</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stages</td>
                                        <td>
                                            <input type="hidden" value="<?php if ($settings) echo $settings->staging; ?>" />
                                            <select name="staging">
                                                <option value="">Select</option>
                                                <option>App Incomplete</option>
                                                <option>App Complete</option>
                                                <option>App Declined</option>
                                                <option>Info Requested</option>
                                                <option>Referred</option>
                                                <option>Unable to Contact</option>
                                                <option>Declined Affordability</option>
                                                <option>Client Cancelled</option>
                                                <option>Declined Fraud/Suspicious</option>
                                                <option>Declined Suitability</option>
                                                <option>Declined Stability</option>
                                                <option>Approved A</option>
                                                <option>Approved B</option>
                                                <option>Approved C</option>
                                                <option>Arrears Stage 1</option>
                                                <option>Arrears Stage 2</option>
                                                <option>Arrears Stage 3</option>
                                                <option>Written Off</option>
                                                <option>Repaid</option>
                                                <option>Settled</option>
                                                <option>Expired</option>
                                            </select>
                                        </td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>Leadgen</td>
                                        <td>
                                            <input type="hidden" value="<?php if ($settings) echo $settings->leadgen; ?>" />
                                            <select name="leadgen">
                                                <option value="">Select</option>
                                                <option>The Loan Centre</option>
                                                <option>First Stop Money</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Product</td>
                                        <td>
                                            <input type="hidden" value="<?php if ($settings) echo $settings->product; ?>" />
                                            <select name="product">
                                                <option value="">Select</option>
                                                <option>Finone 29</option>
                                                <option>Finone 24</option>
                                                <option>Finone 19</option>
                                                <option>YFD Secured</option>
                                                <option>YFD Unsecured</option>
                                                <option>CCC</option>
                                            </select>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>Broker</td>
                                        <td>
                                            <input type="hidden" value="<?php if ($settings) echo $settings->broker; ?>" />
                                            <select name="broker">
                                                <option value="">Select</option>
                                                <option>Credit Choice</option>
                                                <option>Other</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>                        
                </div>

                <div id="email-box" class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-envelope"></i>
                        </span>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab1">Compose</a></li>
                            <li><a data-toggle="tab" href="#tab2">Inbox</a></li>
                            <!--li><a data-toggle="tab" href="#tab3">Archive</a></li-->
                        </ul>
                    </div>
                    <div class="widget-content tab-content nopadding">
                        <div id="tab1" class="tab-pane active">
                            <form class="form-horizontal" id="email-management-form" action="<?php echo site_url('admin/email/send'); ?>">
                                <!--div class="control-group">
                                        <label class="control-label">Subject</label>
                                        <div class="controls">
                                                <input type="text" name="email-subject" />
                                        </div>
                                </div-->
                                <div class="control-group">
                                    <label class="control-label">Body</label>
                                    <div class="controls">
                                        <textarea name="email-content"></textarea>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">Send</button>
                                </div>
                                <input type="hidden" name="admin_name" value="<?php echo $this->session->userdata('user'); ?>" />
                                <input type="hidden" name="admin_email" value="<?php echo $this->session->userdata('email'); ?>" />
                                <input type="hidden" name="client_email" value="<?php echo $applicant->user_email; ?>" />
                                <input type="hidden" name="client_id" value="<?php echo $applicant->id; ?>" />
                            </form>
                        </div>
                        <div id="tab2" class="tab-pane" style="padding: 12px 15px;">
                            <?php if ($messages): ?>
                                <ul class="recent-posts">
                                <?php foreach ($messages as $msg): ?>
                                        <li>
                                            <div class="article-post">
                                                <span class="user-info">By: <?php echo $msg->from; ?> <span class="pull-right"><?php echo date('d-m-Y h:ia', strtotime($msg->time_sent)); ?></span></span>
                                                <div class="clearfix"><pre><?php echo $msg->message; ?></pre></div>
                                            </div>
                                        </li>
                                <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                <h3>No Messages</h3>
                            <?php endif; ?>
                        </div>
                        <!--div id="tab3" class="tab-pane">
                                <pre>
                                    <?php print_r($email_parser); ?>
                                </pre>
                        </div-->
                    </div>                            
                </div>	

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-wrench"></i></span><h5>Manual Control</h5>
                    </div>
                    <div class="widget-content clearfix">
                        <form action="<?php echo site_url('admin/client/save_status'); ?>" class="cancel_form" method="POST" style="float: left; margin-right: 10px;">
                            <input type="hidden" name="id" value="<?php echo $applicant->id; ?>">
                            <input type="hidden" name="status" value="6">
                            <input type="hidden" name="cancelled_by" value="finone">
                            <button class="btn" type="submit">Cancel by Finone</button>
                        </form>
                        <form action="<?php echo site_url('admin/client/save_status'); ?>" class="cancel_form" method="POST" style="float: left; margin-right: 10px;">	
                            <input type="hidden" name="id" value="<?php echo $applicant->id; ?>">
                            <input type="hidden" name="status" value="6">
                            <input type="hidden" name="cancelled_by" value="customer">
                            <button class="btn" type="submit">Cancel by Customer</button>
                        </form>
                        <?php
                        if ($permission_approve_loan == 'yes') {
                            if( $applicant->application_status == 4 ) {
                                echo '<form action="'.site_url('admin/client/send_back_record').'" id="send_back_form" method="POST" style="float: left; margin-right: 10px;">';
                                echo '  <input type="hidden" name="client_id" value="'.$applicant->id.'" />';
                                echo '  <button class="btn btn-warning" type="submit">Send Back</button>';
                                echo '</form>';

                                echo '<form action="' . site_url('admin/client/approve') . '" method="POST" style="float: left; margin-right: 10px;">';
                                echo '  <input type="hidden" name="applicant_id" value="' . $applicant->id . '" />';
                                echo '	<button class="btn btn-success" type="submit" style="padding: 4px auto; width:100px">Approve</button>';
                                echo '</form>';

                                echo '<form action="' . site_url('admin/client/declined') . '" method="POST" style="float: left; margin-right: 10px;">	';
                                echo '  <input type="hidden" name="applicant_id" value="' . $applicant->id . '" />';
                                echo '	<button class="btn btn-danger" type="submit" style="padding: 4px auto; width:100px">Decline</button>';
                                echo '</form>';
                            }
                        }
						if($permission_delete == 'yes'){
							echo '<form method="POST" style="float: left; margin-right: 10px;">	';
                            echo '	<button class="btn" id="delete_record" type="submit">Delete Record</button>';
                            echo '</form>';	
						}
                        ?>
                    </div>                        
                </div>
            </div>
            <div class="span3">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-briefcase"></i>
                        </span>
                        <h5>Documents on File</h5>
                    </div>
                    <div class="widget-content">
                        <ul class="documents-display">
                        <?php
                        if (!empty($documents)) {
                            $url = base_url() . 'uploads/';
                            foreach ($documents as $doc) {
                                if ($doc->supply_via == 'Upload' || $doc->supply_via == 'Manual Upload') {
                                    $file = explode(',', $doc->files);
                                    for ($x = 0; $x < count($file); $x++) {
                                        $str_id = random_string('alnum',20);
                                        $type = preg_replace('/(.+)\./s', '', $file[$x]);
                                        $ip = $doc->ip_address;
                                        $date = date('d-m-Y h:ia', strtotime($doc->datetime_submitted));

                                        echo '<li id="'.$str_id.'">';
                                        if ($type == 'doc' || $type == 'pdf') {
                                            echo '<a href="' . $url . $doc->user_id . '_' . $file[$x] . '" target="_blank"><span class="file-' . $type . '"></span></a>';
                                            echo '<p class="filename"><a href="' . $url . $doc->user_id . '_' . $file[$x] . '" target="_blank">' . $file[$x] . '</a><span doc-str-id="'.$str_id.'" data-num-files="' . count($file) . '"  data-doc-name="' . $file[$x] . '" data-doc-id="' . $doc->id . '" class="remove-docs"><img style="height: 9px;" src="' . base_url() . 'assets/img/cancel_red.png' . '"/></span></p>';
                                        } else {
                                            $fileurl = $url . $doc->user_id . '_' . $file[$x];
                                            $title = $doc->user_id;
                                            ?>
                                                                        <a class="image" href="#" title="<?php echo $file[$x] ?>" onClick="window.open('<?php echo $fileurl ?>', '<?php echo $title ?>', 'width=700, height=500', resizable='yes')"><span class="file-<?php echo $type ?>"></span></a>
                                                                        <p class="filename">
                                                                            <a href="#" class="image" onClick="window.open('<?php echo $fileurl ?>', '<?php echo $title ?>',  'width=700, height=500', resizable='yes')"><?php echo $file[$x] ?></a>
                                                                            <span doc-str-id="<?php echo $str_id; ?>"  data-num-files="<?php echo count($file) ?>" data-doc-name="<?php echo $file[$x]; ?>" data-doc-id="<?php echo $doc->id; ?>"  class="remove-docs"><img style="height: 9px;" src="<?php echo base_url() . 'assets/img/cancel_red.png'; ?>"/></span>
                                                                        </p>
                                            <?php
                                        }
                                        echo '<div class="doc_label">Submitted: ' . $date . '</div>';
                                        echo '<div class="doc_label">From: IP ' . $ip . '</div>';
                                        echo '</li>';
                                    }
                                } else {
                                    echo '<p>Documents sent via: ' . $doc->supply_via . '</p>';
                                }
                            }
                        } else {
                            echo '<p style="font-size:11px">No Documents</p>';
                        }
                        ?>
                        </ul>
                        <hr/>
                        <form action="<?php echo site_url('admin/client/upload_docs'); ?>" method="post" enctype="multipart/form-data" id="manual_upload" >
                            <div class="control-group">
                                <div class="controls">
                                    <input type="file" class="multi" name="myfiles" />
                                    <input type="hidden" name="user_id" value="<?php echo $applicant->id; ?>" />
                                    <?php echo $notify; ?>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary doc_btn">Add</button>
                        </form>

                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-comment"></i>
                        </span>
                        <h5>Send Document Request Email</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form id="email-request-document" class="form-horizontal" method="post" action="<?php echo site_url('admin/email/send_templated_email'); ?>">
                            <div style="padding: 12px 15px;">
                                <label>Request:</label>
                                <label class="checkbox" style="padding-left:5px">
                                    <input type="checkbox" name="doc[]" value="Passport" /> Passport
                                </label>
                                <label class="checkbox" style="padding-left:5px">
                                    <input type="checkbox" name="doc[]" value="Birth Certificate" /> Birth Certificate
                                </label>
                                <label class="checkbox" style="padding-left:5px">
                                    <input type="checkbox" name="doc[]" value="Drivers Licence" /> Drivers Licence
                                </label>
                                <label class="checkbox" style="padding-left:5px">
                                    <label><input type="checkbox" name="doc[]" /> Others:</label>
                                </label>
                                <label><input type="text" name="" style="margin-left:29px"/></label>

                                <label class="checkbox" style="padding-left:5px">
                                    <label><input type="checkbox" name="doc[]" /> Others:</label>
                                </label>
                                <label><input type="text" name="" style="margin-left:29px"/></label>

                                <label class="checkbox" style="padding-left:5px">
                                    <label><input type="checkbox" name="doc[]" /> Others:</label>
                                </label>
                                <label><input type="text" name="" style="margin-left:29px"/></label>

                                <label class="checkbox" style="padding-left:5px">
                                    <label><input type="checkbox" name="doc[]" /> Others:</label>
                                </label>
                                <label><input type="text" name="" style="margin-left:29px; margin-bottom:10px"/></label>
                                <input type="hidden" name="client_email" value="<?php echo $applicant->user_email; ?>" />
                                <input type="hidden" name="applicant_id" value="<?php echo $applicant->id; ?>" />
                                <input type="hidden" name="applicant_name" value="<?php echo $applicant->fname . ' ' . $applicant->lname; ?>" />
                                <input type="hidden" name="template_id" value="1" />
                            </div>
                            <div class="form-actions" style="padding: 12px 15px; clear:both;">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-comment"></i>
                        </span>
                        <h5>Document Request History</h5>
                    </div>
                    <div class="widget-content">
                        <div id="scrollbar1" style="width:100%; height:135px; font-size:11px; overflow:hidden;">
                            <div style="padding-right: 8px; width: 115%; height:140px; overflow-y: scroll;">
                                <?php if ($doc_log): ?>
                                    <table style="font-size: 11px; width: 100%">
                                    <?php rsort($doc_log);
                                            foreach ($doc_log as $item): ?>
                                            <tr>
                                                <td><?php echo date('d-m-Y: h:ia', strtotime($item->date_sent)); ?></td>
                                                <td><?php echo $item->message; ?></td>
                                            </tr>
                                    <?php endforeach; ?>
                                    </table>
                                    <?php else: ?>
                                    <p style="font-size:11px">No Logs</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-print"></i>
                        </span>
                        <h5>Print</h5>
                    </div>
                    <div class="widget-content">
                        <a target="_blank" class="btn btn-primary" href="<?php echo site_url('admin/print/printrecord/' . $this->urlparser->encode($applicant->id)); ?>">Print record</a>
                    </div>
                </div>

                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <i class="icon-user"></i>
                        </span>
                        <h5>Mini Log</h5>
                    </div>
                    <div class="widget-content">
                        <div id="scrollbar1" style="width:100%; height:140px; font-size:11px; overflow:hidden;">
                            <div style="padding-right: 8px; width: 115%; height:140px; overflow-y: scroll;">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <?php
                                    $str = '';
                                    if (count($user_log) > 0) {
                                        foreach ($user_log as $usr_lg) {
                                            $level = '';
                                            switch ($usr_lg->level) {
                                                case 1:
                                                    $level = 'Admin';
                                                    break;
                                                case 2:
                                                    $level = 'Supvr';
                                                    break;
                                                case 3:
                                                    $level = 'Staff';
                                                    break;
                                            }
                                            $str .= '<tr>';
                                            $str .= '	<td style="width:50%">' . date('d-m-Y: h:ia', strtotime($usr_lg->date)) . '</td>';
                                            $str .= '	<td style="width:25%; padding-left:5px">' . $level . '</td>';
                                            $str .= '	<td style="width:25%; padding-left:5px">' . ucfirst($usr_lg->view_by) . '</td>';
                                            $str .= '</tr>';
                                        }
                                    }
                                    echo $str;
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

<div id="delete-dialog" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button">×</button>
        <h3>Confirmation</h3>
    </div>
    <div class="modal-body">
        <p>This will delete this document permanently, you cannot undo this later. Are you sure you want to continue?</p>
    </div>
    <div class="modal-footer">
        <a data-dismiss="modal" class="btn btn-primary" id="delete-yes" href="#">Yes</a>
        <a data-dismiss="modal" class="btn" href="#">No</a>
    </div>
</div>

<script type="text/javascript">
	var base_url = '<?php echo base_url().'admin'; ?>';
	var client_record_id = <?php echo $applicant->id;?>;
	var delete_client_record = '<?php echo base_url() . "admin/client/delete_client_record"; ?>'; 
    var delete_document_url = '<?php echo base_url() . "admin/client/delete_user_document"; ?>';
</script>