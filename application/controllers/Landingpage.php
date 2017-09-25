<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Landingpage extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('download');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('Ajax_pagination');
        $this->load->model('MembersModel');
        $this->load->model('BannersModel');
        $this->load->model('AffiliateModel');
        $this->load->model('LandingModel');
    }

    public function showlandingpage() {
        
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('tag_id');
        $this->session->unset_userdata('searchkey');
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

            $option_id = 13;
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $option_id);
            // echo '<pre>';print_r($checkpermission);die;
            if (isset($checkpermission)) {
               // $permission_option_id = explode(',', $checkpermission->option_id);
               // $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
               // $hasper = $haspermission[0]['is_active'];
                 $hasper = $checkpermission->trial;
                 if ($checkpermission->active == 1 || $checkpermission->trial == 1) {

                //PAGINATION
                    $totalRec = $this->LandingModel->count_all_landing();
                    //pagination configuration
                    $data['page'] = 0;
                    $config['target'] = '#postList';
                    $config['base_url'] = base_url() . 'landingpage/ajaxPaginationData';
                    $config['total_rows'] = $totalRec;
                    $config['per_page'] = 25;
                    $config['link_func'] = 'searchFilter';
                    $this->ajax_pagination->initialize($config);
                    
                    $column_name = "landing_id";
                //call the model function to get the department data
                    $data['alllandingpageinfo'] = $this->LandingModel->alllandingpage($column_name,$config["per_page"], $data['page']);

                    
                    $option_id = 13;
                    $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
                    $data['allcountry'] = $this->BannersModel->getAllCountry();
                    $data['allcategory'] = $this->BannersModel->getAllCat();
                    $data['allsize'] = $this->BannersModel->getAllSize();
                    $data['optionid'] = $this->BannersModel->getoptionid();
                    $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
// $data['allcomments'] = $this->LandingModel->getlandingcomments();

                    $data['page_title'] = 'Landing Page';
                    $data['header'] = $this->load->view('front/common/userheader', $data, true);
                    $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                    $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                    $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                    $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
//print_r($data); exit;
                    $data['front_maincontent'] = $this->load->view('front/landingpage/alllandingpage', $data, TRUE);
                    $this->load->view('front/front_landing_master', $data);
               // }
            } else {
                
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
        $totalRec = $this->LandingModel->count_all_landing();
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        $column_name = "landing_id";
        //get posts data
        $data['alllandingpageinfo'] = $this->LandingModel->alllandingpage($column_name,$config["per_page"], $offset);
        
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function search_filter_data(){
//        print_r($_POST);die;
        $searchval = $_POST['searchval'];
        
        $searchkey = '';
        if($_POST['searchkey'] != ''){
            $searchkey = ','.$_POST['searchkey'].',';
        }
//        echo $searchkey;die;
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
        $totalRec = $this->LandingModel->count_all_filters($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxPaginationFilterData';
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
        
        $data['alllandingpageinfo'] = $this->LandingModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
//         print_r( $data['alllandingpageinfo']);die(); 
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
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
        $totalRec = $this->LandingModel->count_all_filters($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxPaginationFilterData';
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
        
        $data['alllandingpageinfo'] = $this->LandingModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
//        print_r($data['alllandingpageinfo']);die;
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
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
        $totalRec = $this->LandingModel->count_all_filters($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxPaginationKeywordData';
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
        
        $data['alllandingpageinfo'] = $this->LandingModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
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
        $totalRec = $this->LandingModel->count_all_filters($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxPaginationKeywordData';
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
        
        $data['alllandingpageinfo'] = $this->LandingModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function landingcommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $data['all_com_info'] = $this->LandingModel->getlandingcomments($option_id, $addsId);
        $this->load->view('front/landingpage/landingCommentModal', $data);
    }

    public function landingsearch() {
        $data['member_id'] = $_SESSION['member_id'];
        $data1['cat_name'] = $_POST['cat_name'];
        $data1['country_name'] = $_POST['country_name'];
        $data1['keyword_tags'] = $_POST['keyword_tags'];
        $data1['sorting'] = $_POST['sorting'];
        $member_id = $data['member_id'];
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpage($data1);
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $data['page_title'] = 'Landing Page';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/landingpage/alllandingpage', $data, TRUE);
        $this->load->view('front/front_master', $data);
    }

    public function searchlandingbyentries() {
        $searchval = $_POST['searchval'];
        $member_id = $_SESSION['member_id'];
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpageinfo($searchval);
//echo '<pre>'; print_r( $data['alllandingpageinfo']); exit;
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);


        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function landingTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 13;
            $tags_info = $this->LandingModel->getlandingTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }

    public function searchlandingbyautokey() {

        $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpageinfobykey($searchKey);
        // print_r( $data['allbanners']); 
        $option_id = 13;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchlandingbymyfav() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
//        echo $option_id;die;
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
        $totalRec = $this->LandingModel->count_all_favorites_landing($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxFavoritesData';
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
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);

        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['myfav'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxFavoritesData(){
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
        $totalRec = $this->LandingModel->count_all_favorites_landing($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxFavoritesData';
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
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
//        print_r($data['alllandingpageinfo']);die;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchlandingbymycom() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
//        echo $member_id . ' ' .$option_id;die;
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
        $totalRec = $this->LandingModel->count_all_comments_landing($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);

        //print_r($data['alllandingpageinfo']); exit;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['mycom'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
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
        $totalRec = $this->LandingModel->count_all_comments_landing($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'landingpage/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['alllandingpageinfo'] = $this->LandingModel->searchlandingpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
        
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['landingdiv'] = $this->load->view('front/landingpage/landingPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function landingdownloadcheck() {
        $item_id = $_POST['item_id'];
        $member_id = $_SESSION['member_id'];
        $option_id = $_POST['option_id'];
        $data['downloadinfo'] = $this->LandingModel->getdownloadinfo($item_id, $member_id, $option_id);
        if (isset($data['downloadinfo']) && $data['downloadinfo'] != '') {
            $download = $data['downloadinfo']->count;
        } else {
            $download = '';
        }
        $data['downloadsettings'] = $this->LandingModel->downloadsettings();
        $settings = $data['downloadsettings']->download_count;
        $data['bannerinfo'] = $this->LandingModel->getbanINfoById($item_id);
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

    public function landingdownloadnumberadd() {
        $item_id = $_POST['item_id'];
        $member_id = $_SESSION['member_id'];
        $option_id = $_POST['option_id'];
        $checkrow = $this->LandingModel->checkdownloadcountrow($item_id, $member_id, $option_id);
        if (!empty($checkrow)) {
            $id = $checkrow->id;
            $updatedownload = $this->LandingModel->updatedownloadcount($id);
        } else {
            $insertdownload = $this->LandingModel->adddownloadcount($item_id, $member_id, $option_id);
        }
    }
    
    public function landingByCategory($cat_id) {
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

//PAGINATION
                $config = array();
                $config["base_url"] = base_url() . "landingpage/landingByCategory/" . $cat_id;
                $cat_id = ',' .$cat_id. ',' ;
                $config['total_rows'] = $this->LandingModel->count_all_landing_by_cat($cat_id);
                $config["per_page"] = 6;
//                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $this->LandingModel->count_all_landing_by_cat($cat_id);
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
                $data['alllandingpageinfo'] = $this->LandingModel->all_landing_by_cat_id($config["per_page"], $page,$cat_id);
//                print_r($data['alllandingpageinfo']);die;
                $str_links = $this->pagination->create_links();
                $data['links'] = explode('&nbsp;', $str_links);

                $option_id = 13;
                $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
// $data['allcomments'] = $this->LandingModel->getlandingcomments();

                $data['page_title'] = 'Landing Page';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
//print_r($data); exit;
                $data['front_maincontent'] = $this->load->view('front/landingpage/all_landing_by_category', $data, TRUE);
                $this->load->view('front/front_landing_master', $data);
            }
        }
    }
    
    public function landingByCountry($country_id) {
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

//PAGINATION
                $config = array();
                $config["base_url"] = base_url() . "landingpage/landingByCountry/" . $country_id;
                $country_id = ',' .$country_id. ',' ;
                $config['total_rows'] = $this->LandingModel->count_all_landing_by_country($country_id);
                $config["per_page"] = 6;
//                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $this->LandingModel->count_all_landing_by_country($country_id);
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
                $data['alllandingpageinfo'] = $this->LandingModel->all_landing_by_country_id($config["per_page"], $page,$country_id);
                $str_links = $this->pagination->create_links();
                $data['links'] = explode('&nbsp;', $str_links);

                $option_id = 13;
                $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
// $data['allcomments'] = $this->LandingModel->getlandingcomments();

                $data['page_title'] = 'Landing Page';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
//print_r($data); exit;
                $data['front_maincontent'] = $this->load->view('front/landingpage/all_landing_by_country', $data, TRUE);
                $this->load->view('front/front_landing_master', $data);
            }
        }
    }
    
    public function landingByTag($tag_id) {
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

//PAGINATION
                $config = array();
                $config["base_url"] = base_url() . "landingpage/landingByTag/" . $tag_id;
                $tag_id = ',' .$tag_id. ',';
//                echo $tag_id;die;
                $config['total_rows'] = $this->LandingModel->count_all_landing_by_keyword($tag_id);
                $config["per_page"] = 6;
//                $config['use_page_numbers'] = TRUE;
                $config['num_links'] = $this->LandingModel->count_all_landing_by_keyword($tag_id);
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
                $data['alllandingpageinfo'] = $this->LandingModel->all_landing_by_keyword_id($config["per_page"], $page, $tag_id);
//                echo '<pre>';print_r($data['alllandingpageinfo']);die;
                $str_links = $this->pagination->create_links();
                $data['links'] = explode('&nbsp;', $str_links);

                $option_id = 13;
                $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
                $data['allsize'] = $this->BannersModel->getAllSize();
                $data['optionid'] = $this->BannersModel->getoptionid();
                $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
// $data['allcomments'] = $this->LandingModel->getlandingcomments();

                $data['page_title'] = 'Landing Page';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
//print_r($data); exit;
                $data['front_maincontent'] = $this->load->view('front/landingpage/all_landing_by_keyword', $data, TRUE);
                $this->load->view('front/front_landing_master', $data);
            }
        }
    }
    
    
    public function download($id,$fileName) {
        $member_id = $_SESSION['member_id'];
        if (isset($member_id)) {
            $option_id = 13;
            $admin_count = $this->LandingModel->downloadsettings();
            // print_r($admin_count);die;
            $get_count = $this->LandingModel->getdownloadinfo($id, $member_id, $option_id);
            if (isset($get_count)) {
                $count = $get_count->count;
            } else {
                $count = 1;
                $this->LandingModel->adddownloadcount($id, $member_id, $option_id);
            }
            $checkpermission = $this->MembersModel->checkpermissiontblentry($member_id, $option_id);
            // echo $count;die;
            if (isset($checkpermission) && ($count < $admin_count->download_count)) {
            // echo $count;die;
                if ($fileName) {
                    $file = realpath("uploads/landing_page") . "/" . $fileName;
                    // check file exists    
                    if (file_exists($file)) {
                    // echo $file;die;
                        $this->LandingModel->updatedownloadcount($get_count->id);
                        // get file content
                        $data = file_get_contents($file);
                        //force download
                        force_download($fileName, $data);
                    } else {
                        // echo 'hello';die;
                        // Redirect to base url
                        redirect('landingpage');
                    }
                    
                }
            } else {
                $m_data['message']='You have cross your limit of download this add';
                $this->session->set_userdata($m_data);
                redirect('landingpage');
            }
        }else{
            redirect("loginform");
        }
        
    }

}
