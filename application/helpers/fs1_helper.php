<?php

function personal_html($fields, $applicant_data) {

    if ($fields == 'title') {
        return "<tr>
                        <td>Title</td>
                        <td>
                            <input type='hidden' value='" . $applicant_data->title . "' id='title' >
                            <select name='title' class='required' required='required' data-placement='right' data-original-title='Your title or status in life.' >
                                <option value=''>Select</option>
                                <option value='Mr'>Mr</option>
                                <option value='Mrs'>Mrs</option>
                                <option value='Ms'>Ms</option>
                                <option value='Miss'>Miss</option>
                            </select>
                        </td>
                    </tr>";
    }
    if ($fields == 'first_name') {
        return "<tr>
                        <td >First Name</td>
                        <td>
                            <input value='" . $applicant_data->fname . "' type='text' name='fname' class='required' data-placement='right' data-original-title='Your first name. If do you have a second name, you can place it here.' />
                        </td>
                    </tr>";
    }
    if ($fields == 'last_name') {
        return "<tr>
                        <td >Last Name</td>
                        <td>
                            <input value='" . $applicant_data->lname . "' type='text' name='lname' class='required' data-placement='right' data-original-title='Your surname or last name.' />
                        </td>
                    </tr>";
    }
    if ($fields == 'middle_name') {
        return "<tr>
                        <td >Middle Name</td>
                        <td>
                            <input value='" . $applicant_data->mname . "' type='text' name='mname' data-placement='right' data-original-title='Your middle name.' />
                        </td>
                    </tr>";
    }
    if ($fields == "date_of_birth") {

        return "<tr>
                        <td >Date of Birth</td>
                        <td>
                            <input value='" . $applicant_data->birth_date . "' type='text' name='birth_date' id='birth_date' maxlength='2' class='required input-small' data-placement='right' data-original-title='The date of your birthday and you must be 18 and above.' />
                            <span>/</span>
                            <input value='" . $applicant_data->birth_month . "' type='text' name='birth_month' id='birth_month' maxlength='2' class='required input-small' data-placement='right' data-original-title='The month of your birthday and you must be 18 and above.' />
                            <span>/</span>
                            <input value='" . $applicant_data->birth_year . "' type='text' name='birth_year' id='birth_year' maxlength='4' class='required input-medium' data-placement='right' data-original-title='The year of your birthday and you must be 18 and above.' />
                        </td>
                    </tr>";
    }
    if ($fields == 'drivers_license') {

        return "<tr>
                        <td >Drivers License No.</td>
                        <td>
                            <input type='text' value='" . $applicant_data->license_num . "'  name='license-num' class='required' data-placement='right' data-original-title='Your drivers license number.' />
                        </td>
                    </tr>";
    }
}

