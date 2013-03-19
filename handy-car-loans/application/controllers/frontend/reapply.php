<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reapply extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        /*if( !$this->session->userdata('admin_access') ) {
			redirect('/login', 'location');
		}*/

		$this->load->library('parser');
    }

    public function index( $encrypted_id )
    {
    	$this->load->model('backend/application', 'application');
    	//Q0ZUb3NzY3FXMlZtdkJHR2RZS244RnJkQ0lwaElHdFhxWGRMVmtrUmVFdjZTNGVYK1JmMFYvWk1Ud0pzSXBVSER1SGEzUHRDYm1vWWsyakEvYmhKQ0E9PQ%3D%3D%3D%3D
    	$id        = $this->urlparser->decode( $encrypted_id );
    	$applicant = $this->application->view_application_by_id('users_application', $id);

    	if( count($applicant) > 0 ) {
    		if( $applicant->datetime_sms != '0000-00-00 00:00:00' && $applicant->datetime_emailed == '0000-00-00 00:00:00' ) {
    			$now   = new DateTime();
                $ref   = new DateTime( date( 'Y-m-d', strtotime($applicant->datetime_sms)) );
                $diff  = $now->diff($ref);

                if( $diff->d < 14 ) {
                	$this->session->set_userdata('applicant_id', $id);
                    $this->session->set_flashdata('applicant_exist', true);

                    redirect('apply', 'location');
                } else {
                	// codes for date expire
                	$this->session->set_flashdata('expired_url', true);

                    redirect('','location');
                }
    		}
			elseif( $applicant->datetime_emailed != '0000-00-00 00:00:00' && $applicant->datetime_sms == '0000-00-00 00:00:00' ) {
    			$now   = new DateTime();
                $ref   = new DateTime( date( 'Y-m-d', strtotime($applicant->datetime_emailed)) );
                $diff  = $now->diff($ref);

                if( $diff->d < 14 ) {
                	$this->session->set_userdata('applicant_id', $id);
                    $this->session->set_flashdata('applicant_exist', true);

                    redirect('apply', 'location');
                } else {
                	// codes for date expire
                	$this->session->set_flashdata('expired_url', true);

                    redirect('','location');
                }
    		} else {
    			$now   = new DateTime();
                $ref   = new DateTime( date( 'Y-m-d', strtotime($applicant->datetime_emailed)) );
                $diff  = $now->diff($ref);

                $ref2  = new DateTime( date( 'Y-m-d', strtotime($applicant->datetime_sms)) );
                $diff2  = $now->diff($ref2);

                if( $diff->d < 14 && $diff2->d < 14 ) {
                	$this->session->set_userdata('applicant_id', $id);
                    $this->session->set_flashdata('applicant_exist', true);

                    redirect('apply', 'location');
                } else {
                	// codes for date expire
                	$this->session->set_flashdata('expired_url', true);

                    redirect('','location');
                }
    		}
    	} else {
    		echo 'Not exisiting';
    	}
    }
}