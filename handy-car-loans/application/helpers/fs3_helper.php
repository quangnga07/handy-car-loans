<?php

function expenses_html($fields, $applicant_data) {

    if ($fields == 'rent_payment') {

        return "
                    <tr>
                                        <td>Mortgage/Rent Payment Frequency</td>
                                        <td>
                                            <input type='hidden' value='" . $applicant_data->payment_frequency . "' id='payment_frequency' > 
                                            <select class='select-dollar' name='payment-frequency' data-placement='right' data-original-title='How many times do you pay for the Mortgage/Rent within a month?'>
                                                <option value=''>Select</option>
                                                <option value='Monthly'>Monthly</option>
                                                <option value='Fortnightly'>Fortnightly</option>
                                                <option value='Weekly'>Weekly</option>
                                            </select>
                                        </td>
                                    </tr>
                ";
    }


    if ($fields == 'rent_month') {

        return " 
                <tr>
                                        <td>Mortgage/Rent per month</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input class='input-dollar' value='" . $applicant_data->mortgage_rent_month . "' type='text' name='mortgage_rent_month' class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                        </td>
                                    </tr>
            ";
    }

    if ($fields == 'living_expenses') {

        return "
            <tr>
                                        <td>Living Expenses per month</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input class='input-dollar' value='" . $applicant_data->expenses_month . "' type='text' name='expenses_month' class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'loans_month') {

        return "
            <tr>
                                        <td>Loans per month</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input class='input-dollar' value='" . $applicant_data->loans_month . "' type='text' name='loans_month' class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                        </td>
                                    </tr>
                                    
        ";
    }

    if ($fields == 'credit_cards') {

        return " 
            <tr>
                                        <td>Credit Cards per month</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input class='input-dollar' value='" . $applicant_data->credit_card_month . "' type='text' name='credit_card_month' class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                        </td>
                                    </tr>
                                    

        ";
    }

    if ($fields == 'debits_month') {

        return " 
            <tr>
                                        <td>Other Debits per month</td>
                                        <td>
                                            <span class='loan-dollar'>$</span>
                                            <input class='input-dollar' value='" . $applicant_data->debit_months . "' type='text' name='debit_months' class='per-month' data-placement='right' data-original-title='Only numbers are allowed.' />
                                        </td>
                                    </tr>
            ";
    }
}

function bank_html($fields, $applicant_data) {

    if ($fields == 'bank_name') {

        return "
            <tr>
                                        <td>Bank Name</td>
                                        <td>
                                            <input value='" . $applicant_data->bank_name . "' type='text' name='bank-name' data-placement='right' data-original-title='Name of the bank.' />
                                        </td>
                                    </tr>
                                    
            ";
    }

    if ($fields == 'account_name') {

        return "
            <tr>
                                        <td>Name on Account</td>
                                        <td>
                                            <input value='" . $applicant_data->account_name . "' type='text' name='account-name' data-placement='right' data-original-title='Name of the bank account.' />
                                        </td>
                                    </tr>
                                    
            ";
    }

    if ($fields == 'bsb') {

        return "
            <tr>
                                        <td>BSB</td>
                                        <td>
                                            <input value='" . ( ($applicant_data->bsb != 0) ? $applicant_data->bsb : "" ) . "' maxlength='6' size='6' type='text' name='bsb' data-placement='right' data-original-title='Only numbers are allowed and 6 digit max.' />
                                        </td>
                                    </tr>
                                    
            ";
    }


    if ($fields == 'account_number') {

        return "
            <tr>
                                        <td>Account Number</td>
                                        <td>
                                            <input  value='" . ( ($applicant_data->account_num != 0) ? $applicant_data->account_num : "" ) . "' maxlength='10' size='10' type='text' name='account_num' data-placement='right' data-original-title='Only numbers are allowed and 10 digit max.' />
                                        </td>
                                    </tr>
        ";
    }
}

?>
