<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facebookadds extends CI_Controller {

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
        $this->load->model('FacebookaddsModel');
    }

    public function facebookaddsSec() {
        
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('searchKey');
        $this->session->unset_userdata('searchval');
        $this->session->unset_userdata('tag_id');
        
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
           // $haspermission = $this->MembersModel->haspermissiontblentry($permission_option_id);
           // $hasper = $haspermission[0]['is_active'];
           $hasper = $checkpermission->trial;
            if ($hasper == 1) {

                //PAGINATION
                $totalRec = $this->FacebookaddsModel->count_all_fbadds();
                //pagination configuration
                $data['page'] = 0;
                $config['target'] = '#postList';
                $config['base_url'] = base_url() . 'facebookadds/ajaxPaginationData';
                $config['total_rows'] = $totalRec;
                $config['per_page'] = 25;
                $config['link_func'] = 'searchFilter';
                $this->ajax_pagination->initialize($config);

                //call the model function to get the department data
                $data['allfbadds'] = $this->FacebookaddsModel->getloadfbadds($config["per_page"], $data['page']);
                //echo '<pre>'; print_r($data['allfbadds']);
                $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
                $data['allcountry'] = $this->BannersModel->getAllCountry();
                $data['allcategory'] = $this->BannersModel->getAllCat();
               // $data['allsize'] = $this->FacebookaddsModel->getAllSize();
                $data['optionid'] = $this->FacebookaddsModel->getoptionid();
                $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);
                $data['page_title'] = 'FaceBook Adds';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/facebbokadds/allfbadds', $data, TRUE);
                $this->load->view('front/facebbokadds/facebook_master', $data);
            } 
            } else {
                $data['permission_message'] = "You have no permission to access in this page";
                $data['page_title'] = 'FaceBook Adds';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/facebbokadds/allfbadds', $data, TRUE);
                $this->load->view('front/facebbokadds/facebook_master', $data);
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
        $totalRec = $this->FacebookaddsModel->count_all_fbadds();
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allfbadds'] = $this->FacebookaddsModel->getloadfbadds($config["per_page"], $offset);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allfbadds']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
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
        $totalRec = $this->FacebookaddsModel->count_all_filters_native($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxPaginationFilterData';
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
        
        $data['allfbadds'] = $this->FacebookaddsModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
//         print_r( $data['allfbadds']);die(); 
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
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
        $totalRec = $this->FacebookaddsModel->count_all_filters_native($searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxPaginationFilterData';
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
        
        $data['allfbadds'] = $this->FacebookaddsModel->search_all_filter_data($config["per_page"], $offset,$searchkey,$cat_id,$country_id);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
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
        $totalRec = $this->FacebookaddsModel->count_all_filters_native($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxPaginationKeywordData';
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
        
        $data['allfbadds'] = $this->FacebookaddsModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
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
        $totalRec = $this->FacebookaddsModel->count_all_filters_native($tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxPaginationKeywordData';
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
        
        $data['allfbadds'] = $this->FacebookaddsModel->search_all_filter_data($config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }


    public function searchfbbyentries() {
        $searchval = $_POST['searchval']; 
        $member_id = $_SESSION['member_id'];
        
        
        $data['allfbadds'] = $this->FacebookaddsModel->searchfbaddspageinfo($searchval);
         //print_r( $data['allfbadds']); 
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
//     public function searchfbecobyentries() {
//        $searchval = $_POST['searchval'];
//        $member_id = $_SESSION['member_id'];
//        $data['allfbadds'] = $this->FacebookaddsModel->searchbannerpageinfo($searchval);
//        // print_r( $data['allbanners']); 
//        $option_id = 3;
//        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
//        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
//        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
//        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
//        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//
//        $json = array();
//        $json['bannerdiv'] = $this->load->view('front/facebbokadds/allfbadds', $data, TRUE);
//        echo json_encode($json);
//    }

    public function searchfbecobyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allfbadds'] = $this->FacebookaddsModel->searchbannerpageinfobykey($searchKey);
        // print_r( $data['allbanners']); 
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchfbbycatid(){
        $cat_id = $_POST['cat_id'];
        $member_id = $_SESSION['member_id'];
        $data['allfbadds'] = $this->FacebookaddsModel->searchfbpageinfobycat($cat_id);
         //print_r( $data['allbanners']); 
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchfbbycountryid(){
        $country_id = $_POST['country_id'];
        $member_id = $_SESSION['member_id'];
        $data['allfbadds'] = $this->FacebookaddsModel->searchbannerpageinfobycountryid($country_id);
        // print_r( $data['allbanners']); 
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }
   public function fbTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 3;
            $tags_info = $this->FacebookaddsModel->getbanTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    
     public function searchfbbymyfav() {
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
        $totalRec = $this->FacebookaddsModel->count_all_favorites_facebook($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxFavoritesData';
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
        $data['allfbadds'] = $this->FacebookaddsModel->searchfbpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['myfav'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
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
        $totalRec = $this->FacebookaddsModel->count_all_favorites_facebook($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxFavoritesData';
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
        $data['allfbadds'] = $this->FacebookaddsModel->searchfbpageinfobymyfav($config["per_page"], $offset,$member_id, $option_id);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allnativadds']);die;
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchfbbymycom() {
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
        $totalRec = $this->FacebookaddsModel->count_all_comments_facebook($member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'facebookadds/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allfbadds'] = $this->FacebookaddsModel->searchfbpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
//        print_r($option_id); exit;
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['mycom'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
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
        $config['base_url'] = base_url() . 'facebookadds/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allfbadds'] = $this->FacebookaddsModel->searchfbpageinfobymycom($config["per_page"], $offset,$member_id, $option_id);
        
        $option_id = 3;
        $data['favbanner'] = $this->FacebookaddsModel->getfavaddsinfo($member_id);
        $data['allcountry'] = $this->FacebookaddsModel->getAllCountry();
        $data['allcategory'] = $this->FacebookaddsModel->getAllCat();
        $data['optionid'] = $this->FacebookaddsModel->getoptionid();
        $data['alltag'] = $this->FacebookaddsModel->getAllTagByOptionId($data['optionid']->option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/facebbokadds/fbShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
     public function fbcommentmodal(){
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $member_id = $_SESSION['member_id'];
        $data['all_com_info'] = $this->FacebookaddsModel->getfbcomments($option_id, $addsId, $member_id);
        $this->load->view('front/facebbokadds/fbCommentModal', $data);
    }
}
