<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ppv extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->model('BannersModel');
        $this->load->model('MembersModel');
        $this->load->model('PpvModel');
        $this->load->model('LandingModel');
    }

    public function showallppv() { 
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi= explode(',', $permissionId);
            $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $string = array();
            foreach ($getpermisetting as $key=>$get) {
                $string[$get['option_id']] = $get['is_active'];
            }
            $data['testpage'] = $string;
            
            $package_id = 1;
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
             if(isset($checkpermission)){
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {

                //PAGINATION
                $config['base_url'] = site_url('ppvAddSec');
                $config['total_rows'] = $this->PpvModel->count_all_ppv();
                $config['per_page'] = "4";
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
                $data['allppv'] = $this->PpvModel->getloadppv($config["per_page"], $data['page']);
                $data['pagination'] = $this->pagination->create_links();
                $totalshowing = $data['page'] + $config["per_page"];
                $data['showing'] = "Showing " . $data['page'] . " to " . $totalshowing . " of " . $config['total_rows'] . " entries";
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->PpvModel->getAllCountry();
                $data['allcategory'] = $this->PpvModel->getAllCat();
                $data['optionid'] = $this->PpvModel->getoptionid();
                $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'PPV';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/ppv/allppv', $data, TRUE);
                $this->load->view('front/ppv/ppv_master', $data);
            } 
            } else {
                $data['permission_message'] = "You have no permission to access in this page";
                $data['page_title'] = 'PPV';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/ppv/allppv', $data, TRUE);
                $this->load->view('front/ppv/ppv_master', $data);
            }
        }
    }

    


    public function makefavorites() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['adds_id'] = $this->uri->segment('2');
        $data['option_id'] = $this->uri->segment('3');
        $data['date'] = date('Y-m-d');
        $data['date'] = date('Y-m-d');
        $makefav = $this->PpvModel->getbannermakefavorites($data);
        if ($makefav) {
            if ($this->uri->segment('3') == 1) {
                redirect('allbanners');
            }
            if ($this->uri->segment('3') == 13) {
                redirect('landingpage');
            }
            if ($this->uri->segment('3') == 4) {
                redirect('faceecomerceSec');
            }
        } else {
            echo 'error';
        }
    }

    public function loadmorebanner() {
        $last_limit = $_POST['last_limit'];
        $start = 1;
        $limit = $last_limit + 4;
        $data['allppv'] = $this->PpvModel->getloadbanner($limit, $start);
        $member_id = $_SESSION['member_id'];
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        $json['bannercount'] = count($data['allppv']);
        echo json_encode($json);
    }

    public function ppvTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 5;
            $tags_info = $this->PpvModel->getppvTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }

    public function bannercommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $data['all_com_info'] = $this->PpvModel->getbannercomments($option_id, $addsId);
        $this->load->view('front/banners/bannersCommentModal', $data);
    }

    public function searchppvbyentries() {
        $searchval = $_POST['searchval'];
        $member_id = $_SESSION['member_id'];
        $data['allppv'] = $this->PpvModel->searchbannerpageinfo($searchval);
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchppvbyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allppv'] = $this->PpvModel->searchppvpageinfobykey($searchKey);
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchppvbycatid(){
        $cat_id = $_POST['cat_id'];
        $member_id = $_SESSION['member_id'];
        $data['allppv'] = $this->PpvModel->searchppvpageinfobycat($cat_id);
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchppvbycountryid(){
        $country_id = $_POST['country_id'];
        $member_id = $_SESSION['member_id'];
        $data['allppv'] = $this->PpvModel->searchppvpageinfobycountryid($country_id); 
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
     public function ppvcommentmodal(){
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $member_id = $_SESSION['member_id'];
        $data['all_com_info'] = $this->BannersModel->getbannercomments($option_id, $addsId, $member_id);
        $this->load->view('front/ppv/ppvCommentModal', $data);
    }
   
    public function searchppvbymyfav(){
         $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        $data['allppv'] = $this->PpvModel->searchppvpageinfobymyfav($member_id, $option_id);
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['myfav'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchppvbymycom(){
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        $data['allppv'] = $this->PpvModel->searchppvpageinfobymycom($member_id, $option_id);
        //print_r($data['alllandingpageinfo']); exit;
       $option_id = 5;
       $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['mycom'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function ppvByCategory($cat_id) {
        $member_id = $_SESSION['member_id'];

        $checkUserPackage = $this->MembersModel->memberinfo($member_id);
        $userPackageId = $checkUserPackage->package_id;
        $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
        $permissionId = $userPermissionTblInfo->option_id;
        $permi = explode(',', $permissionId);
        $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
        $string = array();
        foreach ($getpermisetting as $key => $get) {
            $string[$get['option_id']] = $get['is_active'];
        }
        $data['testpage'] = $string;

        $package_id = 1;
        $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
        if (isset($checkpermission)) {
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {

                $config = array();
                $config["base_url"] = base_url() . "ppv/ppvByCategory/" . $cat_id;
                $cat_id = ',' .$cat_id.',';
                $config['total_rows'] = $this->PpvModel->count_all_ppv_by_cat($cat_id);
                $config["per_page"] = 4;
//                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $this->PpvModel->count_all_ppv_by_cat($cat_id);
                $config['cur_tag_open'] = '&nbsp;<a class="current">';
                $config['cur_tag_close'] = '</a>';
                $config['next_link'] = 'Next';
                $config['prev_link'] = 'Previous';

                $this->pagination->initialize($config);
                if ($this->uri->segment(4)) {
                    $page = $this->uri->segment(4);
                } else {
                    $page = 0;
                }
//        echo $page;die();        
                $data['allppv'] = $this->PpvModel->all_ppv_by_cat_id($config["per_page"], $page, $cat_id);
//                echo '<pre>';print_r($data['allppv']);die;
                $str_links = $this->pagination->create_links();
                $data['links'] = explode('&nbsp;', $str_links);
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->PpvModel->getAllCountry();
                $data['allcategory'] = $this->PpvModel->getAllCat();
                $data['optionid'] = $this->PpvModel->getoptionid();
                $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'PPV';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);

                $data['front_maincontent'] = $this->load->view('front/ppv/all_ppv_by_category', $data, TRUE);
//                $data['front_maincontent'] = $this->load->view('front/ppv/allppv', $data, TRUE);
                $this->load->view('front/ppv/ppv_master', $data);
            }
        }
    }
    
    public function ppvByCountry($country_id) {
        $member_id = $_SESSION['member_id'];

        $checkUserPackage = $this->MembersModel->memberinfo($member_id);
        $userPackageId = $checkUserPackage->package_id;
        $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
        $permissionId = $userPermissionTblInfo->option_id;
        $permi = explode(',', $permissionId);
        $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
        $string = array();
        foreach ($getpermisetting as $key => $get) {
            $string[$get['option_id']] = $get['is_active'];
        }
        $data['testpage'] = $string;

        $package_id = 1;
        $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
        if (isset($checkpermission)) {
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {

                $config = array();
                $config["base_url"] = base_url() . "ppv/ppvByCountry/" . $country_id;
                $country_id = ',' .$country_id.',';
                $config['total_rows'] = $this->PpvModel->count_all_ppv_by_country($country_id);
                $config["per_page"] = 4;
//                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $this->PpvModel->count_all_ppv_by_country($country_id);
                $config['cur_tag_open'] = '&nbsp;<a class="current">';
                $config['cur_tag_close'] = '</a>';
                $config['next_link'] = 'Next';
                $config['prev_link'] = 'Previous';

                $this->pagination->initialize($config);
                if ($this->uri->segment(4)) {
                    $page = $this->uri->segment(4);
                } else {
                    $page = 0;
                }
//        echo $page;die();        
                $data['allppv'] = $this->PpvModel->all_ppv_by_country_id($config["per_page"], $page, $country_id);
//                echo '<pre>';print_r($data['allppv']);die;
                $str_links = $this->pagination->create_links();
                $data['links'] = explode('&nbsp;', $str_links);
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->PpvModel->getAllCountry();
                $data['allcategory'] = $this->PpvModel->getAllCat();
                $data['optionid'] = $this->PpvModel->getoptionid();
                $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'PPV';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);

                $data['front_maincontent'] = $this->load->view('front/ppv/all_ppv_by_country', $data, TRUE);
//                $data['front_maincontent'] = $this->load->view('front/ppv/allppv', $data, TRUE);
                $this->load->view('front/ppv/ppv_master', $data);
            }
        }
    }
    
    public function ppvByTag($tag_id) {
        $member_id = $_SESSION['member_id'];

        $checkUserPackage = $this->MembersModel->memberinfo($member_id);
        $userPackageId = $checkUserPackage->package_id;
        $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
        $permissionId = $userPermissionTblInfo->option_id;
        $permi = explode(',', $permissionId);
        $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
        $string = array();
        foreach ($getpermisetting as $key => $get) {
            $string[$get['option_id']] = $get['is_active'];
        }
        $data['testpage'] = $string;

        $package_id = 1;
        $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
        if (isset($checkpermission)) {
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {

                $config = array();
                $config["base_url"] = base_url() . "ppv/ppvByTag/" . $tag_id;
                $tag_id = ',' .$tag_id.',';
                $config['total_rows'] = $this->PpvModel->count_all_ppv_by_keyword($tag_id);
                $config["per_page"] = 4;
//                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $this->PpvModel->count_all_ppv_by_keyword($tag_id);
                $config['cur_tag_open'] = '&nbsp;<a class="current">';
                $config['cur_tag_close'] = '</a>';
                $config['next_link'] = 'Next';
                $config['prev_link'] = 'Previous';

                $this->pagination->initialize($config);
                if ($this->uri->segment(4)) {
                    $page = $this->uri->segment(4);
                } else {
                    $page = 0;
                }
//        echo $page;die();        
                $data['allppv'] = $this->PpvModel->all_ppv_by_keyword_id($config["per_page"], $page, $tag_id);
//                echo '<pre>';print_r($data['allppv']);die;
                $str_links = $this->pagination->create_links();
                $data['links'] = explode('&nbsp;', $str_links);
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->PpvModel->getAllCountry();
                $data['allcategory'] = $this->PpvModel->getAllCat();
                $data['optionid'] = $this->PpvModel->getoptionid();
                $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'PPV';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);

                $data['front_maincontent'] = $this->load->view('front/ppv/all_ppv_by_country', $data, TRUE);
//                $data['front_maincontent'] = $this->load->view('front/ppv/allppv', $data, TRUE);
                $this->load->view('front/ppv/ppv_master', $data);
            }
        }
    }

}
