<?php
require_once(DIRNAME(BASEPATH).'/application/third_party/tcpdf/config/lang/eng.php');
require_once(DIRNAME(BASEPATH).'/application/third_party/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $this->SetFont('helvetica', '', 9);
    }

    // Page footer
    public function Footer() {
    	$this->SetFont('helvetica', '', 9);
		$this->SetTextColorArray($this->footer_text_color);
		//set style for cell border
		$line_width = (0.85 / $this->k);
		$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => $this->footer_line_color));
		
		$w_page = isset($this->l['w_page']) ? $this->l['w_page'].' ' : '';
		$pagenumtxt = $w_page.$this->getAliasNumPage().' of '.$this->getAliasNbPages();
		
		$this->SetY(-18);
		$date = date( 'd-m-Y h:ia' );
		//Print page number
		$this->Cell(100, 8, $this->getAliasRightShift().$pagenumtxt, 'T', 0, 'R');
		$this->Cell(0, 8, "Printed  ".$date, 'T', 0, 'R');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, '', PDF_MARGIN_RIGHT);

//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// add a page 1
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 9);

// -----------------------------------------------------------------------------

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');


$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	width: 50%;
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Your Name</td>
	</tr>
	<tr>
		<td>Title</td>
        <td> $applicant->title </td>
	</tr>
	<tr>
		<td>Firstname</td>
		<td> $applicant->fname </td>
    </tr>
    <tr>
    	<td>Lastname</td>
    	<td> $applicant->lname </td>
    </tr>
    <tr>
    	<td>Birthday</td>
        <td> $applicant->birth_date-$applicant->birth_month-$applicant->birth_year </td>
    </tr>
    <tr>
    	<td>Drivers License No.</td>
        <td> $applicant->license_num </td>
    </tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Address Details</td>
	</tr>
	<tr>
		<td>Unit No. / Street No.</td>
		<td> $applicant->unit_num </td>
    </tr>
    <tr>
    	<td>Street Name</td>
    	<td colspan="2" width="100%"> $applicant->street_name </td>
	</tr>
    <tr>
    	<td>City / Suburb</td>
		<td colspan="2" width="100%"> $applicant->city_suburb </td>
	</tr>
	<tr>
    	<td>State & Postcode</td>
    	<td> $applicant->birth_date $applicant->postcode </td>
	</tr>
    <tr>
    	<td>Residential Status</td>
        <td> $applicant->residential_status </td>
    </tr>
    <tr>
    	<td>Time at Address</td>
        <td> $applicant->time_address </td>
	</tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Contact Details</td>
	</tr>
	<tr>
		<td>Email Address</td>
        <td colspan="2" width="100%"> $applicant->user_email </td>
    </tr>
    <tr>
    	<td>Mobile Phone</td>
        <td> $applicant->user_mobile_phone </td>
    </tr>
    <tr>
    	<td>Home Phone</td>
        <td> $applicant->user_home_phone </td>
    </tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Proposed Loan</td>
	</tr>
	<tr>
		<td>Loan Amount</td>
        <td> $applicant->loan_amount </td>
    </tr>
    <tr>
    	<td>Loan Purpose</td>
        <td> $applicant->loan_purpose </td>
    </tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Employment</td>
	</tr>
	<tr>
		<td>Employment Status</td>
        <td> $applicant->employment_status </td>
	</tr>
    <tr>
    	<td>Employment Length</td>
        <td> $applicant->employment_length </td>
    </tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Employment Detail</td>
	</tr>
	<tr>
		<td>Business Name</td>
        <td> $applicant->business_name </td>
    </tr>
	<tr>
    	<td>Employer Phone</td>
        <td> $applicant->employer_phone </td>
	</tr>
    <tr>
        <td>Unit No. / Street No.</td>
		<td> $applicant->employer_unit_num  $applicant->employer_street_num </td>
    </tr>
    <tr>
        <td>Street Name</td>
		<td colspan="2" width="100%"> $applicant->employer_street_name </td>
	</tr>
    <tr>
        <td>City / Suburb</td> 
		<td colspan="2" width="100%"> $applicant->employer_city_suburb </td>
    </tr>
    <tr>
    	<td>State &amp; Postcode</td>
        <td> $applicant->employer_state  $applicant->employer_postcode </td>
    </tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
    <tr>
		<td class="header" colspan="2">Your Expenses</td>
	</tr>
	<tr>
		<td>Mortgage/Rent Freq</td>
        <td> $applicant->payment_frequency </td>
	</tr>
    <tr>
    	<td>Mortgage/Rent /mth</td>
        <td> $ $applicant->mortgage_rent_month </td>
	</tr>
    <tr>
    	<td>Living Exp /mth</td>
        <td> $ $applicant->expenses_month </td>
	</tr>
    <tr>
    	<td>Loans /mth </td>
        <td> $ $applicant->loans_month </td>
	</tr>
    <tr>
        <td>Credit Cards /mth</td>
		<td> $ $applicant->credit_card_month </td>
    </tr>
    <tr>
		<td>Other Debts /mth</td>
        <td> $ $applicant->debit_months </td>
	</tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
    <tr>
		<td class="header" colspan="2">Your Bank Account Details</td>
	</tr>
	<tr>
    	<td class="print-label">Bank Name</td>
        <td> $applicant->bank_name </td>
	</tr>
    <tr>
		<td>Name on Account</td>
        <td> $applicant->account_name </td>
    </tr>
    <tr>
		<td>BSB</td>
        <td> $applicant->bsb </td>
    </tr>
    <tr>
		<td>Account Number</td>
        <td> $applicant->account_num </td>
    </tr>
