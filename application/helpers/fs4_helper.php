<?php

function ref1_html($fields, $applicant_data) {

    if ($fields == 'ref1_name') {
        return "
            <tr>
                                        <td>Name</td>
                                        <td>
                                            <input type='text' value='" . $applicant_data->ref1_name . "' name='ref1-name' data-placement='right' data-original-title='Name of the first reference.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'ref1_relationship') {
        return "
            <tr>
                                        <td>Relationship</td>
                                        <td>
                                            <input type='text' value='" . $applicant_data->ref1_relationship . "' name='ref1-relationship' data-placement='right' data-original-title='Your relationship on the name you have specified above.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'ref1_home_phone') {
        return "
            <tr>
                                        <td>Home Phone</td>
                                        <td>
                                            <input type='text' value='" . (($applicant_data->ref1_home_phone == '') ? 0 : $applicant_data->ref1_home_phone) . "' maxlength='10' size='10' name='ref1_home_phone' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'ref1_mobile_phone') {
        return "
            <tr>
                                        <td>Mobile Phone</td>
                                        <td>
                                            <input type='text' value='" . $applicant_data->ref1_mobile_phone . "' maxlength='11' size='11'  name='ref1_mobile_phone' data-placement='right' data-original-title='Only numbers are allowed and 11 digit max.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'ref1_street_no') {
        return "
            <tr>
                                        <td>Unit No. / Street No.</td>
                                        <td>
                                            <input type='text' value='" . $applicant_data->ref1_unit_num . "' class='input-small' name='ref1-unit-num' class='unit' data-placement='right' data-original-title='Unit number of the reference.' /> <span>/</span> <input type='text' class='input-small' value='" . $applicant_data->ref1_street_num . "' name='ref1-street-num' class='street' data-placement='right' data-original-title='Street number of the reference.' />
                                        </td>
                                    </tr>
                                    
            ";
    }


    if ($fields == 'ref1_street_name') {
        return "
            <tr>
                                        <td>Street Name</td>
                                        <td>
                                            <input type='text' value='" . $applicant_data->ref1_street_name . "'  name='ref1-street-name' data-placement='right' data-original-title='Street Name of the reference.' />
                                        </td>
                                    </tr>
                                    
        ";
    }
    
    if ($fields == 'ref1_city') {
        return "
            <tr>
                                        <td>City / Suburb</td>
                                        <td>
                                            <input type='text' value='".$applicant_data->ref1_city_suburb."'  name='ref1-city-suburb' data-placement='right' data-original-title='City or Suburb of the reference.' />
                                        </td>
                                    </tr>
                                    
        ";
    }
    
    if ($fields == 'ref1_state_postcode') {
        return "
            <tr>
                                        <td>State &amp; Postcode</td>
                                        <td>
                                            <input type='hidden' value='".$applicant_data->ref1_state."' id='ref1_state' >
                                            <select name='ref1-state' class='auto-width' data-placement='right' data-original-title='State of the reference.'>
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
                                            <input type='text' class='input-postcode' value='".$applicant_data->ref1_postcode."' name='ref1-postcode' maxlength='4' size='4' class='post-code' data-placement='right' data-original-title='Postcode of the reference.' />
                                        </td>
                                    </tr>
        ";
        
    }
    
    
}









function ref2_html($fields, $applicant_data) {

    if ($fields == 'ref2_name') {
        return "
            <tr>
                                        <td>Name</td>
                                        <td>
                                            <input type='text' value='".$applicant_data->ref2_name."' name='ref2-name' data-placement='right' data-original-title='Name of the second refernce.' />
                                        </td>
                                    </tr>
                                    
                                    
        ";
    }

    if ($fields == 'ref2_relationship') {
        return "
            <tr>
                                        <td>Relationship</td>
                                        <td>
                                            <input type='text' value='".$applicant_data->ref2_relationship."' name='ref2-relationship' data-placement='right' data-original-title='Your relationship on the name you have specified above.' />
                                        </td>
                                    </tr>
                                    
                                    
        ";
    }

    if ($fields == 'ref2_home_phone') {
        return "
            <tr>
                                        <td>Home Phone</td>
                                        <td>
                                            <input type='text' value='".(($applicant_data->ref2_home_phone == '') ? 0 : $applicant_data->ref2_home_phone)."' maxlength='10' size='10' name='ref2_home_phone' data-placement='right' data-original-title='Only number are allowed and 10 digit max.' />
                                        </td>
                                    </tr>
                                    
                                    
        ";
    }

    if ($fields == 'ref2_mobile_phone') {
        return "
            <tr>
                                        <td>Mobile Phone</td>
                                        <td>
                                            <input type='text' value='".$applicant_data->ref2_mobile_phone."' maxlength='11' size='11'  name='ref2_mobile_phone' data-placement='right' data-original-title='Only number are allowed and 11 digit max.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'ref2_street_no') {
        return "
            <tr>
                                        <td>Unit No. / Street No.</td>
                                        <td>
                                            <input type='text' class='input-small' value='".$applicant_data->ref2_unit_num."' name='ref2-unit-num' class='unit' data-placement='right' data-original-title='Unit number of the reference.' /> <span>/</span> <input type='text' class='input-small' value='".$applicant_data->ref2_street_num."' name='ref2-street-num' class='street' data-placement='right' data-original-title='Street number of the reference.' />
                                        </td>
                                    </tr>
                                    
                                    
            ";
    }


    if ($fields == 'ref2_street_name') {
        return "
            <tr>
                                        <td>Street Name</td>
                                        <td>
                                            <input type='text' value='".$applicant_data->ref2_street_name."'  name='ref2-street-name' data-placement='right' data-original-title='Street Name of the reference.' />
                                        </td>
                                    </tr>
                                    
                                    
        ";
    }
    
    if ($fields == 'ref2_city') {
        return "
            <tr>
                                        <td>City / Suburb</td>
                                        <td>
                                            <input type='text' value='".$applicant_data->ref2_city_suburb."'  name='ref2-city-suburb' data-placement='right' data-original-title='City or Suburb of the reference.' />
                                        </td>
                                    </tr>
                                    
                                    
        ";
    }
    
    if ($fields == 'ref2_state_postcode') {
        return "
           <tr>
                                        <td>State &amp; Postcode</td>
                                        <td>
                                            <input type='hidden' value='".$applicant_data->ref2_state."' id='ref2_state' />
                                            <select name='ref2-state' class='auto-width' data-placement='right' data-original-title='State of the reference.'>
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
                                            <input type='text' class='input-postcode' value='".$applicant_data->ref2_postcode."' name='ref2-postcode' maxlength='4' size='4' class='post-code' data-placement='right' data-original-title='Postcode of the reference.' />
                                        </td>
                                    </tr>
        ";
        
    }
    
    
}





?>
