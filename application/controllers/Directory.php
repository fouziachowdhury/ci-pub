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
        if ($_SESSION['member_id'] != '') {
            $data['page_title'] = 'Directory';
            $data['header'] = $this->load->view('front/common/userheader', '', true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/directory/showdirectory', $data, TRUE);
            $this->load->view('front/front_master', $data);



           // $this->load->view('front/common/header');
            //$this->load->view('front/common/homesidebar');
           // $this->load->view('front/directory/showdirectory');
           // $this->load->view('front/common/footer');
        }
    }

}
