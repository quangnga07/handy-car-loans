<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader_model extends CI_Model {
	
	public function __construct() 
	{
        parent::__construct();
    }

    public function get_user( $user_id )
    {
        $query = $this->db->get_where('users_application', array('id' => $user_id) );
        if( $query->row() ) {
			return $query->result();
		}
    }

    public function insert_data( $table, $fields ) 
    {
        $query = $this->db->get_where($table, array('user_id' => $fields['user_id']));
        
        //if( $query->row() ) {
        //    $result = $query->result();

        //    $fields['files'] .= ",".$result[0]->files;

        //    return $this->db->update( $table, $fields, "user_id = ".$fields['user_id']);
        //} else {
            return $this->db->insert($table, $fields);
        //}
    }

    public function insert_data_backend( $table, $fields )
    {
        $query = $this->db->get_where($table, array('user_id' => $fields['user_id']));
        
        return $this->db->insert($table, $fields);
    }

    public function update_user( $table, $fields, $id )
    {
    	return $this->db->update( $table, $fields, "id = ".$id);
    }
}
