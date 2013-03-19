<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_data()
	{
		$this->db->select('*');
		$this->db->from('users_application');
		$this->db->join('users_settings', 'users_settings.users_application_id = users_application.id', 'left');

		$query = $this->db->get();

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_search_data( $search )
	{
		if( $search != 'HCL' ) {
			$found = preg_match('/HCL/s', $search );
			if( !empty($found) ) {
				$search = preg_replace('/HCL/s', '', $search);	

				$this->db->select('*');
				$this->db->from('users_application');
				$this->db->join('users_settings', 'users_settings.users_application_id = users_application.id', 'left');
				$this->db->where( 'id =', $search );

				$query = $this->db->get();

				if( $query->row() ) {
					return $query->result();
				} else {
					return $array = array();
				}
			}
		} else {
			//we need branding on the database
			$this->db->select('*');
			$this->db->from('users_application');
			$this->db->join('users_settings', 'users_settings.users_application_id = users_application.id', 'left');

			$query = $this->db->get();

			if( $query->row() ) {
				return $query->result();
			} else {
				return $array = array();
			}
		}

		if( $search == 'Incomplete' || $search == 'Incomplete (Abandoned)' || $search == 'incomplete' ) {
			$search = '2';
		}
		else if( $search == 'Required Documents' || $search == 'required documents' || $search == 'required' || $search == 'documents' ) {
			$search = '2';
		}
		else if( $search == 'Staff Processing' || $search == 'staff processing' || $search == 'staff' || $search == 'processing') {
		    $search = '3';
		}
		else if( $search == 'Supervisor Approval' || $search == 'supervisor approval' || $search == 'supervisor' || $search ==  'approval' ) {
			$search = '4';
		} 
		else if( $search == 'Archived' || $search == 'archived' ) {
		    $search = '4';
		}
		else if( $search == 'Approved' || $search == 'approved' ) {
			$search = '5';
		}
		else if( $search == 'Declined' || $search == 'declined' ) {				    	
		 	$search = '6';
		} else {
			
		}

		$data = explode(" ", $search);

		if( count($data) > 1 ) {
			$other_fields = array(
				'fname' => $data[0],
				'lname' => $data[1],
			);
		}

		$string_fields = array(
				'title'                => $search,
				'fname'                => $search,
				'lname'                => $search,
				'mname'                => $search,
				//'birth_date'           => $search,
				//'birth_month'          => $search,
				//'birth_year'           => $search,
				'license_num'          => $search,
				//'unit_num'             => $search,
				//'street_num'           => $search,
				//'city_suburb'          => $search,
				'state'                => $search,
				'postcode'             => $search,
				//'residential_status'   => $search,
				//'time_address'         => $search,
				'user_email'           => $search,
				'loan_amount'          => $search,
				'loan_purpose'         => $search,
				//'employment_status'    => $search,
				//'employment_length'    => $search,
				'monthly_income'       => $search,
				//'payday_frequency'     => $search,
				//'direct_to_bank'       => $search,
				'business_name'        => $search,
				'employer_phone'       => $search,
				//'employer_unit_num'    => $search,
				//'employer_street_num'  => $search,
				//'employer_street_name' => $search,
				//'employer_city_suburb' => $search,
				//'employer_city_suburb' => $search,
				'employer_postcode'    => $search,
				//'payment_frequency'    => $search,
				'mortgage_rent_month'  => $search,
				'expenses_month'       => $search,
				'loans_month'          => $search,
				'credit_card_month'    => $search,
				'debit_months'         => $search,
				'bank_name'            => $search,
				'account_name'         => $search,
				'ref1_name'            => $search,
				'ref1_relationship'    => $search,
				'ref1_city_suburb'     => $search,
				'ref1_state'           => $search,
				'ref1_postcode'        => $search,
				'ref1_street_name'     => $search,
				'ref2_name'            => $search,
				'ref2_relationship'    => $search,
				'ref2_city_suburb'     => $search,
				'ref2_state'           => $search,
				'ref2_postcode'        => $search,
				'ref2_street_name'     => $search,
				'user_mobile_phone'    => $search,
				'users_settings.status' => $search,
				'users_settings.staging' => $search,
				'users_settings.product' => $search,
				'users_settings.brand' => $search,
				'users_settings.leadgen' => $search,
				'users_settings.broker' => $search
			);
		$int_fields    = array(
				'user_home_phone'      => $search,
				'next_payday'          => $search,
				'bsb'                  => $search,
				'account_num'          => $search,
				'ref1_home_phone 	'  => $search,
				'ref1_mobile_phone '   => $search,
				'ref1_unit_num'        => $search,
				'ref1_street_num'      => $search,
				'ref2_home_phone 	'  => $search,
				'ref2_mobile_phone '   => $search,
				'ref2_unit_num'        => $search,
				'ref2_street_num'      => $search,
				'application_status'   => $search
			);

		$this->db->select('*');
		$this->db->from('users_application');
		$this->db->join('users_settings', 'users_settings.users_application_id = users_application.id', 'left');
		$this->db->where( 'id =', $search );
		$this->db->where( $int_fields );
		$this->db->or_like( $string_fields);
		if( count($data) > 1 ) {
			$this->db->or_like( $other_fields);
		}			

		/*$query = $this->db->get();
		echo $this->db->last_query();
		die();*/

		$query = $this->db->get();

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_combo_search_data( $search_for, $status_setting, $date_range, $manual_setting )
	{
		if( !empty($status_setting) && empty($date_range) ) {
			$status_clause = '';
			$manual_clause = '';

			foreach( $manual_setting as $key => $value ){
				if( $value != 'All' ) {
					$manual_clause .= " OR b.".$key." LIKE '%".$value."%' ";
				}
			}
			//has_approved 
			for($x = 0; $x < count($status_setting); $x++) {
				if( $x == 0 ) {
					if( $status_setting[$x] == 'No' ) {
						$status_clause .= " AND application_status = 2";
						$status_clause .= " AND has_fill = 'No'";
					}
					elseif( $status_setting[$x] == 2 ) {
						$status_clause .= " AND application_status = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					}
					elseif( $status_setting[$x] == 'app' ) {
						$status_clause .= " AND has_approved  = 1";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'dec' ) {
						$status_clause .= " AND has_approved  = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} else {
						$status_clause .= " AND application_status = ".$status_setting[$x];
					}
				} else {
					if( $status_setting[$x] == 2 ) {
						$status_clause .= " OR application_status = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'app' ) {
						$status_clause .= " AND has_approved  = 1";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'dec' ) {
						$status_clause .= " AND has_approved  = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} else {
						$status_clause .= " OR application_status = ".$status_setting[$x];
					}
				}
			}

			$sql =  "SELECT * FROM users_application AS a
					LEFT JOIN users_settings AS b
					ON b.users_application_id = a.id
					WHERE id != 0 ".$status_clause." ".$manual_clause;

			$query = $this->db->query( $sql );
			//echo $this->db->last_query();
			//die();
		}

		if( empty($status_setting) && !empty($date_range) ) {
			$manual_clause = '';

			foreach( $manual_setting as $key => $value ){
				if( $value != 'All' ) {
					$manual_clause .= " OR b.".$key." LIKE '%".$value."%' ";
				}
			}

			if( $date_range['all_dates'] == 'No' ) {
				$sql = "SELECT * FROM users_application AS a
					LEFT JOIN users_settings AS b
					ON b.users_application_id = a.id
					WHERE date_submitted
					BETWEEN '".$date_range["range"]."' AND '".$date_range["today"]."'".$manual_clause;
			} else {
				$sql = "SELECT * FROM users_application AS a
					LEFT JOIN users_settings AS b
					ON b.users_application_id = a.id
					WHERE id != 0 ".$manual_clause;
			}

			$query = $this->db->query( $sql );
		}

		if( !empty($status_setting) && !empty($date_range) ) {
			$status_clause = '';
			$manual_clause = '';

			foreach( $manual_setting as $key => $value ){
				if( $value != 'All' ) {
					$manual_clause .= " OR b.".$key." LIKE '%".$value."%' ";
				}
			}

			for($x = 0; $x < count($status_setting); $x++) {
				if( $x == 0 ) {
					if( $status_setting[$x] == 'No' ) {
						$status_clause .= " AND application_status = 2";
						$status_clause .= " AND has_fill = 'No'";
					}
					elseif( $status_setting[$x] == 2 ) {
						$status_clause .= " AND application_status = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'app' ) {
						$status_clause .= " AND has_approved  = 1";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'dec' ) {
						$status_clause .= " AND has_approved  = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} else {
						$status_clause .= " AND application_status = ".$status_setting[$x];
					}
				} else {
					if( $status_setting[$x] == 2 ) {
						$status_clause .= " OR application_status = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'app' ) {
						$status_clause .= " AND has_approved  = 1";
						$status_clause .= " AND has_fill = 'Yes'";
					} 
					elseif( $status_setting[$x] == 'dec' ) {
						$status_clause .= " AND has_approved  = 2";
						$status_clause .= " AND has_fill = 'Yes'";
					} else {
						$status_clause .= " OR application_status = ".$status_setting[$x];
					}
				}
			}

			if( $date_range['all_dates'] == 'No' ) {
				$sql = "SELECT * FROM users_application AS a
					LEFT JOIN users_settings AS b
					ON b.users_application_id = a.id
					WHERE date_submitted
					BETWEEN '".$date_range["range"]."' AND '".$date_range["today"]."'
					".$status_clause." ".$manual_clause;
			} else {
				$sql = "SELECT * FROM users_application AS a
					LEFT JOIN users_settings AS b
					ON b.users_application_id = a.id
					WHERE id != 0 ".$status_clause." ".$manual_clause;
			}
			
			$query = $this->db->query( $sql );
			//$query = $this->db->get();
			//echo $this->db->last_query();
			//die();
		}

		if( empty($status_setting) && empty($date_range) ) {
			$manual_clause = '';

			foreach( $manual_setting as $key => $value ){
				if( $value != 'All' ) {
					$manual_clause .= " AND b.".$key." LIKE '%".$value."%' ";
				}
			}

			$sql = "SELECT * FROM users_application AS a
					LEFT JOIN users_settings AS b
					ON b.users_application_id = a.id
					WHERE id != 0 ".$manual_clause;

			$query = $this->db->query( $sql );
		}

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	function search_tank_1(){
		$arr_state = $this->input->post("state")?$this->input->post("state"):array();
		$arr_amount = $this->input->post("amount")?$this->input->post("amount"):array();
		$arr_auto_sent = $this->input->post("auto_sent")?$this->input->post("auto_sent"):array();
		
		$sql_state = '';
		if(count($arr_state) > 0){
			$sql_state = ' AND users_application.state IN ( ';
			for($i = 0; $i < count($arr_state); $i++){
				$dauphay = ', ';
				if($i == (count($arr_state) - 1))
					$dauphay = '';
				$sql_state .= ' "'.$arr_state[$i].'"'.$dauphay.' ';	
			}
			$sql_state .= ' ) ';
		}
		
		$sql_amount = '';
		if(count($arr_amount) > 0){
			$sql_amount .= ' AND ((';
			for($j = 0; $j < count($arr_amount); $j++){
				$or = ' ) OR ( ';
				if($j == 0) $or = ' ';
				switch($arr_amount[$j]){
					case 1:
						$sql_amount .= ' '.$or.' users_application.loan_amount >= 0 AND users_application.loan_amount < 5000 ';			
						break;
					case 2:
						$sql_amount .= ' '.$or.' users_application.loan_amount >= 5000 AND users_application.loan_amount < 10000 ';			
						break;
					case 3:
						$sql_amount .= ' '.$or.' users_application.loan_amount >= 10000 AND users_application.loan_amount < 20000 ';			
						break;
					case 4:
						$sql_amount .= ' '.$or.' users_application.loan_amount >= 20000  ';			
						break;
				}
			}
			$sql_amount .= ' )) '; 
		}
		
		$sql = "SELECT users_application.*, users_settings.brand  from users_application LEFT JOIN users_settings
				ON users_application.id = users_settings.users_application_id 
				WHERE application_status = 2 
				and has_fill = 'No' ".$sql_state.$sql_amount." 
				ORDER BY date_submitted ASC";

		$query = $this->db->query($sql);
		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	function search_tank_2(){
		$arr_state = $this->input->post("state")?$this->input->post("state"):array();
		$arr_amount = $this->input->post("amount")?$this->input->post("amount"):array();
		$arr_brand = $this->input->post("brand")?$this->input->post("brand"):array();
		$sql_state = '';
		if(count($arr_state) > 0){
			$sql_state = ' AND c.state IN ( ';
			for($i = 0; $i < count($arr_state); $i++){
				$dauphay = ', ';
				if($i == (count($arr_state) - 1))
					$dauphay = '';
				$sql_state .= ' "'.$arr_state[$i].'"'.$dauphay.' ';	
			}
			$sql_state .= ' ) ';
		}
		
		$sql_amount = '';
		if(count($arr_amount) > 0){
			$sql_amount .= ' AND ((';
			for($j = 0; $j < count($arr_amount); $j++){
				$or = ' ) OR ( ';
				if($j == 0) $or = ' ';
				switch($arr_amount[$j]){
					case 1:
						$sql_amount .= ' '.$or.'  c.loan_amount >= 0 AND c.loan_amount < 5000 ';			
						break;
					case 2:
						$sql_amount .= ' '.$or.' c.loan_amount >= 5000 AND c.loan_amount < 10000 ';			
						break;
					case 3:
						$sql_amount .= ' '.$or.' c.loan_amount >= 10000 AND c.loan_amount < 20000 ';			
						break;
					case 4:
						$sql_amount .= ' '.$or.' c.loan_amount >= 20000  ';			
						break;
				}
			}
			$sql_amount .= ' )) ';
		}
		
		$sql_brand = '';
		if(count($arr_brand) > 0){
			$sql_brand = ' AND d.brand IN ( ';
			for($h = 0; $h < count($arr_brand); $h++){
				$dauphay = ', ';
				if($h == (count($arr_brand) - 1))
					$dauphay = '';
				$sql_brand .= ' "'.$arr_brand[$h].'"'.$dauphay.' ';	
			}
			$sql_brand .= ' ) ';
		}
		$sql = "SELECT sum(a.score) AS total, 
						c.fname, 
						c.lname, 
						c.id, 
						c.user_mobile_phone, 
						c.loan_amount, 
						c.date_submitted, 
						c.has_approved, 
						c.date_status, 
						c.last_viewed,
						c.has_docs,
						d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id 
				AND application_status = '2'
				AND has_fill = 'Yes' 
				".$sql_state.$sql_amount.$sql_brand." 
				GROUP BY b.user_id
				ORDER BY c.date_submitted DESC";
		
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	function search_tank_3(){
		$arr_state = $this->input->post("state")?$this->input->post("state"):array();
		$arr_amount = $this->input->post("amount")?$this->input->post("amount"):array();
		$arr_brand = $this->input->post("brand")?$this->input->post("brand"):array();
		$arr_product = $this->input->post("product")?$this->input->post("product"):array();
		
		$sql_state = '';
		if(count($arr_state) > 0){
			$sql_state = ' AND c.state IN ( ';
			for($i = 0; $i < count($arr_state); $i++){
				$dauphay = ', ';
				if($i == (count($arr_state) - 1))
					$dauphay = '';
				$sql_state .= ' "'.$arr_state[$i].'"'.$dauphay.' ';	
			}
			$sql_state .= ' ) ';
		}
		
		$sql_amount = '';
		if(count($arr_amount) > 0){
			$sql_amount .= ' AND ((';
			for($j = 0; $j < count($arr_amount); $j++){
				$or = ' ) OR ( ';
				if($j == 0) $or = ' ';
				switch($arr_amount[$j]){
					case 1:
						$sql_amount .= ' '.$or.' c.loan_amount >= 0 AND c.loan_amount < 5000 ';			
						break;
					case 2:
						$sql_amount .= ' '.$or.' c.loan_amount >= 5000 AND c.loan_amount < 10000 ';			
						break;
					case 3:
						$sql_amount .= ' '.$or.' c.loan_amount >= 10000 AND c.loan_amount < 20000 ';			
						break;
					case 4:
						$sql_amount .= ' '.$or.' c.loan_amount >= 20000  ';			
						break;
				}
			}
			$sql_amount .= ' )) ';
		}
		
		$sql_product = '';
		if(count($arr_product) > 0){
			$sql_product = ' AND d.product IN ( ';
			for($h = 0; $h < count($arr_product); $h++){
				$dauphay = ', ';
				if($h == (count($arr_product) - 1))
					$dauphay = '';
				$sql_product .= ' "'.$arr_product[$h].'"'.$dauphay.' ';	
			}
			$sql_product .= ' ) ';
		}
		
		$sql_brand = '';
		if(count($arr_brand) > 0){
			$sql_brand = ' AND d.brand IN ( ';
			for($k = 0; $k < count($arr_brand); $k++){
				$dauphay = ', ';
				if($k == (count($arr_brand) - 1))
					$dauphay = '';
				$sql_brand .= ' "'.$arr_brand[$k].'"'.$dauphay.' ';	
			}
			$sql_brand .= ' ) ';
		}
		
		$sql = "SELECT sum(a.score) AS total, 
						c.fname, 
						c.lname, 
						c.id, 
						c.user_mobile_phone, 
						c.loan_amount, 
						c.date_submitted, 
						c.has_approved, 
						c.date_status, 
						c.last_viewed,
						c.has_docs,
						d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id 
				AND application_status = '3'
				AND has_fill = 'Yes' 
				".$sql_state.$sql_amount.$sql_brand.$sql_product." 
				GROUP BY b.user_id
				ORDER BY c.date_submitted DESC";
				
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	function search_tank_4(){
		$arr_state = $this->input->post("state")?$this->input->post("state"):array();
		$arr_amount = $this->input->post("amount")?$this->input->post("amount"):array();
		$arr_brand = $this->input->post("brand")?$this->input->post("brand"):array();
		$arr_product = $this->input->post("product")?$this->input->post("product"):array();
		
		$sql_state = '';
		if(count($arr_state) > 0){
			$sql_state = ' AND c.state IN ( ';
			for($i = 0; $i < count($arr_state); $i++){
				$dauphay = ', ';
				if($i == (count($arr_state) - 1))
					$dauphay = '';
				$sql_state .= ' "'.$arr_state[$i].'"'.$dauphay.' ';	
			}
			$sql_state .= ' ) ';
		}
		
		$sql_amount = '';
		if(count($arr_amount) > 0){
			$sql_amount .= ' AND ((';
			for($j = 0; $j < count($arr_amount); $j++){
				$or = ' ) OR ( ';
				if($j == 0) $or = ' ';
				switch($arr_amount[$j]){
					case 1:
						$sql_amount .= ' '.$or.' c.loan_amount >= 0 AND c.loan_amount < 5000 ';			
						break;
					case 2:
						$sql_amount .= ' '.$or.' c.loan_amount >= 5000 AND c.loan_amount < 10000 ';			
						break;
					case 3:
						$sql_amount .= ' '.$or.' c.loan_amount >= 10000 AND c.loan_amount < 20000 ';			
						break;
					case 4:
						$sql_amount .= ' '.$or.' c.loan_amount >= 20000  ';			
						break;
				}
			}
			$sql_amount .= ' )) ';
		}
		
		$sql_product = '';
		if(count($arr_product) > 0){
			$sql_product = ' AND d.product IN ( ';
			for($h = 0; $h < count($arr_product); $h++){
				$dauphay = ', ';
				if($h == (count($arr_product) - 1))
					$dauphay = '';
				$sql_product .= ' "'.$arr_product[$h].'"'.$dauphay.' ';	
			}
			$sql_product .= ' ) ';
		}
		
		$sql_brand = '';
		if(count($arr_brand) > 0){
			$sql_brand = ' AND d.brand IN ( ';
			for($k = 0; $k < count($arr_brand); $k++){
				$dauphay = ', ';
				if($k == (count($arr_brand) - 1))
					$dauphay = '';
				$sql_brand .= ' "'.$arr_brand[$k].'"'.$dauphay.' ';	
			}
			$sql_brand .= ' ) ';
		}
		
		$sql = "SELECT sum(a.score) AS total, 
						c.fname, 
						c.lname, 
						c.id, 
						c.user_mobile_phone, 
						c.loan_amount, 
						c.date_submitted, 
						c.has_approved, 
						c.date_status, 
						c.last_viewed,
						c.has_docs,
						d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND application_status = '4'
				AND has_fill = 'Yes' 
				".$sql_state.$sql_amount.$sql_brand.$sql_product." 
				GROUP BY b.user_id
				ORDER BY c.date_submitted DESC";
		
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	function search_tank_5(){
		$arr_state = $this->input->post("state")?$this->input->post("state"):array();
		$arr_amount = $this->input->post("amount")?$this->input->post("amount"):array();
		
		$sql_state = '';
		if(count($arr_state) > 0){
			$sql_state = ' AND c.state IN ( ';
			for($i = 0; $i < count($arr_state); $i++){
				$dauphay = ', ';
				if($i == (count($arr_state) - 1))
					$dauphay = '';
				$sql_state .= ' "'.$arr_state[$i].'"'.$dauphay.' ';	
			}
			$sql_state .= ' ) ';
		}
		
		$sql_amount = '';
		if(count($arr_amount) > 0){
			$sql_amount .= ' AND ((';
			for($j = 0; $j < count($arr_amount); $j++){
				$or = ' ) OR ( ';
				if($j == 0) $or = ' ';
				switch($arr_amount[$j]){
					case 1:
						$sql_amount .= ' '.$or.' c.loan_amount >= 0 AND c.loan_amount < 5000 ';			
						break;
					case 2:
						$sql_amount .= ' '.$or.' c.loan_amount >= 5000 AND c.loan_amount < 10000 ';			
						break;
					case 3:
						$sql_amount .= ' '.$or.' c.loan_amount >= 10000 AND c.loan_amount < 20000 ';			
						break;
					case 4:
						$sql_amount .= ' '.$or.' c.loan_amount >= 20000  ';			
						break;
				}
			}
			$sql_amount .= ' )) ';
		}
		
		$sql = "SELECT sum(a.score) AS total, 
					c.fname, 
					c.lname, 
					c.id, 
					c.user_mobile_phone, 
					c.loan_amount, 
					c.date_submitted, 
					c.has_approved, 
					c.date_status, 
					c.last_viewed,
					c.has_docs,
					d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND application_status = '5'
				AND has_fill = 'Yes' 
				".$sql_state.$sql_amount." 
				GROUP BY b.user_id
				ORDER BY c.date_status DESC";
		
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	function search_tank_6(){
		$arr_amount = $this->input->post("amount")?$this->input->post("amount"):array();
		
		$sql_amount = '';
		if(count($arr_amount) > 0){
			$sql_amount .= ' AND ((';
			for($j = 0; $j < count($arr_amount); $j++){
				$or = ' ) OR ( ';
				if($j == 0) $or = ' ';
				switch($arr_amount[$j]){
					case 1:
						$sql_amount .= ' '.$or.' c.loan_amount >= 0 AND c.loan_amount < 5000 ';			
						break;
					case 2:
						$sql_amount .= ' '.$or.' c.loan_amount >= 5000 AND c.loan_amount < 10000 ';			
						break;
					case 3:
						$sql_amount .= ' '.$or.' c.loan_amount >= 10000 AND c.loan_amount < 20000 ';			
						break;
					case 4:
						$sql_amount .= ' '.$or.' c.loan_amount >= 20000  ';			
						break;
				}
			}
			$sql_amount .= ' )) ';
		}
		
		$sql = "SELECT sum(a.score) AS total, 
					c.fname, 
					c.lname, 
					c.id, 
					c.user_mobile_phone, 
					c.loan_amount, 
					c.date_submitted, 
					c.has_approved, 
					c.date_status, 
					c.last_viewed,
					d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND has_approved != 0 
				".$sql_amount." 
				GROUP BY b.user_id
				ORDER BY c.date_status DESC";
				
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
}