</table>
EOF;

$pdf->writeHTML($html, true, false, false, false, 'L');


// add a page 2
$pdf->AddPage();

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	width: 50%;
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="1" cellspacing="1">
    <tr>
		<td class="header" colspan="2">Reference No 1</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>$applicant->ref1_name </td>
	</tr>
	<tr>
		<td>Relationship</td>
		<td>$applicant->ref1_relationship </td>
	</tr>
	<tr>
		<td>Home Phone</td>
		<td>$applicant->ref1_home_phone </td>
	</tr>
	<tr>
		<td>Mobile Phone</td>
		<td>$applicant->ref1_mobile_phone </td>
	</tr>
	<tr>
		<td>Unit No. / Street No.</td>
		<td>$applicant->ref1_unit_num / $applicant->ref1_street_num  </td>
	</tr>
	<tr>
		<td>Street Name</td>
		<td colspan="2" width="100%">$applicant->ref1_street_name </td>
	</tr>
	<tr>
		<td>City / Suburb</td>
		<td colspan="2" width="100%">$applicant->ref1_city_suburb </td>
	</tr>
	<tr>
		<td>State &amp; Postcode</td>
		<td>$applicant->ref1_state $applicant->ref1_postcode </td>
	</tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
    <tr>
		<td class="header" colspan="2">Reference No 2</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>$applicant->ref2_name </td>
	</tr>
	<tr>
		<td>Relationship</td>
		<td>$applicant->ref2_relationship </td>
	</tr>
	<tr>
		<td>Home Phone</td>
		<td>$applicant->ref2_home_phone </td>
	</tr>
	<tr>
		<td>Mobile Phone</td>
		<td>$applicant->ref2_mobile_phone </td>
	</tr>
	<tr>
		<td>Unit No. / Street No.</td>
		<td>$applicant->ref2_unit_num / $applicant->ref2_street_num </td>
	</tr>
	<tr>
		<td>Street Name</td>
		<td colspan="2" width="100%">$applicant->ref2_street_name </td>
	</tr>
	<tr>
		<td>City / Suburb</td>
		<td colspan="2" width="100%">$applicant->ref2_city_suburb </td>
	</tr>
	<tr>
		<td>State &amp; Postcode</td>
		<td>$applicant->ref2_state $applicant->ref2_postcode </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'L');

