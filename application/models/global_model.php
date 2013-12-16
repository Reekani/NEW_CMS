<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->load->database();
    }
    
    function data() {
        $data = array();
            $data['me'] = $this->session->userdata('user_name');
            $data['friends'] = $this->user_model->get_friends($data['me']);
            
            return $data;
    }

}
