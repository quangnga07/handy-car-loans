<?php
	foreach( $applicant as $row ){
		if( $row->application_status == 1 ) $status = 'Pending';
		elseif ( $row->application_status == 2 )  $status = 'Approved';
		else $status = 'Failed';

		
		echo 'HCL'.$row->id." Application Form";
		echo '<br/>Application Status: '.$status; 


		echo '<br/><br/>RAW DATA<br/><br/>PERSONAL DETAILS:<br/>';
		echo 'Application ID: HCL'.$row->id.'<br/>';
		echo 'Name: '.$row->fname.' '.$row->mname.' '.$row->lname.'<br/>';
		echo 'Birthday: '.$row->birth_date.'/'.$row->birth_month.'/'.$row->birth_year.'<br/>';
		echo 'License Number: '.$row->license_num.'<br/>';

		echo '<br/>ADDRESS DETAILS<br/>';
		echo 'Unit Number: '.$row->unit_num.'<br/>';
		echo 'Street Number: '.$row->street_num.'<br/>';
		echo 'Street Name: '.$row->street_name.'<br/>';
		echo 'City / Suburb: '.$row->city_suburb.'<br/>';
		echo 'State: '.$row->state.'<br/>';
		echo 'Postcode: '.$row->postcode.'<br/>';
		echo 'Residential Status: '.$row->residential_status.'<br/>';
		echo 'Time At Address: '.$row->time_address.'<br/>';

		echo '<br/>CONTACT DETAILS<br/>';
		echo 'Email Address: '.$row->user_email.'<br/>';
		echo 'Mobile Phone: '.$row->user_mobile_phone.'<br/>';
		echo 'Home Phone: '.$row->user_home_phone.'<br/>';

		echo '<br/>PROPOSED LOAN<br/>';
		echo 'Loan Amount: '.$row->loan_amount.'<br/>';
		echo 'Loan Purpose: '.$row->loan_purpose.'<br/>';


		echo '<br/>EMPLOYMENT<br/>';
		echo 'Employment Status: '.$row->employment_status.'<br/>';
		echo 'Employment Lenght: '.$row->employment_length.'<br/>';
		echo 'Monthly Income: '.$row->monthly_income.'<br/>';
		echo 'Payday Frequency: '.$row->payday_frequency.'<br/>';
		echo 'Next Payday: '.date( 'd/m/Y', strtotime($row->next_payday) ).'<br/>';
		echo 'Salary Diret to Bank: '.$row->direct_to_bank.'<br/>';

		echo '<br/>EMPLOYER DETAILS<br/>';
		echo 'Business Name: '.$row->business_name.'<br/>';
		echo 'Employer Phone: '.$row->employer_phone.'<br/>';
		echo 'Employer Unit Number: '.$row->employer_unit_num.'<br/>';
		echo 'Employer Street Number: '.$row->employer_street_num.'<br/>';
		echo 'Employer Street Name: '.$row->employer_street_name.'<br/>';
		echo 'Employer City / Suburb: '.$row->employer_city_suburb.'<br/>';
		echo 'Employer State: '.$row->employer_state.'<br/>';
		echo 'Employer Postcode: '.$row->employer_postcode.'<br/>';


		echo '<br/>YOUR EXPENSES<br/>';
		echo 'Payment Frequency: '.$row->payment_frequency.'<br/>';
		echo 'Mortgage/Rent Per Month Name: '.$row->mortgage_rent_month.'<br/>';
		echo 'Eexpense Per Month Name: '.$row->expenses_month.'<br/>';
		echo 'Loans Per Month Name: '.$row->loans_month.'<br/>';
		echo 'Credit Card Per Month Name: '.$row->credit_card_month.'<br/>';
		echo 'Other Debits Per Month Name: '.$row->debit_months.'<br/>';

		echo '<br/>YOUR BANK ACCOUNT DETAILS<br/>';
		echo 'Bank Name: '.$row->bank_name.'<br/>';
		echo 'Account Name: '.$row->account_name.'<br/>';
		echo 'BSB: '.$row->bsb.'<br/>';
		echo 'Account Number: '.$row->account_num.'<br/>';

		echo '<br/>REFERENCE 1<br/>';
		echo 'Reference Name: '.$row->ref1_name.'<br/>';
		echo 'Reference Relationship: '.$row->ref1_relationship.'<br/>';
		echo 'Reference Home Phone: '.$row->ref1_home_phone.'<br/>';
		echo 'Reference Mobile Phone: '.$row->ref1_mobile_phone.'<br/>';
		echo 'Reference Unit Number: '.$row->ref1_unit_num.'<br/>';
		echo 'Reference Street Number: '.$row->ref1_street_num.'<br/>';
		echo 'Reference Street Name: '.$row->ref1_street_name.'<br/>';
		echo 'Reference City / Suburb: '.$row->ref1_city_suburb.'<br/>';
		echo 'Reference State: '.$row->ref1_state.'<br/>';
		echo 'Reference Postcode: '.$row->ref1_postcode.'<br/>';

		echo '<br/>REFERENCE 2<br/>';
		echo 'Reference Name: '.$row->ref2_name.'<br/>';
		echo 'Reference Relationship: '.$row->ref2_relationship.'<br/>';
		echo 'Reference Home Phone: '.$row->ref2_home_phone.'<br/>';
		echo 'Reference Mobile Phone: '.$row->ref2_mobile_phone.'<br/>';
		echo 'Reference Unit Number: '.$row->ref2_unit_num.'<br/>';
		echo 'Reference Street Number: '.$row->ref2_street_num.'<br/>';
		echo 'Reference Street Name: '.$row->ref2_street_name.'<br/>';
		echo 'Reference City / Suburb: '.$row->ref2_city_suburb.'<br/>';
		echo 'Reference State: '.$row->ref2_state.'<br/>';
		echo 'Reference Postcode: '.$row->ref2_postcode.'<br/>';
	}

?>

