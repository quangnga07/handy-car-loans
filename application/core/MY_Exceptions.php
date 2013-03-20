<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    public function __construct()
    {
        parent::__construct();
    }

    public function show_404($page = '')
    {
        header("HTTP/1.1 404 Not Found");
        redirect('error_404', 'location');
    }
}