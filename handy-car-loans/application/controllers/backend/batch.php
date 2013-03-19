<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Batch extends CI_Controller {

	public function index()
	{
		
	}

	public function score_checker( $id )
	{
		$this->load->model('backend/scores_model', 'score');

		$score = $this->score->get_scores_by_id( $id );

		if( count($score) < 1 ) {
			return true;
		} else {
			return false;
		}
	}

	public function sms_reminder( $both = false )
	{
		$this->load->library('lib');
		$this->load->model('backend/application', 'application');
		$this->load->model('backend/scores_model', 'score');

		$sms_config = $this->application->get_sms_config();
		$applicants = $this->application->get_all_incomplete_applicants();

		$username = $sms_config[0]['usrname'];
		$password = $sms_config[0]['password'];
		$delay    = (int)$sms_config[0]['delaymin'];
		$message  = $sms_config[0]['message_1'];

		foreach( $applicants as $applicant ) {
			//$destination = '0412086786'; //James' mobile #
			$destination = $applicant->user_mobile_phone;

			$id   = $applicant->id;
			$data = array(
				'datetime_sms'       => date( 'Y-m-d H:i:s' ),
				'application_status' => 6,
				'has_approved'       => 3,
			);
			
			$this->lib->reachtel_sms($username, $password, $message, $destination, $delay);
			if( !$both ) {
				$this->application->update_sms_email_reminder( $data, $id );
				if( $this->score_checker($id) ) {
					$score = array(
						'user_id'   => $id,
						'score_db'  => 1,
						'score_rs'  => 1,
						'score_tca' => 1,
						'score_lp'  => 1,
						'score_es'  => 1,
						'score_el'  => 1,
						'score_ba'  => 1,
						'score_di'  => 1,	 	 	 	 	
					);

					$this->score->insert_score($score);	
				}
			}
		}

		if( $both ) {
			return true;	
		} else {
			echo 'ok';
		}
	}

	public function email_reminder( $both = false )
	{
		$this->load->library(array('email', 'parser'));
        $this->load->model('backend/email_model', 'email_model');
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/scores_model', 'score');

        $applicants = $this->application->get_all_incomplete_applicants();
        $template   = $this->email_model->get_template( 4 );


        foreach( $applicants as $applicant ) {
            $id           = $applicant->id;
            $encrypted_id = $this->urlparser->encode($id);
            $client_name  = ucwords( $applicant->fname )." ".ucwords( $applicant->lname );
            $client_email = $applicant->user_email;
            $admin_email  = 'admin@handycarloans.com.au';
            $subject      = 'Email Notice from Handy Car Loans';

            $email_data = array(
                // Common contents for email
                'name'           => $client_name,
                'application_id' => $id,

                // Template contents for email
                'heading'     => $template->heading,
                'sub_heading' => $template->sub_heading,
                'content'     => $template->content,
                'url'         => base_url()."reapply/".$encrypted_id
            );

            $config['mailtype']  = "html"; 
            $this->email->initialize($config); 

            $content = $this->parser->parse('backend/email_template/email_abandoned_template', $email_data, TRUE);

            $this->email->from($admin_email, 'Handy Car Loans');
            $this->email->to($client_email);

            $this->email->subject( $subject );
            $this->email->message( $content );

            if( $this->email->send() ) {
                // updates the application so that It will moved to tank #6
				if( $both ) {
					$data = array(
						'datetime_sms'       => date( 'Y-m-d H:i:s' ),
						'datetime_emailed'   => date( 'Y-m-d H:i:s' ),
						'application_status' => 6,
						'has_approved'       => 3,
					);
				} else {
					$data = array(
						'datetime_emailed'   => date( 'Y-m-d H:i:s' ),
						'application_status' => 6,
						'has_approved'       => 3,
					);
				}
                                
                $this->application->update_sms_email_reminder( $data, $id );
                if( $this->score_checker($id) ) {
                    $score = array(
                        'user_id'   => $id,
                        'score_db'  => 1,
                        'score_rs'  => 1,
                        'score_tca' => 1,
                        'score_lp'  => 1,
                        'score_es'  => 1,
                        'score_el'  => 1,
                        'score_ba'  => 1,
                        'score_di'  => 1,                                       
                    );

                    $this->score->insert_score($score);     
                }
            }
        }

        if( $both ) {
            return true;    
        } else {
            echo 'ok';
        }
	}

	public function sms_email_reminder()
	{
		$has_sent = true;
		$both     = true;

		$has_sent = $this->sms_reminder( $both );
		$has_sent = $this->email_reminder( $both );

		if( $has_sent ) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}
}