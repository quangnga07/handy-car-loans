<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Minit_model extends CI_Model {

	public function update_settings( $data )
	{
		$this->db->where('id', $data['id']);
		return $this->db->update('minit', $data);
	}

	public function get_settings()
	{
		$query = $this->db->get_where('minit', array('id'=>1));
		return $query->row();
	}
}