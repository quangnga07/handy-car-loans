<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UrlParser {

	public function __construct()
	{
		$CI =& get_instance();
		$CI->load->library('encrypt');
	}

    public function encode( $url )
    {
    	$CI =& get_instance();
    	return urlencode( base64_encode( $CI->encrypt->encode( $url ) ) );
    }

    public function decode( $url )
    {
    	$CI =& get_instance();
    	return $CI->encrypt->decode( base64_decode( urldecode( $url ) ) );
    }
}

/* End of file UrlParser.php */