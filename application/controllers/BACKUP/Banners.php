<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banners extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('BannersModel');
    }

    public function showallbanners() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['allbanners'] = $this->BannersModel->getAllBanners();
            $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['allsize'] = $this->BannersModel->getAllSize();
            $data['optionid'] = $this->BannersModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            $this->load->view('front/common/header');
            //$this->load->view('front/common/homesidebar');
            $this->load->view('front/banners/allbanners_test', $data);
            // $this->load->view('front/banners/allbanners', $data);
            $this->load->view('front/common/footer');
        }
    }

    public function showallbannersTest() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['allbanners'] = $this->BannersModel->getAllBanners();
            $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['allsize'] = $this->BannersModel->getAllSize();
            $data['optionid'] = $this->BannersModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            $this->load->view('front/common/header');
            $this->load->view('front/common/homesidebar');
            $this->load->view('front/banners/allbanners', $data);
            // $this->load->view('front/banners/allbanners', $data);
            $this->load->view('front/common/footer');
        }
    }

    public function bannersearch() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['country'] = $_POST['country'];
        $data['category'] = $_POST['category'];
        $data['tag'] = $_POST['tag'];
        $size = $_POST['size'];
        $dddd = explode("-", $size);
        $data['width'] =$dddd[0];
        $data['height'] =$dddd[1];
        $data1['favbanner'] = $this->BannersModel->getfavbaninfo($data['member_id']);
        $data1['allbanners'] = $this->BannersModel->getSearchResult($data);
        $data1['allcountry'] = $this->BannersModel->getAllCountry();
        $data1['allcategory'] = $this->BannersModel->getAllCat();
        $data1['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data1['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $this->load->view('front/common/header');
        $this->load->view('front/common/homesidebar');
        $this->load->view('front/banners/allbanners', $data1);
        $this->load->view('front/common/footer');
    }

    public function makefavorites() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['adds_id'] = $this->uri->segment('2');
        $data['date'] = date('Y-m-d');
        $makefav = $this->BannersModel->getbannermakefavorites($data);
        if ($makefav) {
            redirect('allbanners');
        } else {
            echo 'error';
        }
    }

    public function loadmorebanner() {
        $last_limit = $_POST['last_limit'];
        $start = 1;
        $limit = $last_limit + 4;
        $data['allbanners'] = $this->BannersModel->getloadbanner($limit, $start);
        $member_id = $_SESSION['member_id'];
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $json = array();
        $json['bannerdiv'] = $this->load->view ('front/banners/bannerShowDiv', $data, TRUE);
        $json['bannercount'] = count($data['allbanners']);
         echo json_encode($json);
        
        
    }

    public function test_banner() {
        $data['allbanners'] = $this->BannersModel->getAllBanners();
        $this->load->view('front/common/header');
        //$this->load->view('front/common/homesidebar');
        $this->load->view('front/banners/testbanner', $data);
        //$this->load->view('front/common/footer');
    }

}
