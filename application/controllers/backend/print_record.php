<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Print_record extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();

        if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }
    }

	private function _load_template( $template_file, $data = NULL )
    {
        $this->load->view('backend/includes/header_print');
        $this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer_print');
    }

    public function index()
    {
    	$this->load->library('encrypt');
    }

    public function record( $encrypt_id )
    {
    	$this->load->model('frontend/score_model', 'score_model');
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/message_model', 'message_model');
        $this->load->library('EmailReader');

        $id        = $this->urlparser->decode( $encrypt_id );
        $applicant = $this->application->view_application_by_id('users_application', $id);
		
        $messages  = $this->emailreader->inbox( $applicant->user_email );
        $date      = date('m/d/Y h:i:s a', time());
        if($messages && !$this->message_model->check_if_exist($applicant->user_email, $messages[0]['body'])) {
        	$msg_exist = $this->message_model->check_if_exist($applicant->user_email);
        	$msg_data = array(
        		'client_email' => $applicant->user_email,
        		'message' => $messages[0]['body'],
        		'has_read' => 0,
        		'unique_id_string' => $msg_exist->unique_id_string,
        		'from' => $messages[0]['header']->senderaddress,
        		'time_sent' => $date
        	);
        	$this->message_model->add_message($msg_data);
        } 
        $messages_db = $this->message_model->get_messages($applicant->user_email);

        $this->application->has_read( $id );

        rsort($messages_db);

        $data = array();
        $data['documents']    = $this->application->get_user_documents( $id );
        $data['messages']     = $messages_db;
        $data['applicant']    = $applicant;
		$data['term_date']    = $this->application->get_term_date($applicant->term_version);
        $data['email_parser'] = $messages;
        $data['score_rs']     = $this->score_model->get_score('RS');
        $data['score_tca']    = $this->score_model->get_score('TCA');
        $data['score_lp']     = $this->score_model->get_score('LP');
        $data['score_es']     = $this->score_model->get_score('ES');
        $data['score_el']     = $this->score_model->get_score('EL');
        $data['notes']        = $this->application->get_notes( $id );
        $data['settings']     = $this->application->get_settings( $id );

        $this->_load_template('backend/client_record', $data);
    }

    public function printrecord( $encrypt_id )
    {
    	$this->load->model('backend/scores_model', 'score_model');
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/message_model', 'message_model');
        $this->load->library('EmailReader');

        $id        = $this->urlparser->decode( $encrypt_id );
        $applicant = $this->application->view_application_by_id('users_application', $id);
        $ranking   = $this->application->get_rank();
        $total     = $this->score_model->get_total( $id );
		
        $messages  = $this->emailreader->inbox( $applicant->user_email );
        $date      = date('m/d/Y h:i:s a', time());
        if($messages && !$this->message_model->check_if_exist($applicant->user_email, $messages[0]['body'])) {
        	$msg_exist = $this->message_model->check_if_exist($applicant->user_email);
        	$msg_data = array(
        		'client_email' => $applicant->user_email,
        		'message' => $messages[0]['body'],
        		'has_read' => 0,
        		'unique_id_string' => $msg_exist->unique_id_string,
        		'from' => $messages[0]['header']->senderaddress,
        		'time_sent' => $date
        	);
        	$this->message_model->add_message($msg_data);
        } 
        $messages_db = $this->message_model->get_messages($applicant->user_email);

        $this->application->has_read( $id );
		
        rsort($messages_db);

        $app_status = 'N/A';
        if( $applicant->application_status == 2 && $applicant->has_fill === 'No' ) {
			$app_status = 'Incomplete Application';
		} elseif( $applicant->application_status == 2 ) {
			$app_status = 'Require Documents';
		} elseif( $applicant->application_status == 3 ) {
			$app_status = 'Staff Processing';
		} elseif( $applicant->application_status == 4 ) {
			$app_status = 'Supervisor Approval';
		} elseif( $applicant->application_status == 5 || $applicant->application_status == 6 ) {
			$app_status = 'Archived';
		} else if( $applicant->application_status == 7 ) {
			$app_status = 'Marketing Queue';
		}

		$rank = 'N/A';
		foreach( $ranking as $ranks ) {
			if( $ranks->max >= $total->total && $ranks->min <= $total->total ) {
				$rank = $ranks->rank;
			}
		}

        $data = array();
        $data['documents']    = $this->application->get_user_documents( $id );
        $data['messages']     = $messages_db;
        $data['applicant']    = $applicant;
        $data['recieved']     = date( 'd-m-Y H:i', strtotime($applicant->date_submitted ) );
        $data['date_status']  = ( $applicant->date_status == '0000-00-00 00:00:00' ) ? "" : date( 'jS F Y', strtotime($applicant->date_status) );
        $data['app_status']   = $app_status;
        $data['rank']         = $rank;
		$data['term_date']    = $this->application->get_term_date($applicant->term_version);
        $data['email_parser'] = $messages;
        $data['notes']        = $this->application->get_notes( $id );
        $data['settings']     = $this->application->get_settings( $id );

        $this->load->view('backend/print_record', $data);
    }
  }