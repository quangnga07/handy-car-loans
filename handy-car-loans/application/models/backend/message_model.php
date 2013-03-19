<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function check_if_exist( $email, $msg = null )
    {
        if($msg != null) $query = $this->db->get_where('users_message', array('client_email' => $email, 'message' => $msg));
        else $query = $this->db->get_where('users_message', array('client_email' => $email));
        return $query->row();
    }

    public function add_message( $data )
    {
        return $this->db->insert('users_message', $data);
    }

    public function get_messages( $email )
    {
        $query = $this->db->get_where('users_message', array('client_email' => $email));
        return $query->result();
    }

    public function update_user_message( $data, $id )
    {
        return $this->db->update('users_message', $data, array('id' => $id));
    }

    public function get_preset_messages( $group )
    {
        $query = $this->db->get_where('pre_set_messages', array('group' => $group));
        return $query->result();
    }

    public function save_message( $data, $id )
    {
        return $this->db->update('pre_set_messages', $data, array('id' => $id));
    }

    public function get_all_messages()
    {
        // $query = $this->db->get('users_message');
        $sql = "SELECT a.*, b.fname, b.mname, b.lname, b.id AS user_id, b.user_email
                FROM users_message a
                LEFT JOIN users_application b ON a.client_email = b.user_email ORDER BY a.time_sent DESC
               ";
        $query = $this->db->query( $sql );
        return $query->result();
    }
}