<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fbecommerceadds extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('Ajax_pagination');
        $this->load->model('BannersModel');
        $this->load->model('MembersModel');
        $this->load->model('LandingModel');
        $this->load->model('FbecommerceaddsModel');
    }

    public function faceecomerceSec() {
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('tag_id');
        $this->session->unset_userdata('searchKey');
        $this->session->unset_userdata('searchval');
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
             $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi= explode(',', $permissionId);
//            $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
//            foreach ($getpermisetting as $key=>$get) {
//                $string[$get['option_id']] = $get['is_active'];
//            }
            foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            $data['testpage'] = $string;
            
            $package_id = 1;
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $package_id);
            if(isset($checkpermission)){
           // $permission_option_id = explode(',', $checkpermission->option_id);
            //$haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
            $hasper = $checkpermission->trial;
             if ($checkpermission->active == 1 || $checkpermission->trial == 1) {

                //PAGINATION
                $totalRec = $this->FbecommerceaddsModel->count_all_fbeco();
                //pagination configuration
                $data['page'] = 0;
                $config['target'] = '#postList';
                $config['base_url'] = base_url() . 'fbecommerceadds/ajaxPaginationData';
                $config['total_rows'] = $totalRec;
                $config['per_page'] = 25;
                $config['link_func'] = 'searchFilter';
                $this->ajax_pagination->initialize($config);

                $column_name = "fb_ecom_id";
                //call the model function to get the department data
                $data['allfbeco'] = $this->FbecommerceaddsModel->getloadfbecom($column_name,$config["per_page"], $data['page']);

                $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
                $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
                $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
                $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
                $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);
                
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/faceecomerceadds/allfbecoadds', $data, TRUE);
                $this->load->view('front/faceecomerceadds/fbecoadds_master', $data);
            } 
          //  }
            else {
                $data['permission_message'] = "You have no permission to access in this page";
                $data['page_title'] = 'Banner';
                $data['header'] = $this->load->view('front/common/userheader', '', true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/faceecomerceadds/allfbecoadds', $data, TRUE);
                $this->load->view('front/faceecomerceadds/fbecoadds_master', $data);
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
        $totalRec = $this->FbecommerceaddsModel->count_all_fbeco();
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $column_name = "fb_ecom_id";
        //get posts data
        $data['allfbeco'] = $this->FbecommerceaddsModel->getloadfbecom($column_name,$config["per_page"], $offset);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allfbadds']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function search_filter_data(){
        
        $searchval = $_POST['searchval'];
        
        $searchkey = '';
        if($_POST['searchkey'] != ''){
            $searchkey = ','.$_POST['searchkey'].',';
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
        
        $member_id = $_SESSION['member_id'];
        
        $name_data['cat_id'] = $_POST['cat_id'];
        $name_data['country_id'] = $_POST['country_id'];
        $name_data['searchval'] = $_POST['searchval'];
        $name_data['searchkey'] = $_POST['searchkey'];
        
        $this->session->set_userdata($name_data);
        
        $page = $this->input->post('page');
//        echo $country_id;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->FbecommerceaddsModel->count_all_filters_fbeco($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxPaginationFilterData';
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
        
        $data['allfbeco'] = $this->FbecommerceaddsModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
//        print_r($data['allfbeco']);die;
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
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
//        echo $country_id;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->FbecommerceaddsModel->count_all_filters_fbeco($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxPaginationFilterData';
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
        
        $data['allfbeco'] = $this->FbecommerceaddsModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function searchFilterDataByKeyword(){
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
        $totalRec = $this->FbecommerceaddsModel->count_all_filters_fbeco($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxPaginationKeywordData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'keywordFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allfbeco'] = $this->FbecommerceaddsModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
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
//        echo $searchkey;die;
        //total rows count
        $totalRec = $this->FbecommerceaddsModel->count_all_filters_fbeco($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxPaginationKeywordData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'keywordFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $data['allfbeco'] = $this->FbecommerceaddsModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function searchbyfavorites() {
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
        $totalRec = $this->FbecommerceaddsModel->count_all_favorites_facebook_ecom($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxFavoritesData';
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
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchfbpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
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
        $totalRec = $this->FbecommerceaddsModel->count_all_favorites_facebook_ecom($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxFavoritesData';
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
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchfbpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbycomments() {
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
        $totalRec = $this->FbecommerceaddsModel->count_all_comments_facebook($member_id, $option_id);
        //echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchfbpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
//        print_r($option_id); exit;
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
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
        $totalRec = $this->FacebookaddsModel->count_all_comments_facebook($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'fbecommerceadds/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allfbeco'] = $this->FacebookaddsModel->searchfbpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
        
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
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

    public function fbecoTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 4;
            $tags_info = $this->FbecommerceaddsModel->getbanTagsInfoForAutocomplete($q, $option_id);
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

    public function searchfbecobyentries() {
        $searchval = $_POST['searchval'];
        $member_id = $_SESSION['member_id'];
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchbannerpageinfo($searchval);
        // print_r( $data['allbanners']); 
        $option_id = 4;
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchfbecobyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchbannerpageinfobykey($searchKey);
        // print_r( $data['allbanners']); 
        $option_id = 4;
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchfbecobycatid(){
        $cat_id = $_POST['cat_id'];
        $member_id = $_SESSION['member_id'];
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchfbecopageinfobycat($cat_id);
         //print_r( $data['allbanners']); 
        $option_id = 4;
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchfbecobycountryid(){
        $country_id = $_POST['country_id'];
        $member_id = $_SESSION['member_id'];
        $data['allfbeco'] = $this->FbecommerceaddsModel->searchbannerpageinfobycountryid($country_id);
        // print_r( $data['allbanners']); 
        $option_id = 4;
        $data['favbanner'] = $this->FbecommerceaddsModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->FbecommerceaddsModel->getAllCountry();
        $data['allcategory'] = $this->FbecommerceaddsModel->getAllCat();
        $data['optionid'] = $this->FbecommerceaddsModel->getoptionid();
        $data['alltag'] = $this->FbecommerceaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/faceecomerceadds/fbecommerceShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function fbecocommentmodal(){
         $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $member_id = $_SESSION['member_id'];
        $data['all_com_info'] = $this->BannersModel->getbannercomments($option_id, $addsId, $member_id);
        $this->load->view('front/faceecomerceadds/bannersCommentModal', $data);
    }
    
}