function address_html($fields, $applicant_data, $score_rs, $score_tca) {

    if ($fields == 'street_no') {
        return "<tr>
                        <td>Unit No. / Street No.</td>
                        <td>
                            <input value='" . $applicant_data->unit_num . "' class='input-small' type='text' name='unit-num' id='unit' data-placement='right' data-original-title='Your Unit number.' /> <span>/</span> <input value='" . $applicant_data->street_num . "' class='input-small'  type='text' name='street-num' id='street' class='required' data-placement='right' data-original-title='Your Street number.' />
                        </td>
                    </tr>";
    }
    if ($fields == 'street_name') {
        return "<tr>
                        <td>Street Name</td>
                        <td>
                            <input value='" . $applicant_data->street_name . "' type='text' name='street-name' class='required' data-placement='right' data-original-title='Your Street name.' />
                        </td>
                    </tr>";
    }
    if ($fields == 'city') {
        return "<tr>
                        <td>City / Suburb</td>
                        <td>
                            <input value='" . $applicant_data->city_suburb . "' type='text' name='city-suburb' class='required' data-placement='right' data-original-title='Your City or Suburb.' />
                        </td>
                    </tr>";
    }

    if ($fields == 'state_postcode') {
        return "<tr>
                        <td>State &amp; Postcode</td>
                        <td>
                            <input type='hidden' value='" . $applicant_data->state . "' id='state' >
                            <select name='state' class='required auto-width data-placement='right' data-original-title='Your state.' >
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
                            <input value='" . $applicant_data->postcode . "' type='text' name='postcode' id='post-code' maxlength='4' size='4' class='input-postcode required' data-placement='right' data-original-title='Your postcode.' />
                        </td>
                    </tr>";
    }

    if ($fields == 'residential') {

        $op = "<option value=''>Select</option>";

        foreach ($score_rs as $data):
            $op .= "<option value='" . $data->option . "'>" . $data->option . "</option>";
        endforeach;


        return "<tr>
                                        <td>Residential Status</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->residential_status . "' id='residential_status' >
                                            <select name='residential-status' data-placement='right' data-original-title='Your permanent address.' >
                                                " . $op . "
                                            </select>
                                        </td>
                                    </tr>";
    }

    if ($fields == 'time_at_address') {

        $op = "<option value=''>Select</option>";

        foreach ($score_tca as $data):
            $op .= "<option value='" . $data->option . "'>" . $data->option . "</option>";
        endforeach;

        return "<tr>
                                        <td>Time at Address</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->time_address . "' id='time_address' >
                                            <select name='time-address' class='required' data-placement='right' data-original-title='How long do live on the specified address.' >
                                                <option value=''>Select</option>
                                                " . $op . "
                                            </select>
                                        </td>
                                    </tr>";
    }
}

function contact_html($fields, $applicant_data) {
    if ($fields == 'email') {
        return "<tr>
                                        <td>Email Address</td>
                                        <td>
                                            <input value='" . $applicant_data->user_email . "' type='text' name='email' id='email-address' data-placement='right' data-original-title='Your email address.' onpaste='return false;' />
                                        </td>
                                    </tr>";
    }
    if ($fields == 'confirm_email') {
        return "<tr>
                                        <td>Confirm Email</td>
                                        <td>
                                            <input type='text' name='user_email' id='email-confirm' data-placement='right' data-original-title='Confirm your email. It should be the same on what you have entered above.' onpaste='return false;' />
                                        </td>
                                    </tr>";
    }
    if ($fields == 'mobile_phone') {
        return "<tr>
                                        <td>Mobile Phone</td>
                                        <td>
                                            <input value='" . (($applicant_data->user_mobile_phone == 0) ? '' : $applicant_data->user_mobile_phone) . "' maxlength='11' size='11' type='text' size='11' name='user_mobile_phone' data-placement='right' data-original-title='Only numbers are allowed and 11 digit max.' />
                                        </td>
                                    </tr>";
    }
    if ($fields == 'home_phone') {
        return "<tr>
                                        <td>Home Phone</td>
                                        <td>
                                            <input value='" . (($applicant_data->user_home_phone == '') ? 0 : $applicant_data->user_home_phone) . "' maxlength='10' size='10' type='text' name='user_home_phone' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
                                        </td>
                                    </tr>";
    }
}

function loan_html($fields, $applicant_data, $score_lp) {
    if ($fields == 'amount') {
        return "<tr>
                                        <td>Loan Amount</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input value='" . $applicant_data->loan_amount . "' type='text' size='11' name='loan_amount' id='loan' data-placement='right' data-original-title='The amount of money you want to borrow and only numbers are allowed.' />
                                        </td>
                                    </tr>";
    }
    if ($fields == 'purpose') {
        $op = '';
        foreach ($score_lp as $data):
            $op .= "<option value='" . $data->option . "'>" . $data->option . "</option>";
        endforeach;

        return "<tr>
                                        <td>Loan Purpose</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->loan_purpose . "' id='loan_purpose' >
                                            <select name='loan-purpose' class='required' data-placement='right' data-original-title='Your intention for applying a loan.'>
                                                <option value=''>Select</option>
                                                " . $op . "
                                            </select>
                                        </td>
                                    </tr>";
    }
}
?>
