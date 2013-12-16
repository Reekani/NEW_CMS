<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirm extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('confirm_model');
    }

    public function email($login, $hash) {
        if ($this->confirm_model->confirm_email($login, $hash)) {
            $data['title'] = 'Email potwierdzony';
            $data['login'] = $login;
            $this->load->view('header_view', $data);
            $this->load->view('confirm_view', $data);
            $this->load->view('footer_view');
        } else {
            $this->load->view('header_view');
            $this->load->view('conf_error_view');
            $this->load->view('footer_view');
        }
    }

}