// add a page 3
$pdf->AddPage();

$docs = '';
if( empty($documents) ) {
	$docs = '<tr><td colspan="2">N/A</td></tr>';
} else {
	$url = DIRNAME(BASEPATH).'/uploads/';
	foreach( $documents as $doc ){
		if( $doc->supply_via == 'Upload' || $doc->supply_via == 'Manual Upload' ) {
			$file = explode( ',' , $doc->files );
			for( $x = 0; $x < count( $file ); $x++ ) {
				$type = preg_replace('/(.+)\./s', '', $file[$x]);
				$byte = filesize($url.$doc->user_id.'_'.$file[$x]);
				$KB   = round($byte / 1024);

				$docs .= '<tr><td width="25%">Document Name</td><td>'. $doc->user_id.'_'.$file[$x] .'</td></tr>';
				$docs .= '<tr><td width="25%">Date Time Submitted</td><td>'. date( 'd-m-Y g:ia', strtotime($doc->datetime_submitted ) ) .'</td></tr>';
				$docs .= '<tr><td width="25%">File Type</td><td>'. strtoupper($type) .'</td></tr>';
				$docs .= '<tr><td width="25%">File Size</td><td>'. $KB .' KB</td></tr>';
				$docs .= '<tr><td width="25%">Submitted by IP</td><td>'. $doc->ip_address .'</td></tr>';
				$docs .= '<tr><td colspan="2"></td></tr>';
			}
		} else {
			$docs = '<tr><td>Supplied Via</td><td>'. $doc->supply_via .'</td></tr>';
		}
	}
}

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	width: 100%;
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Documents Submitted</td>
	</tr>
	$docs
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'L');

// add a page 4
$pdf->AddPage();

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');

if( empty($notes) ) {
	$broker     = 'N/A';
	$staff      = 'N/A';
	$supervisor = 'N/A';
} else {
	$broker     = ( !empty($notes->broker_notes) ) ? nl2br($notes->broker_notes) : 'N/A' ;
	$staff      = ( !empty($notes->staff_notes) ) ? nl2br($notes->staff_notes) : 'N/A' ;
	$supervisor = ( !empty($notes->supervisor_notes) ) ? nl2br($notes->supervisor_notes) : 'N/A' ;
}

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Broker Notes</td>
	</tr>
	<tr>
		<td colspan="2">$broker</td>
	</tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Staff Notes</td>
	</tr>
	<tr>
		<td colspan="2">$staff</td>
	</tr>
</table>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Supervisor Notes</td>
	</tr>
	<tr>
		<td colspan="2">$supervisor</td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'L');

// add a page 5
$pdf->AddPage();

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');

$message = '';

if( !empty($messages) ) {
	foreach( $messages as $msg ) {
		$message .= '<tr>';
		$message .= '<td>'.$msg->from.' @ '. date( 'd-m-Y h:ia', strtotime($msg->time_sent)).'</td>';
		$message .= '<td>'.$msg->message.'</td>';
		$message .= '</tr>';	
	}
} else {
	$message = '<tr><td colspan="2"> N/A </td></tr>';
}

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="2" cellspacing="5">
	<tr>
		<td class="header" colspan="2">Emails on Record</td>
	</tr>
	$message
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'L');

// add a page 6
$pdf->AddPage();

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');

$message = '';

if( empty($settings) ) {
	$status  = 'N/A';
	$staging = 'N/A';
	$product = 'N/A';
	$brand   = 'N/A';
	$leadgen = 'N/A';
	$broker  = 'N/A';
} else {
	$status  = $settings->status;
	$staging = $settings->staging;
	$product = $settings->product;
	$brand   = $settings->brand;
	$leadgen = $settings->leadgen;
	$broker  = $settings->broker;
}

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	width: 50%;
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2">Manual Settings</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>$status</td>
	</tr>
	<tr>
		<td>Stages</td>
		<td>$staging</td>
	</tr>
	<tr>
		<td>Product</td>
		<td>$product</td>
	</tr>
	<tr>
		<td>Brand</td>
		<td>$brand</td>
	</tr>
	<tr>
		<td>Leadgen</td>
		<td>$leadgen</td>
	</tr>
	<tr>
		<td>Broker</td>
		<td>$broker</td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'L');

