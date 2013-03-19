<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fields_model extends CI_Model {

    private $table;

    public function __construct() {
        parent::__construct();
        $this->table = 'fields';
    }

    public function insert_batch($data) {
        return $this->db->insert_batch($this->table, $data);
    }

    public function update() {
        
    }

    public function delete_by_category($cat) {
        $this->db->where('category', $cat)
                ->delete($this->table);
    }

    public function get_by_category($cat = FALSE, $status = null, $sort = NULL) {
        if ($cat != FALSE) {
            $this->db->select('*');
            $this->db->where('category', $cat);
            if($status != NULL){
                $this->db->where('status', $status);
            }
            
            if($sort != NULL){
                foreach ($sort as $a){
                    $this->db->order_by($a, 'ASC');
                }
            }
            
            $fields = $this->db->get($this->table);

            if ($fields->num_rows() > 0) {
                return $fields->result();
            } else {
                return FALSE;
            }
        }
    }

}

?>