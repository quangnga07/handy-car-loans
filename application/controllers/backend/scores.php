<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scores extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();

        if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }
    }

	private function _load_template( $template_file, $data = NULL )
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
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2)
				if($data['access_controls'][6]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][6]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		
		$this->load->model('backend/scores_model', 'scores');
		
		$data['scores'] = $this->scores->get_scores();
		$data['ranks'] = $this->scores->get_rank();

		$this->_load_template('backend/scores', $data);
	}

	public function autosave()
	{
		$this->load->model( 'backend/scores_model', 'scores' );

		$id     = $this->input->post('id');
		$field  = $this->input->post('fields');
		$table  = ( $field == 'score' ) ? 'score' : 'rank' ;

		$fields = array(
				$field => $this->input->post('values')
			);

		$this->scores->update_data( $fields, $table, $id );
	}

}

/* End of file scores.php */
/* Location: ./application/controllers/backend/scores.php */