<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
        /*if (!$this->session->userdata('admin_access')) {
            redirect('/login', 'location');
        }*/
        $this->load->model('frontend/cms/cms_frontend_model');
    }

    public function index($page_name = 'index', $sub_page = '') {
        $url_path = uri_string();
        if($url_path == 'page/index') {
            redirect('', 'location');
        }

        if ($page_name == '') {
            $page_name = 'index';
        }

        $page = ((file_exists('application/views/frontend/' . $page_name . '.php')) ? $page_name : 'index');
        $title = ( $page == 'index' ) ? 'Homepage' : ucwords(str_replace('_', ' ', $page));

        $header_contents = $this->cms_frontend_model->get_header();
        $image_alt_text  = $this->cms_frontend_model->get_alt_text();

        $term_of_use = $this->term_of_use();

        if (file_exists('application/views/frontend/' . $page_name . '.php')) {
            $page_content = $this->cms_frontend_model->get_page_content($page);
            $page_widgets = $this->cms_frontend_model->get_page_widgets($page);
        } else {
            $page_content = $this->cms_frontend_model->get_page_content($page_name);
            $page_widgets = $this->cms_frontend_model->get_page_widgets($page_name);
        }

        if(!$page_content && !$page_widgets) {
            show_404();
        }

        $template = 'defaulttemplate';
        if ($page_content) {
            if ($page_content->layout_id != '') {
                $template = ((file_exists('application/views/frontend/templates/' . $page_content->layout_id . '.php')) ? $page_content->layout_id : 'defaulttemplate');
            }
        }

        $header_data = array(
            'pagetitle' => $page_content->browser_title,
            'header_contents' => $header_contents,
            'header_alt_text' => $image_alt_text
        );

        $content_data = array(
            'term_of_use' => $term_of_use,
            'page_content' => $page_content,
        );

        $footer_contents = $this->cms_frontend_model->get_footer();

        $footer_data = array(
            'js_file' => 'frontend/' . $page_name . '.js',
            'term_of_use' => $term_of_use,
            'footer_contents' => $footer_contents,
            'footer_alt_text' => $image_alt_text
        );

        $data = array(
            'header_data' => $header_data,
            'content_data' => $content_data,
            'page_widgets' => $page_widgets,
            'footer_data' => $footer_data,
            'page' => $page,
            'fileexist' => file_exists('application/views/frontend/' . $page_name . '.php'),
            'template' => $template
        );
        $data['meta_title'] = @$page_content->meta_title;
        $data['meta_keywords'] = @$page_content->meta_keywords;
        $data['meta_description'] = @$page_content->meta_description;
        $this->load->view('frontend/templates/' . $template, $data);
    }

    public function validate_captcha() {
        if ($this->input->is_ajax_request()) {
            $valid = ($this->input->post('captcha') == $this->session->userdata('captcha_answer')) ? true : false;

            if ($valid) {
                echo json_encode(array('valid' => TRUE));
            } else {
                echo json_encode(array('valid' => FALSE, 'captcha' => $this->generate_captcha()));
            }
        }
    }

    public function send_message() {
        $error = '';
        $fileElementName = 'myfiles';
        $root_dir = DIRNAME(DIRNAME(DIRNAME(DIRNAME(__FILE__))));
        $flag = 0;
        $path = '';

        if ($this->input->post()) {
            $this->load->model('frontend/registration_model', 'register_model');
            $this->load->model('backend/contact_model', 'contact');

            $contact_email = $this->contact->get_contact();

            $postData = $this->input->post();
            if(!empty($postData)) {
                $this->load->library('email');
                $data = array(
                    'fname' => $this->input->post('fname'),
                    'lname' => $this->input->post('lname'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'message' => $this->input->post('msg'),
                    'best_contact' => $this->input->post('contact_method'),
                    'topic' => $this->input->post('topic'),
                    'ip' => $this->input->ip_address()
                );

                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from($this->input->post('email'), 'Customer Enquiry');
                $this->email->to($contact_email->email); //enquiries@handycarloans.com.au

                $this->email->subject('Enquiry');
                $html = $this->load->view('frontend/emails_tpl/contact', $data, TRUE);
                $this->email->message($html);

                if ($_FILES) {
                    for ($x = 0; $x < count($_FILES['myfiles']['name']); $x++) {
                        if (!empty($_FILES[$fileElementName]['error'][$x])) {
                            $error = 'Error';
                        } elseif (empty($_FILES[$fileElementName]['tmp_name'][$x]) || $_FILES[$fileElementName]['tmp_name'][$x] == 'none') {
                            $error = 'No file was uploaded..';
                        } else {
                            $name = $_FILES[$fileElementName]['name'][$x];
                            $path = $root_dir . '/temp/';

                            move_uploaded_file($_FILES[$fileElementName]['tmp_name'][$x], $path . '' . $name);
                            $this->email->attach($path . '' . $name);
                        }
                        $flag++;
                    }
                }

                $this->email->send();
                if ($flag != 0) {
                    for ($x = 0; $x < count($_FILES['myfiles']['name']); $x++) {
                        $name = $_FILES[$fileElementName]['name'][$x];

                        if( $path != '' ) {
                            unlink($path . '' . $name);
                        }
                    }
                }

                $msg_data = $this->register_model->get_form_submit_message( 'CF', 'success' );

                $message = '<div class="alert alert-success alert-block"><h4>'.$msg_data->heading.'</h4><p>'.$msg_data->message.'</p></div>';
                $this->session->set_flashdata('message', $message);
            } else {
                $msg_data = $this->register_model->get_form_submit_message( 'CF', 'error' );

                $message = '<div class="alert alert-danger alert-block"><h4 style="color: #B94A48;">'.$msg_data->heading.'</h4><p>'.$msg_data->message.'</p></div>';
                $this->session->set_flashdata('message', $message);
            }
        }
        redirect('contact-us');
    }

    private function generate_captcha() {
        $operation = array(
            '1' => '+',
            '2' => '-'
        );

        $num1 = rand(1, 10);
        $num2 = rand(1, 10);

        $operator = $operation[rand(1, 2)];

        if ($operator == '+') {
            $answer = $num1 + $num2;
        } else {
            $answer = $num1 - $num2;
        }
        $this->session->unset_userdata('captcha_answer');
        $this->session->set_userdata('captcha_answer', $answer);
        return array(
            'num1' => $num1,
            'num2' => $num2,
            'operator' => $operator
        );
    }

    public function contact() {

        $header_contents = $this->cms_frontend_model->get_header();
        $image_alt_text  = $this->cms_frontend_model->get_alt_text();

        $content_data['message'] = $this->session->flashdata('message') ? $this->session->flashdata('message') : '';

        $page = 'contact-us';
        $page_content = $this->cms_frontend_model->get_page_content($page);

        $template = 'defaulttemplate';
        if ($page_content) {
            if ($page_content->layout_id != '') {
                $template = ((file_exists('application/views/frontend/templates/' . $page_content->layout_id . '.php')) ? $page_content->layout_id : 'defaulttemplate');
            }
        }

        $header_data = array(
            'pagetitle' => $page_content->browser_title,
            'js_file' => array('jquery.MultiFile.js', 'frontend/contact-us.js'),
            'header_contents' => $header_contents,
            'header_alt_text' => $image_alt_text
        );
        //$header_data['pagesubtitle'] = @$page_content->sub_title;

        $page_widgets = $this->cms_frontend_model->get_page_widgets('contact-us');

        $captcha = $this->generate_captcha();
        $content_data['operator'] = $captcha['operator'];
        $content_data['num1'] = $captcha['num1'];
        $content_data['num2'] = $captcha['num2'];
        $content_data['page_content'] = $page_content;

        $footer_contents = $this->cms_frontend_model->get_footer();
        $footer_data = array(
            'term_of_use' => $this->term_of_use(),
            'footer_contents' => $footer_contents,
            'footer_alt_text' => $image_alt_text
        );

        $data = array(
            'header_data' => $header_data,
            'content_data' => $content_data,
            'footer_data' => $footer_data,
            'page_widgets' => $page_widgets,
            'page' => $page,
            'fileexist' => file_exists('application/views/frontend/' . $page . '.php'),
            'template' => $template
        );
        $data['meta_title'] = @$page_content->meta_title;
        $data['meta_keywords'] = @$page_content->meta_keywords;
        $data['meta_description'] = @$page_content->meta_description;
        $this->load->view('frontend/templates/' . $template, $data);
    }

    public function term_of_use() {
        $this->load->model('frontend/terms_model', 'terms');
        return $this->terms->get_terms();
    }

}