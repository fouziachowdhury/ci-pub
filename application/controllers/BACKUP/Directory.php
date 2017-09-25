<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Directory extends CI_Controller {
     
    public function __construct() {
  //echo 55555555555555; exit;
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        //$this->load->model('StripeModel');
    }

    public function showdirectory() { 
        if($_SESSION['member_id'] !=''){
        $this->load->view('front/common/header');
        $this->load->view('front/common/homesidebar');
        $this->load->view('front/directory/showdirectory');
        $this->load->view('front/common/footer');
    }
    }

    
}
