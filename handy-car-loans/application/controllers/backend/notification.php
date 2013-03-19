<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }

		notification_check();
	}

	private function _load_template($template_file, $data = NULL) 
	{
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		
        $this->load->view('backend/includes/header');
        $this->load->view('backend/includes/sidebar',$data);
        $this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer');
    }

	public function index() 
	{
		$this->load->model('backend/message_model', 'message_model');
		$this->load->model('backend/document_model');

		$data = array();
		foreach( $this->message_model->get_all_messages() as $msg ) {
			if( $msg->has_read == 0 )
				$data['messages'][] = $msg;
		}

		foreach( $this->document_model->get_all_logs() as $log ) {
			if( $log->message != 'Auto Sent' && $log->message != 'Request Sent' && $log->has_read == 0 ) {
				$data['documents'][] = $log;
			}
		}

		$this->_load_template('backend/notification', $data);
	}

	public function delete_notification()
	{
		$this->load->model('backend/message_model');
		$this->load->model('backend/document_model');

		$id   = $this->input->post('id');
		$type = $this->input->post('type');

		if( $type == 'message' ) {
			if( $this->message_model->update_user_message(array( 'has_read' => 1 ), $id) ) {
				return true;
			}
		} elseif( $type == 'document' ) {
			if( $this->document_model->update_log(array( 'has_read' => 1 ), $id) ) {
				return true;
			}
		}

		return false;
	}

}