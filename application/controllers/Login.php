<?php

class Login extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $member_id =  $this->session->userdata('member_id');
        $type =  $this->session->userdata('type');
//        echo $type;die();
        if($type == 1)
        {
            redirect('admin');
        }
        $this->load->model('login_model');
    }
    
    public function index() {
        $this->load->view('login');
    }
    
    public function checkLogin() {
        $email = $this->input->post('email',TRUE);
        $password  = $this->input->post('password',TRUE);
        
        $result = $this->login_model->admin_login_check($email,$password);
   //     print_r($result);die();
        $m_data = array();
        
        if($result){
            $name_data = array();
            $name_data['member_id']= $result->member_id;
            $name_data['type']= $result->type;
            $name_data['email']= $result->email;
            $name_data['name']= $result->name;
            $name_data['package_id']= $result->package_id ;

//            print_r($name_data);die();

            $this->session->set_userdata($name_data);
            redirect('admin');

        }
        else {
            $m_data['exception']='Email or Password is  Incorrect';
            $this->session->set_userdata($m_data);
            redirect('login');
        }
    }
    
    
}
