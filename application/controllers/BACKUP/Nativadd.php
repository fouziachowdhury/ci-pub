<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nativadd extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('NativaddModel');
        $this->load->model('BannersModel');
    }

    public function shownetivaddsec() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['allnativadds'] = $this->NativaddModel->getAllnativadds();
            //print_r($data['allnativadds']); exit;
            $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['allcomments'] = $this->NativaddModel->getcomments();
            $data['optionid'] = $this->NativaddModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            $data['allsize'] = $this->NativaddModel->getAllSize();
            $this->load->view('front/common/header');
            $this->load->view('front/common/homesidebar');
            $this->load->view('front/netivadds/nativaddspage', $data);
            $this->load->view('front/common/footer');
        }
    }

    public function showdirectory() {
        if ($_SESSION['member_id'] != '') {
            $this->load->view('front/common/header');
            $this->load->view('front/common/homesidebar');
            $this->load->view('front/directory/showdirectory');
            $this->load->view('front/common/footer');
        }
    }

    public function makefavorites() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['adds_id'] = $this->uri->segment('2');
        $data['date'] = date('Y-m-d');
        $data['option_id'] = $this->uri->segment('3');
        $makefav = $this->NativaddModel->getaddsmakefavorites($data);
        if ($makefav) {
            redirect('netivAddSec');
        } else {
            echo 'error';
        }
    }

    public function loadmorenativadds() {
        $last_limit = $_POST['last_limit'];
        $start = 1;
        $limit = $last_limit + 4;
        $data['allnativadds'] = $this->NativaddModel->getloadnativadds($limit, $start);
        $member_id = $_SESSION['member_id'];
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $json = array();
        $json['nativadds'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        $json['nativaddscount'] = count($data['allnativadds']);
        echo json_encode($json);
    }

    public function nativaddssearch() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['country'] = $_POST['country'];
        $data['category'] = $_POST['category'];
        $size = $_POST['size'];
        $dddd = explode("-", $size);
        $data['width'] =$dddd[0];
        $data['height'] =$dddd[1];
        $data['tag'] = $_POST['tag'];
        $data1['allnativadds'] = $this->NativaddModel->getSearchResult($data);
        //print_r($data1['allnativadds']); exit;
        $data1['favbanner'] = $this->NativaddModel->getfavaddsinfo($data['member_id']);
        $data1['allcountry'] = $this->BannersModel->getAllCountry();
        $data1['allcategory'] = $this->BannersModel->getAllCat();
        $data1['allcomments'] = $this->NativaddModel->getcomments();
        $data1['optionid'] = $this->NativaddModel->getoptionid();
        $data1['alltag'] = $this->BannersModel->getAllTagByOptionId($data1['optionid']->option_id);
        $data1['allsize'] = $this->NativaddModel->getAllSize();
        $this->load->view('front/common/header');
        $this->load->view('front/common/homesidebar');
        $this->load->view('front/netivadds/nativaddspage', $data1);
        $this->load->view('front/common/footer');
    }

}
