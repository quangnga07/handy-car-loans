<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scores_Model extends CI_Model {
	
	public function __construct() 
	{
        parent::__construct();
    }

    public function insert_score( $data ) 
    {
    	return	$this->db->insert('users_score', $data); 
    }

    public function update_data( $fields, $table, $id ) 
    {
		return $this->db->update($table, $fields, "id = ".$id);
    }

    public function get_scores()
    {
        $query = $this->db->get('score');
		if( $query->row() ) {
			return $query->result();
		}
    }

    public function get_scores_by_id( $id )
    {
	    $query = $this->db->get_where('users_score', array('user_id' => $id));
	    if( $query->row() ) {
			return $query->result();
		}
    }

    public function get_rank()
    {
    	$query = $this->db->get('rank');
    	if( $query->row() ) {
    		return $query->result();
    	}
    }

    public function get_total( $id )
    {
    	$sql = "SELECT sum(a.score) AS total
    			FROM score AS a, users_score AS b, users_application AS c
    			WHERE a.id IN (score_db, score_rs, score_tca, score_lp, score_es, score_el, score_ba, score_di) 
				AND b.user_id = c.id AND c.id = ".$id;

    	$query = $this->db->query( $sql );
    	return $query->row();
    }


}