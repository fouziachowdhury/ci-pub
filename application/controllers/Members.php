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
//        echo '<pre>';print_r($_POST);die;
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
            $package_id = $_SESSION['package_id'];
            //echo $package_id;die;
            $data = array();

            if (isset($_POST['Banner_Ads']) && $_POST['Banner_Ads'] != '') {
                $banner_adds = $_POST['Banner_Ads'];
            } else {
                $banner_adds = '';
            }

            if (isset($_POST['Facebook_Ecommerce_Ads']) && $_POST['Facebook_Ecommerce_Ads'] != '') {
                $facebook_ecom_adds = $_POST['Facebook_Ecommerce_Ads'];
            } else {
                $facebook_ecom_adds = '';
            }

            if (isset($_POST['Native_Ads']) && $_POST['Native_Ads'] != '') {
                $nativ_adds = $_POST['Native_Ads'];
            } else {
                $nativ_adds = '';
            }

            if (isset($_POST['Facebook_Ads']) && $_POST['Facebook_Ads'] != '') {
                $facebook_adds = $_POST['Facebook_Ads'];
            } else {
                $facebook_adds = '';
            }

            if (isset($_POST['Ppv_Ads']) && $_POST['Ppv_Ads'] != '') {
                $ppv_adds = $_POST['Ppv_Ads'];
            } else {
                $ppv_adds = '';
            }

            if (isset($_POST['amount']) && $_POST['amount'] != '') {
                $option_amount = $_POST['amount'];
            } else {
                $option_amount = '';
            }

            if (isset($_POST['Affiliate_Landing_Page_Feed']) && $_POST['Affiliate_Landing_Page_Feed'] != '') {
                $Affiliate_Landing_Page_Feed = $_POST['Affiliate_Landing_Page_Feed'];
            } else {
                $Affiliate_Landing_Page_Feed = '';
            }


            if (isset($_POST['Advertise_Offer_Feed']) && $_POST['Advertise_Offer_Feed'] != '') {
                $Advertise_Offer_Feed = $_POST['Advertise_Offer_Feed'];
            } else {
                $Advertise_Offer_Feed = '';
            }
            
            if (isset($_POST['Whois_Silver']) && $_POST['Whois_Silver'] != '') {
                $Whois_Silver = $_POST['Whois_Silver'];
            } else {
                $Whois_Silver = '';
            }
            
            if (isset($_POST['Whois_Gold']) && $_POST['Whois_Gold'] != '') {
                $Whois_Gold = $_POST['Whois_Gold'];
            } else {
                $Whois_Gold = '';
            }
            
            if (isset($_POST['Whois_Platnium']) && $_POST['Whois_Platnium'] != '') {
                $Whois_Platnium = $_POST['Whois_Platnium'];
            } else {
                $Whois_Platnium = '';
            }
            
            if (isset($_POST['optionradio']) && $_POST['optionradio'] != '') {
                $optionradio = $_POST['optionradio'];
            } else {
                $optionradio = '';
            }

            $choose_option_id = $banner_adds . '/' . $facebook_ecom_adds . '/' . $nativ_adds . '/' . $facebook_adds . '/' . $ppv_adds . '/' . $Affiliate_Landing_Page_Feed . '/' . $Advertise_Offer_Feed .'/'. $Whois_Silver .'/'. $Whois_Gold .'/'. $Whois_Platnium . '/' . $optionradio;
            
