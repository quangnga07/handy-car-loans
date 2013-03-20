<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->helper("ckeditor");
        $this->load->library("pagination");

        notification_check();
    }

    private function _load_template($template_file, $data = NULL) {
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

    public function index($offset = 0) {
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/message_model', 'message_model');

        $data['tank1_applicants'] = $this->application->get_tank1_applicants();
        $data['tank2_applicants'] = $this->application->get_tank_applicants( 2 );
        $data['tank3_applicants'] = $this->application->get_tank_applicants( 3 );
        $data['tank4_applicants'] = $this->application->get_tank_applicants( 4 );
        $data['tank5_applicants'] = $this->application->get_tank_applicants( 5 );
        $data['tank6_applicants'] = $this->application->get_tank6_applicants();
        $data['ranking']          = $this->application->get_rank();

        //count all applicants by tank
        /*$data['tank1_applicants_read'] = array();

        foreach($data['tank1_applicants'] as $app_data) {
            if( $app_data->has_read == 1) {
                array_push($data['tank1_applicants_read'], $app_data);
            }
        }*/

        $data['tank1'] = $this->application->total_applicants_tank1();
        $data['tank2'] = $this->application->count_applicants_by_tank( 2 );
        $data['tank3'] = $this->application->count_applicants_by_tank( 3 );
        $data['tank4'] = $this->application->count_applicants_by_tank( 4 );
        $data['tank5'] = $this->application->count_applicants_by_tank( 5 );
        $data['tank6'] = $this->application->total_applicants_tank6();

        $data['tank1_applicants_unread'] = array();
        foreach($data['tank1'] as $app_data) {
            if( $app_data->has_read == 0) {
                array_push($data['tank1_applicants_unread'], $app_data);
            }
        }
        foreach($data['tank2'] as $app_data) {
            if( $app_data->has_read == 0) {
                array_push($data['tank1_applicants_unread'], $app_data);
            }
        }

        $this->_load_template('backend/dashboard', $data);
    }

	public function ajax_homepage_contents(){
		if($this->input->is_ajax_request()){	// to insure, the request should be ajax based.
			$call_action_headline	= $this->input->post('call_action_headline');
			$call_action_text		= $this->input->post('call_action_text');
			$disclaimer_text		= $this->input->post('disclaimer_text');
			$header_headline		= $this->input->post('header_headline');
			$header_tagline			= $this->input->post('header_tagline');
			$help1_ico_text			= $this->input->post('help1_ico_text');
			$help1_ico_url			= $this->input->post('help1_ico_url');
			$help2_ico_text			= $this->input->post('help2_ico_text');
			$help2_ico_url			= $this->input->post('help2_ico_url');
			$help3_ico_text			= $this->input->post('help3_ico_text');
			$help3_ico_url			= $this->input->post('help3_ico_url');
			$help4_ico_text			= $this->input->post('help4_ico_text');
			$help4_ico_url			= $this->input->post('help4_ico_url');
			$main_content_headline	= $this->input->post('main_content_headline');
			$main_content_text		= $this->input->post('main_content_text');
			$mini_app_headline		= $this->input->post('mini_app_headline');
			$mini_app_url			= $this->input->post('mini_app_url');
			$step1					= $this->input->post('step1');
			$step2					= $this->input->post('step2');
			$step3					= $this->input->post('step3');
			$step4					= $this->input->post('step4');
			$options				= array('call_action_headline'=>$call_action_headline,'call_action_text'=>$call_action_text,'disclaimer_text'=>$disclaimer_text,'header_headline'=>$header_headline,'header_tagline'=>$header_tagline,'help1_ico_text'=>$help1_ico_text,'help1_ico_url'=>$help1_ico_url,'help2_ico_text'=>$help2_ico_text,'help2_ico_url'=>$help2_ico_url,'help3_ico_text'=>$help3_ico_text,'help3_ico_url'=>$help3_ico_url,'help4_ico_text'=>$help4_ico_text,'help4_ico_url'=>$help4_ico_url,'main_content_headline'=>$main_content_headline,'main_content_text'=>$main_content_text,'mini_app_headline'=>$mini_app_headline,'mini_app_url'=>$mini_app_url,'step1'=>$step1,'step2'=>$step2,'step3'=>$step3,'step4'=>$step4);

			$home_page_contents = $this->cms->__getHomePageContents();
			if(count($home_page_contents)>0){
				$this->cms->__updateHomePageContents($options);
			}else{
				$this->cms->__addHomePageContents($options);
			}


			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array(
					'message'   => 'Contents updated successfully',
			)));

		}
	}
    public function home_page_contents($offset = 0) {
        $this->load->model('backend/application', 'application');
		$data['home_page_contents'] =  $this->cms->__getHomePageContents();
        $this->_load_template('backend/home_page_contents', $data);
    }

    public function incomplete_application($offset = 0) {
        $this->load->model('backend/application', 'application');

        $data['incomplete_apps'] = $this->application->get_all_incomplete_applicants();
        $data['total_count']     = $this->application->total_applicants_tank1();

        $this->_load_template('backend/incomplete_applicants', $data);
    }

    public function required_documents($offset = 0) {
        $this->load->model('backend/application', 'application');

        $data['required_docs'] = $this->application->get_all_applicants( 2 );
        $data['ranking']       = $this->application->get_rank();
        $data['total_count']   = $this->application->count_applicants_by_tank( 2 );

        $this->_load_template('backend/required_documents', $data);
    }

    public function staff_processing($offset = 0) {
        $this->load->model('backend/application', 'application');

        $data['staff_process'] = $this->application->get_all_applicants( 3 );
        $data['ranking']       = $this->application->get_rank();
        $data['total_count']   = $this->application->count_applicants_by_tank( 3 );

        $this->_load_template('backend/staff_processing', $data);
    }

    public function supervisor_approval($offset = 0) {
        $this->load->model('backend/application', 'application');

        $data['supervisor_approval'] = $this->application->get_all_applicants( 4 );
        $data['ranking']             = $this->application->get_rank();
        $data['total_count']         = $this->application->count_applicants_by_tank( 4 );

        $this->_load_template('backend/supervisor_approval', $data);
    }

    public function archived($offset = 0) {
        $this->load->model('backend/application', 'application');

        $data['archived']    = $this->application->get_all_applicants( 5 );
        $data['ranking']     = $this->application->get_rank();
        $data['total_count'] = $this->application->count_applicants_by_tank( 5 );

        $this->_load_template('backend/archived', $data);
    }

    public function marketing_queue($offset = 0) {
        $this->load->model('backend/application', 'application');

        $data['marketing_queue'] = $this->application->get_all_marketing_queue();
        $data['ranking']         = $this->application->get_rank();
        $data['total_count']     = $this->application->total_applicants_tank6();

        $this->_load_template('backend/marketing_queue', $data);
    }

    public function login() {
        $data = array();
        $data['action'] = site_url('admin/process_login');

        $this->load->view('backend/login', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/admin/login', 'location');
    }

    public function configure_fields_update() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('backend/fields_model', 'fields');

            if ($this->input->post('category') == 'ref2') {

                $this->fields->delete_by_category('ref2');

                $data = array(
                    array(
                        'category' => 'ref2',
                        'name' => 'ref2_name',
                        'status' => $this->input->post('ref2_name_status'),
                        'order' => $this->input->post('ref2_name_order'),
                        'label' => 'Name'
                    ), array(
                        'category' => 'ref2',
                        'name' => 'ref2_relationship',
                        'status' => $this->input->post('ref2_relationship_status'),
                        'order' => $this->input->post('ref2_relationship_order'),
                        'label' => 'Relationship'
                    ), array(
                        'category' => 'ref2',
                        'name' => 'ref2_home_phone',
                        'status' => $this->input->post('ref2_home_phone_status'),
                        'order' => $this->input->post('ref2_home_phone_order'),
                        'label' => 'Home Phone'
                    ), array(
                        'category' => 'ref2',
                        'name' => 'ref2_mobile_phone',
                        'status' => $this->input->post('ref2_mobile_phone_status'),
                        'order' => $this->input->post('ref2_mobile_phone_order'),
                        'label' => 'Mobile Phone'
                    ), array(
                        'category' => 'ref2',
                        'name' => 'ref2_street_no',
                        'status' => $this->input->post('ref2_street_no_status'),
                        'order' => $this->input->post('ref2_street_no_order'),
                        'label' => 'Unit No. / Street No.'
                    ), array(
                        'category' => 'ref2',
                        'name' => 'ref2_street_name',
                        'status' => $this->input->post('ref2_street_name_status'),
                        'order' => $this->input->post('ref2_street_name_order'),
                        'label' => 'Street Name'
                    ),
                    array(
                        'category' => 'ref2',
                        'name' => 'ref2_city',
                        'status' => $this->input->post('ref2_city_status'),
                        'order' => $this->input->post('ref2_city_order'),
                        'label' => 'City / Suburb'
                    ), array(
                        'category' => 'ref2',
                        'name' => 'ref2_state_postcode',
                        'status' => $this->input->post('ref2_state_postcode_status'),
                        'order' => $this->input->post('ref2_state_postcode_order'),
                        'label' => 'State & Postcode'
                        ));

                $this->fields->insert_batch($data);
            }

            if ($this->input->post('category') == 'ref1') {

                $this->fields->delete_by_category('ref1');

                $data = array(
                    array(
                        'category' => 'ref1',
                        'name' => 'ref1_name',
                        'status' => $this->input->post('ref1_name_status'),
                        'order' => $this->input->post('ref1_name_order'),
                        'label' => 'Name'
                    ), array(
                        'category' => 'ref1',
                        'name' => 'ref1_relationship',
                        'status' => $this->input->post('ref1_relationship_status'),
                        'order' => $this->input->post('ref1_relationship_order'),
                        'label' => 'Relationship'
                    ), array(
                        'category' => 'ref1',
                        'name' => 'ref1_home_phone',
                        'status' => $this->input->post('ref1_home_phone_status'),
                        'order' => $this->input->post('ref1_home_phone_order'),
                        'label' => 'Home Phone'
                    ), array(
                        'category' => 'ref1',
                        'name' => 'ref1_mobile_phone',
                        'status' => $this->input->post('ref1_mobile_phone_status'),
                        'order' => $this->input->post('ref1_mobile_phone_order'),
                        'label' => 'Mobile Phone'
                    ), array(
                        'category' => 'ref1',
                        'name' => 'ref1_street_no',
                        'status' => $this->input->post('ref1_street_no_status'),
                        'order' => $this->input->post('ref1_street_no_order'),
                        'label' => 'Unit No. / Street No.'
                    ), array(
                        'category' => 'ref1',
                        'name' => 'ref1_street_name',
                        'status' => $this->input->post('ref1_street_name_status'),
                        'order' => $this->input->post('ref1_street_name_order'),
                        'label' => 'Street Name'
                    ),
                    array(
                        'category' => 'ref1',
                        'name' => 'ref1_city',
                        'status' => $this->input->post('ref1_city_status'),
                        'order' => $this->input->post('ref1_city_order'),
                        'label' => 'City / Suburb'
                    ), array(
                        'category' => 'ref1',
                        'name' => 'ref1_state_postcode',
                        'status' => $this->input->post('ref1_state_postcode_status'),
                        'order' => $this->input->post('ref1_state_postcode_order'),
                        'label' => 'State & Postcode'
                        ));

                $this->fields->insert_batch($data);
            }

            if ($this->input->post('category') == 'bank') {

                $this->fields->delete_by_category('bank');

                $data = array(
                    array(
                        'category' => 'bank',
                        'name' => 'bank_name',
                        'status' => $this->input->post('bank_name_status'),
                        'order' => $this->input->post('bank_name_order'),
                        'label' => 'Bank Name'
                    ), array(
                        'category' => 'bank',
                        'name' => 'account_name',
                        'status' => $this->input->post('account_name_status'),
                        'order' => $this->input->post('account_name_order'),
                        'label' => 'Name on Account'
                    ), array(
                        'category' => 'bank',
                        'name' => 'bsb',
                        'status' => $this->input->post('bsb_status'),
                        'order' => $this->input->post('bsb_order'),
                        'label' => 'BSB'
                    ), array(
                        'category' => 'bank',
                        'name' => 'account_number',
                        'status' => $this->input->post('account_number_status'),
                        'order' => $this->input->post('account_number_order'),
                        'label' => 'Account Number'
                        ));

                $this->fields->insert_batch($data);
            }


            if ($this->input->post('category') == 'expenses') {

                $this->fields->delete_by_category('expenses');

                $data = array(
                    array(
                        'category' => 'expenses',
                        'name' => 'rent_payment',
                        'status' => $this->input->post('rent_payment_status'),
                        'order' => $this->input->post('rent_payment_order'),
                        'label' => 'Mortgage/Rent Payment Frequency'
                    ), array(
                        'category' => 'expenses',
                        'name' => 'rent_month',
                        'status' => $this->input->post('rent_month_status'),
                        'order' => $this->input->post('rent_month_order'),
                        'label' => 'Mortgage/Rent per month'
                    ), array(
                        'category' => 'expenses',
                        'name' => 'living_expenses',
                        'status' => $this->input->post('living_expenses_status'),
                        'order' => $this->input->post('living_expenses_order'),
                        'label' => 'Living Expenses per month'
                    ), array(
                        'category' => 'expenses',
                        'name' => 'loans_month',
                        'status' => $this->input->post('loans_month_status'),
                        'order' => $this->input->post('loans_month_order'),
                        'label' => 'Loans per month'
                    ), array(
                        'category' => 'expenses',
                        'name' => 'credit_cards',
                        'status' => $this->input->post('credit_cards_status'),
                        'order' => $this->input->post('credit_cards_order'),
                        'label' => 'Credit Cards per month'
                    ), array(
                        'category' => 'expenses',
                        'name' => 'debits_month',
                        'status' => $this->input->post('debits_month_status'),
                        'order' => $this->input->post('debits_month_order'),
                        'label' => 'Other Debits per month'
                        ));

                $this->fields->insert_batch($data);
            }

            if ($this->input->post('category') == 'personal') {

                $this->fields->delete_by_category('personal');

                $data = array(
                    array(
                        'category' => 'personal',
                        'name' => 'title',
                        'status' => $this->input->post('title_status'),
                        'order' => $this->input->post('title_order'),
                        'label' => 'Title'
                    ), array(
                        'category' => 'personal',
                        'name' => 'first_name',
                        'status' => $this->input->post('first_name_status'),
                        'order' => $this->input->post('first_name_order'),
                        'label' => 'First Name'
                    ), array(
                        'category' => 'personal',
                        'name' => 'last_name',
                        'status' => $this->input->post('last_name_status'),
                        'order' => $this->input->post('last_name_order'),
                        'label' => 'Last Name'
                    ), array(
                        'category' => 'personal',
                        'name' => 'middle_name',
                        'status' => $this->input->post('middle_name_status'),
                        'order' => $this->input->post('middle_name_order'),
                        'label' => 'Middle Name'
                    ), array(
                        'category' => 'personal',
                        'name' => 'date_of_birth',
                        'status' => $this->input->post('date_of_birth_status'),
                        'order' => $this->input->post('date_of_birth_order'),
                        'label' => 'Date of Birth'
                    ), array(
                        'category' => 'personal',
                        'name' => 'drivers_license',
                        'status' => $this->input->post('drivers_license_status'),
                        'order' => $this->input->post('drivers_license_order'),
                        'label' => 'Drivers License No.'
                        ));

                $this->fields->insert_batch($data);
            }

            if ($this->input->post('category') == 'address') {

                $this->fields->delete_by_category('address');

                $data = array(
                    array(
                        'category' => 'address',
                        'name' => 'street_no',
                        'status' => $this->input->post('street_no_status'),
                        'order' => $this->input->post('street_no_order'),
                        'label' => 'Unit No./ Street No.'
                    ), array(
                        'category' => 'address',
                        'name' => 'street_name',
                        'status' => $this->input->post('street_name_status'),
                        'order' => $this->input->post('street_name_order'),
                        'label' => 'Street Name'
                    ), array(
                        'category' => 'address',
                        'name' => 'city',
                        'status' => $this->input->post('city_status'),
                        'order' => $this->input->post('city_order'),
                        'label' => 'City / Suburb'
                    ), array(
                        'category' => 'address',
                        'name' => 'state_postcode',
                        'status' => $this->input->post('state_postcode_status'),
                        'order' => $this->input->post('state_postcode_order'),
                        'label' => 'State & Postcode'
                    ), array(
                        'category' => 'address',
                        'name' => 'residential',
                        'status' => $this->input->post('residential_status'),
                        'order' => $this->input->post('residential_order'),
                        'label' => 'Residential Status'
                    ), array(
                        'category' => 'address',
                        'name' => 'time_at_address',
                        'status' => $this->input->post('time_at_address_status'),
                        'order' => $this->input->post('time_at_address_order'),
                        'label' => 'Time at Address'
                        ));
                $this->fields->insert_batch($data);
            }


            if ($this->input->post('category') == 'contact') {

                $this->fields->delete_by_category('contact');
                $data = array(
                    array(
                        'category' => 'contact',
                        'name' => 'email',
                        'status' => $this->input->post('email_status'),
                        'order' => $this->input->post('email_order'),
                        'label' => 'Email Address'
                    ), array(
                        'category' => 'contact',
                        'name' => 'confirm_email',
                        'status' => $this->input->post('confirm_email_status'),
                        'order' => $this->input->post('confirm_email_order'),
                        'label' => 'Confirm Email'
                    ), array(
                        'category' => 'contact',
                        'name' => 'mobile_phone',
                        'status' => $this->input->post('mobile_phone_status'),
                        'order' => $this->input->post('mobile_phone_order'),
                        'label' => 'Mobile Phone'
                    ), array(
                        'category' => 'contact',
                        'name' => 'home_phone',
                        'status' => $this->input->post('home_phone_status'),
                        'order' => $this->input->post('home_phone_order'),
                        'label' => 'Home Phone'
                        ));
                $this->fields->insert_batch($data);
            }


            if ($this->input->post('category') == 'loan') {

                $this->fields->delete_by_category('loan');

                $data = array(
                    array(
                        'category' => 'loan',
                        'name' => 'amount',
                        'status' => $this->input->post('amount_status'),
                        'order' => $this->input->post('amount_order'),
                        'label' => 'Loan Amount'
                    ), array(
                        'category' => 'loan',
                        'name' => 'purpose',
                        'status' => $this->input->post('purpose_status'),
                        'order' => $this->input->post('purpose_order'),
                        'label' => 'Loan Purpose'
                        ));
                $this->fields->insert_batch($data);
            }

            //employment
            if ($this->input->post('category') == 'employment') {

                $this->fields->delete_by_category('employment');

                $data = array(
                    array(
                        'category' => 'employment',
                        'name' => 'employment_status',
                        'status' => $this->input->post('employment_status_status'),
                        'order' => $this->input->post('employment_status_order'),
                        'label' => 'Employment Status'
                    ), array(
                        'category' => 'employment',
                        'name' => 'employment_length',
                        'status' => $this->input->post('employment_length_status'),
                        'order' => $this->input->post('employment_length_order'),
                        'label' => 'Employment Length'
                    ), array(
                        'category' => 'employment',
                        'name' => 'monthly_income',
                        'status' => $this->input->post('monthly_income_status'),
                        'order' => $this->input->post('monthly_income_order'),
                        'label' => 'monthly_income'
                    ), array(
                        'category' => 'employment',
                        'name' => 'payday_frequency',
                        'status' => $this->input->post('payday_frequency_status'),
                        'order' => $this->input->post('payday_frequency_order'),
                        'label' => 'Payday Frequency'
                    ), array(
                        'category' => 'employment',
                        'name' => 'next_payday',
                        'status' => $this->input->post('next_payday_status'),
                        'order' => $this->input->post('next_payday_order'),
                        'label' => 'Next Payday'
                    ), array(
                        'category' => 'employment',
                        'name' => 'paid_to_bank',
                        'status' => $this->input->post('paid_to_bank_status'),
                        'order' => $this->input->post('paid_to_bank_order'),
                        'label' => 'Is your salary paid directly into your bank account?'
                        ));

                $this->fields->insert_batch($data);
            }

            //employer
            if ($this->input->post('category') == 'employer') {

                $this->fields->delete_by_category('employer');

                $data = array(
                    array(
                        'category' => 'employer',
                        'name' => 'business_name',
                        'status' => $this->input->post('business_name_status'),
                        'order' => $this->input->post('business_name_order'),
                        'label' => 'Business Name'
                    ), array(
                        'category' => 'employer',
                        'name' => 'employer_phone',
                        'status' => $this->input->post('employer_phone_status'),
                        'order' => $this->input->post('employer_phone_order'),
                        'label' => 'Employer Phone'
                    ), array(
                        'category' => 'employer',
                        'name' => 'employer_street_no',
                        'status' => $this->input->post('employer_street_no_status'),
                        'order' => $this->input->post('employer_street_no_order'),
                        'label' => 'Unit No./ Street No.'
                    ), array(
                        'category' => 'employer',
                        'name' => 'employer_street_name',
                        'status' => $this->input->post('employer_street_name_status'),
                        'order' => $this->input->post('employer_street_name_order'),
                        'label' => 'Street Name'
                    ), array(
                        'category' => 'employer',
                        'name' => 'employer_city',
                        'status' => $this->input->post('employer_city_status'),
                        'order' => $this->input->post('employer_city_order'),
                        'label' => 'City / Suburb'
                    ), array(
                        'category' => 'employer',
                        'name' => 'employer_state_postcode',
                        'status' => $this->input->post('employer_state_postcode_status'),
                        'order' => $this->input->post('employer_state_postcode_order'),
                        'label' => 'State & Postcode'
                        ));

                $this->fields->insert_batch($data);
            }

            echo json_encode(array('success' => true));
        }
    }

    public function configure_fields() {
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][5]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][5]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		
        $this->load->model('backend/fields_model', 'fields');
		
        /*
         * first time only to populate db with default ordering and status

          $data = array(
          array(
          'category' => 'ref1',
          'name' => 'ref1_name',
          'status' => '1',
          'order' => '0',
          'label' => 'Name'
          ), array(
          'category' => 'ref1',
          'name' => 'ref1_relationship',
          'status' => '1',
          'order' => '1',
          'label' => 'Relationship'
          ), array(
          'category' => 'ref1',
          'name' => 'ref1_home_phone',
          'status' => '1',
          'order' => '2',
          'label' => 'Home Phone'
          ), array(
          'category' => 'ref1',
          'name' => 'ref1_mobile_phone',
          'status' => '1',
          'order' => '3',
          'label' => 'Mobile Phone'
          ), array(
          'category' => 'ref1',
          'name' => 'ref1_street_no',
          'status' => '1',
          'order' => '4',
          'label' => 'Unit No. / Street No.'
          ), array(
          'category' => 'ref1',
          'name' => 'ref1_street_name',
          'status' => '1',
          'order' => '5',
          'label' => 'Street Name'
          ),
          array(
          'category' => 'ref1',
          'name' => 'ref1_city',
          'status' => '1',
          'order' => '6',
          'label' => 'City / Suburb'
          ), array(
          'category' => 'ref1',
          'name' => 'ref1_state_postcode',
          'status' => '1',
          'order' => '7',
          'label' => 'State & Postcode'
          ),


          array(
          'category' => 'ref2',
          'name' => 'ref2_name',
          'status' => '1',
          'order' => '0',
          'label' => 'Name'
          ), array(
          'category' => 'ref2',
          'name' => 'ref2_relationship',
          'status' => '1',
          'order' => '1',
          'label' => 'Relationship'
          ), array(
          'category' => 'ref2',
          'name' => 'ref2_home_phone',
          'status' => '1',
          'order' => '2',
          'label' => 'Home Phone'
          ), array(
          'category' => 'ref2',
          'name' => 'ref2_mobile_phone',
          'status' => '1',
          'order' => '3',
          'label' => 'Mobile Phone'
          ), array(
          'category' => 'ref2',
          'name' => 'ref2_street_no',
          'status' => '1',
          'order' => '4',
          'label' => 'Unit No. / Street No.'
          ), array(
          'category' => 'ref2',
          'name' => 'ref2_street_name',
          'status' => '1',
          'order' => '5',
          'label' => 'Street Name'
          ),
          array(
          'category' => 'ref2',
          'name' => 'ref2_city',
          'status' => '1',
          'order' => '6',
          'label' => 'City / Suburb'
          ), array(
          'category' => 'ref2',
          'name' => 'ref2_state_postcode',
          'status' => '1',
          'order' => '7',
          'label' => 'State & Postcode'
          )
          );

          $this->fields->insert_batch($data);

         */


        $fs1['personal'] = $this->fields->get_by_category('personal');
        $fs1['address'] = $this->fields->get_by_category('address');
        $fs1['contact'] = $this->fields->get_by_category('contact');
        $fs1['loan'] = $this->fields->get_by_category('loan');

        $fs2['employment'] = $this->fields->get_by_category('employment');
        $fs2['employer'] = $this->fields->get_by_category('employer');

        $fs3['expenses'] = $this->fields->get_by_category('expenses');
        $fs3['bank'] = $this->fields->get_by_category('bank');

        $fs4['ref1'] = $this->fields->get_by_category('ref1');
        $fs4['ref2'] = $this->fields->get_by_category('ref2');

        $html['fs1'] = $this->load->view('backend/configure_fields_part/fs1_html', $fs1, TRUE);
        $html['fs2'] = $this->load->view('backend/configure_fields_part/fs2_html', $fs2, TRUE);
        $html['fs3'] = $this->load->view('backend/configure_fields_part/fs3_html', $fs3, TRUE);
        $html['fs4'] = $this->load->view('backend/configure_fields_part/fs4_html', $fs4, TRUE);
        $this->_load_template('backend/configure_fields', $html);
    }

    public function process_login() {
        $this->load->model('backend/users_model', 'users');

        $username = $this->input->post('username');
        $password = $this->encrypt->sha1($this->input->post('password'));
		$ip = $this->input->post('ip_address');
        $this->users->is_logged_in($username, $password, $ip);

        redirect('/admin', 'location');
    }

    public function dashboard($id = null) {

    }

    /**
     * Function to check url if it has the string /login
     *
     * @param string
     * @return boolean
     */
    private function _check_url($url) {
        if (strpos($url, '/login') !== false) {
            return false;
        } else {
            return true;
        }
    }

	public function terms(){
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][9]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][9]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		$data['terms'] = $this->application->get_terms();
		$data['term_current'] = $this->application->get_term_current();
        $data['ckeditor'] = array(

            //ID of the textarea that will be replaced
            'id'    =>  'term_content',
            'path'  =>  'assets/js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar'   =>  "Full",     //Using the Full toolbar
                'width'     =>  "100%",  //Setting a custom width
                'height'    =>  '400px',    //Setting a custom height
                'filebrowserBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Images',
                'filebrowserFlashBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Flash',
                'filebrowserUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            ),
        );

		$this->_load_template('backend/terms_conditions', $data);
	}

	public function update_terms(){
		if($this->input->post('updateTerms') && $this->input->post('updateTerms') == 'yes'){
			$this->load->model('backend/application', 'application');

			$term_current = $this->input->post('tc-current');

			$data = array(
				'id'      => (int)$this->input->post('term_version'),
				'content' => trim($this->input->post('tc-content')),
				'date'	  => date("Y-m-d H:i:s")
			);
			$this->application->update_terms( $data, $term_current );

            redirect('admin/terms','location');
		}
	}

    public function update_used_term()
    {
        $this->load->model('backend/application', 'application');
        $current = $this->input->post('current');

        $data =  array( 'value' => $current );

        $result = $this->application->update_term_used( $data, 1 );

        if( $result ) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

	public function sms_config(){
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][10]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][10]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		$data['sms_config'] = $this->application->get_sms_config();
		$this->_load_template('backend/sms_config', $data);
	}

	public function update_sms_config(){
		if($this->input->post('update_sms_cf') && $this->input->post('update_sms_cf') == 'yes'){
			$this->load->model('backend/application', 'application');
			$data = array(
				'id' => 1,
				'usrname' => $this->input->post('usr_name'),
				'password' => $this->input->post('passw'),
				'delaymin' => $this->input->post('delay_min'),
				'message_1' => $this->input->post('message_1'),
				'message_2' => $this->input->post('message_2'),
				'message_3' => $this->input->post('message_3')
			);
			echo $this->application->update_sms_config($data);
		}
	}

	public function min_it(){
		$this->load->model('backend/application', 'application');
        $this->load->model('backend/minit_model', 'minit_model');

        if($this->input->post()) {
            $settings = array();
            $settings['id'] = 1;
            $settings['username'] = $this->input->post('username');
            $settings['password'] = $this->input->post('password');

            if( $this->minit_model->update_settings($settings) ) {
                $this->session->set_flashdata('success_message', true);
            }
        }

		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][10]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][10]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}

        $data = array();
        $data['settings'] = $this->minit_model->get_settings();

		$this->_load_template('backend/min_it', $data);
	}

	public function create_user() {
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][2]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][2]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		$this->load->library('lib');
		$data = array();
		$data['create_pass'] = $this->lib->GeneralRandomKey(12);
		$data['accounts'] = $this->application->get_accounts();
        $this->_load_template('backend/create_user', $data);
	}

	public function add_user(){
		if($this->input->post('create_user') && $this->input->post('create_user') == 'yes'){
			$this->load->model('backend/application', 'application');
			echo json_encode($this->application->add_user());
			exit;
		}
	}
	
	public function edit_user(){
		if($this->input->post('edit_account') && $this->input->post('edit_account') == 'yes'){
			$this->load->model('backend/application', 'application');
			echo $this->application->edit_user();
			exit;
		}	
	}
	
	public function delete_user(){
		if($this->input->post('delete_account') && $this->input->post('delete_account') == 'yes'){
			$this->load->model('backend/application', 'application');
			echo $this->application->delete_user();
			exit;
		}
	}
	
	public function send_new_pass(){
		if($this->input->post('sendnew_pass') && $this->input->post('sendnew_pass') == 'yes'){
			$this->load->model('backend/application', 'application');
			echo $this->application->send_new_pass();
			exit;	
		}
	}
	
	public function access_log($offset = 0) {
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][4]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][4]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
        $data['access_log'] = $this->application->get_access_log();
        $this->_load_template('backend/access_log', $data);
    }
	
	public function export_log(){
        error_reporting(0);
		$this->load->model('backend/application', 'application');
		$this->application->export_log();	
	}
	
	public function access_controls($offset = 0) {;
        $this->load->model('backend/application', 'application');
		
		$data['access_controls'] = $this->application->get_access_controls();
		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][3]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][3]->staff != 1){
					echo 'Permission denied.';
					return false;
				}	
			}
		}
		
        $data['access_controls'] = $this->application->get_access_controls();
        $this->_load_template('backend/access_controls', $data);
    }
	
	public function update_access_controls(){
		$this->load->model('backend/application', 'application');
		if($this->input->post('update_control') && $this->input->post('update_control') == 'yes'){
			echo $this->application->update_access_controls();
			exit;
		}
	}

    public function get_all_js() {
        header('Content-type: application/javascript');

        $base_path = base_url();

        $files = array(
            'assets/js/jquery.min.js',
            'assets/js/bootstrap.min.js',
            'assets/js/jquery.validate.js',
            'assets/js/backend/manageuser.js',
            'assets/js/jquery.dataTables.min.js',
            'assets/js/jquery.flot.min.js',
            'assets/js/jquery.flot.resize.min.js',
            'assets/js/jquery.peity.min.js',
            'assets/js/fullcalendar.min.js',
            'assets/js/unicorn.js',
            'assets/js/unicorn.dashboard.js',
            'assets/js/jquery.gritter.min.js',
            'assets/js/bootstrap-datepicker.js',
            'assets/js/jquery.uniform.js',
            'assets/js/convert_to_excel.js',
            'assets/js/backend/email.js',
            'assets/js/backend/client.js',
            'assets/js/backend/dashboard.js',
            'assets/js/backend/tank-pages.js',
            'assets/js/backend/search.js',
            'assets/js/backend/terms.js',
            'assets/js/backend/preset_message.js',
            'assets/js/jquery-ui-1.9.2.custom.min.js',
            'assets/js/colorbox/jquery.colorbox-min.js',
            'assets/js/backend/cms_onload.js',
            'assets/js/backend/media_library.js',
            'assets/js/ckfinder/ckfinder.js',
            'assets/js/ckeditor/ckeditor.js',
        );

        foreach( $files as $file ) {
            //include( $base_path.$file );
            echo file_get_contents($base_path.$file);
            //echo "<script src='".$base_path.$file."'></script>";
        }
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/backend/admin.php */