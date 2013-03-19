<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Minit {
	private $url;
	private $data;
	private $username;
	private $password;

	public function __construct()
	{
        $CI =& get_instance();

        $CI->load->model('backend/minit_model');

        $data = $CI->minit_model->get_settings();

		$this->url = 'https://www.min-it.net/upload/';
		$this->username = $data->username; // 'demo';
		$this->password = $data->password; // 'site_dBhBhgCw';
	}

    public function test_connection()
    {
        echo $this->_connect( 9999 );
    }


	/**
	 * Duplicate check for email address and mobile number
	 *
	 * @param string $email 
	 * @param string $mobile
	 * @return string
	 */
	public function email_mobile_check( $email, $mobile )
	{
        $data = array(
            'email' => $email,
            'mobile' => $mobile
        );

        $output = $this->_strip_string( $this->_connect( 9101, $data ) ); 

        if( $output == 'No Match' ) {
            return false;
        } else {
            return true;
        }
	}

    /**
     * Duplicate check for email address and mobile number
     *
     * @param string $fname 
     * @param string $mnmae
     * @param string $lname 
     * @param string $dob
     * @return string
     */
	public function name_dob_check( $fname, $mname, $lname, $dob )
	{
        $data = array(
            'FirstName' => $fname,
            'MiddleName' => $mname,
            'LastName' => $lname,
            'DateOfBirth' => $dob
        );
        
        $output = $this->_connect( 9102, $data ); 

        return $output;
	}

    /**
     * Add client data to MIN-IT
     *
     * @param array $reqFields
     * @param array $otherFields default null
     * @return string
     */
    public function add_client( $reqFields, $otherFields = null )
    {
        $data = array();
        foreach( $reqFields as $k => $v ) {
            $data[$k] = $v;
        }

        if( $otherFields !== null) {
            foreach( $otherFields as $k => $v ) {
                $data[$k] = $v;
            }
        }
        
        $output = $this->_connect( 9001, $data );
        return $output;
    }

    public function add_reference( $fields ) {
        $data = array();
        foreach( $fields as $k => $v ) {
            $data[$k] = $v;
        }

        $output = $this->_connect( 9004, $data );
        return $output;
    }

    /**
     * Connect to MIN-IT
     *
     * @param int $transcode
     * @param array $data
     * @return string
     */
    private function _connect( $transcode, $data = null )
    {

        $string_data  = "username=" . $this->username;
        $string_data .= "&access=" . $this->password;
        $string_data .= "&transcode=" . $transcode;

        if( $data !== null) {
            foreach( $data as $k => $v ) {
                $string_data .= '&' . $k . '=' . urlencode($v);
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string_data);

        $result = curl_exec($ch);

        if(!$result){
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        } else {
            return $result;
        } 

        curl_close($ch);
    }

    /**
     * Strips the 'OK: Successful' to get actual result
     *
     * @param string $string
     * @return string
     */
    private function _strip_string( $string )
    {
        return preg_replace('/(.*?)-\s/s', '', $string);
    }
}