<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nativadd extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('Ajax_pagination');
        $this->load->model('NativaddModel');
        $this->load->model('BannersModel');
        $this->load->model('MembersModel');
        $this->load->model('LandingModel');
    }

    public function shownetivaddsec() {
        
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
             if(isset($checkpermission)){
           // $permission_option_id = explode(',', $checkpermission->option_id);
            //$haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
           // $hasper = $haspermission[0]['is_active'];
              $hasper = $checkpermission->trial;
            if ($hasper == 1) {
                //PAGINATION
                $totalRec = $this->NativaddModel->count_all_native();
                //pagination configuration
                $data['page'] = 0;
                $config['target'] = '#postList';
                $config['base_url'] = base_url() . 'nativadd/ajaxPaginationData';
                $config['total_rows'] = $totalRec;
                $config['per_page'] = 25;
                $config['link_func'] = 'searchFilter';
                $this->ajax_pagination->initialize($config);
                //call the model function to get the department data
                $data['allnativadds'] = $this->NativaddModel->getAllnativadds($config["per_page"], $data['page']);
//                $data['pagination'] = $this->pagination->create_links();
//                $totalshowing = $data['page'] + $config["per_page"];
//                $data['showing'] = "Showing " . $data['page'] . " to " . $totalshowing . " of " . $config['total_rows'] . " entries";


                $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allcomments'] = $this->NativaddModel->getcomments();
                $data['optionid'] = $this->NativaddModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['allsize'] = $this->NativaddModel->getAllSize();
                $data['page_title'] = 'Native Adds';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
               // echo '<pre>'; print_r($data); exit;
                $data['front_maincontent'] = $this->load->view('front/netivadds/nativaddspage', $data, TRUE);
                $this->load->view('front/netivadds/nativ_master', $data);
            } 
            } else {
                $data['permission_message'] = "You have no permission";
                $data['page_title'] = 'Native Adds';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/netivadds/nativaddspage', $data, TRUE);
                $this->load->view('front/netivadds/nativ_master', $data);
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
        
        //total rows count
        $totalRec = $this->NativaddModel->count_all_native();
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allnativadds'] = $this->NativaddModel->getAllnativadds($config["per_page"], $offset);
        $option_id = 1;
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allcomments'] = $this->NativaddModel->getcomments();
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allsize'] = $this->NativaddModel->getAllSize();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['nativadds'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function search_filter_data(){
        
        $searchval = $_POST['searchval'];
        
        $searchkey = '';
        if($_POST['searchkey'] != ''){
            $searchkey = ','.$this->session->userdata('searchkey').',';
        }
//        echo $searchkey;
        $cat_id = '';
        if($_POST['cat_id'] != ''){
            $cat_id = ','.$_POST['cat_id'].',';
        }
        $country_id = '';
        if(isset($_POST['country_id']) && $_POST['country_id'] != ''){
            $country_id = ','.$_POST['country_id'].',';
        }
        
        $width = $_POST['width'];
        $height = $_POST['height'];
        
        $member_id = $_SESSION['member_id'];
        
        $name_data['cat_id'] = $_POST['cat_id'];
        $name_data['country_id'] = $_POST['country_id'];
        $name_data['width'] = $_POST['width'];
        $name_data['height'] = $_POST['height'];
        $name_data['searchval'] = $_POST['searchval'];
        $name_data['searchkey'] = $_POST['searchkey'];
        
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->NativaddModel->count_all_filters_native($searchkey,$cat_id,$country_id,$width,$height);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxPaginationFilterData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'dataFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allnativadds'] = $this->NativaddModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id,$width,$height);
//         print_r( $data['allnativadds']);die(); 
        $option_id = 1;
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allcomments'] = $this->NativaddModel->getcomments();
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allsize'] = $this->NativaddModel->getAllSize();

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxPaginationFilterData(){
        $searchval = $this->session->userdata('searchval');
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
        $totalRec = $this->NativaddModel->count_all_filters_native($searchkey,$cat_id,$country_id,$width,$height);
        
        //pagination configuration
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxPaginationFilterData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'dataFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allnativadds'] = $this->NativaddModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id,$width,$height);
        
        $option_id = 1;
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allcomments'] = $this->NativaddModel->getcomments();
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allsize'] = $this->NativaddModel->getAllSize();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function showdirectory() {
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
            
            $data['page_title'] = 'Nativ Adds';
            $data['header'] = $this->load->view('front/common/userheader', '', true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/directory/showdirectory', $data, TRUE);
            $this->load->view('front/front_master', $data);
            // $this->load->view('front/common/header');
            //$this->load->view('front/common/homesidebar');
            //$this->load->view('front/directory/showdirectory');
            //$this->load->view('front/common/footer');
        }
    }

    public function makefavorites() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['adds_id'] = $this->uri->segment('2');
        $data['date'] = date('Y-m-d');
        $data['option_id'] = $this->uri->segment('3');
        $makefav = $this->NativaddModel->getaddsmakefavorites($data);
        if ($makefav) {
             $this->session->set_flashdata('success', 'Adds has been added to favorites Successfully');
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
        $data['width'] = $dddd[0];
        $data['height'] = $dddd[1];
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
    
    public function searchnativbymyfav() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        $conditions = array();
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->NativaddModel->count_all_favorites_native($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxFavoritesData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);

        //get posts data
        $data['allnativadds'] = $this->NativaddModel->searchnativpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
                
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allcomments'] = $this->NativaddModel->getcomments();
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allsize'] = $this->NativaddModel->getAllSize();

        $json = array();
        $json['myfav'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
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
        $totalRec = $this->NativaddModel->count_all_favorites_native($member_id, $option_id);
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxFavoritesData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allnativadds'] = $this->NativaddModel->searchnativpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
        $option_id = 2;
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allcomments'] = $this->NativaddModel->getcomments();
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allsize'] = $this->NativaddModel->getAllSize();
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchnativbymycom() {
        
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        $conditions = array();
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->NativaddModel->count_all_comments_native($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allnativadds'] = $this->NativaddModel->searchnativpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
//        print_r($data['allnativadds']); exit;
        $option_id = 2;
        $data['favbanner'] = $this->NativaddModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allcomments'] = $this->NativaddModel->getcomments();
        $data['optionid'] = $this->NativaddModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allsize'] = $this->NativaddModel->getAllSize();

        $json = array();
        $json['mycom'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    function ajaxCommentsData(){
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
        $totalRec = $this->NativaddModel->count_all_comments_native($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'nativadd/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allnativadds'] = $this->NativaddModel->searchnativpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
        
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }


 public function nativTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 2;
            $tags_info = $this->NativaddModel->getnativTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function searchnativbyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allnativadds'] = $this->NativaddModel->searchnativpageinfobykey($searchKey);
        // print_r( $data['allbanners']); 
        $option_id = 2;
        $data1['favbanner'] = $this->NativaddModel->getfavaddsinfo($data['member_id']);
        $data1['allcountry'] = $this->BannersModel->getAllCountry();
        $data1['allcategory'] = $this->BannersModel->getAllCat();
        $data1['allcomments'] = $this->NativaddModel->getcomments();
        $data1['optionid'] = $this->NativaddModel->getoptionid();
        $data1['alltag'] = $this->BannersModel->getAllTagByOptionId($data1['optionid']->option_id);
        $data1['allsize'] = $this->NativaddModel->getAllSize();

        $json = array();
        $json['mycom'] = $this->load->view('front/netivadds/nativAddShowDiv', $data, TRUE);
        echo json_encode($json);
    }
}
