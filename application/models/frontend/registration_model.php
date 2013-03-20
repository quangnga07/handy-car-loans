<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration_Model extends CI_Model {
	
	public function __construct() 
	{
        parent::__construct();
    }

    public function insert_data( $fields, $table ) 
    {
	    $this->db->insert($table, $fields);
        return $this->db->insert_id();
    }

    public function update_data( $fields, $table, $id ) 
    {
		return $this->db->update($table, $fields, "id = ".$id);
    }

    public function get_applicants_by_id( $table, $id )
    {
        $query = $this->db->get_where($table, array('id' => $id));
        return $query->row();
    }

    public function get_applicants_by_name( $data )
    {
        $query = $this->db->get_where('users_application', $data);
        return $query->result();
    }

    public function check_if_registered( $fields )
    {
        $query = $this->db->get_where('users_application', $fields);
        return $query->row();
    }

    public function get_applicants_score( $id )
    {
        $this->db->select('birth_date, birth_month, birth_year, residential_status, time_address, loan_purpose, employment_status, employment_length, monthly_income, direct_to_bank, mortgage_rent_month, expenses_month, loans_month, credit_card_month, debit_months');
        $query = $this->db->get_where('users_application', array('id' => $id));
        return $query->row();
    }

    public function get_form_submit_message( $group, $type = null )
    {
        $data = array();
        $data['group'] = $group;
        if( $type != null ) {
            $data['type'] = $type;
            $query = $this->db->get_where('pre_set_messages', $data);
            return $query->row();
        } else {
            $query = $this->db->get_where('pre_set_messages', $data);
            return $query->result();
        }
    }
}