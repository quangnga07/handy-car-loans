<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function add_log( $fields )
	{
		$this->db->insert('document_log', $fields);

		return $this->db->insert_id();
	}

	public function get_log( $id )
	{
		$query = $this->db->get_where('document_log', array('users_application_id' => $id));
		if( $query->row() ) {
			return $query->result();
		}
	}
	
	public function link_expire( $data )
	{
		return $this->db->insert('link_expire', $data);
	}

	public function get_link_expire( $id )
	{
		$query = $this->db->get_where('link_expire', array('url' => $id));
		return $query->row();
	}

	public function update_log($data, $id)
	{
		return $this->db->update('document_log', $data, array('id' => $id));
	}

	public function get_all_logs()
	{
		$sql = "SELECT a.*, b.fname, b.lname
				FROM document_log a
				LEFT JOIN users_application b ON a.users_application_id = b.id ORDER BY a.date_sent DESC";
		$query = $this->db->query( $sql );
        return $query->result();
	}
}
