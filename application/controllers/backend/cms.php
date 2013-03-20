<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
		error_reporting(E_ALL);
		$this->load->helper('ckeditor');

		if (!$this->session->userdata('user') && !$this->session->userdata('user_level')) {
            redirect('/admin/login', 'location');
        }
	}

	public function index()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$this->load->model('backend/cms/page_m');

		$pages     = $this->page_m->get_all_pages();
		$app_pages = $this->page_m->get_application_pages();

		$data = array();
		$data['pages'] = $pages;
		$data['app_pages'] = $app_pages;

		$this->_load_template('backend/cms/cms_index', $data);
	}

	public function navigation_update_order()
	{
		$order_id = $this->input->get_post('order_id');
		foreach ($order_id as $position => $item)
		{
		   // $sql[] = "UPDATE `table` SET `position` = $position WHERE `id` = $item";
		    $this->db->query("UPDATE `cms_navigations` SET `position` = $position WHERE `id` = $item");
		}

		echo 'ok';
		exit;

	}
	//public function navigations()
	public function menu_control()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$data = array();
		$navigations = $this->cms_model->get_all_navigations();
		$data['navigations'] = $navigations;
		$this->_load_template('backend/cms/cms_navigations', $data);
	}

	public function delete_navigation( $id )
	{
		$this->load->model('backend/cms/cms_model', 'cms');

		if($this->cms->delete_navigation($id)) {
			redirect('admin/cms/menu_control', 'location');
		}
	}

	public function add_navigation($id='parent',$uri_parent='')
	{
		$this->load->helper('url');
		$this->load->helper('widget_helper');
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$this->load->model('backend/cms/page_m');


		if($id!='parent')
			{
				$widget = $this->cms_model->get_navigation($id);
			}
		else{
			$widget = new stdClass;

		}
		// did they even submit?
		if ($input = $this->input->post())
		{
			if($id==''|$id=='parent'){
				// validate and insert
				if ($id = $this->cms_model->create_navigation($input))
				{

					redirect('/admin/cms/menu_control');
				}
			}

			if($id!='parent'){

				if ($id = $this->cms_model->edit_navigation($id,$input))
				{
					redirect('/admin/cms/menu_control');
				}
			}

		}
		$data = array();
		if($uri_parent!=''){
			$widget->parent=$uri_parent;
		}
		$data['navigation'] = $widget;
		$pages = $this->page_m->get_all_pages();
		$data['pages'] = $pages;
		$data['id'] = $id;
		$this->_load_template('backend/cms/add_navigation', $data);
	}


	//public function widgets()
	public function widget_control()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$pages = $this->cms_model->get_all_widgets();
		$data = array();
		$data['widgets'] = $pages;
		$this->_load_template('backend/cms/cms_widgets', $data);
	}

	public function add_widget($id='')
	{
		$this->load->helper('url');
		$this->load->helper('widget_helper');
		$this->load->model('backend/cms/cms_model', 'cms_model');

		if($id!='')
			{
				$widget = $this->cms_model->get_widget($id);
			}
		else{
			$widget = new stdClass;

		}
		// did they even submit?
		if ($input = $this->input->post())
		{
			if($id==''){
				// validate and insert
				if ($id = $this->cms_model->create_widget($input))
				{

					redirect('/admin/cms/widget_control');
				}
			}

			if($id!=''){

				if ($id = $this->cms_model->edit_widget($id,$input))
				{
					redirect('/admin/cms/widget_control');
				}
			}

		}
		$data = array();
		$data['text'] = ( $id != '' ) ? "Edit" : "Add";
		$data['widget'] = $widget;
		$data['id'] = $id;
		$data['ckeditor'] = array(

			//ID of the textarea that will be replaced
			'id' 	=> 	'widget_content',
			'path'	=>	'assets/js/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"80%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height

			),
		);

		$this->_load_template('backend/cms/add_widget', $data);
	}

	public function edit_page_widget()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');

		$id   = $this->input->post('id');
		$data = array(
			'widget_title'   => $this->input->post('title'),
			'widget_content' => $this->input->post('content')
		);

		$result = $this->cms_model->update_page_widget( $id, $data );

		if( $result ) {
			echo "ok";
		} else {
			echo "error";
		}
	}

	public function add_page($id='')
	{

		//http://nukium.com/developpement-php/codeigniter/ckeditor-helper-for-codeigniter/

		$this->load->helper('url');
		$this->load->helper('widget_helper');
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$this->load->model('backend/cms/page_m');
		$widgets = $this->cms_model->get_all_widgets();

		if($id!='')
			{
				$page = $this->page_m->get($id);
				$mywidgets = $this->cms_model->get_my_widgets($id);
			}
		else{
			$page = new stdClass;
			$mywidgets = array();

		}



		// did they even submit?
		if ($input = $this->input->post())
		{
			if($id==''){
				// validate and insert
				if ($id = $this->page_m->create($input))
				{
					redirect('/admin/cms');
				}
			}

			if($id!=''){
				//print_r($input);exit;
				// validate and insert
				$page_id = $id;
				if ($id = $this->page_m->edit($id,$input))
				{
					redirect('/admin/cms/add_page/'.$page_id);
				}
			}

		}


		$data = array();
		$add_edit = 'Add';
		if($id!=''){$add_edit = 'Edit';}
		$data['page'] = $page;
		$data['widgets'] = $widgets;
		$data['mywidgets']=$mywidgets;
		$data['add_edit'] = $add_edit;

		$data['page_type'] = '';
		$data['id'] = $id;

		$data['existing_meta_keywords'] = $this->page_m->get_all_keywords();
		$data['ckeditor'] = array(

			//ID of the textarea that will be replaced
			'id' 	=> 	'page_content',
			'path'	=>	'assets/js/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"80%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height
				  'filebrowserBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html',
          'filebrowserImageBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Images',
          'filebrowserFlashBrowseUrl' => base_url() . 'assets/js/ckfinder/ckfinder.html?Type=Flash',
          'filebrowserUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
          'filebrowserImageUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
          'filebrowserFlashUploadUrl' => base_url() . 'assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

			),
		);
		// Load page editor

		$this->_load_template('backend/cms/add_page', $data);
	}

	public function remove_page() 
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');

		$data = array( 'id' => $this->input->post('id') );

		$this->cms_model->delete_page( $data );
	}

	/**
	 * Function to edit header
	 */
	public function edit_header()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');


		if ($input = $this->input->post())
		{

			// validate and insert
			if ($id = $this->cms_model->update_header($input))
			{

				//$this->edit_header();
			}

		}

		$header = $this->cms_model->get_header();

		$data = array();
		$data['header'] = $header;


		$this->_load_template('backend/cms/edit_header', $data);
	}

	public function edit_footer()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');


		if ($input = $this->input->post())
		{

			// validate and insert
			if ($id = $this->cms_model->update_footer($input))
			{

				//$this->edit_header();
			}

		}

		$footer = $this->cms_model->get_footer();
		$tempFooter = array();
		$reorder = array(
			'helpline',
			'footer_text',
			'footer_image',
			'footer_image_link',
			'footer2_image',
			'footer2_image_link',
			'footer3_image',
			'footer3_image_link',
			'footer_image2',
			'footer_navigation',
			'twitter-username',
			'no-of-twits',
			'facebook_link',
			'twitter_link',
			'youtube_link'
		);

		foreach($reorder as $data) {
			$this->reorder_footer($tempFooter, $footer, $data);
		}


		$data = array();
		$data['footer'] = $tempFooter;
		$this->_load_template('backend/cms/edit_footer', $data);
	}

	private function reorder_footer( &$data, $temp, $string )
	{
		foreach($temp as $value) {
			if($value->item_type == $string) {
				$data[] = $value;
				break;
			}
		}
	}

	public function manage_applicationpages()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$this->load->model('backend/cms/page_m');
		$pages = $this->page_m->get_application_pages();
		$data = array();
		$data['pages'] = $pages;
		$this->_load_template('backend/cms/manage_applicationpages', $data);
	}

	public function add_applicationpage($id='')
	{

		//http://nukium.com/developpement-php/codeigniter/ckeditor-helper-for-codeigniter/

		$this->load->helper('url');
		$this->load->helper('widget_helper');
		$this->load->model('backend/cms/cms_model', 'cms_model');
		$this->load->model('backend/cms/page_m');
		$widgets = $this->cms_model->get_all_widgets();

		if($id!='')
			{
				$page = $this->page_m->get($id);
				$mywidgets = $this->cms_model->get_my_widgets($id);
			}
		else{
			$page = new stdClass;
			$mywidgets = array();

		}

		// did they even submit?
		if ($input = $this->input->post())
		{
			if($id==''){
				// validate and insert
				if ($id = $this->page_m->create($input))
				{

					redirect('/admin/cms');
				}
			}

			if($id!=''){
				// validate and insert
				if ($id = $this->page_m->edit($id,$input))
				{

					redirect('/admin/cms');
				}
			}
		}


		$data = array();
		$data['add_edit'] = ( $id != '' ) ? "Edit" : "Add";
		$data['page'] = $page;
		$data['widgets'] = $widgets;
		$data['mywidgets']=$mywidgets;

		$data['id'] = $id;
		$data['page_type'] = 'application';
		$data['ckeditor'] = array(

			//ID of the textarea that will be replaced
			'id' 	=> 	'page_content',
			'path'	=>	'assets/js/ckeditor',
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"80%",	//Setting a custom width
				'height' 	=> 	'400px',	//Setting a custom height

			),
		);
		// Load page editor

		if( $id == 16 ) {
			$dec = $this->cms_model->get_declaration();;

			$data['dec_id']      = $dec[0]->dec_id;
			$data['dec_heading'] = $dec[0]->dec_heading;
			$data['dec_text']    = $dec[0]->dec_title;
		}

		$this->_load_template('backend/cms/add_page', $data);
	}

	 /*
     * manage cms media files
     */
    public function manage_files()
	{
		$this->load->model('backend/cms/cms_model', 'cms_model');

		$media_path = dirname(BASEPATH) . '/uploads/files/full/images';

		$curr_files = $this->getDirectoryList($media_path);

		foreach($curr_files as $file) {
			$options  = array();
			$fullpath = $media_path.'/'.$file;
			$filename = preg_replace('/(.png|.jpg|.jpeg|.gif)/s', '', $file);
			$ext      = preg_replace('/.*\./s', '', $file);
			$fileCurr = $this->cms_model->get_file_by_name($filename);
			$id       = $fileCurr->id;

			$vals = getimagesize($fullpath);

			if(!file_exists($fullpath)) {
				$row = $this->db->get_where('cms_files',array('id'=>$id))->first_row();

				$filepath = $row->path.'/full/images/'.$row->filename.$row->filenameExt;
				$filepathThumb = $row->path.'/thumbs/'.$row->filename."_thumb".$row->filenameExt;

				unlink($filepath);
				unlink($filepathThumb);

				$this->db->where('id',$id);
				$this->db->delete('cms_files');
			} else {
				if(!$fileCurr) {
					$input = array();
					$input['name'] = $filename;
					$input['alt_text'] = $filename;
					$input['ext'] = '.'.$ext;

					if ( $vals[0] > 100 ) {
						$options['width'] = 100;
					}
					
					if ( $vals[1] > 100 ) {
						$options['height'] = 100;
					}

					$this->cms_model->create_file($input, false);
					$this->cms_model->resize('resize', $fullpath, 'uploads/files/thumbs', $options);
				}
			}
		}

		$files = $this->cms_model->get_all_files();
		$data = array();
		$data['files'] = $files;
		$this->_load_template('backend/cms/manage_files', $data);
	}

	private function getDirectoryList($directory)
	{
		// create an array to hold directory list
	    $results = array();

	    // create a handler for the directory
	    $handler = opendir($directory);

	    // open directory and walk through the filenames
	    while ($file = readdir($handler)) {

	      // if file isn't this directory or its parent, add it to the results
	      if ($file != "." && $file != "..") {
	        $results[] = $file;
	      }

	    }

	    // tidy up: close the handler
	    closedir($handler);

	    // done!
	    return $results;
	}


	public function add_file($id='')
	{
		$this->load->helper('url');
		$this->load->helper('widget_helper');
		$this->load->model('backend/cms/cms_model', 'cms_model');

		if($id!='')
			{
				$file = $this->cms_model->get_file($id);
			}
		else{
			$file = new stdClass;

		}
		// did they even submit?
		if ($input = $this->input->post())
		{

			if($id==''){
				// validate and insert
				if ($id = $this->cms_model->create_file($input))
				{

					redirect('/admin/cms/manage_files');
				}
			}

			if($id!=''){
				if ($id = $this->cms_model->edit_file($id,$input,$_FILES))
				{
					redirect('/admin/cms/manage_files');
				}
			}

		}
		$data = array();
		$data['text'] = ( $id != '' ) ? "Edit" : "Add";
		$data['file'] = $file;
		$data['id'] = $id;

		$this->_load_template('backend/cms/add_file', $data);
	}

	public function delete_file($id)
	{
		$row = $this->db->get_where('cms_files',array('id'=>$id))->first_row();

		$filepath = $row->path.'/full/images/'.$row->filename.$row->filenameExt;
		$filepathThumb = $row->path.'/thumbs/'.$row->filename."_thumb".$row->filenameExt;

		//$this->load->helper('file');
		//delete_files($filepath);
		//delete_files($filepathThumb);
		//removes the physical files on the server
		unlink($filepath);
		unlink($filepathThumb);

		$this->db->where('id',$id);
		$this->db->delete('cms_files');

		redirect('/admin/cms/manage_files');
	}

	/**
	 * Function to load template
	 */
	private function _load_template($template_file, $data = NULL)
	{
		$this->load->model('backend/application', 'application');
		$data['access_controls'] = $this->application->get_access_controls();

		if($this->session->userdata['user_level'] != 1){
			if($this->session->userdata['user_level'] == 2){
				if($data['access_controls'][11]->supervisor != 1){
					echo 'Permission denied.';
					return false;
				}
			}elseif($this->session->userdata['user_level'] == 3){
				if($data['access_controls'][11]->staff != 1){
					echo 'Permission denied.';
					return false;
				}
			}
		}

        $this->load->view('backend/includes/header');
        $this->load->view('backend/includes/sidebar',$data);
        $this->load->view($template_file, $data);
        $this->load->view('backend/includes/footer');
    }

    public function edit_declaration() {
    	$this->load->model('backend/cms/cms_model', 'cms_model');

    	$id = $this->input->post('page_id');
    	$dec_data = array(
    		'dec_id'      => $this->input->post('dec_id'),
    		'dec_heading' => $this->input->post('dec_heading'),
    		'dec_title'   => $this->input->post('dec_text')
    	);

    	$this->cms_model->update_declaration($dec_data);
    	//redirect('admin/cms/add_applicationpage/'.$id);
    	echo 'ok';
    }


}