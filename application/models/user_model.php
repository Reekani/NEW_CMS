<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
 }
 function login($login,$password)
 {
  $this->db->where("login",$login);
  $this->db->where("password",$password);

  $query=$this->db->get("encrypted_users");
  if($query->num_rows()>0)
  {
   foreach($query->result() as $rows)
   {
    $newdata = array(
      'user_id'  => $rows->id,
      'user_name'  => $rows->login,
      'user_email'    => $rows->mail,
      'logged_in'  => TRUE,
    );
   }
   $this->session->set_userdata($newdata);
   return true;
  }
  return false;
 }
 public function add_user()
 {
  $data=array(
    'login'=>$this->input->post('user_name'),
    'password'=>md5($this->input->post('password'))
  );
  $this->db->insert('encrypted_users',$data);
 }
  public function add_unc_mail()
 {
  $login = $this->input->post('user_name');
  $this->db->where("login",$login);
  $query=$this->db->get("encrypted_users");
  if($query->num_rows()>0)
  {
   foreach($query->result() as $rows)
   {
    $newdata = array(
      'user_id'  => $rows->id,
      'mail'  => $this->input->post('email_address'),
      'hash'    => md5(uniqid()),
    );
    $this->db->insert('encrypted_temp',$newdata);
   }

  }
 }
 public function check_login($login)
 {
     $this->db->where("login",$login);
     $query=$this->db->get("encrypted_users");
     if($query->num_rows()>0)
  {
   return true;
  }
  return false;
     
 }
  public function check_mail($mail)
 {
  $this->db->where("mail",$mail);
  $query=$this->db->get("encrypted_users");
  if($query->num_rows()>0)
  {
   return true;
  }
  return false;
     
 }
 public function get_hash($mail)
 {
  $this->db->where("mail",$mail);
  $query=$this->db->get("encrypted_temp");
  if($query->num_rows()>0)
  {
   foreach($query->result() as $rows)
   {
    $data = array(
      'hash'  => $rows->hash,

    );
    return $data['hash'];
   }
 }
}
}
?>