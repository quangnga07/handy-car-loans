<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function update_contact($email)
	{
		return $this->db->update('contact_setting', array('email' => $email), array('id' => 1));
	}

	public function get_contact()
	{
		$query = $this->db->get_where('contact_setting', array('id' => 1));
		return $query->row();
	}
}