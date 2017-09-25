<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affiliate extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('Ajax_pagination');
        $this->load->model('MembersModel');
        $this->load->model('BannersModel');
        $this->load->model('AffiliateModel');
        $this->load->model('LandingModel');
    }

    public function affiliatepackeges() {
        $data['membership_options'] = $this->MembersModel->getoptionbypackages();
        $pack = 11;
        $data['superpackageinfo'] = $this->MembersModel->getsuperpackageinfo($pack);
        $this->load->view('front/common/header');
//        $this->load->view('front/common/menu');
        $this->load->view('front/affiliate/affiliate', $data);
        $this->load->view('front/common/footer');
    }

    public function custompackageforaffiliate() {
        $option_id = $this->input->post('option_id');
           
        foreach ($option_id as $option){
            $option_data[] = $option;
        }
        $this->session->set_userdata('option_id',$option_data);
        
        if ($_SESSION['member_id'] != '') {
            if(isset($_SESSION['choose_amount'])){
               $choose_amount = $_SESSION['choose_amount'];
            } else {
                 $choose_amount = 0;
            }
            
            if(isset($_SESSION['choose_amount'])){
                $choose_option_id = $_SESSION['choose_amount'];
            } else {
                $choose_option_id = 0;
            }
            
            
            $data['choose_amount'] = $choose_amount;
            $choose_option_id = $choose_option_id;
            $optionvalue = explode("/", $choose_option_id);
            foreach ($optionvalue as $key => $option) {
                if ($option != '') {
                    $optionid[] = $option;
                }
           $member_access = $this->MembersModel->getmemberaccessbymemberid($_SESSION['member_id']);
           if(empty($member_access)){
               $data['membership_options'] = $this->MembersModel->getoptionbypackages();
           } else {
            foreach($member_access as $maccess){ 
                $access[] = $maccess['ads_type'];
            }
            $data['membership_options'] = $this->MembersModel->getoptionbypackagesnew($access);
           }
             //$data['membership_options'] = $this->MembersModel->getoptionbypackages();
            //print_r($member_access);die;
//            $this->load->view('front/common/header');
//            $this->load->view('front/common/menu');
//            $this->load->view('front/affiliate/affliatecuspackageoptions', $data);
//            $this->load->view('front/common/footer'); 
           redirect('payforaffiliate');
        } 
        } else {
            $this->session->set_userdata('last_page', 'affiliate');
            $this->session->set_userdata('redirect', 'custompackageforaffiliate');
            //redirect('loginform');
            redirect('registrationform');
        }
    }


    public function freepack() {
        $packId = $this->uri->segment('2');
        if ($packId == 1) {
            $this->session->set_userdata('last_page', 'affiliate');
            $this->session->set_userdata('redirect', 'affiliate');
            $this->session->set_userdata('free', 'affiliatefree');
            redirect('registrationform');
        } else if ($packId == 2) {
            $this->session->set_userdata('last_page', 'network');
            $this->session->set_userdata('redirect', 'network');
            $this->session->set_userdata('free', 'networkfree');
            redirect('registrationform');
        } else if ($packId == 3) {
            $this->session->set_userdata('last_page', 'whois');
            $this->session->set_userdata('redirect', 'whois');
            $this->session->set_userdata('free', 'whoisfree');
            redirect('registrationform');
        }
        
    }
    
    
    public function superpackageforaffiliate() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['amount'] = $this->uri->segment('2');
            $data['user_info'] = $this->MembersModel->memberinfo($member_id);
            $data['email'] = $data['user_info']->email;
            $data['item_name'] = "Super Affiliate Package";
            $data['custom'] = $member_id;
            $data['package_id'] = 1;
            $data['option_id'] = 11;
            
            $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
            $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
            
            $data['notify_url'] = base_url() . 'paypal_notification';
            $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
            $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
            $data['paypalfor'] = "Super Affiliate Package";
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/affiliate/affliatesuppackageoptions', $data);
            $this->load->view('front/common/footer');
        } else {
            $this->session->set_userdata('last_page', 'affiliate');
            $this->session->set_userdata('redirect', 'superpackageforaffiliate/185');
            //redirect('loginform');
            redirect('registrationform');
        }
    }

    public function payforaffiliate() {
        $data['option_id'] = $this->session->userdata('option_id');
        $member_id = $_SESSION['member_id'];
        $form_array = $_POST;
        $final_array = array_pop($form_array);
        //print_r($form_array); exit;
        $data['optionname'] = $this->MembersModel->getoptionbyid($data['option_id']);
//        $data['amount'] = $_POST['amount'];
        $member_id = $_SESSION['member_id'];
//        $data['option_id'] = $_POST['option_id'];
        $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
        $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
        
        $data['custom'] = $member_id;
        $data['package_id'] = 1;
        $data['user_info'] = $this->MembersModel->memberinfo($member_id);
        $data['email'] = $data['user_info']->email;
        //print_r($data); exit;
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/affiliate/payforaffiliateform', $data);
        $this->load->view('front/common/footer');
    }

    public function affiliatefeed() {
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
            //PAGINATION
            $totalRec = $this->AffiliateModel->count_all_data('affiliate_landing_page');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'affiliate/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            //call the model function to get the department data
            $data['allfeed'] = $this->AffiliateModel->getAllOfferFeedInfo('affiliate_landing_page',$config["per_page"], $data['page']);
            //echo '<pre>';  print_r($data['allaffifeed']); exit;
//            $data['allaffifeed'] = $this->AffiliateModel->getAllAffiliateFeedInfo($config["per_page"], $data['page']);
            //echo '<pre>';  print_r($data['allaffifeed']); exit;
//            $data['pagination'] = $this->pagination->create_links();
//            $totalshowing = $data['page'] + $config["per_page"];
//            $data['showing'] = "Showing " . $totalshowing . " of " . $config['total_rows'] . " entries";

            $data['favbanner'] = $this->AffiliateModel->getfavafflibaninfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['optionid'] = $this->BannersModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();


            $data['page_title'] = 'Affiliate Feed';
            $data['header'] = $this->load->view('front/common/userheader', '', true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/affiliate/affiliatefeed', $data, TRUE);
            $this->load->view('front/affiliate/affiliate_master', $data);
        }else{
            redirect("loginform");
        }
    }
    
    public function searchafffeedbymyfavoffer() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        $data['allaffifeed'] = $this->AffiliateModel->searchafffeedpageinfobymyfav($member_id, $option_id);
        $option_id = 6;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['myfav'] = $this->load->view('front/affiliate/affiliatefeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function searchafffeedbymycom() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        $data['allaffifeed'] = $this->AffiliateModel->searchafffeedpageinfobymycom($member_id, $option_id);
        //print_r($data['alllandingpageinfo']); exit;
        $option_id = 6;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['mycom'] = $this->load->view('front/affiliate/affiliatefeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function searchafffeedbycatid(){
         $cat_id = $_POST['cat_id'];
        $member_id = $_SESSION['member_id'];
        $data['allaffifeed'] = $this->AffiliateModel->searchafffeedpageinfobycat($cat_id);
        // print_r( $data['allbanners']); 
        $option_id = 6;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['afffeeddiv'] = $this->load->view('front/affiliate/affiliatefeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchafffeedbycountryid(){
        $country_id = $_POST['country_id'];
        $member_id = $_SESSION['member_id'];
        $data['allaffifeed'] = $this->AffiliateModel->searchafffeedpageinfobycountryid($country_id);
        // print_r( $data['allbanners']); 
        $option_id = 6;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['afffeeddiv'] = $this->load->view('front/affiliate/affiliatefeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    
    public function searchafffeedbyentries(){
        $searchval = $_POST['searchval'];
        $member_id = $_SESSION['member_id'];
        $data['allaffifeed'] = $this->AffiliateModel->searchafffeedpageinfo($searchval);
        // print_r( $data['allofferfeed']); 
        $option_id = 6;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['afffeeddiv'] = $this->load->view('front/affiliate/affiliatefeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function afffeedTagTagAutocomplete(){
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 6;
            $tags_info = $this->AffiliateModel->getafffeedTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function searchafffeedTagbyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allaffifeed'] = $this->AffiliateModel->searchafffeedpageinfobykey($searchKey);
        $option_id = 6;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['afffeeddiv'] = $this->load->view('front/affiliate/affiliatefeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    public function activefreepackage() {
        $data = array();
        $package_id = $_POST['package_id'];
        $member_id = $_SESSION['member_id'];
        if ($package_id == 1) {
            $option_id = '1,2,3,4,5';
        } else if ($package_id == 2) {
            $option_id = '6,7,8';
        } else {
            $option_id = '8';
        }


        $data['member_id'] = $member_id;
        $data['package_id'] = $package_id;
        $data['type'] = 'Free';
        $data['option_id'] = $option_id;
//        echo '<pre>';print_r($data);die;
        
        $access_option = explode(',', $option_id);
//        print_r(count($access_option));die;
        $count = $this->AffiliateModel->count_trial_package($member_id,$package_id);
//        echo $count;die;
        if($count > 0){
            $json['insertmessage'] = "Once you get this free Package. Now you have to Upgrade";
            $json['success'] = 1;
            //print_r($json); exit;
            echo json_encode($json);
        }else{
            //$this->AffiliateModel->deleteInfo('access', 'member_id', $member_id);
            for ($i = 0; $i < count($access_option); $i++) {
                $accessdata['member_id'] = $member_id;
                $accessdata['package_id'] = $package_id;
                $accessdata['ads_type'] = $access_option[$i];
                $accessdata['active'] = 0;
                $accessdata['trial'] = 1;

                $this->db->insert('access', $accessdata);
            }

            $insert = $this->db->insert('user_permission_tbl', $data);
            if ($insert) {
                $json = array();
                $json['insertmessage'] = "Your Package is active successfully";
                $json['success'] = 1;
                //print_r($json); exit;
                echo json_encode($json);
            }
        }
    }

    public function offerfeed() {
        
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        $this->session->unset_userdata('tag_id');
        $this->session->unset_userdata('searchkey');
        $this->session->unset_userdata('searchval');
        
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            
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
            
        //PAGINATION
            $totalRec = $this->AffiliateModel->count_all_data('advertise_offer_feed');
            //pagination configuration
            $data['page'] = 0;
            $config['target'] = '#postList';
            $config['base_url'] = base_url() . 'affiliate/ajaxPaginationData';
            $config['total_rows'] = $totalRec;
            $config['per_page'] = 25;
            $config['link_func'] = 'searchFilter';
            $this->ajax_pagination->initialize($config);
            //call the model function to get the department data
            $data['allfeed'] = $this->AffiliateModel->getAllOfferFeedInfo('advertise_offer_feed',$config["per_page"], $data['page']);
            //echo '<pre>';  print_r($data['allaffifeed']); exit;
            
            $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
            $data['allcountry'] = $this->BannersModel->getAllCountry();
            $data['allcategory'] = $this->BannersModel->getAllCat();
            $data['optionid'] = $this->BannersModel->getoptionid();
            $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
            $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();


            $data['page_title'] = 'Affiliate Feed';
            $data['header'] = $this->load->view('front/common/userheader', '', true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/affiliate/offerfeed', $data, TRUE);
            $this->load->view('front/affiliate/offer_master', $data);
        }else{
            redirect("loginform");
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
        $totalRec = $this->AffiliateModel->count_all_data($table);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxPaginationData';
        $config['total_rows'] = $totalRec;
        $config['per_page'] = 25;
        $config['link_func'] = 'searchFilter';
        $this->ajax_pagination->initialize($config);

        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $config['per_page'];
        
        //get posts data
        $data['allfeed'] = $this->AffiliateModel->getAllOfferFeedInfo($table,$config["per_page"], $offset);
//        echo '<pre>';
//        print_r($data['allofferfeed']);die; 
        $option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
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
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
//        echo $country_id;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = $this->AffiliateModel->count_all_filters($table,$searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxPaginationFilterData';
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
        
        $data['allfeed'] = $this->AffiliateModel->search_all_filter_data($table,$config["per_page"], $offset,$searchkey,$cat_id,$country_id);
//        echo '<pre>'; print_r($data['allfeed']);die(); 
        $option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        echo '<pre>';print_r($data);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
//        echo '<pre>';print_r($json['offerdiv']);die;
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
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->AffiliateModel->count_all_filters($table,$searchkey,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxPaginationFilterData';
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
        
        $data['allfeed'] = $this->AffiliateModel->search_all_filter_data($table,$config["per_page"], $offset,$searchkey,$cat_id,$country_id);
//        print_r($data['alllandingpageinfo']);die;
        $option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function search_by_keyword_Data(){
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
        
        $table = $this->input->post('table');
        $page = $this->input->post('page');
        $page_link = $this->input->post('page_link');
//        echo $page_link;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
//        echo $searchkey;die;
        //total rows count
        $totalRec = $this->AffiliateModel->count_all_filters($table,$tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxPaginationKeywordData';
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
        
        $data['allfeed'] = $this->AffiliateModel->search_all_filter_data($table,$config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
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
        $table = $this->input->post('table');
        $page = $this->input->post('page');
        $page_link = $this->input->post('page_link');
//        echo $tag_id;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->AffiliateModel->count_all_filters($table,$tag_id,$cat_id,$country_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxPaginationKeywordData';
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
        
        $data['allfeed'] = $this->AffiliateModel->search_all_filter_data($table,$config["per_page"], $offset,$tag_id,$cat_id,$country_id);
        
        $option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }

    public function searchbymyfav() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
//        echo $option_id;die;
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
        $page = $this->input->post('page');
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
//        $col_name = $this->input->post('col_name');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->AffiliateModel->count_all_favorites_data($table,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxFavoritesData';
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
        $data['allfeed'] = $this->AffiliateModel->searchinfobymyfav($table,$config["per_page"], $offset,$member_id, $option_id);
        //print_r($data['allfeed']);die;
        //$option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        //print_r($data['favbanner']);die;
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxFavoritesData(){
        $option_id = $this->session->userdata('option_id');
        $member_id = $_SESSION['member_id'];
        
        //calc offset number
        $page = $this->input->post('page');
        $table = $this->input->post('table');
        $page_link = $this->input->post('page_link');
//        $col_name = $this->input->post('col_name');
//        echo $page;die;
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        //total rows count
        $totalRec = $this->AffiliateModel->count_all_favorites_data($table,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxFavoritesData';
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
        $data['allfeed'] = $this->AffiliateModel->searchinfobymyfav($table,$config["per_page"], $offset,$member_id, $option_id);
//        print_r($data['alllandingpageinfo']);die;
        //$option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbymycom() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
//        echo $member_id . ' ' .$option_id;die;
        $name_data['option_id'] = $option_id;
        $this->session->set_userdata($name_data);
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
        $totalRec = $this->AffiliateModel->count_all_comments_data($table,$member_id, $option_id);
        //echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allfeed'] = $this->AffiliateModel->searchinfobymycom($table,$config["per_page"], $offset,$member_id, $option_id);

        //print_r($data['alllandingpageinfo']); exit;
        //$option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavouriteinfo($member_id, $option_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }
    
    function ajaxCommentsData(){
        $option_id = $this->session->userdata('option_id');
        
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
        $totalRec = $this->AffiliateModel->count_all_comments_data($table,$member_id, $option_id);
//        echo $totalRec;die;
        //pagination configuration
        $config['target'] = '#postList';
        $config['base_url'] = base_url() . 'affiliate/ajaxCommentsData';
        $config['total_rows'] = $totalRec;
        if($this->session->userdata('searchval') != ''){
            $config['per_page'] = $this->session->userdata('searchval');
        }
        else{
            $config['per_page'] = 25;
        }
        $config['link_func'] = 'commentsData';
        $this->ajax_pagination->initialize($config);
        
        $data['allfeed'] = $this->AffiliateModel->searchinfobymycom($table,$config["per_page"], $offset,$member_id, $option_id);
        
        //$option_id = 7;
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();
//        print_r($data['allbanners']);die;
        //load the view
        $json = array();
        $json['offerdiv'] = $this->load->view($page_link, $data, TRUE);
        echo json_encode($json);
    }

    public function searchlandingbymycomoffer() {
        $member_id = $_POST['member_id'];
        $option_id = $_POST['option_id'];
        $data['allofferfeed'] = $this->AffiliateModel->searchofferpageinfobymycom($member_id, $option_id);
        //print_r($data['alllandingpageinfo']); exit;
        $option_id = 7;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['mycom'] = $this->load->view('front/affiliate/offerfeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function searchofferbycatid(){
         $cat_id = $_POST['cat_id'];
        $member_id = $_SESSION['member_id'];
        $data['allofferfeed'] = $this->AffiliateModel->searchofferpageinfobycat($cat_id);
        // print_r( $data['allbanners']); 
        $option_id = 7;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['offerdiv'] = $this->load->view('front/affiliate/offerfeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchofferbycountryid(){
        $country_id = $_POST['country_id'];
        $member_id = $_SESSION['member_id'];
        $data['allofferfeed'] = $this->AffiliateModel->searchofferpageinfobycountryid($country_id);
        // print_r( $data['allbanners']); 
        $option_id = 7;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['offerdiv'] = $this->load->view('front/affiliate/offerfeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }

    
    public function searchofferbyentries(){
        $searchval = $_POST['searchval'];
        $member_id = $_SESSION['member_id'];
        $data['allofferfeed'] = $this->AffiliateModel->searchofferpageinfo($searchval);
        // print_r( $data['allofferfeed']); 
        $option_id = 7;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['offerdiv'] = $this->load->view('front/affiliate/offerfeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function offerTagAutocomplete(){
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $option_id = 7;
            $tags_info = $this->AffiliateModel->getofferTagsInfoForAutocomplete($q, $option_id);
            $json = array();
            echo json_encode($tags_info);
        }
    }
    
    public function searchofferbyautokey(){
         $searchKey = $_POST['searchKey'];
        $member_id = $_SESSION['member_id'];
        $data['allofferfeed'] = $this->AffiliateModel->searchofferpageinfobykey($searchKey);
        $option_id = 7;
        $data['favbanner'] = $this->BannersModel->getfavbaninfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['allsize'] = $this->BannersModel->getAllSize();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);

        $json = array();
        $json['offerdiv'] = $this->load->view('front/affiliate/offerfeedPageDiv', $data, TRUE);
        echo json_encode($json);
    }
    
    public function offercommentmodal() {
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $data['all_com_info'] = $this->LandingModel->getlandingcomments($option_id, $addsId);
        //print_r($data['all_com_info']); exit;
        $this->load->view('front/affiliate/offerCommentModal', $data);
    }
    
    public function feedcommentmodal(){
        $option_id = $_POST['option_id'];
        $addsId = $_POST['addsId'];
        $data['all_com_info'] = $this->LandingModel->getlandingcomments($option_id, $addsId);
        $this->load->view('front/affiliate/feedCommentModal', $data);
    }
    
    public function offerFeedByCategory($cat_id) {

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

        //PAGINATION
        $config = array();
        $config["base_url"] = base_url() . "affiliate/offerFeedByCategory/" . $cat_id;
        $cat_id = ',' . $cat_id . ',';
        $config['total_rows'] = $this->AffiliateModel->count_all_offer_by_cat($cat_id);
        $config["per_page"] = 25;
//                $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $this->AffiliateModel->count_all_offer_by_cat($cat_id);
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
        $data['allofferfeed'] = $this->AffiliateModel->all_offer_by_cat_id($config["per_page"], $page, $cat_id);
//        echo '<pre>';print_r($data['allofferfeed']);die;
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;', $str_links);
        
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();


        $data['page_title'] = 'Affiliate Feed';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/affiliate/all_offer_by_category', $data, TRUE);
        $this->load->view('front/affiliate/offer_master', $data);
    }
    
    public function offerFeedByCountry($country_id) {

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

        //PAGINATION
        $config = array();
        $config["base_url"] = base_url() . "affiliate/offerFeedByCountry/" . $country_id;
        $tag_id = ',' . $country_id . ',';
        $config['total_rows'] = $this->AffiliateModel->count_all_offer_by_country($country_id);
        $config["per_page"] = 25;
//                $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $this->AffiliateModel->count_all_offer_by_country($country_id);
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
        $data['allofferfeed'] = $this->AffiliateModel->all_offer_by_country_id($config["per_page"], $page, $country_id);
//        echo '<pre>';print_r($data['allofferfeed']);die;
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;', $str_links);
        
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();


        $data['page_title'] = 'Affiliate Feed';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/affiliate/all_offer_by_country', $data, TRUE);
        $this->load->view('front/affiliate/offer_master', $data);
    }
    
    public function offerFeedByTag($tag_id) {

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

        //PAGINATION
        $config = array();
        $config["base_url"] = base_url() . "landingpage/landingByCategory/" . $tag_id;
        $tag_id = ',' . $tag_id . ',';
        $config['total_rows'] = $this->AffiliateModel->count_all_offer_by_keyword($tag_id);
        $config["per_page"] = 25;
//                $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $this->AffiliateModel->count_all_offer_by_keyword($tag_id);
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
        $data['allofferfeed'] = $this->AffiliateModel->all_offer_by_keyword_id($config["per_page"], $page, $tag_id);
//        echo '<pre>';print_r($data['allofferfeed']);die;
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;', $str_links);
        
        $data['favbanner'] = $this->AffiliateModel->getfavaofferinfo($member_id);
        $data['allcountry'] = $this->BannersModel->getAllCountry();
        $data['allcategory'] = $this->BannersModel->getAllCat();
        $data['optionid'] = $this->BannersModel->getoptionid();
        $data['alltag'] = $this->BannersModel->getAllTagByOptionId($data['optionid']->option_id);
        $data['allcomments'] = $this->AffiliateModel->getaffiliatecomments();


        $data['page_title'] = 'Affiliate Feed';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/affiliate/all_offer_by_keyword', $data, TRUE);
        $this->load->view('front/affiliate/offer_master', $data);
    }

}
