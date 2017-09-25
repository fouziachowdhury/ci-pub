<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Banners extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
//        $this->load->library('pagination');
        $this->load->library('Ajax_pagination');
        $this->load->model('BannersModel');
        $this->load->model('MembersModel');
        $this->load->model('LandingModel');
    }

    public function showallbanners() { 
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('width');
        $this->session->unset_userdata('height');
        $this->session->unset_userdata('searchKey');
        $this->session->unset_userdata('searchval');
        
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
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {

                //PAGINATION
                $totalRec = $this->BannersModel->count_all_banners();
                //pagination configuration
                $data['page'] = 0;
                $config['target'] = '#postList';
                $config['base_url'] = base_url() . 'banners/ajaxPaginationData';
                $config['total_rows'] = $totalRec;
                $config['per_page'] = 20;
                $config['link_func'] = 'searchFilter';
                $this->ajax_pagination->initialize($config);

                //get the posts data
                $data['allbanners'] = $this->BannersModel->getloadbanner($config["per_page"], $data['page']);
                $totalshowing = $data['page'] + $config["per_page"];
                $data['showing'] = "Showing " . $totalshowing . " of " . $config['total_rows'] . " entries";
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);
                $this->load->view('front/banners/banner_master', $data);
            } else {
                $data['permission_message'] = "You have no permission";
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
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
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('width');
        $this->session->unset_userdata('height');
        $this->session->unset_userdata('searchKey');
        $this->session->unset_userdata('searchval');
        
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
           //echo 8888888; print_r($checkpermission); exit;
            if(isset($checkpermission)){
            ///$permission_option_id = explode(',', $checkpermission->option_id);
            //$haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            // echo '<pre>'; print_r($haspermission); exit;
            //$hasper = $haspermission[0]['is_active'];
             $hasper = $checkpermission->trial;
            if ($hasper == 1) {
               
                //PAGINATION
                
                //total rows count
                $totalRec = $this->BannersModel->count_all_banners();
                //pagination configuration
                $data['page'] = 0;
                $config['target'] = '#postList';
                $config['base_url'] = base_url() . 'banners/ajaxPaginationData';
                $config['total_rows'] = $totalRec;
                $config['per_page'] = 20;
                $config['link_func'] = 'searchFilter';
                $this->ajax_pagination->initialize($config);

                //get the posts data
                $data['allbanners'] = $this->BannersModel->getloadbanner($config["per_page"], $data['page']);
//                $config['base_url'] = site_url('allbannerstest');
//                $config['total_rows'] = $this->BannersModel->count_all_banners();
//                $config['per_page'] = "25";
//                $config["uri_segment"] = 2;
//                $choice = $config["total_rows"] / $config["per_page"];
//                $config["num_links"] = floor($choice);
//
//                //config for bootstrap pagination class integration
//                $config['full_tag_open'] = '<ul class="pagination">';
//                $config['full_tag_close'] = '</ul>';
//                $config['first_link'] = false;
//                $config['last_link'] = false;
//                $config['first_tag_open'] = '<li>';
//                $config['first_tag_close'] = '</li>';
//                $config['prev_link'] = 'Previous';
//                $config['prev_tag_open'] = '<li class="prev">';
//                $config['prev_tag_close'] = '</li>';
//                $config['next_link'] = 'Next';
//                $config['next_tag_open'] = '<li>';
//                $config['next_tag_close'] = '</li>';
//                $config['last_tag_open'] = '<li>';
//                $config['last_tag_close'] = '</li>';
//                $config['cur_tag_open'] = '<li class="active"><a href="#">';
//                $config['cur_tag_close'] = '</a></li>';
//                $config['num_tag_open'] = '<li>';
//                $config['num_tag_close'] = '</li>';
//
//                $this->pagination->initialize($config);
//                $data['page'] = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
//
//                //call the model function to get the department data
//                $data['allbanners'] = $this->BannersModel->getloadbanner($config["per_page"], $data['page']);
//                $data['pagination'] = $this->pagination->create_links();
                $totalshowing = $data['page'] + $config["per_page"];
                $data['showing'] = "Showing " . $totalshowing . " of " . $config['total_rows'] . " entries";
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);  
                $this->load->view('front/banners/banner_master', $data);
            } 
            }
            else {
                $data['permission_message'] = "You have no permission";
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/allbanners', $data, TRUE);
                $this->load->view('front/banners/banner_master', $data);
            }
        }
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
//        $keywords = $this->input->post('keywords');
//        $sortBy = $this->input->post('sortBy');
//        if(!empty($keywords)){
//            $conditions['search']['keywords'] = $keywords;
//        }
//        if(!empty($sortBy)){
//            $conditions['search']['sortBy'] = $sortBy;
//        }
        
        //total rows count
        $totalRec = $this->BannersModel->count_all_banners();
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 20;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->getloadbanner($config["per_page"], $offset);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }


    public function favbannerbyuser(){
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
            //print_r($checkpermission); exit;
            if(isset($checkpermission)){
            $permission_option_id = explode(',', $checkpermission->option_id);
            $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $haspermission[0]['is_active'];
            if ($hasper == 1) {
               
                //PAGINATION
                $config['base_url'] = site_url('favbannerbyuser');
                $config['total_rows'] = $this->BannersModel->count_all_fav_banners($member_id);
                $config['per_page'] = "3";
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
                $data['allfavbanners'] = $this->BannersModel->getfavbannerbyuser($config["per_page"], $data['page'], $member_id);
                $data['pagination'] = $this->pagination->create_links();
                $totalshowing = $data['page'] + $config["per_page"];
                $data['showing'] = "Showing " . $totalshowing . " of " . $config['total_rows'] . " entries";
                // $data['allbanners'] = $this->BannersModel->getAllBanners();
                $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'Favorite Banner';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/favbanners', $data, TRUE);  
                $this->load->view('front/banners/banner_master', $data);
            } 
            }
            else {
                $data['permission_message'] = "You have no permission";
                $data['page_title'] = 'Favorite Banner';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/banners/favbanners', $data, TRUE);
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
                 $this->session->set_flashdata('success', 'Make adds Favorite Successfully');
                redirect('allbanners');
            }
            if ($this->uri->segment('3') == 13) {
                 $this->session->set_flashdata('success', 'Make adds Favorite Successfully');
                redirect('landingpage');
            }
            if ($this->uri->segment('3') == 4) {
                 $this->session->set_flashdata('success', 'Make adds Favorite Successfully');
                redirect('faceecomerceSec');
            }
            
            if ($this->uri->segment('3') == 7) {
                 $this->session->set_flashdata('success', 'Make adds Favorite Successfully');
                redirect('offerfeed');
            }
            
            if ($this->uri->segment('3') == 6) {
                 $this->session->set_flashdata('success', 'Make adds Favorite Successfully');
                redirect('affiliatefeed');
            }
            if ($this->uri->segment('3') == 3) {
                 $this->session->set_flashdata('success', 'Make adds Favorite Successfully');
                redirect('facebookSec');
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
//            print_r($tags_info);
            $json = array();
            echo json_encode($tags_info);
        }
    }

    public function bannercommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $member_id = $_SESSION['member_id'];
        $data['all_com_info'] = $this->BannersModel->getbannercomments($option_id, $addsId, $member_id);
        $this->load->view('front/banners/bannersCommentModal', $data);
    }

    public function searchbannerbyentries() {
        $searchval = $_POST['searchval'];
        
        $name_data['searchval'] = $_POST['searchval'];
        $this->session->set_userdata($name_data);
//        echo $searchval;die;
        $member_id = $_SESSION['member_id'];
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
        
        $cat_id = '';
        if($this->session->userdata('cat_id') != ''){
            $cat_id = ','.$this->session->userdata('cat_id').',';
        }
        
        $country_id = '';
        if($this->session->userdata('country_id') != ''){
            $country_id = ','.$this->session->userdata('country_id').',';
        }
        $width = $this->session->userdata('width');
        $height = $this->session->userdata('height');
        
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height);
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationLimitData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $searchval;
        $config['link_func'] = 'limitFilter';
        $this->ajax_pagination->initialize($config);

        $data['allbanners'] = $this->BannersModel->searchbannerpageinfo($config['per_page'],$offset,$searchkey,$cat_id,$country_id,$width,$height);