//            print_r($choose_option_id);die;
            if ($_SESSION['redirect'] != '') {
                $redirect = $_SESSION['redirect'];
            } else {
                $redirect = '';
            }
            // echo $redirect;die;
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
            $data['redirect'] = $redirect;
            $data['choose_option_id'] = $choose_option_id;
            $data['choose_amount'] = $option_amount;
            
            // Add By SHifat. After choosing any option the package id is 0 in members table. 
            $data['package_id'] = $_SESSION['package_id'];

            $this->db->insert('members', $data);
            $member_id = $this->db->insert_id();
            $package_id = $_SESSION['package_id'];
            if ($member_id) {
                // $actual_link = "https://rs7.beshijoss.com/publyfe/" . "memberactivate/" . $member_id ;
                $actual_link = "https://rs7.beshijoss.com/publyfe/" . "memberactivate/" . $member_id . '/' . $package_id;
                $toEmail = $data['email'];
                $subject = "User Registration Activation Email";
                $content = "Click this link to activate your account: " . $actual_link;
                $mailHeaders = "From: Admin\r\n";
                if (mail($toEmail, $subject, $content, $mailHeaders)) {
                    $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";
                }

                $update = $this->MembersModel->updatemember($actual_link, $member_id);
                if ($update) {
                    $page = $this->session->userdata('last_page');
                    
                    $this->session->set_flashdata('success', 'Registration is Successfull');
                    if (isset($_SESSION['free']) && $_SESSION['free'] != '') {
                        $redirect = $_SESSION['redirect'];

                        if ($redirect == 'affiliate') {
                            //INSERT ACCESS FOR THIS USER
                            $optype = array('1', '2', '3', '4', '5');
                            $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                            $access = array();
                            foreach ($adminoptionINfo as $k => $v) {
                                $optionINfo = $this->MembersModel->getoptionidbytype($v);
                                $access['member_id'] = $member_id;
                                $access['ads_type'] = $v['option_id'];
                                $access['price'] = 0;
                                $access['active'] = 0;
                                $access['trial'] = 1;
                                $this->db->insert('access', $access);
                            }
                        } else if ($redirect == 'network') {
                            //INSERT ACCESS FOR THIS USER
                            $optype = array('6', '7', '8', '9', '10');
                            $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                            $access = array();
                            foreach ($adminoptionINfo as $k => $v) {
                                $optionINfo = $this->MembersModel->getoptionidbytype($v);
                                $access['member_id'] = $member_id;
                                $access['ads_type'] = $v['option_id'];
                                $access['price'] = 0;
                                $access['active'] = 0;
                                $access['trial'] = 1;
                                $this->db->insert('access', $access);
                            }
                        } else if ($redirect == 'whois') {
                            //INSERT ACCESS FOR THIS USER
                            $optype = array('8', '9', '10');
                            $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                            $access = array();
                            foreach ($adminoptionINfo as $k => $v) {
                                $optionINfo = $this->MembersModel->getoptionidbytype($v);
                                $access['member_id'] = $member_id;
                                $access['ads_type'] = $v['option_id'];
                                $access['price'] = 0;
                                $access['active'] = 0;
                                $access['trial'] = 1;
                                $this->db->insert('access', $access);
                            }
                        }
                    }else{

                        $package_id = '1';
                        $updatepackageid = $this->MembersModel->setpackageid($package_id, $member_id);
                        $optype = array('1', '2', '3', '4', '5');
                        $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                        $access = array();
                        foreach ($adminoptionINfo as $k => $v) {
                            $optionINfo = $this->MembersModel->getoptionidbytype($v);
                            $access['member_id'] = $member_id;
                            $access['ads_type'] = $v['option_id'];
                            $access['price'] = 0;
                            $access['active'] = 0;
                            $access['trial'] = 1;
                            $this->db->insert('access', $access);
                        }
                    }
                    $this->session->unset_userdata('last_page');
                    $this->session->unset_userdata('option_id');
                    // print_r($_SESSION); exit;
                    redirect('thankyoupage');
                } else {
                    $this->session->set_flashdata('error', 'Registration is not Complete. Retry again');
                    redirect('registrationform');
                }
            } else {
                $this->session->set_flashdata('error', 'Registration is not Complete. Retry again');
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
        $permi = explode(',', $permissionId);
        $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
        $string = array();
        foreach ($getpermisetting as $key => $get) {
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
        
        $active = $this->MembersModel->activatememberstatus($member_id);
        $getuserinfo = $this->MembersModel->memberinfo($member_id);
        // echo $getuserinfo->redirect;die;
        $optionsession = array(
            'choose_option_id' => $getuserinfo->choose_option_id,
            'choose_amount' => $getuserinfo->choose_amount
        );
        $this->session->set_userdata($optionsession);


        $redirect = 'https://rs7.beshijoss.com/publyfe/' . $getuserinfo->redirect;
        if ($active) {
            $session = array(
                'member_id' => $member_id,
                'member_name' => $getuserinfo->name,
                'type' => $getuserinfo->type,
                'package_id' => $getuserinfo->package_id,
                'package_option' => $getuserinfo->redirect,
            );
            $this->session->set_userdata($session);
            $page = $this->uri->segment('3');
            
            // echo '<pre>'; print_r($page); exit;
            
            if ($page == '1') {
                $optype = array('1', '2', '3', '4', '5');
                $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                $access = array();
                foreach ($adminoptionINfo as $k => $v) {
                    $optionINfo = $this->MembersModel->getoptionidbytype($v);
                    $access['member_id'] = $member_id;
                    $access['ads_type'] = $v['option_id'];
                    $access['price'] = 0;
                    $access['active'] = 0;
                    $access['trial'] = 1;
                    $this->db->insert('access', $access);
                }
                $this->session->unset_userdata('redirect');
                redirect('https://rs7.beshijoss.com/publyfe/' . $getuserinfo->redirect);
            } else if ($page == '2') {
                $optype = array('6', '7', '8', '9', '10');
                $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                $access = array();
                foreach ($adminoptionINfo as $k => $v) {
                    $optionINfo = $this->MembersModel->getoptionidbytype($v);
                    $access['member_id'] = $member_id;
                    $access['ads_type'] = $v['option_id'];
                    $access['price'] = 0;
                    $access['active'] = 0;
                    $access['trial'] = 1;
                    $this->db->insert('access', $access);
                }
                $this->session->unset_userdata('redirect');
                redirect('https://rs7.beshijoss.com/publyfe/' . $getuserinfo->redirect);
            } else if ($page == '3') {
                $optype = array('8', '9', '10');
                $adminoptionINfo = $this->MembersModel->getoptionidbyadmin($optype);

                $access = array();
                foreach ($adminoptionINfo as $k => $v) {
                    $optionINfo = $this->MembersModel->getoptionidbytype($v);
                    $access['member_id'] = $member_id;
                    $access['ads_type'] = $v['option_id'];
                    $access['price'] = 0;
                    $access['active'] = 0;
                    $access['trial'] = 1;
                    $this->db->insert('access', $access);
                }

                $this->session->unset_userdata('redirect');
                redirect('https://rs7.beshijoss.com/publyfe/' . $getuserinfo->redirect);
            } else {
                $this->session->unset_userdata('redirect');
                redirect('userhome');
            }
        }
    }

    public function geturl($redirect) {
        
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
            $member_id = $_SESSION['member_id'];
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
            $permi = explode(',', $permissionId);
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

            $data['memberinfo'] = $this->MembersModel->memberinfo($member_id);
            $data['country_info'] = $this->MainfrontModel->getallcountryinfo();
            $data['access_info'] = $this->MembersModel->get_all_access_info($member_id);
            $data['invoice_info'] = $this->MembersModel->get_all_invoice_info($member_id);

            //echo '<pre>';print_r($data['access_info']);die;

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

    public function editAccountInfo() {
        $member_id = $this->input->post('member_id');
        $data['name'] = $this->input->post('m_name');
        $data['email'] = $this->input->post('m_email');
        $data['address_1'] = $this->input->post('m_address1');
        $data['address_2'] = $this->input->post('m_address2');
        $data['city'] = $this->input->post('m_city');
        $data['state'] = $this->input->post('m_state');
        $data['country_id'] = $this->input->post('country_id');
        $data['zip'] = $this->input->post('m_zip');

//        print_r($data);die();
        $this->MembersModel->updateInfo('member_id', $member_id, 'members', $data);
        redirect('members/accounteditform');
    }

    public function updatePassword() {
        $member_id = $this->input->post('member_id');
        $data['password'] = md5($this->input->post('m_password'));
//        die;
        $this->MembersModel->updateInfo('member_id', $member_id, 'members', $data);
        redirect('members/accounteditform');
    }

    public function sendMessage() {
        $from_email = "shifat@sahajjo.com"; //$this->input->post('email'); 
        $to_email = "amithassan3229@gmail.com";
        $comment = $this->input->post('comments');
//        echo $from_email;die;
        $this->email->from($from_email, 'Your Name');
        $this->email->to($to_email);
        $this->email->subject('Email Test');
        $this->email->message($comment);

        if ($this->email->send())
            $this->session->set_flashdata("email_sent", "Email sent successfully.");
        else
            $this->session->set_flashdata("email_sent", "Error in sending Email.");

        redirect('members/accounteditform', 'refresh');
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

    public function myaccount() {
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
