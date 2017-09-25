<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mainfront extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('MainfrontModel');
        $this->load->model('MembersModel');
    }

    public function home() {
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/common/homecarousel');
        $this->load->view('front/home');
        $this->load->view('front/common/footer');
    }

    public function userhome() {
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
            //print_r($data['testpage']); exit;
        $data['newsinfo'] = $this->MembersModel->getnews();
        $data['sponsorinfo'] = $this->MembersModel->getsponsor();
        //echo '<pre>'; print_r($_SESSION); exit;
        //$this->session->unset_userdata('some_name');
        $this->session->unset_userdata('redirect');
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/userhome', $data, TRUE);
        $this->load->view('front/front_master', $data);
            
            
            
            //$this->load->view('front/common/header');
            //$this->load->view('front/common/homesidebar');
            //$this->load->view('front/userhome');
           // $this->load->view('front/common/footer');
        }
    }

    public function memberregistration() {
        $data['country_info'] = $this->MainfrontModel->getallcountryinfo();
        //$this->load->view('front/members/registrationform', $data);
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/members/registrationform', $data);
        $this->load->view('front/common/footer');
    }

    public function memberlogin() {
        //$this->load->view('front/members/loginform');
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/members/loginform');
        $this->load->view('front/common/footer');
    }

    public function memberforgetpass() {
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/members/forgetpassword');
        $this->load->view('front/common/footer');
    }

    public function contactwithus() {
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/contactform');
        $this->load->view('front/common/footer');
    }

    public function siteterms() {
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/terms');
        $this->load->view('front/common/footer');
    }

    public function siteprivacy() {
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/privacy');
        $this->load->view('front/common/footer');
    }

    public function withoutlogin() {
        $this->load->view('front/common/header');
        $this->load->view('front/error/withoutloginerror');
    }

    public function permissionerror() {
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', '', true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', '', true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $this->load->view('front/error/error', $data);
        //$this->load->view('front/common/header');
       // $this->load->view('front/error/permissionerror');
    }

    public function pageviewcount() {
        $member_id = $_SESSION['member_id'];
        $page_id = $_POST['page_id'];
        $usercountinfo = $this->MainfrontModel->getuserpageviewcountdata($member_id, $page_id);
        //print_r($usercountinfo); exit;
        $json = array();
        if ($usercountinfo != 0) {
            $this->MainfrontModel->updatepageview($member_id, $page_id);
            $json['result'] = 1;
        } else {
            $data = array(
                'member_id' => $member_id,
                'count' => 1,
                'page_id' => $page_id
            );

            $this->db->insert('pageviewcount', $data);
            $json['result'] = 0;
        }
        echo json_encode($json);
    }

    public function pageaccesspermission() {
        $member_id = $_SESSION['member_id'];
        $page_id = $_POST['page_id'];
        if ($page_id == 13) {
            $viewaccessinfo = $this->MainfrontModel->getviewaccesslanding($page_id);
            $viewaccess = $viewaccessinfo->view_page_count;
        } else {
            $viewaccessinfo = $this->MainfrontModel->getviewaccess($page_id);
            $viewaccess = $viewaccessinfo->view_count;
        }

        $viewinfo = $this->MainfrontModel->getuserpageviewcountinfo($member_id, $page_id);
        $json = array();
        if (!empty($viewinfo)) {
            $viewcount = $viewinfo->count;
            if ($viewaccess > $viewcount) {
                $json['result'] = 1;
            } else {
                $json['result'] = 0;
            }
        } else {
            $data = array(
                'member_id' => $member_id,
                'count' => 1,
                'page_id' => $page_id
            );

            $this->db->insert('pageviewcount', $data);
        }

        echo json_encode($json);
    }

}
