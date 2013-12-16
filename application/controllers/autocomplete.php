<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autocomplete extends CI_Controller {

    function index() {
        $this->load->view('autocomplete');
    }

    function users() {
        // Search term from jQuery
        $term = $this->input->post('term');

        $result = array();

        $this->load->model('auto_model');
        $users = $this->auto_model->search('encrypted_users', 'login', $term);
        foreach ($users as $user) {
            $result[] = $user;
        }

        // Finally the JSON, including the correct content-type
        header('Content-type: application/json');

        echo json_encode($result); // see NOTE!
    }

    function user_result() {
        $user = $this->input->post('user');
        redirect('user/profile/' . $user, 'refresh');
    }

}

/* End of file autocomplete.php */
/* Location: ./application/controllers/autocomplete.php */
