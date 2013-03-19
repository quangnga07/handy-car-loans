<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms_frontend_model extends CI_Model {

	public function get_header()
	{
		$query = $this->db->get_where('cms_contents', array('area' => 'header','page'=>'all'));
		$result = $query->result();
		$data = array();
		foreach($result as $row){
			$data[$row->item_type] = $row->content;
		}
		return $data;

	}

	public function get_navigations()
	{
		$this->db->order_by('position','asc');
		$query = $this->db->get('cms_navigations');
		$result = $query->result();
		return $result;

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

	public function get_page_content($slug)
	{
		$query = $this->db->get_where('cms_pages', array('slug' => $slug));
		$result = $query->first_row();
		return $result;
	}

	public function get_page_widgets($slug)
	{
		$page_id = $this->get_page_content($slug);

		if( !empty($page_id) ) {
			$query = $this->db->get_where('cms_widget_instances',array('page_id'=>$page_id->id));
			return $query->result();
		}
	}
	
	public function get_footer()
	{
		$query = $this->db->get_where('cms_contents', array('area' => 'footer','page'=>'all'));
		$result = $query->result();
		$data = array();
		foreach($result as $row){
			$data[$row->item_type] = $row->content;
		}
		return $data;
	}

	public function get_alt_text()
	{
		$data    = array();

		$query = $this->db->get('cms_files');
		$result = $query->result();

		foreach($result as $row){
			$data[$row->alt_text] = $row->filename.$row->filenameExt;
		}
		return $data;
	}

}