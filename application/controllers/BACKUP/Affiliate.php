<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affiliate extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('MembersModel');
        $this->load->model('BannersModel');
        $this->load->model('AffiliateModel');
    }

    public function affiliatepackeges() {
        $data['membership_options'] = $this->MembersModel->getoptionbypackages();
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/affiliate/affiliate', $data);
        $this->load->view('front/common/footer');
    }

    public function custompackageforaffiliate() {
        if ($_SESSION['member_id'] != '') {
            $data['membership_options'] = $this->MembersModel->getoptionbypackages();
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/affiliate/affliatecuspackageoptions', $data);
            $this->load->view('front/common/footer');
        } else {
            $this->session->set_userdata('last_page', 'affiliate');
            redirect('loginform');
            //redirect('loginerror');
        }
    }

    public function superpackageforaffiliate() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['amount'] = $this->uri->segment('2');
            $data['user_info'] = $this->MembersModel->memberinfo($member_id);
            $data['email'] = $data['user_info']->email;
            $data['item_name'] = "Whois Silver";
            $data['custom'] = $member_id;
            $data['notify_url'] = base_url() . 'paypal_notification';
            $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
            $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
            $data['paypalfor'] = "Super Affiliate Package";
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/affiliate/affliatesuppackageoptions', $data);
            $this->load->view('front/common/footer');
        } else {
            redirect('loginerror');
        }
    }

    public function payforaffiliate() {
        $form_array = $_POST;
        $final_array = array_pop($form_array);
        //print_r($form_array); exit;
        $data['optionname'] = $this->MembersModel->getoptionbyid($form_array);
        $data['amount'] = $_POST['amount'];
        $member_id = $_SESSION['member_id'];
        $data['user_info'] = $this->MembersModel->memberinfo($member_id);
        $data['email'] = $data['user_info']->email;
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/affiliate/payforaffiliateform', $data);
        $this->load->view('front/common/footer');
    }

    public function affiliatefeed() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['allbanners'] = $this->BannersModel->getAllBanners();
            $data['favbanner'] = $this->AffiliateModel->getfavafflibaninfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['allsize'] = $this->BannersModel->getAllSize();
           $data['optionid'] = $this->BannersModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
            $this->load->view('front/common/header');
            $this->load->view('front/common/homesidebar');
            $this->load->view('front/affiliate/affiliatefeed', $data);
            $this->load->view('front/common/footer');
        }
    }

}
