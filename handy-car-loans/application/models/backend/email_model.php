<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function get_template( $id )
	{
		$query = $this->db->get_where('email_template', array('id' => $id));
		return $query->row();
	}

	public function update_template( $fields, $id )
	{
		$this->db->where('id', $id);
		return $this->db->update('email_template', $fields);
	}
}