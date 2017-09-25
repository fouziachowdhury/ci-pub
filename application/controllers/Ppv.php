<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ppv extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('Ajax_pagination');
        $this->load->library('pagination');
        $this->load->model('BannersModel');
        $this->load->model('MembersModel');
        $this->load->model('PpvModel');
        $this->load->model('LandingModel');
    }

    public function showallppv() {
        
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi= explode(',', $permissionId);
            //$getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
           // foreach ($getpermisetting as $key=>$get) {
               // $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            $data['testpage'] = $string;
            
            $package_id = 1;
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
             if(isset($checkpermission)){
            //$permission_option_id = explode(',', $checkpermission->option_id);
            //$haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
           // $hasper = $haspermission[0]['is_active'];
             $hasper = $checkpermission->trial;
            if ($checkpermission->active == 1 || $checkpermission->trial == 1) {

                //PAGINATION
                $totalRec = $this->PpvModel->count_all_ppv();
                //pagination configuration
                $data['page'] = 0;
                $config['target'] = '#postList';
                $config['base_url'] = base_url() . 'ppv/ajaxPaginationData';
                $config['total_rows'] = $totalRec;
                $config['per_page'] = 25;
                $config['link_func'] = 'searchFilter';
                $this->ajax_pagination->initialize($config);

                $column_name = "ppv_id";
                //call the model function to get the department data
                $data['allppv'] = $this->PpvModel->getloadppv($column_name,$config["per_page"], $data['page']);
                
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
           // } 
            } else {
                $data['permission_message'] = "You have no permission";
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
        }else{
            redirect("loginform");
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
        $totalRec = $this->PpvModel->count_all_ppv();
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $column_name = "ppv_id";
        //get posts data
        $data['allppv'] = $this->PpvModel->getloadppv($column_name,$config["per_page"], $offset);
        
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function search_filter_data(){
//        print_r($_POST);die;
        $cat_id = '';
        if($_POST['cat_id'] != ''){
            $cat_id = ','.$_POST['cat_id'].',';
        }
//        echo $cat_id;die;
        $searchval = $_POST['searchval'];
        
        $searchkey = '';
        if($_POST['searchkey'] != ''){
            $searchkey = ','.$_POST['searchkey'].',';
        }
//        echo $searchkey;
        $country_id = '';
        if(isset($_POST['country_id']) && $_POST['country_id'] != ''){
            $country_id = ','.$_POST['country_id'].',';
        }
        
        $member_id = $_SESSION['member_id'];
        
        $name_data['cat_id'] = $_POST['cat_id'];
        $name_data['country_id'] = $_POST['country_id'];
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
//        echo $searchkey;die;
        //total rows count
        $totalRec = $this->PpvModel->count_all_filters_ppv($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxPaginationFilterData';
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
        
        $data['allppv'] = $this->PpvModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
        
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
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
        $totalRec = $this->PpvModel->count_all_filters_ppv($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxPaginationFilterData';
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
        
        $data['allppv'] = $this->PpvModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
        
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function search_filter_data_by_keyword(){
//        print_r($_POST);die;
        $cat_id = '';
        if($_POST['cat_id'] != ''){
            $cat_id = ','.$_POST['cat_id'].',';
        }
//        echo $cat_id;die;
        $searchval = $_POST['searchval'];
        $tag_id = $_POST['tag_id'];
        
//        echo $searchkey;
        $country_id = '';
        if(isset($_POST['country_id']) && $_POST['country_id'] != ''){
            $country_id = ','.$_POST['country_id'].',';
        }
        
        $member_id = $_SESSION['member_id'];
        
        $name_data['tag_id'] = $_POST['tag_id'];
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $tag_id;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
//        echo $searchkey;die;
        //total rows count
        $totalRec = $this->PpvModel->count_all_filters_ppv($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxPaginationKeywordData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 2;
        }
        $config['link_func'] = 'keywordFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allppv'] = $this->PpvModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    function ajaxPaginationKeywordData(){
        $searchval = $this->session->userdata('searchval');
        $tag_id = '';
        if($this->session->userdata('tag_id') != ''){
            $tag_id = ','.$this->session->userdata('tag_id').',';
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
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $tag_id;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->PpvModel->count_all_filters_ppv($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxPaginationKeywordData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 2;
        }
        $config['link_func'] = 'keywordFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allppv'] = $this->PpvModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
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
        //print_r($data['all_com_info']); exit;
        $this->load->view('front/ppv/ppvCommentModal', $data);
    }
   
    public function searchppvbymyfav(){
         $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->PpvModel->count_all_favorites_ppv($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxFavoritesData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);
        
        $data['allppv'] = $this->PpvModel->searchppvpageinfobymyfav($config["per_page"],$offset,$member_id,$option_id);
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
        $totalRec = $this->PpvModel->count_all_favorites_ppv($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxFavoritesData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'favoritesData';
        $this->ajax_pagination->initialize($config);
        
        $data['allppv'] = $this->PpvModel->searchppvpageinfobymyfav($config["per_page"],$offset,$member_id,$option_id);
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchppvbymycom(){
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        //calc offset number
        $page = $this->input->post('page');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->PpvModel->count_all_comments_ppv($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allppv'] = $this->PpvModel->searchppvpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
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
        $totalRec = $this->PpvModel->count_all_comments_ppv($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'ppv/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allppv'] = $this->PpvModel->searchppvpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
        
        $option_id = 5;
        $data['favbanner'] = $this->PpvModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->PpvModel->getAllCountry();
        $data['allcategory'] = $this->PpvModel->getAllCat();
        $data['optionid'] = $this->PpvModel->getoptionid();
        $data['alltag'] = $this->PpvModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/ppv/ppvShowDiv', $data, TRUE);
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
    
    public function download($id,$fileName) {
        $member_id = $_SESSION['member_id'];
        if (isset($member_id)) {
            $option_id = 5;
            $admin_count = $this->PpvModel->downloadsettings();
            // print_r($admin_count);die;
            $get_count = $this->PpvModel->getdownloadinfo($id, $member_id, $option_id);
            if (isset($get_count)) {
                $count = $get_count->count;
            } else {
                $count = 1;
                $this->PpvModel->adddownloadcount($id, $member_id, $option_id);
            }
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $option_id);
            if (isset($checkpermission) && ($count < $admin_count->download_count)) {
            // echo $count;die;
                if ($fileName) {
                    $file = realpath("uploads/ppv") . "/" . $fileName;
                    // echo $file;die;
                    // check file exists    
                    if (file_exists($file)) {
                        $this->PpvModel->updatedownloadcount($get_count->id);
                        // get file content
                        $data = file_get_contents($file);
                        //force download
                        force_download($fileName, $data);
                    } else {
                        // Redirect to base url
                        redirect('ppvAddSec');
                    }
                    
                }
            } else {
                $m_data['message']='You have cross your limit of download this add';
                $this->session->set_userdata($m_data);
                redirect('ppvAddSec');
            }
        }
        else{
            redirect("loginform");
        }
    }

}
