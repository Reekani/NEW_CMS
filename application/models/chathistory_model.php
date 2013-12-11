<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ChatHistory_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_history($me, $user) {
        $this->db->where('from', $me);
        $this->db->where('to', $user);
        $this->db->select('id, from, message, sent');
        $query = $this->db->get("chat");
        $array = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rows) {
                $array[$rows->id]['id'] = $rows->id;
                $array[$rows->id]['from'] = $rows->from;
                $array[$rows->id]['message'] = $rows->message;
                $array[$rows->id]['date'] = $rows->sent;
            }
        }
        
        $this->db->where('to', $me);
        $this->db->where('from', $user);
        $this->db->select('id, from, message, sent');
        $query2 = $this->db->get("chat");
        
          if ($query2->num_rows() > 0) {
            foreach ($query2->result() as $rows) {
                $array[$rows->id]['id'] = $rows->id;
                $array[$rows->id]['from'] = $rows->from;
                $array[$rows->id]['message'] = $rows->message;
                $array[$rows->id]['date'] = $rows->sent;
            }
        }
        
        return $array;
    }
}

?>