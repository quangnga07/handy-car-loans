<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }

        notification_check();
    }

    private function _load_template($template_file, $data = NULL) {
        $this->load->model('backend/application', 'application');
        $data['access_controls'] = $this->application->get_access_controls();

        $this->load->view('backend/includes/header');
        $this->load->view('backend/includes/sidebar', $data);
        $this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer');
    }

    public function index() {
        $this->load->library('encrypt');
    }

    public function record($encrypt_id) {
        $this->load->model('frontend/score_model', 'score_model');
        $this->load->model('backend/scores_model', 'score_model_b');
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/message_model', 'message_model');
        $this->load->model('backend/document_model', 'document_model');
        $this->load->library('EmailReader');

        $id = $this->urlparser->decode($encrypt_id);
        $applicant = $this->application->view_application_by_id('users_application', $id);

        $data['access_controls'] = $this->application->get_access_controls();

        /*$permission_back_in_progress = 'yes';
        if ($this->session->userdata['user_level'] != 1) {
            if ($this->session->userdata['user_level'] == 2) {
                if ($data['access_controls'][0]->supervisor != 1) {
                    $permission_back_in_progress = 'no';
                }
            } elseif ($this->session->userdata['user_level'] == 3) {
                if ($data['access_controls'][0]->staff != 1) {
                    $permission_back_in_progress = 'no';
                }
            }
        }*/
        $permission_approve_loan = 'yes';
        if ($this->session->userdata['user_level'] != 1) {
            if ($this->session->userdata['user_level'] == 2) {
                if ($data['access_controls'][1]->supervisor != 1) {
                    $permission_approve_loan = 'no';
                }
            } elseif ($this->session->userdata['user_level'] == 3) {
                if ($data['access_controls'][1]->staff != 1) {
                    $permission_approve_loan = 'no';
                }
            }
        }
		$permission_delete = 'no';
		if($this->session->userdata['user_level'] == 1){
			$permission_delete = 'yes';	
		}elseif ($this->session->userdata['user_level'] == 2) {
			if ($data['access_controls'][14]->supervisor == 1) {
				$permission_delete = 'yes';
			}
		}elseif ($this->session->userdata['user_level'] == 3) {
			if ($data['access_controls'][14]->staff == 1) {
				$permission_delete = 'yes';
			}
		}
        $messages = $this->emailreader->inbox($applicant->user_email);
        $date = date('Y-m-d H:i:s', time());
        if ($messages && !$this->message_model->check_if_exist($applicant->user_email, $messages[0]['body'])) {
            $msg_exist = $this->message_model->check_if_exist($applicant->user_email);
            $msg_data = array(
                'client_email' => $applicant->user_email,
                'message' => $messages[0]['body'],
                'has_read' => 0,
                'unique_id_string' => $msg_exist->unique_id_string,
                'from' => $messages[0]['header']->senderaddress,
                'time_sent' => $date
            );
            $this->message_model->add_message($msg_data);
        }
        $messages_db = $this->message_model->get_messages($applicant->user_email);

        $this->application->has_read($id);
        $this->application->save_view_log($id);
        $this->application->save_last_viewed($id);

        $rank    = 'N/A';
        $ranking = $this->score_model_b->get_rank();
        $total   = $this->score_model_b->get_total($id);

		foreach( $ranking as $ranks ) {
			if( $ranks->max >= $total->total && $ranks->min <= $total->total ) {
				$rank = $ranks->rank;
			}
		}

        rsort($messages_db);

        $data = array();
        $data['documents'] = $this->application->get_user_documents($id);
        $data['messages'] = $messages_db;
        $data['applicant'] = $applicant;
        $data['term_date'] = $this->application->get_term_date($applicant->term_version);
        $data['email_parser'] = $messages;
        $data['score_rs'] = $this->score_model->get_score('RS');
        $data['score_tca'] = $this->score_model->get_score('TCA');
        $data['score_lp'] = $this->score_model->get_score('LP');
        $data['score_es'] = $this->score_model->get_score('ES');
        $data['score_el'] = $this->score_model->get_score('EL');
        $data['notes'] = $this->application->get_notes($id);
        $data['settings'] = $this->application->get_settings($id);
        $data['user_log'] = $this->application->get_user_log($id);
        $data['rank'] = $rank;

        // checks if gritter notification will show. 
        $data['notify'] = $this->session->flashdata('notify') ? $this->session->flashdata('notify') : '';
        $data['doc_log'] = $this->document_model->get_log($id);

        // check access control
        //$data['permission_back_progress'] = $permission_back_in_progress;
        $data['permission_approve_loan'] = $permission_approve_loan;
		$data['permission_delete'] = $permission_delete;
        $this->_load_template('backend/client_record', $data);
    }

    private function _send_email($id, $status)
    {
        $this->load->library('email');

        $username = $this->session->userdata('user');
        $date = date('m/d/Y h:i a');

        $this->email->set_mailtype('html');
        $this->email->from('admin@handycarloans.com.au');
        $this->email->to('admin@handycarloans.com.au');
        $this->email->subject('HCL'.$id.' - '.$status);
        $this->email->message('HCL'.$id.' '.$status.' by '.$username.' at '.$date);
        $this->email->send();
    }

    public function approve()
    {
        $this->load->model('backend/application', 'application');
        $this->load->library('Minit');

        $id = $this->input->post('applicant_id');
        $applicant = $this->application->view_application_by_id('users_application', $id);

        $data_approve = array(
            'application_status' => 5,
            'has_approved' => 1,
            'last_viewed' => $this->session->userdata('user'),
            'date_status' => date('Y-m-d H:i:s')
        );

        $this->application->update_status($data_approve, $id);

        $dob = $applicant->birth_date . '/' . $applicant->birth_month . '/' . $applicant->birth_year;
        $gender = ($applicant->title == 'Mr') ? 'M' : 'F';
        $frequency = '';
        if($applicant->payday_frequency == 'Fortnightly') {
            $frequency = 'Fortnight';
        } elseif($applicant->payday_frequency == 'Monthy') {
            $frequency = 'Month';
        } elseif($applicant->payday_frequency == 'Weekly') {
            $frequency = 'Week';
        } elseif($applicant->payday_frequency == 'Four-weekly') {
            $frequency = 'Year';
        }

        $employment_status = '';
        if($applicant->employment_status == 'Employed - full time') {
            $employment_status = 'Full-Time';
        } elseif($applicant->employment_status == 'Employed - part time') {
            $employment_status = 'Part-Time';
        } elseif($applicant->employment_status == 'Employed - Casual') {
            $employment_status = 'Casual';
        } elseif($applicant->employment_status == 'Self - Employed') {
            $employment_status = 'Self-Employed';
        } elseif($applicant->employment_status == 'Unemployed') {
            $employment_status = 'Unemployed';
        } elseif($applicant->employment_status == 'Retired') {
            $employment_status = 'Retired';
        }

        $emp_street = $applicant->employer_unit_num . '/' . $applicant->employer_street_num . ' ' . $applicant->employer_street_name;
        $street = $applicant->unit_num . '/' . $applicant->street_num . ' ' . $applicant->street_name;
        
        $reqField = array(
            'ClientNumber' => $applicant->id,
            'ClientStatus' => 'Approved',
            'CompanyTradingName' => 'Handy Car Loans',
            'DateOfBirth' => $dob,
            'EnableEmail' => 'N',
            'EnableFax' => 'N',
            'EnableSMS' => 'N',
            'FirstName' => $applicant->fname,
            'Gender' => $gender,
            'GrossIncomeAmount' => $applicant->monthly_income,
            'HomeOwnership' => 'No',
            'IncomeFrequency' => $frequency,
            'LastName' => $applicant->lname,
            'MaritalStatus' => 'Single',
            'NumberOfChildren' => 0
        );
        $otherField = array(
            'ClientTitle' => $applicant->title,
            'MiddleName' => $applicant->mname,
            'Email' => $applicant->user_email,
            'EmployerName' => $applicant->business_name,
            'EmployerStreet' => $emp_street, 
            'EmployerState' => $applicant->employer_state,
            'EmploymentStatus' => $employment_status,
            'MobilePhone' => $applicant->user_mobile_phone,
            'HomePhone' => $applicant->user_home_phone,
            'StreetNumberName' => $street,
            'StreetPostcode' => $applicant->postcode,
            'StreetState' => $applicant->state,
            'StreetSuburb' => $applicant->city_suburb

        );

        $ref1_name = explode(" ", $applicant->ref1_name);
        $ref1_firstname = '';
        for($i=0; $i < count($ref1_name)-1; $i++) {
            if($i == count($ref1_name)-1) {
                break;
            }
            if($i == 0) {
                $ref1_firstname .= $ref1_name[$i];
            } else {
                $ref1_firstname .= ' '.$ref1_name[$i];
            }
        }
        $ref1_lastname = $ref1_name[count($ref1_name)-1];
        $ref1_street = $applicant->ref1_unit_num . '/' . $applicant->ref1_street_num . ' ' . $applicant->ref1_street_name;

        $reference1Field = array(
            'clientnumber' => $applicant->id,
            'Relationship' => $applicant->ref1_relationship,
            'rFirstName' => $ref1_firstname,
            'rLastName' => $ref1_lastname,
            'rLandlinePhone' => $applicant->ref1_home_phone,
            'rMobilePhone' => $applicant->ref1_mobile_phone,
            'rPostcode' => $applicant->ref1_postcode,
            'rState' => $applicant->ref1_state,
            'rStreetNumberName1' => $ref1_street,
            'rSuburb' => $applicant->ref1_city_suburb
        );

        $ref1_name = explode(" ", $applicant->ref1_name);
        $ref1_firstname = '';
        for($i=0; $i < count($ref1_name)-1; $i++) {
            if($i == count($ref1_name)-1) {
                break;
            }
            if($i == 0) {
                $ref1_firstname .= $ref1_name[$i];
            } else {
                $ref1_firstname .= ' '.$ref1_name[$i];
            }
        }
        $ref1_lastname = $ref1_name[count($ref1_name)-1];
        $ref1_street = $applicant->ref1_unit_num . '/' . $applicant->ref1_street_num . ' ' . $applicant->ref1_street_name;

        $reference1Field = array(
            'clientnumber' => $applicant->id,
            'Relationship' => $applicant->ref1_relationship,
            'rFirstName' => $ref1_firstname,
            'rLastName' => $ref1_lastname,
            'rLandlinePhone' => $applicant->ref1_home_phone,
            'rMobilePhone' => $applicant->ref1_mobile_phone,
            'rPostcode' => $applicant->ref1_postcode,
            'rState' => $applicant->ref1_state,
            'rStreetNumberName1' => $ref1_street,
            'rSuburb' => $applicant->ref1_city_suburb,
            'IsCurrentClient' => 'N'
        );

        $ref2_name = explode(" ", $applicant->ref2_name);
        $ref2_firstname = '';
        for($i=0; $i < count($ref2_name)-1; $i++) {
            if($i == count($ref2_name)-1) {
                break;
            }
            if($i == 0) {
                $ref2_firstname .= $ref2_name[$i];
            } else {
                $ref2_firstname .= ' '.$ref2_name[$i];
            }
        }
        $ref2_lastname = $ref2_name[count($ref2_name)-1];
        $ref2_street = $applicant->ref2_unit_num . '/' . $applicant->ref2_street_num . ' ' . $applicant->ref2_street_name;

        $reference2Field = array(
            'clientnumber' => $applicant->id,
            'Relationship' => $applicant->ref2_relationship,
            'rFirstName' => $ref2_firstname,
            'rLastName' => $ref2_lastname,
            'rLandlinePhone' => $applicant->ref2_home_phone,
            'rMobilePhone' => $applicant->ref2_mobile_phone,
            'rPostcode' => $applicant->ref2_postcode,
            'rState' => $applicant->ref2_state,
            'rStreetNumberName1' => $ref2_street,
            'rSuburb' => $applicant->ref2_city_suburb,
            'IsCurrentClient' => 'N'
        );

        $this->minit->add_client( $reqField, $otherField );
        $this->minit->add_reference( $reference1Field );
        $this->minit->add_reference( $reference2Field );

        $this->_send_email($applicant->id, 'Approved');

        redirect('admin/client/record/'. $this->urlparser->encode($applicant->id), 'location');
    }

    public function declined()
    {
        $this->load->model('backend/application', 'application');
        $this->load->library('Minit');

        $id = $this->input->post('applicant_id');
        $applicant = $this->application->view_application_by_id('users_application', $id);

        $data_approve = array(
            'application_status' => 5,
            'has_approved' => 2,
            'last_viewed' => $this->session->userdata('user'),
            'date_status' => date('Y-m-d H:i:s')
        );

        $this->application->update_status($data_approve, $id);

        $dob = $applicant->birth_date . '/' . $applicant->birth_month . '/' . $applicant->birth_year;
        $gender = ($applicant->title == 'Mr') ? 'M' : 'F';
        $frequency = '';
        if($applicant->payday_frequency == 'Fortnightly') {
            $frequency = 'Fortnight';
        } elseif($applicant->payday_frequency == 'Monthy') {
            $frequency = 'Month';
        } elseif($applicant->payday_frequency == 'Weekly') {
            $frequency = 'Week';
        } elseif($applicant->payday_frequency == 'Four-weekly') {
            $frequency = 'Year';
        }

        $employment_status = '';
        if($applicant->employment_status == 'Employed - full time') {
            $employment_status = 'Full-Time';
        } elseif($applicant->employment_status == 'Employed - part time') {
            $employment_status = 'Part-Time';
        } elseif($applicant->employment_status == 'Employed - Casual') {
            $employment_status = 'Casual';
        } elseif($applicant->employment_status == 'Self - Employed') {
            $employment_status = 'Self-Employed';
        } elseif($applicant->employment_status == 'Unemployed') {
            $employment_status = 'Unemployed';
        } elseif($applicant->employment_status == 'Retired') {
            $employment_status = 'Retired';
        }

        $emp_street = $applicant->employer_unit_num . '/' . $applicant->employer_street_num . ' ' . $applicant->employer_street_name;
        $street = $applicant->unit_num . '/' . $applicant->street_num . ' ' . $applicant->street_name;

        $reqField = array(
            'ClientNumber' => $applicant->id,
            'ClientStatus' => 'Declined',
            'CompanyTradingName' => 'Handy Car Loans',
            'DateOfBirth' => $dob,
            'EnableEmail' => 'N',
            'EnableFax' => 'N',
            'EnableSMS' => 'N',
            'FirstName' => $applicant->fname,
            'Gender' => $gender,
            'GrossIncomeAmount' => $applicant->monthly_income,
            'HomeOwnership' => 'No',
            'IncomeFrequency' => $frequency,
            'LastName' => $applicant->lname,
            'MaritalStatus' => 'Single',
            'NumberOfChildren' => 0
        );
        $otherField = array(
            'ClientTitle' => $applicant->title,
            'MiddleName' => $applicant->mname,
            'Email' => $applicant->user_email,
            'EmployerName' => $applicant->business_name,
            'EmployerStreet' => $emp_street, 
            'EmployerState' => $applicant->employer_state,
            'EmploymentStatus' => $employment_status,
            'MobilePhone' => $applicant->user_mobile_phone,
            'HomePhone' => $applicant->user_home_phone,
            'StreetNumberName' => $street,
            'StreetPostcode' => $applicant->postcode,
            'StreetState' => $applicant->state,
            'StreetSuburb' => $applicant->city_suburb
        );

        $ref1_name = explode(" ", $applicant->ref1_name);
        $ref1_firstname = '';
        for($i=0; $i < count($ref1_name)-1; $i++) {
            if($i == count($ref1_name)-1) {
                break;
            }
            if($i == 0) {
                $ref1_firstname .= $ref1_name[$i];
            } else {
                $ref1_firstname .= ' '.$ref1_name[$i];
            }
        }
        $ref1_lastname = $ref1_name[count($ref1_name)-1];
        $ref1_street = $applicant->ref1_unit_num . '/' . $applicant->ref1_street_num . ' ' . $applicant->ref1_street_name;

        $reference1Field = array(
            'clientnumber' => $applicant->id,
            'Relationship' => $applicant->ref1_relationship,
            'rFirstName' => $ref1_firstname,
            'rLastName' => $ref1_lastname,
            'rLandlinePhone' => $applicant->ref1_home_phone,
            'rMobilePhone' => $applicant->ref1_mobile_phone,
            'rPostcode' => $applicant->ref1_postcode,
            'rState' => $applicant->ref1_state,
            'rStreetNumberName1' => $ref1_street,
            'rSuburb' => $applicant->ref1_city_suburb,
            'IsCurrentClient' => 'N'
        );

        $ref2_name = explode(" ", $applicant->ref2_name);
        $ref2_firstname = '';
        for($i=0; $i < count($ref2_name)-1; $i++) {
            if($i == count($ref2_name)-1) {
                break;
            }
            if($i == 0) {
                $ref2_firstname .= $ref2_name[$i];
            } else {
                $ref2_firstname .= ' '.$ref2_name[$i];
            }
        }
        $ref2_lastname = $ref2_name[count($ref2_name)-1];
        $ref2_street = $applicant->ref2_unit_num . '/' . $applicant->ref2_street_num . ' ' . $applicant->ref2_street_name;

        $reference2Field = array(
            'clientnumber' => $applicant->id,
            'Relationship' => $applicant->ref2_relationship,
            'rFirstName' => $ref2_firstname,
            'rLastName' => $ref2_lastname,
            'rLandlinePhone' => $applicant->ref2_home_phone,
            'rMobilePhone' => $applicant->ref2_mobile_phone,
            'rPostcode' => $applicant->ref2_postcode,
            'rState' => $applicant->ref2_state,
            'rStreetNumberName1' => $ref2_street,
            'rSuburb' => $applicant->ref2_city_suburb,
            'IsCurrentClient' => 'N'
        );

        $this->minit->add_client( $reqField, $otherField );
        $this->minit->add_reference( $reference1Field );
        $this->minit->add_reference( $reference2Field );

        $this->_send_email($applicant->id, 'Declined');

        redirect('admin/client/record/'. $this->urlparser->encode($applicant->id), 'location');
    }

    public function delete_user_document(){
        if($this->input->is_ajax_request()){
            $this->load->model('backend/application', 'application');
            $doc = $this->application->get_document($this->input->post('doc_id'));
                
            $file = FCPATH . 'uploads/'.$doc->user_id.'_'.$this->input->post('doc_name');
            unlink($file);
                
            $new_file_str = '';
            if($this->input->post('num_files') > 1){
                
                $file_list = explode(',', $doc->files);
                $new_file_list = array();
                
                foreach ($file_list as $a) {
                    if($this->input->post('doc_name') != $a){
                        $new_file_list[] = $a;
                    }
                }
                $new_file_str = implode(',', $new_file_list);
                $this->application->update_document($this->input->post('doc_id'), array('files'=> $new_file_str));
            }else{
                $this->application->delete_document($this->input->post('doc_id'));
            }

            //$this->_send_email($applicant->id, 'Deleted');

            echo json_encode(array('success'=>true, $new_file_str));
        }
    }
    
    public function print_record($encrypt_id) {
        $this->load->view('backend/includes/header_print');
        //$this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer_print');

        $this->load->model('frontend/score_model', 'score_model');
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/message_model', 'message_model');
        $this->load->library('EmailReader');

        $id = $this->urlparser->decode($encrypt_id);
        $applicant = $this->application->view_application_by_id('users_application', $id);

        $messages = $this->emailreader->inbox($applicant->user_email);
        $date = date('m/d/Y h:i:s a', time());
        if ($messages && !$this->message_model->check_if_exist($applicant->user_email, $messages[0]['body'])) {
            $msg_exist = $this->message_model->check_if_exist($applicant->user_email);
            $msg_data = array(
                'client_email' => $applicant->user_email,
                'message' => $messages[0]['body'],
                'has_read' => 0,
                'unique_id_string' => $msg_exist->unique_id_string,
                'from' => $messages[0]['header']->senderaddress,
                'time_sent' => $date
            );
            $this->message_model->add_message($msg_data);
        }
        $messages_db = $this->message_model->get_messages($applicant->user_email);

        $this->application->has_read($id);

        rsort($messages_db);

        $data = array();
        $data['documents'] = $this->application->get_user_documents($id);
        $data['messages'] = $messages_db;
        $data['applicant'] = $applicant;
        $data['term_date'] = $this->application->get_term_date($applicant->term_version);
        $data['email_parser'] = $messages;
        $data['score_rs'] = $this->score_model->get_score('RS');
        $data['score_tca'] = $this->score_model->get_score('TCA');
        $data['score_lp'] = $this->score_model->get_score('LP');
        $data['score_es'] = $this->score_model->get_score('ES');
        $data['score_el'] = $this->score_model->get_score('EL');
        $data['notes'] = $this->application->get_notes($id);
        $data['settings'] = $this->application->get_settings($id);

        $this->_load_template('backend/print_record', $data);
    }

    public function save_status() {
        $this->load->model('backend/application', 'application');
        $this->load->model('backend/scores_model', 'score');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $has_fill = $this->input->post('has_fill');

        if ($status == 5) {
            $data = array(
                'application_status' => $status,
                'has_approved' => 1,
                'last_viewed' => $this->session->userdata('user'),
                'date_status' => date('Y-m-d H:i:s')
            );
        } elseif ($status == 6) {
            $data = array(
                'application_status' => 5,
                'has_approved' => 2,
                'last_viewed' => $this->session->userdata('user'),
                'date_status' => date('Y-m-d H:i:s'),
                'cancelled_by' => $this->input->post('cancelled_by')
            );
        } elseif ($status == 7) {
            $data = array(
                'application_status' => $status,
                'has_approved' => 3,
                'last_viewed' => $this->session->userdata('user'),
                'date_status' => date('Y-m-d H:i:s')
            );

            $score = array(
                'user_id' => $id,
                'score_db' => 1,
                'score_rs' => 1,
                'score_tca' => 1,
                'score_lp' => 1,
                'score_es' => 1,
                'score_el' => 1,
                'score_ba' => 1,
                'score_di' => 1,
            );

            $this->score->insert_score($score);
        } elseif ( $status == 2 && $has_fill == 'No' ) {
            $data = array(
                'has_fill' => 'Yes',
                'application_status' => $status,
                'last_viewed' => $this->session->userdata('user'),
                'date_status' => date('Y-m-d H:i:s')
            );

            $score = array(
                'user_id' => $id,
                'score_db' => 1,
                'score_rs' => 1,
                'score_tca' => 1,
                'score_lp' => 1,
                'score_es' => 1,
                'score_el' => 1,
                'score_ba' => 1,
                'score_di' => 1,
            );

            $this->score->insert_score($score);
        } else {
            $data = array(
                'application_status' => $status,
                'last_viewed' => $this->session->userdata('user'),
                'date_status' => date('Y-m-d H:i:s')
            );
        }

        if ($this->application->update_status($data, $id)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function edit_record() {
        $this->load->model('backend/application', 'application');
        $id = $this->input->post('applicant_id');
        $table = 'users_application';
        $fields = array();

        foreach ($this->input->post() as $k => $v) {
            $temp = str_replace('-', '_', $k);
            if ($v == '') {
                $v = null;
            }

            if ($temp == 'birthday' || $temp == 'next_payday') {
                $date = date('Y-m-d', strtotime(str_replace('/', '-', $v)));

                $fields[$temp] = $date;
            } else {
                $fields[$temp] = $v;
            }
        }

        unset($fields['applicant_id']);

        if ($this->application->update_applicant($fields, $id)) {
            echo 'success';
        } else {
            echo 'fail';
        }
    }

    public function add_notes() {
        $this->load->model('backend/application', 'application');
        if ($this->input->post()) {
            $data_notes = $this->input->post();
            $data_notes['users_application_id'] = $this->urlparser->decode($data_notes['users_application_id']);

            $this->application->add_notes($data_notes);

            redirect('admin/client/record/' . $this->urlparser->encode($data_notes['users_application_id']));
        } else {
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }
    }

    public function add_settings() {
        $this->load->model('backend/application', 'application');
        if ($this->input->post()) {
            $data_notes = $this->input->post();
            $data_notes['users_application_id'] = $this->urlparser->decode($data_notes['users_application_id']);

            $this->application->add_settings($data_notes);

            redirect('admin/client/record/' . $this->urlparser->encode($data_notes['users_application_id']));
        } else {
            redirect($_SERVER['HTTP_REFERER'], 'location');
        }
    }

    public function upload_docs() {
        $this->load->model('frontend/uploader_model', 'uploader');
        $this->load->library('encrypt');

        $id = $this->input->post('user_id');
        $url = 'admin/client/record/' . $this->urlparser->encode($id);
        $table = 'users_application';
        $table2 = 'users_documents';

        if ($_FILES) {
            if (!empty($_FILES['myfiles']['error'])) {
                $error = 'Error';
            } elseif (empty($_FILES['myfiles']['tmp_name']) || $_FILES['myfiles']['tmp_name'] == 'none') {
                $error = 'No file was uploaded..';
            } else {
                $name = $id . '_' . $_FILES['myfiles']['name'];
                $path = DIRNAME(BASEPATH) . '/uploads/';

                move_uploaded_file($_FILES['myfiles']['tmp_name'], $path . $name);
            }
        }

        $fields = array(
            'has_docs' => 'Yes'
        );
        $data = array(
            'user_id' => $id,
            'supply_via' => 'Manual Upload',
            'specific_docs' => '',
            'other_docs' => '',
            'files' => $_FILES['myfiles']['name'],
            'ip_address' => $this->input->ip_address(),
            'datetime_submitted' => date('Y-m-d H:i:s')
        );

        $this->uploader->update_user($table, $fields, $id);
        $this->uploader->insert_data_backend($table2, $data);

        // sets the value on the uploader input to show notification.
        $notify = '<input type="hidden" id="uploaded" value="1">';
        $this->session->set_flashdata('notify', $notify);

        redirect($url);
    }
	
	public function delete_client_record() {
		if($this->input->post('delete_record') && $this->input->post('delete_record') == 'yes'){
			$this->load->model('backend/application', 'application');
			$result =  $this->application->delete_client_record();

            if($result == '') {
                $id = $this->input->post('client_record_id');
                $this->_send_email($id, 'Deleted');
                array_map('unlink', glob(FCPATH . 'uploads/'.$id.'_*.*'));
            }

            echo $result;
			exit;	
		}
	}

    public function send_back_record() {
        $this->load->model('backend/application', 'application');

        $id        = $this->input->post('client_id');
        $user_data = array(
            'application_status' => 3,
            'last_viewed'        => $this->session->userdata('user'),
            'date_status'        => date('Y-m-d H:i:s')
        );

        $result = $this->application->update_application( $user_data, $id );

        if( $result ) echo 'ok';
        else echo 'error';
    }
}

