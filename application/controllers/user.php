<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('user_model');
 }
 public function index()
 {
  if(($this->session->userdata('user_name')!=""))
  {
   $this->welcome();
  }
  else{
   $data['title']= 'Home';
   $this->load->view('header_view',$data);
   $this->load->view("registration_view.php");
   $this->load->view('footer_view');
  }
 }
 public function welcome()
 {
  if(($this->session->userdata('user_name')==""))
  {
   $data['title']= 'Home';
   $this->load->view('header_view',$data);
   $this->load->view("registration_view.php");
   $this->load->view('footer_view');
  }
  else
  {
  $data['title']= 'Welcome';
  $this->load->view('header_view',$data);
  $this->load->view('welcome_view.php');
  $this->load->view('footer_view');
  }
 }
 public function login()
 {
  $login=$this->input->post('login');
  $password=md5($this->input->post('pass'));

  $result=$this->user_model->login($login,$password);
  if($result) $this->welcome();
  else        $this->index();
 }
 public function thank()
 {
  $data['title']= 'Thank';
  $this->load->view('header_view',$data);
  $this->load->view('thank_view.php');
  $this->load->view('footer_view');
  
 }
 public function registration()
 {
  $this->load->library('form_validation');
  $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
  $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
  $login=$this->input->post('user_name');
  $mail=$this->input->post('email_address');

  if($this->form_validation->run() == FALSE)
  {
   $this->index();
  }
  elseif($this->user_model->check_login($login))
  {
       $this->login_error();
  }
  elseif($this->user_model->check_mail($mail))
  {
       $this->mail_error();
  }
  else
  {

   $this->user_model->add_user();
   $this->user_model->add_unc_mail();
   $this->send_activation($mail, $login);
   $this->thank();  
   
  }
 }
 public function logout()
 {
  if(($this->session->userdata('user_name')==""))
  {
   $data['title']= 'Home';
   $this->load->view('header_view',$data);
   $this->load->view("registration_view.php");
   $this->load->view('footer_view');
  }
  else
  {
  $newdata = array(
  'user_id'   =>'',
  'user_name'  =>'',
  'user_email'     => '',
  'logged_in' => FALSE,
  );
  $this->session->unset_userdata($newdata );
  $this->session->sess_destroy();
  $this->index();
  }
 }
 public function login_error()
 {
  $data['login_error']= 'Error';
  $data['title']= 'Login zajęty';
  $this->load->view('header_view',$data);
  $this->load->view('registration_view.php',$data);
  $this->load->view('footer_view');
 }
  public function mail_error()
 {
  $data['mail_error']= 'Error';
  $data['title']= 'Mail zajęty';
  $this->load->view('header_view',$data);
  $this->load->view('registration_view.php',$data);
  $this->load->view('footer_view');
 }
 public function send_activation($mail, $login)
 {

 $email_config = Array(
            'mailtype'  => 'html',
            'starttls'  => true,
            'newline'   => "\r\n"
        );
 $this->load->library('email', $email_config);

$this->email->from('noreply@encrypted.pl', 'Invoice');
$this->email->to($mail); 

$hash = $this->user_model->get_hash($mail);

$this->email->subject('Mail aktywacyjny');
$this->email->message('Aby potwierdzić swój adres email '
        . 'kliknij link: {unwrap} www.reekani.encrypted.pl/confirm/email/'
        .$login.'/'.$hash.'{/unwrap}');	

$this->email->send();




 }
}
?>