//         print_r( $data['allbanners']);die(); 
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
    
    function ajaxPaginationLimitData(){
        $conditions = array();
        $searchval = $this->session->userdata('searchval');
        
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
        
        $cat_id = '';
        if($this->session->userdata('cat_id') != ''){
            $cat_id = ','.$this->session->userdata('cat_id').',';
        }
        
        $country_id = '';
        if($this->session->userdata('country_id') != ''){
            $country_id = ','.$this->session->userdata('country_id').',';
        }
        
        $width = $this->session->userdata('width');
        $height = $this->session->userdata('height');
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height);
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationLimitData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = $searchval;
        $config['link_func'] = 'limitFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfo($config['per_page'], $offset,$searchkey,$cat_id,$country_id,$width,$height);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchbannerbyautokey(){
        $searchKey = ','.$_POST['searchKey'].',';
        $name_data['searchKey'] = $_POST['searchKey'];
        $this->session->set_userdata($name_data);
        
        $member_id = $_SESSION['member_id'];
        $conditions = array();
        $searchval = $this->session->userdata('searchval');

        $cat_id = '';
        if($this->session->userdata('cat_id') != ''){
            $cat_id = ','.$this->session->userdata('cat_id').',';
        }
        
        $country_id = '';
        if($this->session->userdata('country_id') != ''){
            $country_id = ','.$this->session->userdata('country_id').',';
        }
        
        $width = $this->session->userdata('width');
        $height = $this->session->userdata('height');
        
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_keyword_banner($searchKey,$cat_id,$country_id,$width,$height);

        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationKeywordData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'keywordFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobykey($config['per_page'],$offset,$searchKey,$cat_id,$country_id,$width,$height);
        
