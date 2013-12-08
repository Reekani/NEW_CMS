<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function login($login, $password) {
        $this->db->where("login", $login);
        $this->db->where("password", $password);

        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $newdata = array(
                    'user_id' => $rows->id,
                    'user_name' => $rows->login,
                    'user_email' => $rows->mail,
                    'logged_in' => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }
        return false;
    }

    public function add_user() {
        $data = array(
            'login' => $this->input->post('user_name'),
            'password' => md5($this->input->post('password'))
        );
        $this->db->insert('encrypted_users', $data);
    }

    public function add_unc_mail() {
        $login = $this->input->post('user_name');
        $this->db->where("login", $login);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $newdata = array(
                    'user_id' => $rows->id,
                    'mail' => $this->input->post('email_address'),
                    'hash' => md5(uniqid()),
                );
                $this->db->insert('encrypted_temp', $newdata);
            }
        }
    }

    public function check_login($login) {
        $this->db->where("login", $login);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function check_mail($mail) {
        $this->db->where("mail", $mail);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function get_hash($mail) {
        $this->db->where("mail", $mail);
        $query = $this->db->get("encrypted_temp");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data = array(
                    'hash' => $rows->hash,
                );
                return $data['hash'];
            }
        }
    }

    public function change_user_login($old_login, $new_login) {
        $this->db->where("login", $new_login);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $data = array(
                'login' => $new_login
            );

            $this->db->where('login', $old_login);
            $this->db->update('encrypted_users', $data);
            $newdata = array(
                'user_name' => $new_login
            );

            $this->session->set_userdata($newdata);
            return true;
        }
    }

    public function change_user_mail($old_mail, $new_mail) {
        $this->db->where("mail", $new_mail);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            return false;
        } else {

            $this->db->where("mail", $old_mail);
            $query = $this->db->get("encrypted_users");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rows) {
                    $newdata = array(
                        'user_id' => $rows->id,
                        'mail' => $new_mail,
                        'hash' => md5(uniqid()),
                    );
                    $this->db->insert('encrypted_temp', $newdata);
                }
            }

            return true;
        }
    }

    public function change_user_password($id, $old_password, $new_password) {
        $this->db->where('id', $id);
        $query = $this->db->get("encrypted_users");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $data = array(
                    'password' => $rows->password
                );

                if ($data['password'] == $old_password) {
                    $newdata = array(
                        'password' => $new_password
                    );
                    $this->db->where('id', $id);
                    $this->db->update('encrypted_users', $newdata);
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
    
    public function get_friends($me) {
            $this->db->where("from", $me);
            $query = $this->db->get("encrypted_friends");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rows) {
                    $array[$rows->id] = $rows->to;
                    
                }
                $newdata = $array;
                return $newdata;
            }
        
    }
    
     public function get_priv_messages($user)
 {
         $this->db->where('from', $user);
//         $this->db->or_where('from', $user);
//         $this->db->select('from, to');
//         $this->db->distinct();
         
         $query = $this->db->get("chat");
         if ($query->num_rows() > 0) {
             foreach ($query->result() as $rows) {
                 $data = array(
                     'from' => $rows->from,
                     'to' => $rows->to,
                     'id' =>$rows->id
                 );
             }
             
             return $data;
         }
 }
 
 public function get_priv_count($user)
 {
     $counter = 0;
     $this->db->where('to', $user);
     $this->db->where('rcvd', 0);
     $query = $this->db->get("encrypted_private");
     if ($query->num_rows() > 0) {
         foreach ($query->result() as $rows) {
             $counter++;
         }
         return $counter;
     }
 }

}

?>