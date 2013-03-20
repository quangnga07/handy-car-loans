<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scores extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        /*if( !$this->session->userdata('admin_access') ) {
			redirect('/login', 'location');
		}*/
    }

	public function index() 
	{
		$this->load->model('frontend/score_model', 'score_model');
		$this->load->model('frontend/registration_model', 'registration_model');

		$applicant_id = $this->input->post('id');
		
		$score = $this->registration_model->get_applicants_score( $applicant_id );

		$birthDate = array(
			$score->birth_month,
			$score->birth_date,
			$score->birth_year
		);

		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y")-$birthDate[2])-1):(date("Y")-$birthDate[2]));
     	
     	$disposable_income = 0;
     	$disposable_income += ( $score->debit_months !== NULL ) ? (int)$score->monthly_income      : 0;
     	$disposable_income -= ( $score->debit_months !== NULL ) ? (int)$score->mortgage_rent_month : 0;
     	$disposable_income -= ( $score->debit_months !== NULL ) ? (int)$score->expenses_month      : 0;
     	$disposable_income -= ( $score->debit_months !== NULL ) ? (int)$score->loans_month         : 0;
     	$disposable_income -= ( $score->debit_months !== NULL ) ? (int)$score->credit_card_month   : 0;
     	$disposable_income -= ( $score->debit_months !== NULL ) ? (int)$score->debit_months        : 0;

     	$data_score = array(
     		'DB'  => $age,
     		'RS'  => $score->residential_status,
     		'TCA' => $score->time_address,
     		'LP'  => $score->loan_purpose,
     		'ES'  => $score->employment_status,
     		'EL'  => ( !empty($score->employment_length) ) ? $score->employment_length : 'Less than 3 months',
     		'BA'  => ( !empty($score->direct_to_bank) )    ? $score->direct_to_bank    : 'No',
     		'DI'  => $disposable_income
     	);

     	$data_obj = array();
     	$total_score = 0;
     	foreach($data_score as $k => $v) {
     		$obj = $this->score_model->get_score($k, $v);

     		$data_obj['score_' . strtolower($k)] = $obj->id;
     	}
     	$data_obj['user_id'] = $applicant_id;

     	if( !$this->score_model->check_if_existing($applicant_id) ) {
			if( $this->score_model->insert_score_by_user( $data_obj ) ) {
                $table  = 'users_application';
                $field  = $this->input->post('fields');

                $fields = array(
                    $field => $this->input->post('values')
                );

                $this->registration_model->update_data( $fields, $table, $applicant_id );
                echo 'true';
            } else {
                echo 'false';
            }
		} else {
            if( $this->score_model->update_score_by_user( $data_obj, $applicant_id ) ) {
                $table  = 'users_application';
                $field  = $this->input->post('fields');

                $fields = array(
                    $field => $this->input->post('values')
                );

                $this->registration_model->update_data( $fields, $table, $applicant_id );
                echo 'true';
            } else {
                echo 'false';
            }
		}
	}
} 