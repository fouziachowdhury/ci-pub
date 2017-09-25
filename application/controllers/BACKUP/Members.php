<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('MembersModel');
        $this->load->model('MainfrontModel');
    }

    public function insertmember() {
        $this->form_validation->set_rules('m_name', 'Member Name', 'required');
        $this->form_validation->set_rules('m_email', 'Email Address', 'trim|required|is_unique[members.email]');
        $this->form_validation->set_rules('m_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('m_password_confirmation', 'Confirm password', 'trim|required|matches[m_password]');
        $this->form_validation->set_rules('m_address1', 'Address 1', 'required');
        //$this->form_validation->set_rules('m_address2', 'Address 2', 'required');
        $this->form_validation->set_rules('m_city', 'City', 'required');
        $this->form_validation->set_rules('m_state', 'State', 'required');
        $this->form_validation->set_rules('m_zip', 'Zip', 'required');

        if ($this->form_validation->run() === FALSE) { //echo 'error!';exit;
            redirect('registrationform');
            //$this->shopSignupform();
        } else {
            $data = array();
            /* required */
            $data['name'] = $this->input->post('m_name');
            $data['email'] = $this->input->post('m_email');
            $data['password'] = md5($this->input->post('m_password'));
            $data['address_1'] = $this->input->post('m_address1');
            $data['address_2'] = $this->input->post('m_address2');
            $data['city'] = $this->input->post('m_city');
            $data['state'] = $this->input->post('m_state');
            $data['country_id'] = $this->input->post('country_id');
            $data['zip'] = $this->input->post('m_zip');
            $data['type'] = 2;
            $data['status'] = 0;

            //echo '<pre>'; print_r($data); exit;
            $this->db->insert('members', $data);
            $member_id = $this->db->insert_id();

            if ($member_id) {
                $actual_link = "https://rs7.beshijoss.com/publyfe/" . "memberactivate/" . $member_id;
                $toEmail = $data['email'];
                $subject = "User Registration Activation Email";
                $content = "Click this link to activate your account: " . $actual_link ;
                $mailHeaders = "From: Admin\r\n";
                if (mail($toEmail, $subject, $content, $mailHeaders)) {
                    $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";
                }

                $update = $this->MembersModel->updatemember($actual_link, $member_id);
                if ($update) {
                    $this->session->set_flashdata('success', 'Registration is Successfull');
                    
                    //INSERT ACCESS FOR THIS USER
                    $optionINfo = $this->MembersModel->getallmembershipoptions();
                    $access = array(); 
                    foreach($optionINfo as $key=>$val){

                    $access['member_id'] = $member_id;
                    $access['ads_type'] = $val['option_id'];
                    $access['price'] = 0;
                    $access['active'] = 0;
                    $access['trial'] = 1;
                    $this->db->insert('access', $access);
                    }
                    
                    $page = $this->session->userdata('last_page');
                    if ($page == 'affiliate') { 
                        $package_id = '1';
                        $updatepackageid = $this->MembersModel->setpackageid($package_id, $member_id);
                        $this->session->set_flashdata('singup_package','Affiliate');  
                        $this->session->unset_userdata('last_page');
                        $session = array(
                            'member_id' => $member_id,
                            'member_name' => $this->input->post('m_name'),
                        );
                        $this->session->set_userdata($session);
                        redirect('affiliate');
                    } else if ($page == 'network') {
                       $package_id = '2';
                        $updatepackageid = $this->MembersModel->setpackageid($package_id, $member_id);
                        $this->session->set_flashdata('singup_package','Network'); 
                        $this->session->unset_userdata('last_page');
                        $session = array(
                            'member_id' => $member_id,
                            'member_name' => $this->input->post('m_name'),
                        );
                        $this->session->set_userdata($session);
                        redirect('network');
                    } else if ($page == 'whois') {
                        $package_id = '3';
                        $updatepackageid = $this->MembersModel->setpackageid($package_id, $member_id);
                        $this->session->set_flashdata('singup_package','Whois');
                        $this->session->unset_userdata('last_page');
                        $session = array(
                            'member_id' => $member_id,
                            'member_name' => $this->input->post('m_name'),
                        );
                        $this->session->set_userdata($session);
                        redirect('whois');
                    } else {
                        $package_id = '1';
                        $updatepackageid = $this->MembersModel->setpackageid($package_id, $member_id);
                        $this->session->unset_userdata('last_page');
                        //$session = array(
                          //  'member_id' => $member_id,
                           // 'member_name' => $this->input->post('m_name'),
                       // );
                        //$this->session->set_userdata($session);
                        //redirect('userhome');
                        //redirect('home');
                        redirect('thankyoupage');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Registration is not Complete. Re try again');
                    redirect('registrationform');
                }
            } else {
                $this->session->set_flashdata('error', 'Registration is not Complete. Re try again');
                redirect('registrationform');
            }
        }
    }

    public function loginmember() {
        $msg = "Login Successfully";
        $error = "Login Error";
        $this->form_validation->set_rules('member_email', 'Email', 'required');
        $this->form_validation->set_rules('member_password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            redirect('loginform');
        } else {
            $data['email'] = $this->input->post('member_email');
            $data['password'] = md5($this->input->post('member_password'));
            $login = $this->MembersModel->memberlogin($data);
            $member_id = $_SESSION['member_id'];
            if ($login == 1) {
                $this->session->set_flashdata('success', $msg);
                $page = $this->session->userdata('last_page');
                    if ($page == 'affiliate') { 
                         $this->session->unset_userdata('last_page');
                    if ($this->session->userdata('redirect')) {
                        $redirect = $this->session->userdata('redirect');
                        $this->session->unset_userdata('redirect');
                        redirect($redirect);
                    }
                    } else if ($page == 'network') {
                        $this->session->unset_userdata('last_page');
                    if ($this->session->userdata('redirect')) {
                        $redirect = $this->session->userdata('redirect');
                        $this->session->unset_userdata('redirect');
                        redirect($redirect);
                    }
                    } else if ($page == 'whois') {
                       $this->session->unset_userdata('last_page');
                    if ($this->session->userdata('redirect')) {
                        $redirect = $this->session->userdata('redirect');
                        $this->session->unset_userdata('redirect');
                        redirect($redirect);
                    }
                    } else {
                        $this->session->unset_userdata('last_page');
                redirect('userhome');
                //redirect('memberprofile/' . $member_id);
                    }
            } else {
                $this->session->set_flashdata('error', $errmsg);
                redirect('loginform');
            }
        }
    }

    public function memberprofile() {
        $member_id = $this->uri->segment('2');
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
        $data['memberinfo'] = $this->MembersModel->memberinfo($member_id);
        $membership_package_options = $data['memberinfo']->membership_package_options;
        $package_options = explode(",", $membership_package_options);
        $data['paymentinfo'] = $this->MembersModel->memberpaymentinfo($member_id);
        $data['membership_options'] = $this->MembersModel->getallmembershipoptions();
        //print_r($data['membership_options']); exit;
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/members/profile', $data);
        $this->load->view('front/common/footer');
    }

    public function logoutmember() {
        $this->session->unset_userdata('member_id');
        $this->session->unset_userdata('member_name');
        $this->session->unset_userdata('type');
        redirect('home');
    }

    public function activatemember() { 
        $member_id = $this->uri->segment('2');
        $active =  $this->MembersModel->activatememberstatus($member_id);
        if($active) {
           redirect('home');
       }
    }

    public function changepassword() {
        $member_id = $this->uri->segment('2');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('re_password', 'Confirm password', 'trim|required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            redirect('memberprofile/' . $member_id);
        } else {
            $password = md5($this->input->post('password'));
            $update = $this->MembersModel->updatememberpassword($password, $member_id);
            if ($update) {
                $this->session->set_flashdata('success', 'Update Successfully');
                redirect('memberlogout');
            } else {
                $this->session->set_flashdata('error', 'Not Updated');
                redirect('memberprofile/' . $member_id);
            }
        }
    }

    public function accounteditform() {
         if ($_SESSION['member_id'] != '') {
        $member_id = $this->uri->segment('2');
        $data['memberinfo'] = $this->MembersModel->memberinfo($member_id);
        $data['country_info'] = $this->MainfrontModel->getallcountryinfo();

        $data['page_title'] = 'Edit User';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);        
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true); 
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true); 
        $data['front_maincontent'] = $this->load->view('front/members/userprofileeditform', $data, TRUE); 
        //$data['front_maincontent'] = $this->load->view('front/members/profileeditform', $data, TRUE);

        $this->load->view('front/front_master', $data);
       // $this->load->view('front/common/header');
       // $this->load->view('front/common/homesidebar');
        //$this->load->view('front/members/profileeditform', $data);
        //$this->load->view('front/common/footer');
    }
    }

    public function updateprofile() {
         $member_id = $this->uri->segment('2');
        $this->form_validation->set_rules('m_name', 'Member Name', 'required');
        $this->form_validation->set_rules('m_email', 'Email Address', 'required');
        $this->form_validation->set_rules('m_address1', 'Address 1', 'required');
        $this->form_validation->set_rules('m_address2', 'Address 2', 'required');
        $this->form_validation->set_rules('m_city', 'City', 'required');
        $this->form_validation->set_rules('m_state', 'State', 'required');
        $this->form_validation->set_rules('m_zip', 'Zip', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('re_password', 'Confirm password', 'matches[new_password]');
          
        if ($this->form_validation->run() === FALSE) {  
            redirect('editaccount/' . $member_id);
        } else { //echo 44444; exit;
            $data = array();
            /* required */
            $data['name'] = $this->input->post('m_name');
            $data['email'] = $this->input->post('m_email');
            $data['address_1'] = $this->input->post('m_address1');
            $data['address_2'] = $this->input->post('m_address2');
            $data['city'] = $this->input->post('m_city');
            $data['state'] = $this->input->post('m_state');
            $data['country_id'] = $this->input->post('country_id');
            $data['zip'] = $this->input->post('m_zip');
            $data['password'] = md5($this->input->post('new_password'));

            $update = $this->MembersModel->updatememberaccount($data, $member_id);
            if ($update) {
                $this->session->set_flashdata('success', 'Profile Update is Successfull');
                redirect('userhome');
            } else {
                $this->session->set_flashdata('error', 'There is an error in Update');
                redirect('editaccount/' . $member_id);
            }
        }
    }
    
    public function thankyoupage() {
        $this->load->view('front/common/header');
        $this->load->view('front/members/thankyou');
        $this->load->view('front/common/footer');
    }

 public function myaccount(){
        $member_id = $this->uri->segment('2');
        $data['memberinfo'] = $this->MembersModel->memberinfo($member_id);
        $membership_package_options = $data['memberinfo']->membership_package_options;
        $package_options = explode(",", $membership_package_options);
        $data['paymentinfo'] = $this->MembersModel->memberpaymentinfo($member_id);
        $data['membership_options'] = $this->MembersModel->getallmembershipoptions();
        
         $data['page_title'] = 'Edit User';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/members/memberaccount', $data, TRUE);
        $this->load->view('front/front_master', $data);
    }
}
