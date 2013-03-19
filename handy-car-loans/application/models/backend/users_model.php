<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	var $username;
	var $password;
	var $email;
	var $user_level;

	public function __construct()
	{
		parent::__construct();
	}

	public function is_logged_in($username, $password, $ip)
	{
		$data = array(
			'username' => $username,
			'password' => $password
		);
		
		$query = $this->db->get_where('users', $data);
		if( $query->row() ) {
			$this->session->set_userdata(array(
				'user'       => $query->row()->username,
				'email'      => $query->row()->email,
				'user_level' => $query->row()->user_level,
				'logged_in'  => true
			));
			$this->save_access_log($query->row()->username, $query->row()->user_level, $ip);
			return true;
		} else {
			return false;
		}
	}

	public function get_users()
	{
		$query = $this->db->get('users');
		if( $query->row() ) {
			return $query->result();
		}
	}

	public function add_user($username, $password, $email, $user_level = 3)
	{
		$this->username   = $username;
		$this->password   = $password;
		$this->email      = $email;
		$this->user_level = $user_level;

		return $this->db->insert('users', $this);
	}

	public function delete( $data )
	{
		if( $this->db->delete('users', $data) ) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}
	
	private function save_access_log($username, $user_level, $ip){
		$arr_data = array(
			'name' 	=> $username,
			'level' => $user_level,
			'date'	=> date('Y-m-d H:i:s',time()),
			'ip'	=> $ip
		);
		$this->db->insert('access_log', $arr_data);
	}
	
}

/* End of file users.php */
/* Location: ./application/models/backend/users.php */