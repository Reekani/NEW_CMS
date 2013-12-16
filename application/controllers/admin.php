<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('global_model');
        $this->load->model('user_model');
        $this->load->model('admin_model');
        $this->load->model('design_model');
        $this->load->helper('url');
    }

    public function index() {
        if ($this->session->userdata('admin')) {
            $data = $this->global_model->data();
            $this->load->view('admin/main_view', $data);
        } else {
            redirect('error/no_access');
        }
    }

    public function menu($action = false, $id = false) {
        if ($this->session->userdata('admin')) {

            if ($action && $id) {
                if ($action == 'up') {
                    $this->admin_model->menu_up($id);
                }
                if ($action == 'down') {
                    $this->admin_model->menu_down($id);
                }
                if ($action == 'del') {
                    $this->admin_model->menu_del($id);
                }
            }

            $data = $this->global_model->data();

            $icons = $this->input->post('icons');
            $title = $this->input->post('title');
            $url = $this->input->post('url');

            if ($icons && $title && $url) {
                $this->admin_model->menu_add($icons, $title, $url);
                $data['message'] = $this->design_model->success('Odnośnik dodany do bazy');
            } elseif ($icons || $title || $url) {
                $data['message'] = 'Wypełnij wszystkie pola';
            }

            $data['links'] = $this->global_model->get_menu();
            $this->load->view('admin/menu_view', $data);
        } else {
            redirect('error/no_access');
        }
    }

    public function icons() {
        if ($this->session->userdata('admin')) {
            $data = $this->global_model->data();
            $this->load->view('admin/icons_view', $data);
        } else {
            redirect('error/no_access');
        }
    }

}