//        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobykey($searchKey);
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
    
    function ajaxPaginationKeywordData(){
        $conditions = array();
        $searchKey = '';
        if($this->session->userdata('searchKey') != ''){
            $searchKey = ','.$this->session->userdata('searchKey').',';
        }
        $searchval = $this->session->userdata('searchval');
        $cat_id = '';
        if($this->session->userdata('cat_id') != ''){
            $cat_id = ','.$this->session->userdata('cat_id').',';
        }
        
        $country_id = '';
        if($this->session->userdata('country_id') != ''){
            $country_id = ','.$this->session->userdata('country_id').',';
        }
        
        $width = $this->session->userdata('width');
        $height = $this->session->userdata('height');
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_keyword_banner($searchKey,$cat_id,$country_id,$width,$height);
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationKeywordData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'keywordFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobykey($config['per_page'],$offset,$searchKey,$cat_id,$country_id,$width,$height);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbannerbycatid(){
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
        $cat_id = '';
        if($_POST['cat_id'] != ''){
            $cat_id = ','.$_POST['cat_id'].',';
        }
        
//        echo $cat_id;die;
        $country_id = '';
        if(isset($_POST['country_id']) && $_POST['country_id'] != ''){
            $country_id = ','.$_POST['country_id'].',';
        }
        
        $width = $_POST['width'];
        $height = $_POST['height'];
        
        $member_id = $_SESSION['member_id'];
        
        $name_data['cat_id'] = $_POST['cat_id'];
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->BannersModel->count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationFilterData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'dataFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobycat($config["per_page"], $offset,$searchkey,$cat_id,$country_id,$width,$height);
//         print_r( $data['allbanners']);die(); 
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
    
    function ajaxPaginationFilterData(){
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
        
        
        $conditions = array();
        $cat_id = '';
        if($this->session->userdata('cat_id') != ''){
            $cat_id = ','.$this->session->userdata('cat_id').',';
        }
        
        $country_id = '';
        if($this->session->userdata('country_id') != ''){
            $country_id = ','.$this->session->userdata('country_id').',';
        }
        $width = $this->session->userdata('width');
        $height = $this->session->userdata('height');
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height);
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationFilterData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'dataFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->get_all_filter_banner($config["per_page"], $offset,$searchkey,$cat_id,$country_id,$width,$height);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbannerbycountryid(){
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
        
        $country_id = ','.$_POST['country_id'].',';
        
        $cat_id = '';
        if(isset($_POST['cat_id']) && $_POST['cat_id'] != ''){
            $cat_id = ','.$_POST['cat_id'].',';
        }
        
        $width = $_POST['width'];
        $height = $_POST['height'];
        
        $member_id = $_SESSION['member_id'];
//        echo $cat_id;die;
        $name_data['country_id'] = $_POST['country_id'];
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->BannersModel->count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationFilterData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'dataFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allbanners'] = $this->BannersModel->get_all_filter_banner($config["per_page"], $offset,$searchkey,$cat_id,$country_id,$width,$height);
//        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobycountryid($country_id,$cat_id,$width,$height);
//         print_r($data['allbanners']); 
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
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
        
        $width = $_POST['width'];
        $height = $_POST['height'];
        
        $cat_id = '';
        if(isset($_POST['cat_id']) && $_POST['cat_id'] != ''){
            $cat_id = ','.$_POST['cat_id'].',';
        }
        
        $country_id = '';
        if(isset($_POST['country_id']) && $_POST['country_id'] != ''){
            $country_id = ','.$_POST['country_id'].',';
        }
        
        $member_id = $_SESSION['member_id'];
        
        $name_data['width'] = $_POST['width'];
        $name_data['height'] = $_POST['height'];
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->BannersModel->count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxPaginationFilterData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'dataFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allbanners'] = $this->BannersModel->get_all_filter_banner($config["per_page"], $offset,$searchkey,$cat_id,$country_id,$width,$height);

        
//        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobysize($width,$height,$cat_id,$country_id);
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
    
    public function searchbanbymyfav(){
//        print_r($_POST);die;
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        
        $conditions = array();
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
//        $keywords = $this->input->post('keywords');
//        $sortBy = $this->input->post('sortBy');
//        if(!empty($keywords)){
//            $conditions['search']['keywords'] = $keywords;
//        }
//        if(!empty($sortBy)){
//            $conditions['search']['sortBy'] = $sortBy;
//        }
        
        //total rows count
        $totalRec = $this->BannersModel->count_all_favorites_banner($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxFavoritesData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
        
//        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobymyfav($member_id, $option_id);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['myfav'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxFavoritesData(){
        $conditions = array();
        $option_id = $this->session->userdata('option_id');
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_favorites_banner($member_id, $option_id);
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxFavoritesData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobymyfav($config["per_page"], $offset, $member_id, $option_id);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbanbymycom(){
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        
        $conditions = array();
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
//        $keywords = $this->input->post('keywords');
//        $sortBy = $this->input->post('sortBy');
//        if(!empty($keywords)){
//            $conditions['search']['keywords'] = $keywords;
//        }
//        if(!empty($sortBy)){
//            $conditions['search']['sortBy'] = $sortBy;
//        }
        
        //total rows count
        $totalRec = $this->BannersModel->count_all_comments_banner($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobymycom($config["per_page"], $offset, $member_id, $option_id);
        //print_r($data['alllandingpageinfo']); exit;
       $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['mycom'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxCommentsData(){
        $conditions = array();
        $option_id = $this->session->userdata('option_id');
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->BannersModel->count_all_comments_banner($member_id, $option_id);
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'banners/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 20;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allbanners'] = $this->BannersModel->searchbannerpageinfobymycom($config["per_page"], $offset, $member_id, $option_id);
        $option_id = 1;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/banners/bannerShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function downloadcheck() {
        $item_id = $_POST['item_id'];
        $member_id = $_SESSION['member_id'];
        $option_id = $_POST['option_id'];
        $data['downloadinfo'] = $this->BannersModel->getdownloadinfo($item_id, $member_id, $option_id);
        if (isset($data['downloadinfo']) && $data['downloadinfo'] != '') {
            $download = $data['downloadinfo']->count;
        } else {
            $download = '';
        }
        $data['downloadsettings'] = $this->BannersModel->downloadsettings($option_id);
        $settings = $data['downloadsettings']->download_count;
        $data['bannerinfo'] = $this->BannersModel->getbanINfoById($item_id);
        $bannerimage = $data['bannerinfo']->image;
        $json = array();
        if ($download > $settings) {
            $json['downloadresult'] = 0;
            $json['bannerimage'] = $bannerimage;
        } else {
            $json['downloadresult'] = 1;
            $json['bannerimage'] = $bannerimage;
        }
        echo json_encode($json);
    }

    public function downloadnumberadd() {
        echo  $item_id = $_POST['item_id'];
          $member_id = $_SESSION['member_id'];
          $option_id = $_POST['option_id'];
        $checkrow = $this->BannersModel->checkdownloadcountrow($item_id, $member_id, $option_id);
        if(!empty($checkrow)){
             $id = $checkrow->id;
             $updatedownload = $this->BannersModel->updatedownloadcount($id);
        } else { 
        $insertdownload = $this->BannersModel->adddownloadcount($item_id, $member_id, $option_id);
        }
    }
}
