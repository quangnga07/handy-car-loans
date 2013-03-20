<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if( !function_exists('br2nl')) {
    function br2nl( $input ) {
        return preg_replace('/<br(\s+)?\/?>/i', "\n", $input);
    }
}

if ( ! function_exists('email_template')) {
    function email_template($template_id, $id) {
        $CI =& get_instance();

        $CI->load->library(array('email', 'parser', 'encrypt'));
        $CI->load->model('backend/email_model', 'email_model');
        $CI->load->model('backend/document_model', 'document_model');
        $CI->load->model('backend/application');

        $applicant_data = $CI->application->view_application_by_id('users_application', $id);

        $client_email = $applicant_data->user_email;
        $admin_email  = 'noreply@handycarloans.com.au';
        $subject      = 'Email Notice from Handy Car Loans';
        $date         = date('Y-m-d H:i:s', time() );
        $name         = $applicant_data->fname . ' ' . $applicant_data->lname;

        if($template_id == 4)
            $template = $CI->email_model->get_template( 1 );
        else 
            $template = $CI->email_model->get_template( $template_id );

        $email_data = array(
            // Common contents for email
            'name'           => $name,
            'application_id' => $id,

            // Template contents for email
            'heading'     => $template->heading,
            'sub_heading' => $template->sub_heading,
            'content'     => $template->content
        );

        // Specific for Document Requested Email
        if($template_id == 1) {
            $email_data['url'] = base_url().'documentuploader/'.$CI->urlparser->encode($id).'/1';
            foreach($CI->input->post('doc') as $data) {
                $email_data['documents'][] = array(
                    'document' => $data
                );
            }
        }

        // print_r($email_data);

        $config['mailtype']  = "html"; 
        $CI->email->initialize($config); 

        if($template_id == 1) {
            $content = $CI->parser->parse('backend/email_template/email_required_template_doc', $email_data, TRUE);
        } elseif($template_id == 2) {
            $content = $CI->parser->parse('backend/email_template/email_complete_template', $email_data, TRUE);
        } elseif($template_id == 3) {
            $content = $CI->parser->parse('backend/email_template/email_approved_template', $email_data, TRUE);
        } elseif($template_id == 4) {
            $email_data['url'] = base_url().'documentuploader/'.$CI->urlparser->encode($id).'/4';
            $content = $CI->parser->parse('backend/email_template/email_required_template', $email_data, TRUE);
        }  

        $CI->email->from($admin_email, 'Handy Car Loans');
        $CI->email->to($client_email);

        $CI->email->subject( $subject );
        $CI->email->message( $content );

        if( $CI->email->send() ) {
            if( $template_id == 1 || $template_id == 4 ) {
                $data_log = array(
                    'date_sent'            => $date,
                    'users_application_id' => $id
                );

                if($template_id == 1) {
                    $data_log['message']        = 'Request Sent';
                    $data_log['requested_docs'] = implode(',', $CI->input->post('doc'));
                } elseif($template_id == 4) {
                    $data_log['message'] = 'Auto Sent';
                }

                $CI->document_model->add_log( $data_log );
            }
            return true;
        } else {
            return false;
        }
    }   
}

if ( !function_exists('notification_check') ) {
	function notification_check() {
		$CI =& get_instance();

        $CI->load->model('backend/message_model', 'message_model');
        $CI->load->model('backend/document_model', 'document_model');

        $ctr = 0;

        foreach( $CI->message_model->get_all_messages() as $msg ) {
            if( $msg->has_read == 0 )
                $ctr++;
        }

        foreach( $CI->document_model->get_all_logs() as $log ) {
			if( $log->message != 'Auto Sent' && $log->message != 'Request Sent' && $log->has_read == 0 ) {
				$ctr++;
			}
		}

        $CI->session->set_userdata('notify_count', $ctr);
	}
}