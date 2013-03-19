<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailReader{
    // imap server connection
    public $conn;

    // inbox and inbox message count
    private $inbox;
    private $msg_cnt;

    // Login credentials
    private $hostname;
    private $username;
    private $password;

	public function __construct()
	{
        $this->hostname = '{mail.handycarloans.com.au:143/novalidate-cert}INBOX';
        $this->username = 'apps@handycarloans.com.au';
        $this->password = 'bYX42ND9';
	}

    private function _connect()
    {
        $this->conn = imap_open($this->hostname, $this->username, $this->password) or die('Cannot connect to Email: ' . imap_last_error());
    }

    public function inbox( $email = null )
    {
        if( $email == null ) return null;

        $rules = array(
            "/##----------.*/s",
            "/(.+)\nContent-Type:(.+)\n.+Encoding:\s\w+/s",
            "/From:\s*(.+)\s*$/s",
            "/\"from:\s*$\"/s",
            "/<(.+)\>/s",
            "/(.+) wrote:/s",
            "/On(.+) wrote:/s",
            "/On(.+)at(.+)(AM|PM),/s",
            "/-+(.+)original\s+message(.+)-+\s*$/s",
            "/\>\sTo:(.+)/s"
        );

        $this->_connect();
        $this->msg_cnt = imap_search($this->conn, 'ALL');

        
        if( $this->msg_cnt) {
            rsort($this->msg_cnt);
   
            $in = array();
            foreach($this->msg_cnt as $i) {
                $header = imap_headerinfo($this->conn, $i);
                $header_email = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                
                if( $email != $header_email ) continue;

                $body = urldecode(imap_fetchbody($this->conn, $i, 1));

                foreach($rules as $rule) {
                    $body = preg_replace($rule, '', $body);
                }
                $structure = imap_fetchstructure($this->conn, $i);

                if($structure->encoding == 3) {
                    $body = imap_base64($body);
                } else if($structure->encoding == 4) {
                    $body = imap_qprint($body);
                }

                $body = quoted_printable_decode($body);
                // $body = preg_replace("/<(div|\/div)(.*\"\>|\>|.*\" \>)/", '', $body);

                $in[] = array(
                    'index'     => $i,
                    'header'    => $header,
                    'body'      => $body,
                    'structure' => $structure
                );
            }

            return $in;
        } else {
            return null;
        }
    }
}

/* End of file UrlParser.php */