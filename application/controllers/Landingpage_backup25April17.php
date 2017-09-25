<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landingpage extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('MembersModel');
        $this->load->model('BannersModel');
        $this->load->model('AffiliateModel');
        $this->load->model('LandingModel');
    }

    public function showlandingpage() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['alllandingpageinfo'] = $this->LandingModel->alllandingpage();
            //print_r($data['alllandingpageinfo']); exit; 
            $data['favbanner'] = $this->AffiliateModel->getfavafflibaninfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['allsize'] = $this->BannersModel->getAllSize();
            $data['optionid'] = $this->BannersModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            // $data['allcomments'] = $this->LandingModel->getlandingcomments();

            $data['page_title'] = 'Offer';
            $data['header'] = $this->load->view('front/common/userheader', '', true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/landingpage/alllandingpage', $data, TRUE);
            $this->load->view('front/front_master', $data);
        }
    }

    public function landingcommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $data['all_com_info'] = $this->LandingModel->getlandingcomments($option_id,$addsId);
        $this->load->view('front/landingpage/landingCommentModal', $data);
    }

}
