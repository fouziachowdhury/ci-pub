<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Network extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('MembersModel');
    }

    public function networkpackeges() { 
        $data['membership_options'] = $this->MembersModel->getoptionbynetpack();
        $data['mem_opt'] = $this->MembersModel->getoptionbynetwhoispack();
        $pack = 12;
        
        $data['superpackageinfo'] = $this->MembersModel->getsuperpackageinfo($pack);

        $this->load->view('front/common/header');
//        $this->load->view('front/common/menu');
        $this->load->view('front/network/network', $data);
        $this->load->view('front/common/footer');
    }

    public function userhomenetworkpackeges() {
        $data['membership_options'] = $this->MembersModel->getoptionbynetpack();
        //print_r($data['membership_options']); exit;
        $this->load->view('front/common/header');
        $this->load->view('front/common/homesidebar');
        $this->load->view('front/network/userhomenetwork', $data);
        $this->load->view('front/common/footer');
    }

    public function selectcustompackageoption() {
//        echo '<pre>';print_r($_POST);die;
        $option_id = $this->input->post('option_id');
           
        foreach ($option_id as $option){
            $option_data[] = $option;
        }
        $this->session->set_userdata('option_id',$option_data);
        
        if ($_SESSION['member_id'] != '') {
             if(isset($_SESSION['choose_amount'])){
               $choose_amount = $_SESSION['choose_amount'];
            } else {
                 $choose_amount = 0;
            }
            
            if(isset($_SESSION['choose_amount'])){
                $choose_option_id = $_SESSION['choose_amount'];
            } else {
                $choose_option_id = 0;
            }
            
            $data['choose_amount'] = $choose_amount;
            $choose_option_id = $choose_option_id;
            $optionvalue = explode("/", $choose_option_id);
            foreach ($optionvalue as $key => $option) {
                if ($option != '') {
                    $optionid[] = $option;
                }
            }
            $data['choose_option_id'] = $optionid;

            $data['membership_options'] = $this->MembersModel->getoptionbynetpack();
            $data['mem_opt'] = $this->MembersModel->getoptionbynetwhoispack();
            
//            $this->load->view('front/common/header');
////            $this->load->view('front/common/menu');
//            $this->load->view('front/network/custompackageoptions', $data);
//            $this->load->view('front/common/footer');
            redirect('payfornetwork');
        } else {
            
//            print_r($option_data);die;
            
           $this->session->set_userdata('last_page', 'network');
           $this->session->set_userdata('redirect', 'selectcustompackageoption');
            //redirect('loginform');
           
            redirect('registrationform');
        }
    }

    public function approvepackage() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['amount'] = $this->uri->segment('2');
            $data['user_info'] = $this->MembersModel->memberinfo($member_id);
            $data['email'] = $data['user_info']->email;
            $data['item_name'] = "Network Super";
            $data['custom'] = $member_id;
            $data['package_id'] = 2;
            $data['option_id'] = 12;
            
            $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
            $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
            
            $data['notify_url'] = base_url() . 'paypal_notification';
            $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
            $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
            $data['paypalfor'] = "Network Super Package";
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/network/superpackage', $data);
            $this->load->view('front/common/footer');
        } else {
            $option_id = 12;
            $data['optionPrice'] = $this->MembersModel->getOptionPrice($option_id);
            $optionPrice = $data['optionPrice']->option_price;
            $this->session->set_userdata('last_page', 'network');
            $net = 'approveNetworkPackage/'.$optionPrice;
            $this->session->set_userdata('redirect', $net);
            //redirect('loginform');
            redirect('registrationform');
        }
    }

    public function payfornetwork() {
//        print_r($_POST); exit; 
        $data['option_id'] = $this->session->userdata('option_id');
//        print_r($option_id);die;
        $form_array = $_POST;
        $final_array = array_pop($form_array);
//        print_r($final_array);die;
//        $data['optionname'] = $this->MembersModel->getoptionbyid($form_array);
        $data['optionname'] = $this->MembersModel->getoptionbyid($data['option_id']);
//        $data['amount'] = $_POST['amount'];
        $member_id = $_SESSION['member_id'];
        
        $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
        $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
        
        $data['user_info'] = $this->MembersModel->memberinfo($member_id);
        $data['email'] = $data['user_info']->email;
        $data['item_name'] = "Whois Silver";
        $data['custom'] = $member_id;
        $data['package_id'] = 2;
//        $data['option_id'] = $_POST['option_id'];
//        $data['option_id1'] = $_POST['optionradio'];
        $data['notify_url'] = base_url() . 'paypal_notification';
        $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
        $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
        $data['paypalfor'] = "Super Affiliate Package";
//        echo '<pre>';print_r($data['optionname']);die;
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/network/payfornetworkform', $data);
        $this->load->view('front/common/footer');
    }

}
