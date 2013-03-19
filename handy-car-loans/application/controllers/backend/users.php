<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	private function _load_template( $template_file, $data = NULL )
	{
		if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
			redirect('/admin/login', 'location');
		}
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/sidebar',$data);
		$this->load->view($template_file, $data);
		$this->load->view('backend/includes/footer');
	}

	public function index()
	{
		$this->load->model('backend/users_model', 'users');

		$data['users'] = $this->users->get_users();

		$this->_load_template('backend/users', $data);
	}

	public function manage_action_users() 
	{
		$this->_load_template('backend/users-form');
	}

	public function save_user() 
	{
		$this->load->model('backend/users_model', 'users');
		$this->load->library('encrypt');

		$username   = $this->input->post('username');
		$password   = $this->encrypt->sha1( $this->input->post('password') );
		$email      = $this->input->post('email');
		$user_level = $this->input->post('user');

		$this->users->add_user($username, $password, $email, $user_level);

		redirect('/admin/users', 'location');
	}

	public function remove_user() 
	{
		$this->load->model('backend/users_model', 'users');

		$data = array( 'id' => $this->input->post('id') );

		$this->users->delete( $data );
	}

}