<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_model extends CI_Model {

	public function delete_page( $data )
	{
		if( $this->db->delete('cms_pages', $data) ) {
			echo 'ok';
		} else {
			echo 'error';
		}
	}

	public function delete_navigation($id)
	{
		return $this->db->delete('cms_navigations', array('id' => $id));
	}

	public function get_header()
	{
		$query = $this->db->get_where('cms_contents', array('area' => 'header','page'=>'all'));
		return $query->result();
	}

	public function update_header($input )
	{
		$item_types = array('toll','logo_image');
		foreach($item_types as $item_type){
			$id = $input[$item_type.'_id'];
			/*if($item_type == 'logo_image'){
				$this->upload_header($input,$id,$item_type);
			}
			else{*/
			$content = $input[$item_type];
			$this->db->where(array('id'=>$id));
			$this->db->update('cms_contents', array('content'=>$content));
			//}



		}
		return true;
	}

	public function get_footer()
	{
		$query = $this->db->get_where('cms_contents', array('area' => 'footer','page'=>'all'));
		return $query->result();
	}

	public function update_footer( $input )
	{		
		$item_types = array(
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

		foreach($item_types as $item_type){

			$id = $input[$item_type.'_id'];

			//if($item_type == 'footer_image'||$item_type == 'footer_image2'){
			//	$this->upload_footer($input,$id,$item_type);
			//} else {
				$content = @$input[$item_type];
				$this->db->where(array('id'=>$id));
				$this->db->update('cms_contents', array('content'=>$content));
			//}
		}
		return true;
	}

	public function get_all_widgets()
	{
		$query = $this->db->get('cms_widgets');
		return $query->result();

	}

	public function get_my_widgets($page_id)
	{
		//$sql = "select cms_widgets.widget_title,cms_widgets.widget_content,cms_widgets.id,cms_widgets.widget_class,cms_widget_instances.area from cms_widgets,cms_widget_instances where cms_widget_instances.page_id = $page_id and cms_widget_instances.widget_id = cms_widgets.id order by cms_widget_instances.order";
		//$query = $this->db->query($sql);
		//return $query->result();
		$this->db->order_by('order','asc');
		$query = $this->db->get_where('cms_widget_instances',array('page_id'=>$page_id));
		return $query->result();

	}
	public function get_widget($id)
	{
		$query = $this->db->get_where('cms_widgets', array('id' => $id));
		return $query->first_row();
	}

	public function create_widget($input=array())
	{
		$data = array(
			'widget_title'=>$input['widget_title'],
			'widget_content'=>$input['widget_content'],
			'widget_class'=>$input['widget_class'],
		);
		return $this->db->insert('cms_widgets',$data);
	}

	public function edit_widget($id,$input=array())
	{
		$this->db->where('id',$id);
		$data = array(
			'widget_title'=>$input['widget_title'],
			'widget_content'=>$input['widget_content'],
			'widget_class'=>$input['widget_class'],
		);
		return $this->db->update('cms_widgets',$data);
	}

	//----- used for updating the widget. updating widget via pages
	public function update_page_widget( $id, $data )
	{
		return $this->db->update('cms_widgets', $data, array('id' => $id));
	}

	/**
	 * functions to manage navigation
	 */

	 public function get_all_navigations()
	{
		$this->db->order_by('position','asc');
		$query = $this->db->get('cms_navigations');

		return $query->result();

	}


	public function get_navigation($id)
	{
		$query = $this->db->get_where('cms_navigations', array('id' => $id));
		return $query->first_row();
	}

	public function create_navigation($input=array())
	{
		$data = array(
			'title'=>$input['title'],
			'link'=>$input['link'],
			'uri'=>$input['uri'],
			'parent'=>@$input['parent'],
		);
		return $this->db->insert('cms_navigations',$data);
	}

	public function edit_navigation($id,$input=array())
	{
		$this->db->where('id',$id);
		$data = array(
			'title'=>$input['title'],
			'link'=>$input['link'],
			'uri'=>$input['uri'],
			'parent'=>@$input['parent'],
		);
		return $this->db->update('cms_navigations',$data);
	}

	public function get_child_navigations($parent)
	{
		if($parent==''){return array();}
		$this->db->order_by('position','asc');
		$this->db->where('parent',$parent);
		$query = $this->db->get('cms_navigations');
		$result = $query->result();
		return $result;

	}

	public function get_all_files()
	{
		$query = $this->db->get('cms_files');
		return $query->result();
	}

	public function get_file($id)
	{
		$query = $this->db->get_where('cms_files', array('id' => $id));
		return $query->first_row();
	}

	public function get_file_by_name($name)
	{
		$query = $this->db->get_where('cms_files', array('filename' => $name));
		return $query->row(); 
	}


	public function create_file($input=array(), $existing=true)
	{
		$this->load->helper('date');
		$data = array(
			'name'=>$input['name'],
			'alt_text'=>@$input['alt_text'],
			'created_on'=> date('Y-m-d H:i:s')
		);

		if(!$existing) {
			$data['path']        = 'uploads/files/';
			$data['filename']    = $input['name'];
			$data['thumbnail']   = $input['name'];
			$data['filenameExt'] = $input['ext'];
		}

		$this->db->insert('cms_files',$data);
		$insertId = $this->db->insert_id();
		if($existing) $this->upload_image($input,$insertId);
		return true;
	}

	public function edit_file($id,$input=array(),$file=array())
	{
		//$this->load->helper('date');
		$this->db->where('id',$id);
		$data = array(
			'name'=>$input['name'],
			'alt_text'=>@$input['alt_text'],
			'created_on'=> date('Y-m-d H:i:s')
		);
	    $this->db->update('cms_files',$data);

	    if( !empty($file['filename']['name']) ) {
	    	$insertId = $id;
			$this->upload_image($input,$insertId,TRUE);
	    }
		return true;
	}

	public function upload_image($input,$insertId,$replace=FALSE)
	{

		$this->load->library('upload');
		$this->load->library('image_lib');
		// First we need to upload the image to the server
		$upload_conf['upload_path'] 	= 'uploads/files/full/images/';
		$upload_conf['allowed_types'] 	= 'jpeg|jpg|gif|png';
		//$upload_conf['max_size']=120;
		$this->upload->initialize($upload_conf);

		// Let's see if we can upload the file

		$images_list = array('filename');

		for($i=0;$i<count($images_list);$i++)
		{
			$this->image_lib->clear();
			$imageNo = $images_list[$i];

			if ( $this->upload->do_upload($imageNo) )
			{
				$uploaded_data 	= $this->upload->data();

				// Set the data for creating a thumbnail
				$source			= 'uploads/files/full/images/' . $uploaded_data['file_name'];
				$destination	= 'uploads/files/thumbs';
				$options		= array();

				// Is the current size larger? If so, resize to a width/height of X pixels (determined by the config file)
				if ( $uploaded_data['image_width'] > 100)
				{
					$options['width'] = 100;
				}
				if ( $uploaded_data['image_height'] > 100)
				{
					$options['height'] = 100;
				}

				$feasible = true;// $this->isFeasibleForThumb($source);
				if($feasible){
					 $this->resize('resize', $source, $destination, $options);
				}

				$DATA[$imageNo]=$uploaded_data['raw_name'];
				$DATA[$imageNo.'Ext']=$uploaded_data['file_ext'];
				$DATA['thumbnail']=$uploaded_data['raw_name'];
				$DATA['path']='uploads/files/';

				if($insertId)
						{
							$this->db->where('id', $insertId);
							$this->db->update('cms_files', $DATA);

						}


			}
		else{
		echo $this->upload->display_errors();exit;
		}
			}

	}

	 public function resize($mode, $source, $destination, $options = array())
	{
		$this->load->library('upload');
		$this->load->library('image_lib');
		// Time to resize the image
		$image_conf['image_library'] 	= 'gd2';
		$image_conf['source_image']  	= $source;
		$image_conf['maintain_ratio'] = FALSE;
		// Save a new image somewhere else?
		if ( !empty($destination) )
		{
			$image_conf['new_image']	= $destination;
		}

		$image_conf['thumb_marker']		= '_thumb';
		$image_conf['create_thumb']  	= TRUE;
		$image_conf['quality']			= '80';

		// Optional parameters set?
		if ( !empty($options) )
		{
			// Loop through each option and add it to the $image_conf array
			foreach ( $options as $key => $option )
			{
				$image_conf[$key] = $option;
			}
		}

		$this->image_lib->initialize($image_conf);

		if ( $mode == 'resize' )
		{
			//if(!$this->image_lib->resize())
			//	{
			//		$this->image_lib->display_errors();exit;
			//	}
			return $this->image_lib->resize();
		}
		else if ( $mode == 'crop' )
		{
			return $this->image_lib->crop();
		}

		return FALSE;
	}


	public function upload_footer($input,$insertId,$item_type)
	{

		$this->load->library('upload');
		$this->load->library('image_lib');
		// First we need to upload the image to the server
		$upload_conf['upload_path'] 	= 'uploads/files/footer/';
		$upload_conf['allowed_types'] 	= 'jpeg|jpg|gif|png';
		//$upload_conf['max_size']=120;
		$this->upload->initialize($upload_conf);

		// Let's see if we can upload the file

		$images_list = array($item_type);

		for($i=0;$i<count($images_list);$i++)
		{
			$this->image_lib->clear();
			$imageNo = $images_list[$i];

			if ( $this->upload->do_upload($imageNo) )
			{
				$uploaded_data 	= $this->upload->data();

				// Set the data for creating a thumbnail
				$source			= 'uploads/files/footer/' . $uploaded_data['file_name'];


				$DATA['content']=$uploaded_data['file_name'];

				if($insertId)
						{
							$this->db->where('id', $insertId);
							$this->db->update('cms_contents', $DATA);

						}


			}
		else{
		//echo $this->upload->display_errors();exit;
		}
			}

	}

	public function upload_header($input,$insertId,$item_type)
	{

		$this->load->library('upload');
		$this->load->library('image_lib');
		// First we need to upload the image to the server
		$upload_conf['upload_path'] 	= 'uploads/files/header/';
		$upload_conf['allowed_types'] 	= 'jpeg|jpg|gif|png';
		//$upload_conf['max_size']=120;
		$this->upload->initialize($upload_conf);

		// Let's see if we can upload the file

		$images_list = array($item_type);

		for($i=0;$i<count($images_list);$i++)
		{
			$this->image_lib->clear();
			$imageNo = $images_list[$i];

			if ( $this->upload->do_upload($imageNo) )
			{
				$uploaded_data 	= $this->upload->data();

				// Set the data for creating a thumbnail
				$source			= 'uploads/files/header/' . $uploaded_data['file_name'];


				$DATA['content']=$uploaded_data['file_name'];

				if($insertId)
						{
							$this->db->where('id', $insertId);
							$this->db->update('cms_contents', $DATA);

						}


			}
		else{
		//echo $this->upload->display_errors();exit;
		}
			}

	}

	public function get_declaration() {
		$query = $this->db->get('declaration');
		if( $query->row() ) {
			return $query->result();
		}
	}

	public function update_declaration( $data ) {
		$table = 'declaration';

		$query = $this->db->get_where($table, array('dec_id' => $data['dec_id']));
        
        if( $query->row() ) {
            return $this->db->update( $table, $data, "dec_id = ".$data['dec_id']);
        } else {
            return $this->db->insert($table, $data);
        }
		
	}




}