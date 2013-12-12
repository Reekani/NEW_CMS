<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
        
        
        
        $this->load->model('user_model');
        $this->load->model('design_model');
        $this->load->helper('url');
    }
 
    public function index()
    {
        if($this->session->userdata('user_name'))
        {
            $data = array();
            $data['me'] = $this->session->userdata('user_name');
            $data['friends'] = $this->user_model->get_friends($data['me']);
            $this->welcome();
        }
        else 
        {
            $this->load->view('default');
//            redirect('error/no_access');
        }
    }
    
    public function welcome()
    {
        if($this->session->userdata('user_name'))
        {
            $data = array();
            $data['me'] = $this->session->userdata('user_name');
            $data['friends'] = $this->user_model->get_friends($data['me']);
              $data['title']= 'WelcomeX';
            $data['priv_count'] = $this->user_model->get_priv_count($data['me']);
            $data['message'] = $this->design_model->success('Zalogowano poprawnie.');
            $this->load->view('default',$data);   
            //$this->load->view('chat',$data);
        } 
        else 
        {
            redirect('error/no_access');
        }
 }
 
// public	function chat($me, $you)
//    {
//        $data['me'] = $this->session->userdata('user_name');
//        $data['you'] = $you;
//        
//        $this->load->view('chatty', $data);
//    }
 public function login()
 {
  $login=$this->input->post('login');
  $password=md5($this->input->post('pass'));

  $result=$this->user_model->login($login,$password);
  if($result) {
      $_SESSION['username'] = $this->session->userdata('user_name');
      $this->welcome();
  }
  else $this->wrong_login_data();
 }
 
  public function wrong_login_data()
 {
      $data['message'] = $this->design_model->error('Niepoprawne dane logowania.');
      $this->load->view('default',$data);  
 }
  public function edit()
 {
    if(($this->session->userdata('user_name')!=""))
  {
        $data = array();
            $data['me'] = $this->session->userdata('user_name');
            $data['friends'] = $this->user_model->get_friends($data['me']);
        $this->load->view('user/edit_view',$data);
  }
  else{
   redirect('error/no_access');
  }
 }
 
 public function change_mail()
 {
     $data = array();
            $data['me'] = $this->session->userdata('user_name');
            $data['friends'] = $this->user_model->get_friends($data['me']);
     $this->load->library('form_validation');
     $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
     if($this->form_validation->run() == FALSE)
     {
         $this->edit();
     }
     else
     {
     $old_mail = $this->session->userdata('user_email');
     $new_mail = $this->input->post('email_address');
     if($old_mail == $new_mail)
     {
        $data['message'] = 'ten_sam_email';
        $this->load->view('user/edit_view',$data);
     }
     else
     {
        $result = $this->user_model->change_user_mail($old_mail, $new_mail);
        if ($result)
        {
            $data['message'] = 'brawo';
            $login = $this->session->userdata('user_name');
            $this->send_activation($new_mail, $login);
        }
        else 
        {
            $data['message'] = 'tryAgain';

        }

        $this->load->view('user/edit_view',$data);
     }
     }
 }
 
 public function change_password()
 {
     $data = array();
            $data['me'] = $this->session->userdata('user_name');
            $data['friends'] = $this->user_model->get_friends($data['me']);
     $this->load->library('form_validation');
     $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
     $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
     if($this->form_validation->run() == FALSE)
     {
        $this->load->view('user/edit_view',$data);
     }
     else
     {
         $id = $this->session->userdata('user_id');
         $old_password = md5($this->input->post('current_password'));
         $new_password = md5($this->input->post('password'));
         $result = $this->user_model->change_user_password($id, $old_password, $new_password);
         if($result)
         {
             $data['message'] = 'brawo';

         }
         else 
         {
             $data['message'] = 'Niepoprawne haseło';
         }
         
        $this->load->view('user/edit_view',$data);
         
         
     }
     
 }
 public function thank()
 {
   $data['title']= 'Rejestracja';
 $data['message'] = $this->design_model->success('Zostałeś poprawnie zarejestrowany. Prosimy o aktywację konta za pomocą linku aktywacyjnego wysłanego na adres mail.');
$this->load->view('default.php',$data);
  
 }
    public function registration()
    {
        if($this->session->userdata('user_name'))
        {
            $data['message'] = $this->design_model->error('Nie możesz się zarejestrować, gdy jesteś już zalogowany.');
            $this->load->view('default',$data); 
        }
        else 
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
            $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');
            $login=$this->input->post('user_name');
            $mail=$this->input->post('email_address');

            if($this->form_validation->run() == FALSE)
            {
                $data['title']= 'Rejestracja';
                $this->load->view('user/register_view.php',$data);
            }
            elseif($this->user_model->check_login($login))
            {
                 $this->login_taken();
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
 }
 
 
 public function logout()
 {
  if($this->session->userdata('user_name'))
  {
      session_start();
    $this->session->sess_destroy();
    session_destroy();
  }
  $this->load->view('default');
 }
 

 public function login_taken()
 {
 $data['title']= 'Rejestracja';
 $data['message'] = $this->design_model->error('Niestety ten login jest już zajęty.');
$this->load->view('user/register.php',$data);
 }
  public function mail_error()
 {
 $data['title']= 'Rejestracja';
 $data['message'] = $this->design_model->error('Niestety ten adres mail został już użyty.');
$this->load->view('user/register.php',$data);
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
        . 'kliknij link: {unwrap} www.reekani.encrypted.pl/NEW_CMS/index.php/confirm/email/'
        .$login.'/'.$hash.'{/unwrap}');	

$this->email->send();




 }
 
 public function private_messages()
 {
       if(($this->session->userdata('user_name')!=""))
  {
           $data['me'] = $this->session->userdata('user_name');
           $data['priv'] = $this->user_model->get_priv_messages($data['me']);
           $this->load->view('priv_view', $data);
       }
 }
 

}
?>