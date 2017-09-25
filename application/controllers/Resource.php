<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resource extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('Ajax_pagination');
//        $this->load->library('pagination');
        $this->load->model('MembersModel');
        $this->load->model('BannersModel');
        $this->load->model('ResourceModel');
    }

    public function showaffiliatenetwork() {
        
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
            //$getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
            //foreach ($getpermisetting as $key => $get) {
               // $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $option_id = 20;
            $data['testpage'] = $string;
            
            $totalRec = $this->ResourceModel->count_all_resource('resources_tbl');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('resources_tbl',$config["per_page"], $data['page']);

//            $data['allaffiliatenetwork'] = $this->ResourceModel->getloadaffiliatenetwork();
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            //print_r($data['favresource']); exit;
            $data['page_title'] = 'Affiliate Networks';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/affliateNetwork/affliNet', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }
    
    function ajaxPaginationData(){
        $conditions = array();
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
//        echo $table;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->ResourceModel->count_all_resource($table);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork($table,$config["per_page"], $offset);
        $option_id = 20;
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchFilterData() {
        $searchval = $_POST['searchval'];
        
        $name_data['searchval'] = $_POST['searchval'];
        $name_data['searchkey'] = $_POST['searchkey'];
        $this->session->set_userdata($name_data);
        
        $searchkey = '';
        if($searchkey = $_POST['searchkey'] != ''){
            $searchkey = $searchkey = $_POST['searchkey'];
        }
        $member_id = $_SESSION['member_id'];
        $page = $this->input->post('page');
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
        
//        echo $searchkey;die;
        
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->ResourceModel->count_all_filters($table,$searchkey);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxPaginationLimitData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'limitFilter';
        $this->ajax_pagination->initialize($config);

        $data['allresource'] = $this->ResourceModel->search_all_filter_data($table,$config['per_page'],$offset,$searchkey);
        print_r( $data['allresource']);die(); 
        $option_id = 20;
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function ajaxPaginationLimitData() {
        $searchval = $this->session->userdata('searchval');
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = $this->session->userdata('searchkey');
        }
        $conditions = array();
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->ResourceModel->count_all_filters($table,$searchkey);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxPaginationLimitData';
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
        
        $data['allresource'] = $this->ResourceModel->search_all_filter_data($table,$config['per_page'],$offset,$searchkey);
//         print_r( $data['allaffiliatenetwork']);die(); 
        $option_id = 20;
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function resourceTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'resources_tbl';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function adNetworksTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'ad_networks';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function hostingTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'hosting';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function trackingTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'tracking';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function coachingTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'coaching';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function forumsTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'forums';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function blogsTagAutocomplete() {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $table = 'blogs';
            $tags_info = $this->ResourceModel->get_info_by_search_key($table,$q);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function searchbymyfav() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
//        echo $option_id;die;
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        $page = $this->input->post('page');
        $page_link = $this->input->post('page_link');
        $table = $this->input->post('table');
        $col_name = $this->input->post('col_name');
//        echo $col_name;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->ResourceModel->count_all_favorites_data($table,$col_name,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxFavoritesData';
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
        $data['allresource'] = $this->ResourceModel->searchpageinfobymyfav($table,$col_name,$config["per_page"], $offset,$member_id, $option_id);

        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
        //print_r($data['favresource']);
        //print_r($data['allresource']);
        //die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxFavoritesData(){
        $option_id = $this->session->userdata('option_id');
        $member_id = $_SESSION['member_id'];
        
        //calc offset number
        $page = $this->input->post('page');
        $page_link = $this->input->post('page_link');
        $table = $this->input->post('table');
        $col_name = $this->input->post('col_name');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->ResourceModel->count_all_favorites_data($table,$col_name,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxFavoritesData';
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
        $data['allresource'] = $this->ResourceModel->searchpageinfobymyfav($table,$col_name,$config["per_page"], $offset,$member_id, $option_id);
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }

    public function searchbymycom() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
//        echo $member_id . ' ' .$option_id;die;
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        $page = $this->input->post('page');
        $page_link = $this->input->post('page_link');
        $table = $this->input->post('table');
        $col_name = $this->input->post('col_name');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->ResourceModel->count_all_comments_data($table,$col_name,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allresource'] = $this->ResourceModel->searchpageinfobymycom($table,$col_name,$config["per_page"], $offset,$member_id, $option_id);
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxCommentsData(){
        $option_id = $this->session->userdata('option_id');
        
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
        $table = $this->input->post('table');
        $col_name = $this->input->post('col_name');
        $page_link = $this->input->post('page_link');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->ResourceModel->count_all_comments_data($table,$col_name,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allresource'] = $this->ResourceModel->searchpageinfobymycom($table,$col_name,$config["per_page"], $offset,$member_id, $option_id);
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }

    public function showaddnetwork() {
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
            //$getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
             $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
           // foreach ($getpermisetting as $key => $get) {
                //$string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $option_id = 21;
            $data['testpage'] = $string;
            
            $totalRec = $this->ResourceModel->count_all_resource('ad_networks');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('ad_networks',$config["per_page"], $data['page']);
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            
            $data['page_title'] = 'Adds Networks';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/adNetworks/addsNet', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }
    
    function ajaxPaginationNetworkData(){
        $conditions = array();
        $member_id = $_SESSION['member_id'];
        //calc offset number
        $page = $this->input->post('page');
//        echo $table;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->ResourceModel->count_all_resource('ad_networks');
        
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxPaginationNetworkData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['alladdsnetwork'] = $this->ResourceModel->getloadaddsnetwork($config["per_page"], $offset);
        $option_id = 21;
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['alladdsnetwork']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/resource/adNetworks/addsNetShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchNetworkFilterData() {
        $searchval = $_POST['searchval'];
        
        $name_data['searchval'] = $_POST['searchval'];
        $name_data['searchkey'] = $_POST['searchkey'];
        $this->session->set_userdata($name_data);
        
        $searchkey = '';
        if($searchkey = $_POST['searchkey'] != ''){
            $searchkey = $searchkey = $_POST['searchkey'];
        }
        $member_id = $_SESSION['member_id'];
        $page = $this->input->post('page');
        
//        echo $searchkey;die;
        
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
//        echo $offset;die;
        //total rows count
        $totalRec = $this->ResourceModel->count_all_network_filters($searchkey);
//        print_r( $totalRec);die();
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxPaginationNetworkLimitData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $searchval;
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'limitFilter';
        $this->ajax_pagination->initialize($config);

        $data['alladdsnetwork'] = $this->ResourceModel->search_all_network_filter_data($config['per_page'],$offset,$searchkey);
//         print_r( $data['alladdsnetwork']);die(); 
        $option_id = 21;
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['alladdsnetwork']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/resource/adNetworks/addsNetShowDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function ajaxPaginationNetworkLimitData() {
        $searchval = $this->session->userdata('searchval');
        $searchkey = '';
        if($this->session->userdata('searchkey') != ''){
            $searchkey = $this->session->userdata('searchkey');
        }
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
        $totalRec = $this->ResourceModel->count_all_network_filters($searchkey);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'resource/ajaxPaginationNetworkLimitData';
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
        
        $data['alladdsnetwork'] = $this->ResourceModel->search_all_network_filter_data($config['per_page'],$offset,$searchkey);
//         print_r( $data['alladdsnetwork']);die(); 
        $option_id = 21;
        $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
//        print_r($data['alladdsnetwork']);die;
        //load the view
        $json = array();
        $json['bannerdiv'] = $this->load->view('front/resource/adNetworks/addsNetShowDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function showhosting() {
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
            //$getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
            //foreach ($getpermisetting as $key => $get) {
               // $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $data['testpage'] = $string;
            $option_id = 22;
            
            $totalRec = $this->ResourceModel->count_all_resource('hosting');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
           // $data['allresource'] = $this->ResourceModel->getloadhostingrsc($config["per_page"], $data['page']);
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('hosting',$config["per_page"], $data['page']);
            
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            $data['page_title'] = 'Hosting';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/hosting/allhosting', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }

    public function showtraking() {
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
            //$getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
            //foreach ($getpermisetting as $key => $get) {
              //  $string[$get['option_id']] = $get['is_active'];
           // }
           
            foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            
            $data['testpage'] = $string;
            $option_id = 23;
            
            $totalRec = $this->ResourceModel->count_all_resource('tracking');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('tracking',$config["per_page"], $data['page']);

            
//            $data['alltraking'] = $this->ResourceModel->getloadtraking();
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            $data['page_title'] = 'Traking';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/tracking/alltracking', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }

    public function showcoaching() {
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
           // $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
            //foreach ($getpermisetting as $key => $get) {
               // $string[$get['option_id']] = $get['is_active'];
           // }
           
            foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $data['testpage'] = $string;
            $option_id = 24;
            
            $totalRec = $this->ResourceModel->count_all_resource('coaching');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('coaching',$config["per_page"], $data['page']);
            
//            $data['allcoaching'] = $this->ResourceModel->getloadcoaching();
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            $data['page_title'] = 'Coaching';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/coaching/allcoaching', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }

    public function showforums() {
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
           // $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
           // foreach ($getpermisetting as $key => $get) {
                //$string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $data['testpage'] = $string;
            $option_id = 27;
           
            $totalRec = $this->ResourceModel->count_all_resource('forums');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('forums',$config["per_page"], $data['page']);
           
//            $data['allforums'] = $this->ResourceModel->getloadforums();
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            $data['page_title'] = 'Forum';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/forums/allforums', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }

    public function showblogs() {
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];

            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
            //$getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
            //foreach ($getpermisetting as $key => $get) {
              //  $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $data['testpage'] = $string;
            $option_id = 28;
            
            $totalRec = $this->ResourceModel->count_all_resource('blogs');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'resource/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);

            //get the posts data
            $data['allresource'] = $this->ResourceModel->getloadaffiliatenetwork('blogs',$config["per_page"], $data['page']); 
             
//            $data['allblog'] = $this->ResourceModel->getloadblogs();
            $data['favresource'] = $this->ResourceModel->getfavafflires($member_id, $option_id);
            $data['page_title'] = 'Blog';
            $data['header'] = $this->load->view('front/common/userheader', $data, true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/resource/blogs/allblog', $data, TRUE);
            $this->load->view('front/resource/resource_master', $data);
        } else {
            redirect('loginform');
        }
    }

    public function resourcecommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $member_id = $_SESSION['member_id'];
        $data['all_com_info'] = $this->BannersModel->getbannercomments($option_id, $addsId, $member_id);
        $data['option_id'] = $option_id;
        //print_r($data['option_id']);die;
        if($option_id == '20'){
             $this->load->view('front/resource/affliateNetwork/affliNetCommentModal', $data);
        }
        
        if($option_id == '21'){
             $this->load->view('front/resource/adNetworks/adNetworksCommentModal', $data);
        }
        
        if($option_id == '22'){
             $this->load->view('front/resource/hosting/hostingCommentModal', $data);
        }
        
        if($option_id == '23'){
             $this->load->view('front/resource/tracking/trackingCommentModal', $data);
        }
        
        if($option_id == '24'){
             $this->load->view('front/resource/coaching/coachingCommentModal', $data);
        }
        
        if($option_id == '27'){
             $this->load->view('front/resource/forums/forumsCommentModal', $data);
        }
        
        if($option_id == '28'){
             $this->load->view('front/resource/blogs/blogCommentModal', $data);
        }
       
    }
    
     public function makefavoritesresource() {
        $data['member_id'] = $_SESSION['member_id'];
        $data['adds_id'] = $this->uri->segment('2');
        $data['option_id'] = $this->uri->segment('3');
        $data['date'] = date('Y-m-d');
        $data['date'] = date('Y-m-d');
        $makefav = $this->ResourceModel->getresourcemakefavorites($data);
        if ($makefav) {
            $this->session->set_flashdata('success', "Favorite Adds successfully");
            if ($this->uri->segment('3') == 20) {
                redirect('showaffiliatenetwork');
            }
            if ($this->uri->segment('3') == 21) {
                redirect('showaddnetwork');
            }
            if ($this->uri->segment('3') == 22) {
                redirect('showhosting');
            }
            
            if ($this->uri->segment('3') == 23) {
                redirect('showtraking');
            }
            
            if ($this->uri->segment('3') == 24) {
                redirect('showcoaching');
            }
            if ($this->uri->segment('3') == 27) {
                redirect('showforums');
            }
            
            if ($this->uri->segment('3') == 28) {
                redirect('showblogs');
            }
        } else {
            echo 'error';
        }
    }

}
