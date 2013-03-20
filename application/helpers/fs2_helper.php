<?php

function employment_html($fields, $applicant_data, $score_es, $score_el) {

    if ($fields == "employment_status") {
        $op = "<option value=''>Select</option>";

        foreach ($score_es as $data):
            $op .= "<option value='" . $data->option . "'>" . $data->option . "</option>";
        endforeach;


        return "
            <tr>
                                        <td>Employment Status</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->employment_status . "' id='employment_status' > 
                                            <select name='employment-status' data-placement='right' data-original-title='Your employement status or position on the company.' >
                                                 " . $op . "
                                            </select>
                                        </td>
                                    </tr>
        ";
    }

    if ($fields == "employment_length") {
        $op = "<option value=''>Select</option>";

        foreach ($score_el as $data):
            $op .= "<option value='" . $data->option . "'>" . $data->option . "</option>";
        endforeach;


        return "
                <tr>
                                        <td>Employment Length</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->employment_length . "' id='employment_length' > 
                                            <select name='employment-length' data-placement='right' data-original-title='Your employement length on the company.'>
                                                " . $op . "
                                            </select>
                                        </td>
                                    </tr>
            ";
    }

    if ($fields == "monthly_income") {


        return "
            <tr>
                                        <td>Monthly Income</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input class='input-match-select' value='" . $applicant_data->monthly_income . "' type='text' name='monthly_income' id='income' data-placement='right' data-original-title='Your monthly salary. Only numbers are allowed.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == "payday_frequency") {


        return "
            <tr>
                                        <td>Payday Frequency</td>
                                        <td> 
                                            <input type='hidden' value='" . $applicant_data->payday_frequency . "' id='payday_frequency' > 
                                            <select name='payday-frequency' data-placement='right' data-original-title='How many times do you get you salary within a month?'>
                                                <option value=''>Select</option>
                                                <option value='Weekly'>Weekly</option>
                                                <option value='Fortnightly'>Fortnightly</option>
                                                <option value='Monthy'>Monthy</option>
                                                <option value='Yearly'>Yearly</option>
                                            </select>
                                        </td>
                                    </tr>
                                    

        ";
    }

    if ($fields == "next_payday") {


        return "
            <script type='text/javascript'>
                var payday = 'true';
            </script>
            <tr>
                                        <td>Next Payday</td>
                                        <td>
                                            <input value='" . $applicant_data->next_payday . "' type='hidden' name='next-payday' id='payday' data-placement='right' data-original-title='When is your next payday? Before date is not allowed.' />
                                            <input value='' type='text' id='birth_date' maxlength='2' class='required input-small' data-placement='right' data-original-title='When is your next payday? Before date is not allowed.' />
                                            <span>/</span>
                                            <input value='' type='text' id='birth_month' maxlength='2' class='required input-small' data-placement='right' data-original-title='When is your next payday? Before date is not allowed.' />
                                            <span>/</span>
                                            <input value='' type='text' id='birth_year' maxlength='4' class='required input-medium' data-placement='right' data-original-title='When is your next payday? Before date is not allowed.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == "paid_to_bank") {


        return "
            <tr>
                                        <td colspan='2'>Is your salary paid directly into your bank account?</td>
                                    </tr>
                                    <tr>
                                        <td colspan='2' align='center'>
                                            <input type='hidden' value='" . $applicant_data->direct_to_bank . "' id='direct_to_bank' > 
                                            <span style='margin: 0 0 0 150px; float: left;'><label><input type='radio' name='direct-to-bank' value='Yes' /> Yes</label></span>
                                            <span style='float: left;'><label><input type='radio' name='direct-to-bank' value='No' /> No</label></span>
                                        </td>
                                    </tr>
        ";
    }
}

function employer_html($fields, $applicant_data) {

    if ($fields == "business_name") {

        return "
            <tr>
                                        <td>Business Name</td>
                                        <td>
                                            <input value='" . $applicant_data->business_name . "' type='text' name='business-name' data-placement='right' data-original-title='Business name of the employer.' />
                                        </td>
                                    </tr>
                                    
            
        ";
    }

    if ($fields == "employer_phone") {

        return "
            <tr>
                                        <td>Employer Phone</td>
                                        <td>
                                            <input value='" . $applicant_data->employer_phone . "' maxlength='11' size='11' type='text' name='employer_phone' data-placement='right' data-original-title='Phone number of the employer. Only number are allowed and 11 digit max.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == "employer_street_no") {

        return "
            <tr>
                                        <td>Unit No. / Street No.</td>
                                        <td>
                                            <input value='" . $applicant_data->employer_unit_num . "' type='text' class='input-small' name='employer-unit-num' id='unit' data-placement='right' data-original-title='Unit number of the employer.' /> <span>/</span> <input value='" . $applicant_data->employer_street_num . "' type='text' class='input-small' name='employer-street-num' id='street' data-placement='right' data-original-title='Street number of the employer.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == "employer_street_name") {

        return "
            
                <tr>
                                        <td>Street Name</td>
                                        <td>
                                            <input value='" . $applicant_data->employer_street_name . "' type='text' name='employer-street-name' id='employer-street-name' data-placement='right' data-original-title='Street Name of the employer.' />
                                        </td>
                                    </tr>
                                    
            ";
    }

    if ($fields == "employer_city") {

        return "
            <tr>
                                        <td>City / Suburb</td>
                                        <td>
                                            <input value='" . $applicant_data->employer_city_suburb . "' type='text' name='employer-city-suburb' data-placement='right' data-original-title='City or Suburb of the employer.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == "employer_state_postcode") {

        return "
            <tr>
                                        <td>State &amp; Postcode</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->employer_state . "' id='employer_state' > 
                                            <select name='employer-state' class='required auto-width' data-placement='right' data-original-title='State of the employer'>
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
                                            <input type='text'class='input-postcode' value='" . $applicant_data->employer_postcode . "' name='employer-postcode' maxlength='4' size='4' id='post-code' data-placement='right' data-original-title='Postcode of the employer.' />
                                        </td>
                                    </tr>
                                    
            ";
    }
}

?>
