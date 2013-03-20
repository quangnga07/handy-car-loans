<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class lib{
	var $CI;
	function __construct(){
		 $this->CI =& get_instance();
	}
	
	function GeneralRandomKey($size){
		$keyset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_";
		$randkey = "";
		for ($i=0; $i<$size; $i++)
			$randkey .= substr($keyset, rand(0,strlen($keyset)-1), 1);
		return $randkey;
	}
	
	function escape($str){
		$str = trim($str);
		if (is_string($str)){
			$str = htmlentities($str, ENT_QUOTES, 'utf-8');
		}elseif (is_bool($str)){
			$str = ($str === FALSE) ? 0 : 1;
		}elseif (is_null($str)){
			$str = 'NULL';
		}
		return $str;
	}
	
	function __grabURL__($data){
		$data = trim($data);
		$data = str_replace("\n", "", $data);
		$data = str_replace("\t", "", $data);
		$data = str_replace("<", "%3C", $data);
		$data = str_replace(">", "%3E", $data);
		$data = str_replace("  ", " ", $data);
		$data = str_replace(" ", "%20", $data);
		$data = str_replace('"', "%22", $data);
		$data = str_replace("'", "%27", $data);
		return $data;
	}
	
	function reachtel_sms($username, $password, $message, $destination, $delay = NULL){
		$data = 'http://api.reachtel.com.au/api?';
		$data .= 'user='.$username;
		$data .= '&pass='.$password;
		$data .= '&action=smssend&version=3';
		$data .= '&message='.$message;
		$data .= '&destination='.$destination;
		if($delay != NULL)
			$data .= '&sendafter="+'.$delay.'"';
		
		$data = $this->__grabURL__($data);
		$content = file_get_contents($data);
		return $data;
	}
}