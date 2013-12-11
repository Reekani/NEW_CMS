<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ChatHistory extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('chatHistory_model');
  $this->load->model('user_model');
 }
 
 public function view_history($user) {
     $data['me'] = $this->session->userdata('user_name');
     $data['priv'] = $this->user_model->get_priv_messages($data['me']);
     $data['messages'] = $this->chatHistory_model->get_history($data['me'], $user);
     $this->load->view('priv_view', $data);
 }
 
 
}

?>