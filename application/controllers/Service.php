<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->model('MembersModel');
        $this->load->model('BannersModel');
        $this->load->model('ServiceModel');
    }

    public function showbandesign(){
         if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi= explode(',', $permissionId);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
           // $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $string = array();
            //foreach ($getpermisetting as $key=>$get) {
                //$string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            
            $data['testpage'] = $string;
                $data['alldesign'] = $this->ServiceModel->getloadbandesign();
                $data['page_title'] = 'Banner Design';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/service/bannerdesign/bannerdesign', $data, TRUE);
                $this->load->view('front/service/service_master', $data);
         }  else {
             redirect('loginform');
         }
        }
        
        public function showprogramming(){
         if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi= explode(',', $permissionId);
           // $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
            //foreach ($getpermisetting as $key=>$get) {
               // $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            
            $data['testpage'] = $string;
                $data['allprogramming'] = $this->ServiceModel->getloadprogramming();
                $data['page_title'] = 'Programming';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/service/programming/allprogramming', $data, TRUE);
                $this->load->view('front/service/service_master', $data);
         }  else {
             redirect('loginform');
         }
        }
        
        public function showmanagement(){
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
            //foreach ($getpermisetting as $key=>$get) {
               // $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            
            $data['testpage'] = $string;
                $data['allmanagement'] = $this->ServiceModel->getloadmanagement();
                $data['page_title'] = 'Management';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/service/management/allmanagement', $data, TRUE);
                $this->load->view('front/service/service_master', $data);
         }  else {
             redirect('loginform');
         }
        }
        
        public function showtranslation(){
             if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi= explode(',', $permissionId);
           // $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
            $string = array();
           // foreach ($getpermisetting as $key=>$get) {
              //  $string[$get['option_id']] = $get['is_active'];
           // }
           
           foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            
            $data['testpage'] = $string;
                $data['alltranslation'] = $this->ServiceModel->getloadtranslation();
                $data['page_title'] = 'Translation';
                $data['header'] = $this->load->view('front/common/userheader', $data, true);
                $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
                $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
                $data['footer'] = $this->load->view('front/common/userfooter', '', true);
                $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
                $data['front_maincontent'] = $this->load->view('front/service/translation/alltranslation', $data, TRUE);
                $this->load->view('front/service/service_master', $data);
         }  else {
             redirect('loginform');
         }
        }
        
    }
    