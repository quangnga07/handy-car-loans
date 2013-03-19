<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct() 
	{
        parent::__construct();
        if( !$this->input->is_ajax_request() ) {
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }
    }

    public function index()
    {
        redirect($_SERVER['HTTP_REFERER'], 'location');
    }

    public function send()
    {
        $this->load->model('backend/message_model', 'message_model');
        $this->load->library(array('email', 'parser'));
        $this->load->helper('string');

        $client_email = $this->input->post('client_email');

        $msg_exist = $this->message_model->check_if_exist($client_email);
        
        $string_id    = ($msg_exist)? $msg_exist->unique_id_string : random_string('alnum', 16);
        $client_id    = $this->input->post('client_id');
        $admin_email  = $string_id.'+apps@handycarloans.com.au'; //$this->input->post('admin_email');
        $admin_name   = $this->input->post('admin_name');
        $subject      = 'Notice from Handy Car Loans'; // $this->input->post('email-subject');
        $date         = date('Y-m-d H:i:s', time());

        $data = array(
            'email_content' => $this->input->post('email-content'),
            'admin_name'    => $admin_name,
            'admin_email'   => $admin_email
        );

        $content = $this->parser->parse('backend/email_thread_template', $data, TRUE);

        $this->email->from($admin_email, $admin_name);
        $this->email->to($client_email);

        $this->email->subject( $subject );
        $this->email->message( $content );

        $msg_data = array(
            'client_email' => $client_email, 
            'message' => $this->input->post('email-content'), 
            'has_read' => 1, 
            'unique_id_string' => $string_id, 
            'from' => $admin_name, 
            'time_sent' => $date
        );

        if( $this->email->send() ) {
            $this->message_model->add_message($msg_data);
            echo 'success';
        } else {
            echo 'failed';
        }
    }

    public function send_templated_email()
    {
        $this->load->library(array('email', 'parser', 'encrypt'));
        $this->load->model('backend/email_model', 'email_model');
        $this->load->model('backend/document_model', 'document_model');
        $this->load->model('backend/application');

        $applicant_data = $this->application->view_application_by_id('users_application', $this->input->post('applicant_id'));

        $client_email = $this->input->post('client_email');
        $admin_email  = 'noreply@handycarloans.com.au';
        $subject      = 'Email Notice from Handy Car Loans';
        $template_id  = $this->input->post('template_id');
        $date         = date('Y-m-d H:i:s', time() );
        $name         = $applicant_data->fname . ' ' . $applicant_data->lname;

        if($template_id == 4)
            $template = $this->email_model->get_template( 1 );
        else 
            $template = $this->email_model->get_template( $template_id );

        $email_data = array(
            // Common contents for email
            'name'           => $name,
            'application_id' => $this->input->post('applicant_id'),

            // Template contents for email
            'heading'     => $template->heading,
            'sub_heading' => $template->sub_heading,
            'content'     => $template->content
        );

        // Specific for Document Requested Email
        if($template_id == 1) {
            $email_data['url'] = base_url().'documentuploader/'.$this->urlparser->encode($this->input->post('applicant_id')).'/1';
            foreach($this->input->post('doc') as $data) {
                $email_data['documents'][] = array(
                    'document' => $data
                );
            }
        }

        // print_r($email_data);

        $config['mailtype']  = "html"; 
        $this->email->initialize($config); 

        if($template_id == 1) {
            $content = $this->parser->parse('backend/email_template/email_required_template_doc', $email_data, TRUE);
        } elseif($template_id == 2) {
            $content = $this->parser->parse('backend/email_template/email_complete_template', $email_data, TRUE);
        } elseif($template_id == 3) {
            $content = $this->parser->parse('backend/email_template/email_approved_template', $email_data, TRUE);
        } elseif($template_id == 4) {
            $email_data['url'] = base_url().'documentuploader/'.$this->urlparser->encode($this->input->post('applicant_id')).'/4';
            $content = $this->parser->parse('backend/email_template/email_required_template', $email_data, TRUE);
        }  

        $this->email->from($admin_email, 'Handy Car Loans');
        $this->email->to($client_email);

        $this->email->subject( $subject );
        $this->email->message( $content );

        if( $this->email->send() ) {
            if( $template_id == 1 || $template_id == 4 ) {
                $data_log = array(
                    'date_sent'            => $date,
                    'users_application_id' => $this->input->post('applicant_id')
                );

                $date_expire = date('Y-m-d H:i:s', strtotime( $date." + 14 days") );

                if($template_id == 1) {
                    $data_log['message']        = 'Request Sent';
                    $data_log['requested_docs'] = implode(',', $this->input->post('doc'));
                } elseif($template_id == 4) {
                    $data_log['message'] = 'Auto Sent';
                }

                $id = $this->document_model->add_log( $data_log );

                $data_url = array(
                    'date_sent' => $date,
                    'date_expire' => $date_expire,
                    'url' => $email_data['url']
                );

                $this->document_model->link_expire($data_url);
            }
            echo 'success';
        } else {
            echo 'failed';
        }
    }
} 
