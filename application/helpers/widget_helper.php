<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author 	Mohammad Tareq Alam
 */
if (!function_exists('render_widget'))
{
	/**
	 * render in front end
	 */

	function render_widget($widgetid)
	{

	}

	/**
	 * render the widget form in backend
	 */
	 function render_widget_form($widgetid,$data=array())
	 {
	 	$CI =& get_instance();
	 	$template_file = 'frontend/widgets/'.$widgetid.'/form';
		return $CI->load->view($template_file, $data,TRUE);

	 }
}