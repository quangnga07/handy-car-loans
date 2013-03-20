<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configure extends CI_Controller {

	public function  __construct() 
	{
		parent::__construct();

		if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }
	}

	public function index()
	{

	}

	public function email_template()
	{
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2)
				if($data['access_controls'][8]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][8]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		$this->load->model('backend/email_model', 'email_model');

		$data = array();
		$data['email_1'] = $this->email_model->get_template(1);
		$data['email_2'] = $this->email_model->get_template(2);
		$data['email_3'] = $this->email_model->get_template(3);
		$data['email_4'] = $this->email_model->get_template(4);

		$this->_load_template('backend/configure_email', $data);
	}

	public function process_email_template()
	{
		$this->load->model('backend/email_model', 'email_model');

		$data = $this->input->post();
		$this->email_model->update_template($data, $data['id']);

		redirect('admin/configure/email_template', 'location');
	}

	public function pre_set_messages()
	{
		$this->load->model('backend/message_model', 'message');
		$this->load->model('backend/contact_model', 'contact');
		
		$tab1_content['messages'] = $this->message->get_preset_messages( 'FS' );
		$tab2_content['messages'] = $this->message->get_preset_messages( 'WB' );
		$tab3_content['messages'] = $this->message->get_preset_messages( 'CF' );
		$tab3_content['contact']  = $this->contact->get_contact();

		$html['tab1'] = $this->load->view('backend/pre_set_messages/tab1', $tab1_content, TRUE);
        $html['tab2'] = $this->load->view('backend/pre_set_messages/tab2', $tab2_content, TRUE);
        $html['tab3'] = $this->load->view('backend/pre_set_messages/tab3', $tab3_content, TRUE);

		$this->_load_template('backend/pre_set_message', $html);
	}

	public function save_email_contact()
	{
		$this->load->model('backend/contact_model');

		$email = $this->input->post('contact-receiver');

		if($this->contact_model->update_contact($email)) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function save_preset_message( $text, $tab )
	{
		$this->load->model('backend/message_model', 'message');

		$id      = $this->input->post( 'id_'.$text );
		$type    = $this->input->post( 'type_'.$tab.'_'.$text );
		$heading = $this->input->post( 'heading_'.$text );
		$message = $this->input->post( 'message_'.$text );

		$data = array(
			'type'    => $type,
			'heading' => $heading,
			'message' => $message
		);

		$is_update = $this->message->save_message( $data, $id );

		if( $is_update ) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	/**
	 * Function to load template
	 */
	private function _load_template($template_file, $data = NULL) 
	{
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		
        $this->load->view('backend/includes/header');
        $this->load->view('backend/includes/sidebar',$data);
        $this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer');
    }
}