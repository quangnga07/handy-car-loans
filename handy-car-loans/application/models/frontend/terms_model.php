<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms_model extends CI_Model {
	
	public function __construct() 
	{
        parent::__construct();
    }

    public function get_terms()
    {
		$term_current = 1;
		$query = $this->db->query("select * from sysval where name = 'term_current'");
		if($query->row()){
			$row = $query->result_array();
			$term_current = $row[0]['value'];
		}

		$query_1 = $this->db->query("select id,content from terms where id = ".$term_current);
		if($query_1->row()){
			return $query_1->result_array();	
		}else{
			return $arr = array();
		}
	}

}

?>