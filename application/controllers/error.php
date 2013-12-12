<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller{
 
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('design_model');
    }
    
    public function no_access() 
    {
        $code['message'] = $this->design_model->error('text').
                $this->design_model->info('text').
                $this->design_model->success('text').
                $this->design_model->warning('text').
                $this->design_model->validation('text').
                
                "";
        $this->load->view('default',$code);        
    }
}