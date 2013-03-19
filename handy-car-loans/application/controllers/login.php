<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


	/*public function index() 
	{
		$data = array();
		$data['action'] = site_url('login');

		if( $this->input->post() && ($this->input->post('username') == 'admin' && $this->input->post('password') == 'MwmnZQ3c-12A') ) {
			$this->session->set_userdata('admin_access', true);
			redirect('/', 'location');
		}
		
		$this->load->view('backend/login', $data);
	}
	
	public function lost_password() 
	{
		if( $this->input->post('recover_password') && $this->input->post('recover_password') == 'yes'){
			$this->load->model('backend/application', 'application');
			echo json_encode($this->application->lost_password());
			exit;	
		}
	}*/
}