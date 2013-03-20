<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploader extends CI_Controller {
	var $user_id;

	public function __construct() 
	{
        parent::__construct();

        $this->load->model('frontend/cms/cms_frontend_model');
		$this->load->library('UrlParser');
    }

	public function index( $id ) 
	{
		redirect('/login', 'location');
	}

	public function application_documents( $id, $template_id, $doc_id = 0 )
	{
		$this->load->model('frontend/uploader_model', 'uploader');
        $this->load->model('backend/document_model', 'document_model');
        $this->load->model('frontend/terms_model', 'terms');
		$this->user_id = $this->urlparser->decode($id);
		$url = base_url().'documentuploader/'.$id.'/'.$template_id;

		if( $doc_id == 0) {
			$expire = $this->document_model->get_link_expire($url);
			$date_expire = date('Y-m-d', strtotime( $expire->date_expire ) );
			$now = date('Y-m-d', time() );

			if($date_expire <= $now) {
				show_404();
			}
		}


		$header_contents = $this->cms_frontend_model->get_header();
		$image_alt_text  = $this->cms_frontend_model->get_alt_text();
		$term_of_use     = $this->terms->get_terms();

		$data['user']        = $this->uploader->get_user( $this->user_id );
		$data['template_id'] = $template_id;
		$data['doc_log']     = $this->document_model->get_log( $this->user_id );
		
		if( !empty($data['doc_log']) ) {
			rsort($data['doc_log']);
			$data['doc_log'] = explode(',', $data['doc_log'][0]->requested_docs);
		}

		$header_data = array(
            'header_contents' => $header_contents,
            'header_alt_text' => $image_alt_text
        );

        $content_data = array(
            'term_of_use' => $term_of_use,
        );

	    $footer_contents = $this->cms_frontend_model->get_footer();

        $footer_data = array(
            'js_file' => 'frontend/uploader.js',
            'term_of_use' => $term_of_use,
            'footer_contents' => $footer_contents,
            'footer_alt_text' => $image_alt_text
        );

		$this->load->view('frontend/includes/header', $header_data);
		$this->load->view('frontend/documents_required', $data);
		$this->load->view('frontend/includes/footer',  $footer_data);
	}

	public function print_fax_cover( $id, $docs = '' ) {
		$this->load->model('frontend/uploader_model', 'uploader');
        $this->load->model('backend/document_model', 'document_model');
       
        $data['user']    = $this->uploader->get_user( $id );
		$data['doc_log'] = $this->document_model->get_log( $id );
		$data['method']  = 'fax';

		if( $docs == '' ) {
			rsort($data['doc_log']);
			$data['doc_log'] = explode(',', $data['doc_log'][0]->requested_docs);
		} else {
			$data['doc_log'] = explode('%2C', $docs);
		}

		$this->load->view('frontend/print_cover', $data);
	}

	public function print_post_cover( $id, $docs = '' ) {
		$this->load->model('frontend/uploader_model', 'uploader');
        $this->load->model('backend/document_model', 'document_model');
       
        $data['user']    = $this->uploader->get_user( $id );
		$data['doc_log'] = $this->document_model->get_log( $id );
		$data['method']  = 'post';

		if( $docs == '' ) {
			rsort($data['doc_log']);
			$data['doc_log'] = explode(',', $data['doc_log'][0]->requested_docs);
		} else {
			$data['doc_log'] = explode('%2C', $docs);
		}

		$this->load->view('frontend/print_cover', $data);
	}

	public function upload_docs()
	{
		$error           = "";
		$fileElementName = $_POST['file_element'];   
		$folder          = $_POST['folder'];   
		$id              = $_POST['user_id'];
		$root_dir        = DIRNAME(DIRNAME(DIRNAME(DIRNAME(__FILE__))));
		
		if(!empty($_FILES[$fileElementName]['error']))
		{
			switch($_FILES[$fileElementName]['error'])
			{
				case '1':
					$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
					break;
				case '2':
					$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
					break;
				case '3':
					$error = 'The uploaded file was only partially uploaded';
					break;
				case '4':
					$error = 'No file was uploaded.';
					break;

				case '6':
					$error = 'Missing a temporary folder';
					break;
				case '7':
					$error = 'Failed to write file to disk';
					break;
				case '8':
					$error = 'File upload stopped by extension';
					break;
				case '999':
				default:
					$error = 'No error code avaiable';
			}
		} elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none') {
			$error = 'No file was uploaded..';
		} else {
			$fnam = $id.'_'.$_FILES[$fileElementName]['name'];
			$name = $_FILES[$fileElementName]['name'];
			$type = preg_replace('/(.+)\//s', '', $_FILES[$fileElementName]["type"]);
			$path = $root_dir.'/uploads/';
			$size = @filesize($_FILES[$fileElementName]['tmp_name']);
							
			move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $path.''.$fnam);
		}
		
		$res = new stdClass();
					
		$res->error    = $error;
		$res->uid      = $id;
		$res->filename = $name;
		$res->filetype = $type;
		$res->path     = $path;
		$res->size     = sprintf("%.2fMB", $size/1048576);
		$res->dt       = date('Y-m-d H:i:s');
		echo json_encode($res);
	}

	public function save_upload()
	{
		$this->load->model('frontend/uploader_model', 'uploader');
		$this->load->model('backend/document_model', 'document_model');

		$id      = $this->input->post('id');		
		$table   = 'users_application';
		$table2  = 'users_documents';
		$method  = array( 'Fax', 'Post' );

		$supply = $this->input->post('supply');
		$docs   = ( is_array( $this->input->post('doc_type') ) ? $this->input->post('doc_type') : array() );
		$others = ( is_array( $this->input->post('others') ) ? $this->input->post('others') : array() );

		$data    = array(
			'user_id'            => $id,
			'supply_via'         => $supply,
			'specific_docs'      => implode(",", $docs ),
			'other_docs'         => implode(",", $others ),
			'files'              => $this->input->post('files'),
			'ip_address'         => $this->input->ip_address(),
			'datetime_submitted' => date( 'Y-m-d H:i:s' )
		);

		email_template(3, $id);

		$docs  = '';
		$docs2 = '';
		$comma = 0;
		$specific_docs = ( !empty($data['specific_docs']) ? $data['specific_docs'] : '' );

		if( !empty($data['other_docs']) ) {
			$docs2 = $data['other_docs'];
			$comma = 1;
		} else {
			$docs2 = '';
		}

		if( $comma != 0 ) {
			$docs   = $specific_docs.",".$other_docs;
		} else {
			$docs   = $specific_docs;
		}		

		if( in_array($supply, $method) ) {
			$fields  = array(
				'has_docs' => 'Yes'
			);

			$log =  array(
				'users_application_id' => $id,
				'date_sent'            => date('Y-m-d H:i:s', time() ),
				'message'              => 'Advised '.$supply,
				'requested_docs'       => $docs,
			);			
		} else {
			$fields = array(
				'has_docs'            => 'Yes',
				'application_status'  => 3
			); 

			$log =  array(
				'users_application_id' => $id,
				'date_sent'            => date('Y-m-d H:i:s', time() ),
				'message'              => 'Uploaded Docs',
				'requested_docs'       => $docs,
			);

			email_template(2, $id);
		}

		$this->document_model->add_log( $log );
		$this->uploader->update_user( $table, $fields, $id );
		$this->uploader->insert_data( $table2, $data );
	}

	public function remove_file()
	{
		$filename = $this->input->post('fname');
		$user_id  = $this->input->post('id');
		$filepath = $this->input->post('path');
		
		if( file_exists($filepath.$user_id.'_'.$filename) ) {
			if( unlink($filepath.$user_id.'_'.$filename) ) echo true;
			else echo false;
		}
	}

} 