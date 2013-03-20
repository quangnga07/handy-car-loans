<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        /*if( !$this->session->userdata('admin_access') ) {
        	redirect('/login', 'location');
        }*/
        $this->load->model('frontend/cms/cms_frontend_model');
        $this->load->model('frontend/terms_model', 'terms_model');
    }

    public function index($step = 1) {

        $this->load->model('frontend/score_model', 'score_model');
        $this->load->model('frontend/registration_model', 'register_model');
        $table = 'users_application';

        $header_contents = $this->cms_frontend_model->get_header();
        $image_alt_text  = $this->cms_frontend_model->get_alt_text();
        $page_content = $this->cms_frontend_model->get_page_content('step'.$step);
		$page_widgets = $this->cms_frontend_model->get_page_widgets('step'.$step);
		$content_data = array(
			'page_content' => $page_content,
		);

        $header_data = array(
            'pagetitle' => $page_content->browser_title,
            //'pagesubtitle' => 'Apply For Loan',
            'header_contents'=>$header_contents,
            'header_alt_text' => $image_alt_text
        );

        $data = array();

		$data['meta_title'] = @$page_content->meta_title;
		$data['meta_keywords'] = @$page_content->meta_keywords;
		$data['meta_description'] = @$page_content->meta_description;

        $data['applicant_id'] = $this->session->userdata('applicant_id');
        $data['applicant_data'] = $this->register_model->get_applicants_by_id($table, $data['applicant_id']);
        $data['score_rs'] = $this->score_model->get_score('RS');
        $data['score_tca'] = $this->score_model->get_score('TCA');
        $data['score_lp'] = $this->score_model->get_score('LP');
        $data['score_es'] = $this->score_model->get_score('ES');
        $data['score_el'] = $this->score_model->get_score('EL');
        $data['missing_field'] = array();
        $applicant = $data['applicant_data'];
        $score_rs = $data['score_rs'];
        $score_tca = $data['score_tca'];
        $score_lp = $data['score_lp'];
        $score_es = $data['score_es'];
        $score_el = $data['score_el'];

        $this->load->model('backend/fields_model', 'fields');

        if($step == 4){
            $this->load->helper('fs4');
            $ref1_fields = $this->fields->get_by_category('ref1', 1, array('order', 'name'));
            $ref2_fields = $this->fields->get_by_category('ref2', 1, array('order', 'name'));

            $ref1 = '';

            foreach ($ref1_fields as $a) {
                $ref1 .= ref1_html($a->name, $applicant);
            }
            $data['ref1_fields'] = $ref1;

            $ref2 = '';

            foreach ($ref2_fields as $a) {
                $ref2 .= ref2_html($a->name, $applicant);
            }
            $data['ref2_fields'] = $ref2;

        }

        if($step == 3){
            $this->load->helper('fs3');
            $expenses_fields = $this->fields->get_by_category('expenses', 1, array('order', 'name'));
            $bank_fields = $this->fields->get_by_category('bank', 1, array('order', 'name'));

            $expenses = '';

            foreach ($expenses_fields as $a) {
                $expenses .= expenses_html($a->name, $applicant);
            }
            $data['expenses_fields'] = $expenses;

            $bank = '';

            foreach ($bank_fields as $a) {
                $bank .= bank_html($a->name, $applicant);
            }
            $data['bank_fields'] = $bank;

        }

        if ($step == 2) {
            $this->load->helper('fs2');
            $employment_fields = $this->fields->get_by_category('employment', 1, array('order', 'name'));
            $employer_fields = $this->fields->get_by_category('employer', 1, array('order', 'name'));

            $employment = '';
            $next_payday = 'false';
            foreach ($employment_fields as $a) {
                $employment .= employment_html($a->name, $applicant, $score_es, $score_el);
                if($a->name == 'next_payday'){
                    $next_payday = 'true';
                }
            }
            $data['employment_fields'] = $employment;

            $employer = '';

            foreach ($employer_fields as $a) {
                $employer .= employer_html($a->name, $applicant);
            }
            $data['employer_fields'] = $employer;
            $data['next_payday'] = $next_payday;
        }
        if ($step == 1) {
            $this->load->helper('fs1');

            $personal_fields = $this->fields->get_by_category('personal', 1, array('order', 'name'));
            $address_fields = $this->fields->get_by_category('address', 1, array('order', 'name'));
            $contact_fields = $this->fields->get_by_category('contact', 1, array('order', 'name'));
            $loan_fields = $this->fields->get_by_category('loan', 1, array('order', 'name'));

            $personal = '';

            foreach ($personal_fields as $a) {
                $personal .= personal_html($a->name, $applicant);
            }
            $data['personal_fields'] = $personal;

            $address = '';

            foreach ($address_fields as $a) {
                $address .= address_html($a->name, $applicant, $score_rs, $score_tca);
            }
            $data['address_fields'] = $address;


            $contact = '';

            foreach ($contact_fields as $a) {
                $contact .= contact_html($a->name, $applicant);
            }
            $data['contact_fields'] = $contact;

            $loan = '';

            foreach ($loan_fields as $a) {
                $loan .= loan_html($a->name, $applicant, $score_lp);
            }
            $data['loan_fields'] = $loan;
        }


        $footer_contents = $this->cms_frontend_model->get_footer();
        $footer_data = array(
            'js_file' => 'frontend/application_form_' . $step . '.js',
            'footer_contents' => $footer_contents,
            'footer_alt_text' => $image_alt_text
        );

        if ($step == 5) {
            $this->load->model('backend/cms/cms_model', 'cms_model');
            
            $data['terms'] = $this->terms_model->get_terms();
            $data['dec']   = $this->cms_model->get_declaration();
        }


        if($step == 6) {
            $this->load->model('backend/scores_model', 'score');

            $ranking    = $this->score->get_rank();
            $user_score = $this->score->get_total( $data['applicant_id'] );

            foreach( $ranking as $ranks ) {
            if( $ranks->max >= $user_score->total && $ranks->min <= $user_score->total ) {
                    $rank = $ranks->rank;
                }
            }

            if($this->input->post('submit_later')) {
                $this->session->set_flashdata('submit_later', true);
            }

            if( $rank == 'X' ) {
                $data['show_notice'] = 'Yes';    
            } else {
                $data['show_notice'] = 'No';
            }
        }

        // get the pre-setting message set on the backend
        $data['messages'] = $this->register_model->get_form_submit_message( 'FS' );
        if($step == 1 && $this->session->flashdata('applicant_exist')) {
            $data['wb_message'] = $this->register_model->get_form_submit_message('WB', 'notice');
        }

		$template = 'defaulttemplate';
		if($page_content){
			if($page_content->layout_id!=''){
				$template = ((file_exists('application/views/frontend/templates/' . $page_content->layout_id . '.php')) ? $page_content->layout_id : 'defaulttemplate');
			}
		}

		$data['header_data'] =  $header_data;
		$data['content_data'] =  $content_data;
		$data['page_widgets'] =  $page_widgets;
		$data['footer_data'] =  $footer_data;
		$data['page'] =  'application_form_' . $step;
		$data['fileexist'] = file_exists('application/views/frontend/application_form_' . $step . '.php');
		$data['template']=$template;

        $this->load->view('frontend/templates/application/'.$template, $data);

        /* $this->load->view('frontend/includes/header', $header_data);
        $this->load->view('frontend/application_form_' . $step, $data);
        $this->load->view('frontend/includes/footer', $footer_data); */
    }

    public function ajax_apply() {
        $this->load->model('frontend/registration_model', 'register_model');
        $table = 'users_application';

        $fields = array(
            'title' => $this->input->post('title'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'user_mobile_phone' => $this->input->post('phone'),
            'user_email' => $this->input->post('email'),
            'has_fill' => 'No',
            'application_status' => 2,
            'date_submitted' => date('Y-m-d H:i:s'),
        );

        $result = $this->register_model->insert_data($fields, $table);
        if ($result)
            echo $result;
        else
            echo 'error';
        die();
    }

    public function duplicate_check() 
    {
        $this->load->library('Minit');
        if( $this->minit->email_mobile_check( $this->input->post('email'), $this->input->post('phone') ) ) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function second_duplicate_check()
    {
        $this->load->model('frontend/registration_model', 'register_model');
        $this->load->model('backend/application', 'application');
        $this->load->library('Minit');

        $applicant = $this->register_model->get_applicants_by_id('users_application', $this->input->post('id'));
        $data = array(
            'fname' => $applicant->fname,
            'lname' => $applicant->lname,
            'unit_num' => $applicant->unit_num,
            'street_num' => $applicant->street_num,
            'street_name' => $applicant->street_name,
            'birth_date' => $applicant->birth_date,
            'birth_month' => $applicant->birth_month,
            'birth_year' => $applicant->birth_year,
        );

        $dob = $applicant->birth_date.'/'.$applicant->birth_month.'/'.$applicant->birth_year;

        $status = $this->minit->name_dob_check($applicant->fname, $applicant->mname, $applicant->lname, $dob);

        if (strpos($status,'No Match') !== false) {
            $otherApplicant = $this->register_model->get_applicants_by_name($data);
            foreach($otherApplicant as $app) {
                if($app->application_status == 2) {
                    echo 'No Exist';
                } else {
                    $this->session->set_flashdata('existing_on_system', true);
                    $this->application->delete_dup_client_record($this->input->post('id'));
                    echo 'Exist';
                }
            }
        } else {
            $this->session->set_flashdata('existing_on_system', true);
            $this->application->delete_dup_client_record($this->input->post('id'));
            echo 'Exist';
        }
    }

    public function process_registration() {
        $this->load->model('frontend/registration_model', 'register_model');
        $this->load->model('backend/application', 'backend_application');
        $this->load->library('Minit');
        $table = 'users_application';

        $fields = array(
            'title' => $this->input->post('title'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'user_mobile_phone' => $this->input->post('phone'),
            'user_email' => $this->input->post('email'),
            'has_fill' => 'No',
            'application_status' => 2,
            'date_submitted' => date('Y-m-d H:i:s'),
			'term_version' => (int)$this->input->post('term_version'),
        );

        $fields_check = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'user_mobile_phone' => $this->input->post('phone'),
            'user_email' => $this->input->post('email'),
            'has_fill' => 'No',
            'application_status' => 2
        );

        /* if( $this->minit->email_mobile_check( $this->input->post('email'), $this->input->post('phone') ) ) {
            $this->session->set_flashdata('minit_check', true);
            redirect('', 'location');
        } else {*/
            $check = $this->register_model->check_if_registered($fields_check);
            if (!$check) {
                $result = $this->register_model->insert_data($fields, $table);

                if ($result) {
                    //---- insert application brand
                    $brand_data = array(
                        'users_application_id' => $result,
                        'brand'                => 'Handy Car Loans'
                    );
                    $this->backend_application->add_settings( $brand_data );

                    $this->session->set_userdata('applicant_id', $result);
                }
            } else {
                $this->session->set_userdata('applicant_id', $check->id);
                $this->session->set_flashdata('applicant_exist', true);
            }

            redirect('apply', 'location');
        // } 
    }

    public function autosave() {
        
        $this->load->model('frontend/registration_model', 'register_model');
        if ($this->input->post('fields')) {
            $id = $this->input->post('id');
            $table = 'users_application';
            $field = str_replace('-', '_', $this->input->post('fields'));

            if ($field == 'birthday' || $field == 'next_payday') {
                $date = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('values'))));

                $fields = array(
                    $field => $date
                );
            } else {
                $fields = array(
                    $field => $this->input->post('values')
                );
            }

            $this->register_model->update_data($fields, $table, $id);
        }
    }

    /* public function save_form()
      {
      $this->load->model( 'frontend/registration_model', 'register_model' );
      $table  = 'test';

      print_r( $fields ); die();

      $result = $this->register_model->update_data( $fields, $table, $id );

      if( $result ) echo 'ok';
      else echo 'error';
      die();
      } */
}