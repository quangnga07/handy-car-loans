<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Score_model extends CI_Model {
	
	public function __construct() 
	{
        parent::__construct();
    }

    public function get_score($score_id, $value = null)
    {
        if( $value == null ) {
            $query = $this->db->get_where('score', array('score_id' => $score_id));
            return $query->result();
        }

        if( $score_id == 'DB' ) {
            if( $value <= 21 ) $id = 1;
            elseif( $value >= 22 && $value <= 29 ) $id = 2;
            elseif( $value >= 30 ) $id = 3;

            $query = $this->db->get_where('score', array('id' => $id));
            return $query->row();
        } elseif( $score_id == 'DI' ) {
            if( $value <= 200.00 ) $id = 34;
            elseif( $value >= 200.01 && $value <= 1000.00 ) $id = 35;
            elseif( $value >= 1000.01 ) $id = 36;

            $query = $this->db->get_where('score', array('id' => $id));
            return $query->row();
        } else {
            $query = $this->db->get_where('score', array('score_id' => $score_id, 'option' => $value));
            // $query = $this->db->query('SELECT * FROM score WHERE score_id = ? AND option LIKE ?', array($score_id, '%'.$value.'%'));
            return $query->row();
        }
    }

    public function check_if_existing( $user_id )
    {
        $query = $this->db->get_where('users_score', array('user_id' => $user_id));
        
        if( $query->row() ) return true;
        
        return false;
    }

    public function insert_score_by_user( $arr ) 
    {
        return $this->db->insert('users_score', $arr);
    }

    public function update_score_by_user( $arr, $id )
    {
        $this->db->where('user_id', $id);
        return $this->db->update('users_score', $arr);
    }
}

?>