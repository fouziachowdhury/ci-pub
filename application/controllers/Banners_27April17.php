<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banners extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->model('BannersModel');
        $this->load->model('MembersModel');
        $this->load->model('LandingModel');
    }

    public function showallbanners() { 
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $package_id = 1;
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {

                //PAGINATION
                $config['base_url'] = site_url('allbannerstest');
                $config['total_rows'] = $this->BannersModel->count_all_banners();
                $config['per_page'] = "10";
                $config["uri_segment"] = 2;
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = floor($choice);

                //config for bootstrap pagination class integration
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = false;
                $config['last_link'] = false;
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = 'Previous';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);
                $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

                //call the model function to get the department data
                $data['allbanners'] = $this->BannersModel->getloadbanner($config["per_page"], $data['page']);
                $data['pagination'] = $this->pagination->create_links();
                $totalshowing = $data['page'] + $config["per_page"];
                $data['showing'] = "Showing " . $data['page'] . " to " . $totalshowing . " of " . $config['total_rows'] . " entries";
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);
                $this->load->view('front/banners/banner_master', $data);
            } else {
                $data['permission_message'] = "You have no permission to access in this page";
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);
                $this->load->view('front/banners/banner_master', $data);
            }
        }
    }

    public function showallbannersTest() { 
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $package_id = 1;
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {
               
                //PAGINATION
                $config['base_url'] = site_url('allbannerstest');
                $config['total_rows'] = $this->BannersModel->count_all_banners();
                $config['per_page'] = "10";
                $config["uri_segment"] = 2;
                $choice = $config["total_rows"] / $config["per_page"];
                $config["num_links"] = floor($choice);

                //config for bootstrap pagination class integration
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = false;
                $config['last_link'] = false;
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = 'Previous';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';

                $this->pagination->initialize($config);
                $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

                //call the model function to get the department data
                $data['allbanners'] = $this->BannersModel->getloadbanner($config["per_page"], $data['page']);
                $data['pagination'] = $this->pagination->create_links();
                $totalshowing = $data['page'] + $config["per_page"];
                $data['showing'] = "Showing " . $data['page'] . " to " . $totalshowing . " of " . $config['total_rows'] . " entries";
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);  
                $this->load->view('front/banners/banner_master', $data);
            } else {
                $data['permission_message'] = "You have no permission to access in this page";
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);
                $this->load->view('front/banners/banner_master', $data);
            }
        }
    }

    public function bannersearch() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['country'] = $_POST['country'];
        $data['category'] = $_POST['category'];
        $data['tag'] = $_POST['tag'];
        $size = $_POST['size'];
        $dddd = explode("-", $size);
        $data['width'] = $dddd[0];
        $data['height'] = $dddd[1];
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
        $data['option_id'] = $this->uri->segment('3');
        $data['date'] = date('Y-m-d');
        $data['date'] = date('Y-m-d');
        $makefav = $this->BannersModel->getbannermakefavorites($data);
        if ($makefav) {
            if ($this->uri->segment('3') == 1) {
                redirect('allbanners');
            }
            if ($this->uri->segment('3') == 13) {
                redirect('landingpage');
            }
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
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
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

    public function bannerTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 1;
            $tags_info = $this->BannersModel->getbanTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }

    public function bannercommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $data['all_com_info'] = $this->BannersModel->getbannercomments($option_id, $addsId);
        $this->load->view('front/banners/bannersCommentModal', $data);
    }

    public function searchbannerbyentries() {
        $searchval = $_POST['searchval'];
        $member_id = $_SESSION['member_id'];
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfo($searchval);
        // print_r( $data['allbanners']); 
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchbannerbyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobykey($searchKey);
        // print_r( $data['allbanners']); 
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbannerbycatid(){
        $cat_id = $_POST['cat_id'];
        $member_id = $_SESSION['member_id'];
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobycat($cat_id);
        // print_r( $data['allbanners']); 
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbannerbycountryid(){
        $country_id = $_POST['country_id'];
        $member_id = $_SESSION['member_id'];
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobycountryid($country_id);
        // print_r( $data['allbanners']); 
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbannerbysize(){
        $width = $_POST['width'];
        $height = $_POST['height'];
        $member_id = $_SESSION['member_id'];
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobysize($width,$height);
        // print_r( $data['allbanners']); 
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
}
