<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function total_applicants_tank1() 
	{
		$this->db->order_by("date_submitted", "DESC");
		$this->db->where('application_status', 2); 
		$query = $this->db->get_where('users_application', array('has_fill' => 'No'));
		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function count_applicants_by_tank( $status )
	{
		$sql = "SELECT c.fname, c.has_read, c.has_approved
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND application_status = '$status'
				AND has_fill = 'Yes'
				GROUP BY b.user_id";

		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function total_applicants_tank6() 
	{
		$sql = "SELECT c.fname, c.has_approved
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND has_approved != 0
				GROUP BY b.user_id
				ORDER BY c.date_status DESC
				LIMIT 0, 50";
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_tank1_applicants() 
	{
		$this->db->order_by("date_submitted", "DESC");
		$this->db->where('application_status', 2); 
		$query = $this->db->get_where('users_application', array('has_fill' => 'No'), 50, 0);
		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_tank_applicants( $status )
	{
		if( $status == 2 || $status == 3 || $status == 4 ) {
			$sort_by = 'ORDER BY c.date_submitted DESC LIMIT 0, 50';
		} else {
			$sort_by = 'ORDER BY c.date_status DESC LIMIT 0, 50';
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
						c.has_read,
						d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND application_status = '$status'
				AND has_fill = 'Yes'
				GROUP BY b.user_id
				".$sort_by;
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_tank6_applicants()
	{
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
						c.cancelled_by
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND has_approved != 0
				GROUP BY b.user_id
				ORDER BY c.date_status DESC
				LIMIT 0, 50";
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_all_incomplete_applicants()
	{	
		$sql = "SELECT users_application.*, users_settings.brand from users_application LEFT JOIN users_settings
				ON users_application.id = users_settings.users_application_id
				WHERE application_status = 2  
				AND has_fill = 'No' 
				ORDER BY date_submitted DESC
				LIMIT 0, 100";
		
		$query = $this->db->query($sql);
		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_all_applicants( $status )
	{
		if( $status == 2 || $status == 3 || $status == 4 ) {
			$sort_by = 'ORDER BY c.date_submitted DESC LIMIT 0, 100';
		} else {
			$sort_by = 'ORDER BY c.date_status DESC LIMIT 0, 100';
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
						c.has_read,
						d.brand
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND application_status = '$status'
				AND has_fill = 'Yes'
				GROUP BY b.user_id
				".$sort_by;
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_all_marketing_queue()
	{
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
						d.brand,
						c.cancelled_by
				FROM score AS a, users_score AS b, users_application AS c LEFT JOIN users_settings AS d
				ON c.id = d.users_application_id 
				WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id
				AND has_approved != 0
				GROUP BY b.user_id
				ORDER BY c.date_status DESC
				LIMIT 0, 100";
				
		$query = $this->db->query( $sql );

		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}

	public function get_rank()
	{
		$query = $this->db->get('rank');
		if( $query->row() ) {
			return $query->result();
		}
	}

	public function view_application_by_id( $table, $id ) 
	{
		$query = $this->db->get_where($table, array('id' => $id));
		return $query->row();
	}

	public function get_term_date($ver)
	{
		$query = $this->db->get_where('terms', array('id' => $ver));
		return $query->row();
	}
	
	public function update_status( $data, $id )
	{
		return $this->db->update('users_application', $data, "id = ".$id);
	}

	public function update_applicant( $data, $id )
	{
		$this->db->where('id', $id);
		return $this->db->update('users_application', $data);
	}

	public function get_user_documents( $id )
	{
		$query = $this->db->get_where('users_documents', array('user_id' => $id));
		return $query->result();
	}
        
        public function delete_document($doc_id)
        {
                $this->db->delete('users_documents', array('id'=> $doc_id));
        }
	
        public function get_document($doc_id){
                return $this->db->get_where('users_documents', array('id'=> $doc_id))
                                ->row(); 
        }
        
        public function update_document($doc_id, $data){
                $this->db->where('id', $doc_id)
                         ->update('users_documents', $data);
        }
        
	public function get_terms(){
		$query = $this->db->get('terms');
		if( $query->row() ) {
			return $query->result_array();
		}else{
			return $arr = array();	
		}
	}
	
	public function get_term_current(){
		$this->db->where('name', 'term_current');
		$query = $this->db->get_where('sysval', array('name' => 'term_current'));
		if($query->num_rows() > 0){
			return $query->row_array();	
		}else{
			return $data = array();	
		}
	}
	
	public function update_terms( $data, $term_current ){
		$err = '';
		
		$query = $this->db->query("select value from sysval where name = 'term_current'");
		if( $query->num_rows() > 0 ){
			$this->db->update('sysval', $arr = array('value' => $term_current), "name = 'term_current'");
		}else{
			$this->db->insert('sysval', $arr = array('name' => 'term_current', 'value' => 1)); 	
		}		
		
		$query = $this->db->query("select * from terms where id = ".$data['id']);
		if( $query->row() ){
			//$this->db->update('terms', $data, "id = ".$data['id']);
		}else{
			$this->db->insert('terms', $data); 	
		}
		return $err;
	}

	public function update_term_used( $data, $id )
	{
		return $this->db->update('sysval', $data, "id = ".$id);
	}
	
	public function get_sms_config(){
		$query = $this->db->get('reachtel_sms');
		if( $query->row() ) {
			return $query->result_array();
		}else{
			return $arr = array();	
		}	
	}
	
	public function update_sms_config($data){
		$err = '';
		$query = $this->db->query("select * from reachtel_sms where id = 1");
		if( $query->row() ){
			$this->db->update('reachtel_sms', $data, "id = 1");
		}else{
			$this->db->insert('reachtel_sms', $data); 	
		}
		return $err;
	}
	
	public function add_notes( $data )
	{
		$query = $this->db->get_where('users_notes', array('users_application_id' => $data['users_application_id']));
		if( $query->row() ) {
			$this->db->where('users_application_id', $data['users_application_id']);
			return $this->db->update('users_notes', $data);
		} else {
			return $this->db->insert('users_notes', $data);
		}
	}

	public function get_notes( $id ) 
	{
		$query = $this->db->get_where('users_notes', array('users_application_id' => $id));
		return $query->row();
	}

	public function add_settings( $data )
	{
		$query = $this->db->get_where('users_settings', array('users_application_id' => $data['users_application_id']));
		if( $query->row() ) {
			$this->db->where('users_application_id', $data['users_application_id']);
			return $this->db->update('users_settings', $data);
		} else {
			return $this->db->insert('users_settings', $data);
		}
	}

	public function get_settings( $id )
	{
		$query = $this->db->get_where('users_settings', array('users_application_id' => $id));
		return $query->row();
	} 

	public function has_read( $id )
	{
		$this->db->where('id', $id);
		return $this->db->update('users_application', array('has_read' => 1));
	}
	
	function add_user(){

		$error = '';
		$type = $this->input->post('type');
		$user = trim($this->input->post('usrname'));
		$password = $this->encrypt->sha1($this->input->post('passwrd'));
		$user_level = trim($this->input->post('user_level'));
		$user_email = trim($this->input->post('user_email'));
		$direct_to_bank = trim($this->input->post('direct_to_bank'));
		$date = date('Y-m-d H:i:s',time());
		$error = $this->check_username_exist($user);
		if($error == ''){
			$error = $this->check_email_exist($user_email);
		}
		if($error == ''){
			$this->db->set('username',$user);
			$this->db->set('user_level',$user_level);
			$this->db->set('email',$user_email);
			$this->db->set('password',$password);
			$this->db->set('status',$direct_to_bank);
			$this->db->set('date_created',$date);
			$this->db->insert('users');
			if($type == 1){
				switch($user_level){
					case 1:
						$level = 'Admin';
						break;
					case 2:
						$level = 'Supervisor';
						break;
					case 3:
						$level = 'Staff';
						break;
				}
				$this->load->library('email');
				$this->email->set_mailtype('html');
				$this->email->from($this->config->item('email_noreply_address'), $this->config->item('email_noreply_name'));
				$this->email->to($user_email);
				$this->email->subject('Your account has been created');
				$msg = "Congratulations! Your account has been created. <br /> User Name: ".$user."<br />Password: ".$this->input->post('passwrd')."<br /> Access here: http://handycarloans.com.au/admin";
				$this->email->message($msg);				
				$this->email->send();
			}
		}
		return array('error' => $error);
	}
	
	public function get_accounts(){
		$this->db->order_by("date_created", "DESC");
		$query = $this->db->get('users');
		if($query->row()){
			return $query->result();	
		}else{
			return array();
		}
	}
	
	public function edit_user(){
		$err = '';
		$id = $this->input->post('id_edit');
		$arr_data = array(
			'id' =>	$id,
			'email' =>	$this->input->post('email_edit'),
			'user_level' =>	$this->input->post('level_edit'),
			'status' =>	$this->input->post('status_edit')
		);
		$this->db->update('users',$arr_data, 'id = '.$id);
		return $err;
	}
	
	public function delete_user(){
		$err = '';
		$id = $this->input->post('uid');
		$this->db->query("delete from users where id = ".(int)$id);	
		return $err;
	}
	
	public function send_new_pass(){
		$error = '';
		$email = $this->input->post('email');
		$id = $this->input->post('uid');
		$this->load->library('lib');
		$new_pass = $this->lib->GeneralRandomKey(12);
		$password = $this->encrypt->sha1($new_pass);
		$arr_data =array(
			'password'	=> $password
		);
		$this->db->update('users',$arr_data,'id = '.$id);
		
		$data = array();
		$query = $this->db->query("select * from users where id = ".$id);
		if($query->row()){
			$data = $query->result();
			$this->load->library('email');
			$this->email->set_mailtype('html');
			$this->email->from($this->config->item('email_noreply_address'), $this->config->item('email_noreply_name'));
			$this->email->to($email);
			$this->email->subject('New account password');
			$msg = "Your new password. <br /> User Name: ".$data[0]->username."<br />Password: ".$new_pass."<br />User Level: ".$data[0]->user_level;
			$this->email->message($msg);				
			if(!$this->email->send()){
				$this->email->print_debugger();	
			}
		}
		return $error;
	}
	
	private function check_username_exist($user){
		$check = '';
		$query = $this->db->query("select id from users where username = '".$user."'");
		if($query->row()){
			$check = 'This username is exist on system. Please choose another username.';	
		}
		return $check;
	}
	
	private function check_email_exist($email){
		$check = '';
		$query = $this->db->query("select id from users where email = '".$email."'");
		if($query->row()){
			$check = 'This email was registed on system.';	
		}
		return $check;
	}
	
	public function get_user_log($id){
		$query = $this->db->query("select * from view_log where application_id = ".$id." ORDER BY date DESC limit 50");
		if($query->row()){
			return $query->result();	
		}else{
			return array();	
		}
	}
	
	public function get_access_log(){
		$sql = "SELECT * from access_log ORDER BY date DESC LIMIT 1000";
		
		$query = $this->db->query($sql);
		if( $query->row() ) {
			return $query->result();
		} else {
			return $array = array();
		}
	}
	
	public function save_view_log( $id ){
		$arr_data = array(
			'application_id' 	=> $id,
			'view_by' 			=> $this->session->userdata['user'],
			'level'				=> $this->session->userdata['user_level'],
			'date'				=> date('Y-m-d H:i:s',time())
		);
		$this->db->insert('view_log', $arr_data);
	}

	public function save_last_viewed( $id ) {
		$last_viewed = array(
			'last_viewed' => $this->session->userdata['user'],
		);

		$this->db->update('users_application', $last_viewed, "id = ".$id);
	}
	
	public function export_log(){
		$data_export = array();
		$sql = "SELECT * from access_log ORDER BY date DESC LIMIT 1000";
		$query = $this->db->query($sql);
		if( $query->row() ) {
			$data_export = $query->result();
		}
		if(count($data_export) > 0){
			set_include_path(get_include_path() . PATH_SEPARATOR . 'application/third_party/excel_class/');
			include 'PHPExcel.php';
			include 'PHPExcel/IOFactory.php';
			require_once 'PHPExcel/RichText.php';
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getActiveSheet()-> setTitle('Access Log');
			
			$objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(13);
			$objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
			$objPHPExcel->getDefaultStyle()->getFont()->setSize(9); 
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
			$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);
			$objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(18);
			$objPHPExcel->getActiveSheet()->setShowGridlines(false);
			
			$objPHPExcel->getActiveSheet()->mergeCells('B1:G1');
			$objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
			$objPHPExcel->getActiveSheet()->mergeCells('A3:B3');
			$objPHPExcel->getActiveSheet()->mergeCells('C3:D3');
			$objPHPExcel->getActiveSheet()->mergeCells('E3:F3');
			$objPHPExcel->getActiveSheet()->mergeCells('G3:H3');
			
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(16); 
			$objPHPExcel->getActiveSheet()->getStyle('A1:G3')->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->getColor()->setRGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0099FF');
			
			$objPHPExcel->getActiveSheet()->getStyle('B3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('B3')->getBorders()->getRight()->getColor()->setRGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('D3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('D3')->getBorders()->getRight()->getColor()->setRGB(PHPExcel_Style_Color::COLOR_WHITE);
			$objPHPExcel->getActiveSheet()->getStyle('F3')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle('F3')->getBorders()->getRight()->getColor()->setRGB(PHPExcel_Style_Color::COLOR_WHITE);
			
			$objPHPExcel->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:G3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
			$objDrawing = new PHPExcel_Worksheet_Drawing();
			$objDrawing->setName('Logo');
			$objDrawing->setDescription('Logo');
			$objDrawing->setPath('assets/img/car_small.png');
			$objDrawing->setHeight(50);
			$objDrawing->setCoordinates('B1');
			$objDrawing->setOffsetX(200);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
			
			$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Total record: '.count($data_export));
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Access Log');
			$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date');
			$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Level');
			$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Name');
			$objPHPExcel->getActiveSheet()->setCellValue('G3', 'IP');
			
			for($j = 0; $j < count($data_export); $j++){
				$t = $j+4;
				$level = '';
				switch($data_export[$j]->level){
					case 1:
						$level = 'Admin';
						break;
					case 2:
						$level = 'Supervisor';
						break;
					case 3:
						$level = 'Staff';
						break;
				}
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$t.':B'.$t);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$t, date('d-m-Y: g.ia', strtotime($data_export[$j]->date)));
				$objPHPExcel->getActiveSheet()->mergeCells('C'.$t.':D'.$t);
				$objPHPExcel->getActiveSheet()->getStyle('C'.$t)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$t, $level);
				$objPHPExcel->getActiveSheet()->mergeCells('E'.$t.':F'.$t);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$t, $data_export[$j]->name);
				$objPHPExcel->getActiveSheet()->mergeCells('G'.$t.':H'.$t);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$t, $data_export[$j]->ip);

			}
			$objPHPExcel->setActiveSheetIndex(0);
			
			$file_name = "Access_Log.csv";
			header('Content-Type: application/csv;charset=iso-8859-1');
			header('Content-Disposition: attachment;filename="'.$file_name.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output'); 
		}
	}
	
	public function get_access_controls(){
		$query = $this->db->get('access_control');
		if($query->row()){
			return $query->result();	
		}else{
			return array();	
		}
	}
	
	public function update_access_controls(){
		$err = '';
		$this->db->query("TRUNCATE TABLE access_control");
		$arr_staff = $this->input->post('staff');
		$arr_supervisor = $this->input->post('supervisor');
		for($i = 0; $i < count($arr_supervisor); $i++){
			$arr_data = array(
				'function' 		=> 	$i,
				'staff'			=>	(int)$arr_staff[$i],
				'supervisor'	=> 	(int)$arr_supervisor[$i]
			);
			$this->db->insert("access_control", $arr_data);
		}
		return $err;
	}
	
	public function lost_password(){
		$error = '';
		$email = $this->input->post('user_email');
		
		$this->load->library('lib');
		$new_pass = $this->lib->GeneralRandomKey(12);
		$password = $this->encrypt->sha1($new_pass);
		$arr_data =array(
			'password'	=> $password
		);
		$this->db->update('users',$arr_data,'email = "'.$email.'"');
		
		$data = array();
		$query = $this->db->query("select * from users where email = '".$email."'");
		if($query->row()){
			$data = $query->result();
			$this->load->library('email');
			$this->email->set_mailtype('html');
			$this->email->from('admin@handycarloans.com.au', 'Handy Car Loans');
			$this->email->to($email);
			$this->email->subject('Recover password');
			$msg = "Your recover password information <br /> User Name : ".$data[0]->username."<br />Password :".$new_pass."<br />User Level :".$data[0]->user_level;
			$this->email->message($msg);				
			if(!$this->email->send()){
				$this->email->print_debugger();	
			}
		}
		return array('error' => $error);
	}

	public function update_application( $data, $id ) {
		return $this->db->update('users_application', $data, "id = ".$id);
	}
	
	public function delete_client_record() {
		$err = '';
		$client_id = $this->input->post('client_record_id')?$this->input->post('client_record_id'):'';
		if($client_id != ''){
			$this->db->where('id', $client_id);
			$this->db->delete('users_application');
			$this->db->where('user_id', $client_id);
			$this->db->delete('users_documents');
			$this->db->where('users_application_id', $client_id);
			$this->db->delete('users_notes');
			$this->db->where('user_id', $client_id);
			$this->db->delete('users_score');
			$this->db->where('users_application_id', $client_id);
			$this->db->delete('users_settings');
			$this->db->where('users_application_id', $client_id);
			$this->db->delete('document_log');
			$this->db->where('application_id', $client_id);
			$this->db->delete('application_view');
		}
		return $err;
	}

	public function delete_dup_client_record($id) {
		$err = '';
		$client_id = $id;
		if($client_id != ''){
			$this->db->where('id', $client_id);
			$this->db->delete('users_application');
			$this->db->where('user_id', $client_id);
			$this->db->delete('users_documents');
			$this->db->where('users_application_id', $client_id);
			$this->db->delete('users_notes');
			$this->db->where('user_id', $client_id);
			$this->db->delete('users_score');
			$this->db->where('users_application_id', $client_id);
			$this->db->delete('users_settings');
			$this->db->where('users_application_id', $client_id);
			$this->db->delete('document_log');
			$this->db->where('application_id', $client_id);
			$this->db->delete('application_view');
		}
		return $err;
	}

	public function update_sms_email_reminder( $data, $id )
	{
		return $this->db->update('users_application', $data, array( 'id' => $id ));
	}
}
