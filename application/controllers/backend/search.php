<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	private function _load_template($template_file, $data = NULL) {
        if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }
		
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		
        $this->load->view('backend/includes/header');
        $this->load->view('backend/includes/sidebar',$data);
        $this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer');
    }

	public function index()
	{
		$data['results'] = array();

		$this->_load_template( 'backend/search', $data );
	}
	
	public function search_tank_1(){
		$str_data = '';
		$arr_data = array();
		if($this->input->post('searchTank_1') && $this->input->post('searchTank_1') == 'yes'){
			$this->load->model('backend/search_model', 'search');
			$abandonded = $this->input->post("abandonded")?$this->input->post("abandonded"):array();
			$date_range = $this->input->post("date_range")?$this->input->post("date_range"):'';
			
			$arr_data = json_encode($this->search->search_tank_1());
			$arr_data = json_decode($arr_data);
			
			foreach( $arr_data as $applicant ){
				$row  = $applicant;
				$id   = 'HCL'.$row->id;
				$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
				$date = date( 'd-m-Y @ H:i', strtotime( $row->date_submitted) );
				$now  = new DateTime();
				$ref  = new DateTime($row->date_submitted);
				$diff = $now->diff($ref);
				
				$check = true;
				if($abandonded > 0){
					switch($abandonded){
						case 1:
							if($diff->d > 1)
								$check = false;
							break;
						case 2:
							if($diff->d > 7)
								$check = false;
							break;
						case 3:
							if($diff->d > 31)
								$check = false;
							break;
						case 4:
							if($diff->d > 90)
								$check = false;
							break;		
					}
				}
				if($date_range != '' || $date_range != NULL){
					switch($date_range){
						case 1:	
							if($diff->d > 7)
								$check = false;
							break;
						case 2:	
							if($diff->d > 14)
								$check = false;
							break;
						case 3:	
							if($diff->d > 31)
								$check = false;
							break;
						case 4:	
							if($diff->d > 365)
								$check = false;
							break;
					}
				}
				if($check){
					$str_data .= '<tr>';
					$str_data .= '	<td class="incomplete-id"> <a '; 
					
					if($applicant->has_read == 0) 
						$str_data .= '		style="color: red"';
					$str_data .= '		href="'.site_url('admin/client/record/' . $this->urlparser->encode($row->id)).'">'.$id.'</a> </td>';
					$str_data .= '	<td class="incomplete-name"> '.$name.' </td>';
					$str_data .= '	<td class="incomplete-mobile"> '. $row->user_mobile_phone. '</td>';
					$str_data .= '	<td class="incomplete-website"> '.$row->brand.' </td>';
					$str_data .= '	<td class="incomplete-datetime">'.$date.'</td>';
					$str_data .= '	<td class="taskOptions incomplete-days" >'.$diff->d.'</td>';
					$str_data .= '	<td class="incomplete-auto-sms"> N/A </td>';
					$str_data .= '	<td class="incomplete-auto-email"> N/A </td>';
					$str_data .= '	<td class="taskOptions incomplete-broker-id" >  </td>';
					$str_data .= '</tr>';
				}
			}
		}
		echo json_encode($str_data);
	}
	
	public function search_tank_2(){
		$str_data = '';
		$required_docs = array();
		
		if($this->input->post('searchTank_2') && $this->input->post('searchTank_2') == 'yes'){
			$this->load->model('backend/application', 'application');
			$this->load->model('backend/search_model', 'search');
			
			$required_docs = json_encode($this->search->search_tank_2());
			$required_docs = json_decode($required_docs);
			
			$arr_rank = $this->input->post("rank")?$this->input->post("rank"):array();
			$date_range = $this->input->post("date_range")?$this->input->post("date_range"):'';
			$ranking = $this->application->get_rank();
			
			foreach( $required_docs as $applicant ){
				$row  = $applicant;
				$id   = 'HCL'.$row->id;
				$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
				$date = date( 'd-m-Y @ H:i', strtotime( $row->date_submitted) );
				
				$now  = new DateTime();
				$ref  = new DateTime($row->date_submitted);
				$diff = $now->diff($ref);
				
				foreach( $ranking as $ranks ) {
					if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
						$rank = $ranks->rank;
					}
				}
				$check = true;
				if(count($arr_rank) > 0){
					$check = false;
					for($h = 0; $h < count($arr_rank); $h++){
						if($arr_rank[$h] == $rank){
							$check = true;
							break;	
						}
					}
				}
				if($date_range != '' || $date_range != NULL){
					switch($date_range){
						case 1:	
							if($diff->d > 7)
								$check = false;
							break;
						case 2:	
							if($diff->d > 14)
								$check = false;
							break;
						case 3:	
							if($diff->d > 31)
								$check = false;
							break;
						case 4:	
							if($diff->d > 365)
								$check = false;
							break;
					}
				}
				if($check){
					$str_data .= '<tr>';
					$str_data .= '	<td class="required-id"> <a href="'.site_url('admin/client/record/' . $this->urlparser->encode($row->id)).'">'.$id.'</a> </td>';
					$str_data .= '	<td class="required-name">'.$name.' </td>';
					$str_data .= '	<td class="required-mobile">'.$row->user_mobile_phone.' </td>';
					$str_data .= '	<td class="required-loan">$ '.$row->loan_amount.' </td>';
					$str_data .= '	<td class="required-website"> '.$row->brand.' </td>';
					$str_data .= '	<td class="taskOptions required-datetime">'.$date.' </td>';
					$str_data .= '	<td class="taskOptions required-days">'.$diff->d.'</td>';
					$str_data .= '	<td class="taskOptions required-docs">'.$row->has_docs.' </td>';
					$str_data .= '	<td class="taskOptions required-rank">'.$rank.'</td>';
					$str_data .= '	<td class="taskOptions required-broker-id"> </td>';
					$str_data .= '</tr>';
				}
			}
		}
		echo json_encode($str_data);
	}
	
	public function search_tank_3(){
		$str_data = '';
		$required_docs = array();
		
		if($this->input->post('searchTank_3') && $this->input->post('searchTank_3') == 'yes'){
			$this->load->model('backend/application', 'application');
			$this->load->model('backend/search_model', 'search');
			
			$required_docs = json_encode($this->search->search_tank_3());
			$required_docs = json_decode($required_docs);
			
			$arr_rank = $this->input->post("rank")?$this->input->post("rank"):array();
			$date_range = $this->input->post("date_range")?$this->input->post("date_range"):'';
			$ranking = $this->application->get_rank();
			
			foreach( $required_docs as $applicant ){
				$row  = $applicant;
				$id   = 'HCL'.$row->id;
				$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
				$date = date( 'd-m-Y @ H:i', strtotime( $row->date_submitted) );
				
				$now  = new DateTime();
				$ref  = new DateTime($row->date_submitted);
				$diff = $now->diff($ref);
				
				foreach( $ranking as $ranks ) {
					if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
						$rank = $ranks->rank;
					}
				}
				
				$check = true;
				if(count($arr_rank) > 0){
					$check = false;
					for($h = 0; $h < count($arr_rank); $h++){
						if($arr_rank[$h] == $rank){
							$check = true;
							break;	
						}
					}
				}
				if($date_range != '' || $date_range != NULL){
					switch($date_range){
						case 1:	
							if($diff->d > 7)
								$check = false;
							break;
						case 2:	
							if($diff->d > 14)
								$check = false;
							break;
						case 3:	
							if($diff->d > 31)
								$check = false;
							break;
						case 4:	
							if($diff->d > 365)
								$check = false;
							break;
					}
				}
				if($check){
					$str_data .= '<tr>';
					$str_data .= '	<td class="required-id"> <a href="'.site_url('admin/client/record/' . $this->urlparser->encode($row->id)).'">'.$id.'</a> </td>';
					$str_data .= '	<td class="required-name">'.$name.' </td>';
					$str_data .= '	<td class="required-mobile">'.$row->user_mobile_phone.' </td>';
					$str_data .= '	<td class="required-loan">$ '.$row->loan_amount.' </td>';
					$str_data .= '	<td class="required-website"> '.$row->brand.' </td>';
					$str_data .= '	<td class="taskOptions required-datetime">'.$date.' </td>';
					$str_data .= '	<td class="taskOptions required-days">'.$diff->d.'</td>';
					$str_data .= '	<td class="taskOptions staff-viewed">'.ucwords( $row->last_viewed ).'</td>';
					$str_data .= '	<td class="taskOptions required-rank">'.$rank.'</td>';
					$str_data .= '	<td class="taskOptions required-broker-id"> </td>';
					$str_data .= '</tr>';
				}
			}
		}
		echo json_encode($str_data);
	}
	
	public function search_tank_4(){
		$str_data = '';
		$required_docs = array();
		
		if($this->input->post('searchTank_4') && $this->input->post('searchTank_4') == 'yes'){
			$this->load->model('backend/application', 'application');
			$this->load->model('backend/search_model', 'search');
			
			$required_docs = json_encode($this->search->search_tank_4());
			$required_docs = json_decode($required_docs);
			
			$arr_rank = $this->input->post("rank")?$this->input->post("rank"):array();
			$date_range = $this->input->post("date_range")?$this->input->post("date_range"):'';
			$ranking = $this->application->get_rank();
			
			foreach( $required_docs as $applicant ){
				$row  = $applicant;
				$id   = 'HCL'.$row->id;
				$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
				$date = date( 'd-m-Y @ H:i', strtotime( $row->date_submitted) );
				
				$now  = new DateTime();
				$ref  = new DateTime($row->date_submitted);
				$diff = $now->diff($ref);
				
				foreach( $ranking as $ranks ) {
					if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
						$rank = $ranks->rank;
					}
				}
				
				$check = true;
				if(count($arr_rank) > 0){
					$check = false;
					for($h = 0; $h < count($arr_rank); $h++){
						if($arr_rank[$h] == $rank){
							$check = true;
							break;	
						}
					}
				}
				if($date_range != '' || $date_range != NULL){
					switch($date_range){
						case 1:	
							if($diff->d > 7)
								$check = false;
							break;
						case 2:	
							if($diff->d > 14)
								$check = false;
							break;
						case 3:	
							if($diff->d > 31)
								$check = false;
							break;
						case 4:	
							if($diff->d > 365)
								$check = false;
							break;
					}
				}
				if($check){
					$str_data .= '<tr>';
					$str_data .= '	<td class="required-id"> <a href="'.site_url('admin/client/record/' . $this->urlparser->encode($row->id)).'">'.$id.'</a> </td>';
					$str_data .= '	<td class="required-name">'.$name.' </td>';
					$str_data .= '	<td class="required-mobile">'.$row->user_mobile_phone.' </td>';
					$str_data .= '	<td class="required-loan">$ '.$row->loan_amount.' </td>';
					$str_data .= '	<td class="required-website"> '.$row->brand.' </td>';
					$str_data .= '	<td class="taskOptions required-datetime">'.$date.' </td>';
					$str_data .= '	<td class="taskOptions required-days">'.$diff->d.'</td>';
					$str_data .= '	<td class="taskOptions staff-viewed">'.ucwords( $row->last_viewed ).'</td>';
					$str_data .= '	<td class="taskOptions required-rank">'.$rank.'</td>';
					$str_data .= '	<td class="taskOptions required-broker-id"> </td>';
					$str_data .= '</tr>';
				}
			}
		}
		echo json_encode($str_data);
	}
	
	public function search_tank_5(){
		$str_data = '';
		$required_docs = array();
		
		if($this->input->post('searchTank_5') && $this->input->post('searchTank_5') == 'yes'){
			$this->load->model('backend/application', 'application');
			$this->load->model('backend/search_model', 'search');
			
			$required_docs = json_encode($this->search->search_tank_5());
			$required_docs = json_decode($required_docs);
			
			$arr_rank = $this->input->post("rank")?$this->input->post("rank"):array();
			$date_range = $this->input->post("date_range")?$this->input->post("date_range"):'';
			$arr_loan = $this->input->post("loan")?$this->input->post("loan"):'';
			$ranking = $this->application->get_rank();
			
			foreach( $required_docs as $applicant ){
				$row  = $applicant;
				$id   = 'HCL'.$row->id;
				$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
				$date = date( 'd-m-Y @ H:i', strtotime( $row->date_status) );
				
				$now  = new DateTime();
				$ref  = new DateTime($row->date_submitted);
				$diff = $now->diff($ref);
				
				$status = ( $row->has_approved == 1 ) ? 'Approved' : 'Rejected' ;
				
				foreach( $ranking as $ranks ) {
					if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
						$rank = $ranks->rank;
					}
				}
				
				$check = true;
				if(count($arr_rank) > 0){
					$check = false;
					for($h = 0; $h < count($arr_rank); $h++){
						if($arr_rank[$h] == $rank){
							$check = true;
							break;	
						}
					}
				}
				
				if(is_array($arr_loan) && count($arr_loan) > 0){
					$check = false;
					for($k = 0; $k < count($arr_loan); $k++){
						if($status == 'Approved'){
							if($arr_loan[$k] == 1){
								$check = true;
								break;	
							}
						}else if($status == 'Rejected'){
							if($arr_loan[$k] == 2){
								$check = true;
								break;	
							}	
						}
					}
				}
				
				if($date_range != '' || $date_range != NULL){
					switch($date_range){
						case 1:	
							if($diff->d > 7)
								$check = false;
							break;
						case 2:	
							if($diff->d > 14)
								$check = false;
							break;
						case 3:	
							if($diff->d > 31)
								$check = false;
							break;
						case 4:	
							if($diff->d > 365)
								$check = false;
							break;
					}
				}
				if($check){
					$str_data .= '<tr>';
					$str_data .= '	<td class="required-id"> <a href="'.site_url('admin/client/record/' . $this->urlparser->encode($row->id)).'">'.$id.'</a> </td>';
					$str_data .= '	<td class="required-name">'.$name.' </td>';
					$str_data .= '	<td class="required-mobile">'.$row->user_mobile_phone.' </td>';
					$str_data .= '	<td class="required-loan">$ '.$row->loan_amount.' </td>';
					$str_data .= '	<td class="required-website"> '.$row->brand.' </td>';
					$str_data .= '	<td class="taskOptions supervisor-days">'.$status.' </td>';
					$str_data .= ' 	<td class="taskOptions supervisor-datetime">'. $date.'</td>';
					$str_data .= '	<td class="taskOptions staff-viewed">'.ucwords( $row->last_viewed ).'</td>';
					$str_data .= '	<td class="taskOptions required-rank">'.$rank.'</td>';
					$str_data .= '	<td class="taskOptions required-broker-id"> </td>';
					$str_data .= '</tr>';
				}
			}
		}
		echo json_encode($str_data);
	}
	
	public function search_tank_6(){
		$str_data = '';
		$required_docs = array();
		
		if($this->input->post('searchTank_6') && $this->input->post('searchTank_6') == 'yes'){
			$this->load->model('backend/application', 'application');
			$this->load->model('backend/search_model', 'search');
			
			$required_docs = json_encode($this->search->search_tank_6());
			$required_docs = json_decode($required_docs);
			
			$arr_rank = $this->input->post("rank")?$this->input->post("rank"):array();
			$date_range = $this->input->post("date_range")?$this->input->post("date_range"):'';
			$arr_loan = $this->input->post("loan")?$this->input->post("loan"):'';
			$ranking = $this->application->get_rank();
			
			foreach( $required_docs as $applicant ){
				$row  = $applicant;
				$id   = 'HCL'.$row->id;
				$name = ucfirst( $row->fname ).' '.ucfirst( $row->lname );
				$date = date( 'd-m-Y @ H:i', strtotime( $row->date_submitted) );
				
				$now  = new DateTime();
				$ref  = new DateTime($row->date_submitted);
				$diff = $now->diff($ref);
				
				if( $row->has_approved == 1 ) {
					$status = 'Approved';
				} 
				elseif( $row->has_approved == 2 ) {
					$status = 'Rejected';
				} else {
					$status = 'Abandoned';
				}
				
				foreach( $ranking as $ranks ) {
					if( $ranks->max >= $row->total && $ranks->min <= $row->total ) {
						$rank = $ranks->rank;
					}
				}
				
				$check = true;
				if(count($arr_rank) > 0){
					$check = false;
					for($h = 0; $h < count($arr_rank); $h++){
						if($arr_rank[$h] == $rank){
							$check = true;
							break;	
						}
					}
				}
				
				if(is_array($arr_loan) && count($arr_loan) > 0){
					$check = false;
					for($k = 0; $k < count($arr_loan); $k++){
						if($status == 'Approved'){
							if($arr_loan[$k] == 1){
								$check = true;
								break;	
							}
						}else if($status == 'Rejected'){
							if($arr_loan[$k] == 2){
								$check = true;
								break;	
							}	
						}
					}
				}
				
				if($date_range != '' || $date_range != NULL){
					switch($date_range){
						case 1:	
							if($diff->d > 7)
								$check = false;
							break;
						case 2:	
							if($diff->d > 14)
								$check = false;
							break;
						case 3:	
							if($diff->d > 31)
								$check = false;
							break;
						case 4:	
							if($diff->d > 365)
								$check = false;
							break;
					}
				}
				if($check){
					$str_data .= '<tr>';
					$str_data .= '	<td class="required-id"> <a href="'.site_url('admin/client/record/' . $this->urlparser->encode($row->id)).'">'.$id.'</a> </td>';
					$str_data .= '	<td class="required-name">'.$name.' </td>';
					$str_data .= '	<td class="required-mobile">'.$row->user_mobile_phone.' </td>';
					$str_data .= '	<td class="required-loan">$ '.$row->loan_amount.' </td>';
					$str_data .= '	<td class="required-website"> '.$row->brand.' </td>';
					$str_data .= '	<td class="taskOptions supervisor-days">'.$status.' </td>';
					$str_data .= '	<td class="taskOptions market-datetime">'.$date.'</td>';
					$str_data .= '	<td class="taskOptions required-rank">'.$rank.'</td>';
					$str_data .= '	<td class="taskOptions required-broker-id"> </td>';
					$str_data .= '</tr>';
				}
			}
		}
		echo json_encode($str_data);
	}
	
	public function result()
	{
		$this->load->model('backend/search_model', 'search');
		
		$search_for 	= '';
		if(isset($_POST['search-for-top'])){
			$search_for     = $this->input->post('search-for-top');
			$status         = false;
			$date           = false;
			$date_from      = '';
			$date_to        = '';
			$manual_status  = 'All';
			$manual_stages  = 'All';
			$manual_product = 'All';
			$manual_brand   = 'All';
			$manual_leadgen = 'All';
			$manual_broker  = 'All';
		}else{
			$search_for     = $this->input->post('search-for');
			$status         = $this->input->post('status');
			$date           = $this->input->post('date');
			$date_from      = $this->input->post('date-from');
			$date_to        = $this->input->post('date-to');
			$manual_status  = $this->input->post('manual-status');
			$manual_stages  = $this->input->post('manual-stages');
			$manual_product = $this->input->post('manual-product');
			$manual_brand   = $this->input->post('manual-brand');
			$manual_leadgen = $this->input->post('manual-leadgen');
			$manual_broker  = $this->input->post('manual-broker');
		}
		
		if( empty($search_for) && empty($status) && empty($date) && empty($date_from) && empty($date_to) && $manual_status == 'All' && $manual_stages == 'All' && $manual_product == 'All' && $manual_brand == 'All' && $manual_leadgen == 'All' && $manual_broker == 'All' )
		{
			$data['results'] = $this->search->get_all_data();	
		} 
		elseif( !empty($search_for) && empty($status) && empty($date) && empty($date_from) && empty($date_to) && $manual_status == 'All' && $manual_stages == 'All' && $manual_product == 'All' && $manual_brand == 'All' && $manual_leadgen == 'All' && $manual_broker == 'All' )
		{			
			$data['results'] = $this->search->get_search_data( $search_for );
		}
		else {
			$status_setting = array();
			$date_range     = array();
			$manual_setting = array();
			$search_for     = '';

			if( !empty($status) ) {
				$status_setting = $status;
			}

			if( !empty($date) ) {
				$now  = date( 'Y-m-d' );

				if( $date == 'All Dates' ) {
					$date_range = array(
							'all_dates' => 'Yes'
						);
				}
				elseif( $date == 'Last Week') {
					$newdate = strtotime ( '-1 week' , strtotime ( $now ) ) ;
					$newdate = date ( 'Y-m-d' , $newdate );

					$date_range = array(
							'all_dates' => 'No',
							'range'     => $newdate,
							'today'     => $now
						);
				}
				elseif( $date == 'Last Two Weeks') {
					$newdate = strtotime ( '-2 week' , strtotime ( $now ) ) ;
					$newdate = date ( 'Y-m-d' , $newdate );					

					$date_range = array(
							'all_dates' => 'No',
							'range'     => $newdate,
							'today'     => $now
						);
				}
				elseif( $date == 'Last Month') {
					$newdate = strtotime ( '-1 month' , strtotime ( $now ) ) ;
					$newdate = date ( 'Y-m-d' , $newdate );

					$date_range = array(
							'all_dates' => 'No',
							'range'     => $newdate,
							'today'     => $now
						);
				}
				else {
					$date_from = date ( 'Y-m-d' ,  strtotime ($date_from) );
					$date_to   = date ( 'Y-m-d' ,  strtotime ($date_to) );
					
					$date_range = array(
							'all_dates' => 'No',
							'range'     => $date_from,
							'today'     => $date_to
						);
				}
			}

			$manual_setting = array(
					'status'  => $manual_status,
					'staging' => $manual_stages,
					'product' => $manual_product,
					'brand'   => $manual_brand,
					'leadgen' => $manual_leadgen,
					'broker'  => $manual_broker,
				);

			$data['results'] = $this->search->get_combo_search_data( $search_for, $status_setting, $date_range, $manual_setting );
		}
		
		$this->_load_template( 'backend/search', $data );
	}

	public function export()
	{
		$header  = 'header("Content-type: application/csv;charset=iso-8859-1");';
	    $header .= 'header("Content-Disposition: filename=search_result.csv");';
	    $header .= 'header("Pragma: no-cache");';
	    $header .= 'header("Expires: 0");';
	        
	    echo eval($header);
		print $_REQUEST['exportdata'];
	}

}