$docs = '';
if( !empty($documents) ) {
	$url = DIRNAME(BASEPATH).'/uploads/';
	foreach( $documents as $doc ){
		if( $doc->supply_via == 'Upload' || $doc->supply_via == 'Manual Upload' ) {
			$file = explode( ',' , $doc->files );
			for( $x = 0; $x < count( $file ); $x++ ) {
				$type = preg_replace('/(.+)\./s', '', $file[$x]);				
				
				if( $type == 'jpg' || $type == 'jpeg' ) {
					$filepath = $url.$doc->user_id.'_'.$file[$x];
					$name     = $doc->user_id.'_'.$file[$x];

					$data    = getimagesize($filepath);
					$width   = $data[0];
					$height  = $data[1];
					$target  = 180;
					$target2 = 160;

					//takes the larger size of the width and height and applies the formula accordingly...this is so this script will work dynamically with any size image
					if ($width > $height) {
						$percentage = ($target2 / $width);
						$x_axis     = 30;
					} else {
						$percentage = ($target / $height);
						$x_axis     = 45;
					}

					//gets the new value and applies the percentage, then rounds the value
					$width  = round($width * $percentage);
					$height = round($height * $percentage);
					//returns the new sizes in html image tag format...this is so you can plug this function inside an image tag and just get the
					
					$new_width  = $width;
					$new_height = $height;

					$pdf->AddPage();

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0; padding: 0; font-family: Arial; font-size: 9pt; }
    table {

    }
    .id {
    	font-size: 19pt;
    	line-height: 0.5px;
    }
</style>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td width="75.3%" class="first"></td>
		<td align="left" class="id">HCL$applicant->id</td>
	</tr>
	<tr>
		<td width="75%" class="">Received</td>
		<td align="left"> $recieved </td>
	</tr>
	<tr>
		<td width="75%" class="">Status</td>
		<td align="left"> $app_status </td>
	</tr>
	<tr>
		<td width="75%" class="">Rank</td>
		<td align="left"> $rank </td>
	</tr>
	<tr>
		<td width="75%" class="">Accepted</td>
		<td align="left"> Terms-v$applicant->term_version $date_status </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'R');

$message = '';

if( empty($settings) ) {
	$status  = 'N/A';
	$staging = 'N/A';
	$product = 'N/A';
	$brand   = 'N/A';
	$leadgen = 'N/A';
	$broker  = 'N/A';
} else {
	$status  = $settings->status;
	$staging = $settings->staging;
	$product = $settings->product;
	$brand   = $settings->brand;
	$leadgen = $settings->leadgen;
	$broker  = $settings->broker;
}

$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	* { margin: 0px; padding: 0px; font-family: Arial; font-size: 8pt; }
    p {

    }
    hr { margin: 0px padding: 0px; }
    table {
    	width: 50%;
    }
    span.name {
    	font-size: 20pt;
    	font-weight: bold;
    }
    span { 
    	font-size: 17pt;
    }
    .header {
    	font-weight: bold;	
    }
</style>
<hr/>
<div> Applicant &nbsp; <span class="name">$applicant->fname $applicant->lname</span></div>
<hr/>
<span></span>
<table cellpadding="1" cellspacing="1">
	<tr>
		<td class="header" colspan="2"> $name </td>
	</tr>
</table>
EOF;
$pdf->writeHTML($html, true, false, false, false, 'L');

					// set JPEG quality
					$pdf->setJPEGQuality(80);
					$pdf->Image($filepath, $x_axis, 80, $new_width, $new_height, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
				}
			}
		}
	}
}

//Close and output PDF document
$pdf->Output('client_record.pdf', 'I');
?>
