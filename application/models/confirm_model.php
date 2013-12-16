<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirm_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function confirm_email($login, $hash) {
        $con_data = array();
        $this->db->where("login", $login);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $con1_data = array(
                    'id' => $rows->id,
                );
            }
            $this->db->where("hash", $hash);
            $query = $this->db->get("encrypted_temp");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rows) {
                    $con_data = array(
                        'temp_id' => $rows->user_id,
                        'mail' => $rows->mail,
                    );
                }
                if ($con1_data['id'] == $con_data['temp_id']) {
                    $data = array(
                        'mail' => $con_data['mail'],
                    );

                    $this->db->where('id', $con_data['temp_id']);
                    $this->db->update('encrypted_users', $data);
                    $this->db->where('user_id', $con_data['temp_id']);
                    $this->db->delete('encrypted_temp');
                    return true;
                }
            }
        }
    }

}

?>