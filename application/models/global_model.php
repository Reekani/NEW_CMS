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

    function get_menu() {

        $this->db->order_by("position", "desc");
        $query = $this->db->get("encrypted_admin_menu");
        $array = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $array[$row->id][0] = $row->icon;
                $array[$row->id][1] = $row->title;
                $array[$row->id][2] = $row->url;
                $array[$row->id][3] = $row->position;
            }
        }

        return $array;
    }

}
