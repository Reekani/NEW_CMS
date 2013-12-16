<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }

    function menu_add($icon, $title, $url) {
        $data = array(
            'icon' => $icon,
            'title' => $title,
            'url' => $url
        );
        $this->db->insert('encrypted_admin_menu', $data);
    }

    function menu_up($id) {
        $this->db->query("UPDATE `encrypted_admin_menu` SET `position` = `position` + 1 WHERE `id` = '$id'");
    }

    function menu_down($id) {
        $this->db->query("UPDATE `encrypted_admin_menu` SET `position` = `position` - 1 WHERE `id` = '$id'");
    }

    function menu_del($id) {
        $this->db->query("DELETE FROM `encrypted_admin_menu` WHERE `id` = '$id'");
    }

}

?>