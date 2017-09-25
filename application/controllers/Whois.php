<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Whois extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('WhoisModel');
        $this->load->model('MembersModel');
    }

    public function whoispackeges() {
        $data['whoisS'] = $this->WhoisModel->getwhoisinfoS();
        $data['whoisG'] = $this->WhoisModel->getwhoisinfoG();
        $data['whoisP'] = $this->WhoisModel->getwhoisinfoP();
//        echo '<pre>';print_r($data);die;
        $this->load->view('front/common/header');
//        $this->load->view('front/common/menu');
        $this->load->view('front/whois/whoispackeges', $data);
        $this->load->view('front/common/footer');
    }

   public function activewhoissilver() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['amount'] = $this->uri->segment('2');
            $data['user_info'] = $this->MembersModel->memberinfo($member_id);
            $data['email'] = $data['user_info']->email;
            $data['item_name'] = "Whois Silver";
            $data['package_id'] = 3;
            $data['option_id'] = 8;
            $data['custom'] = $member_id;
            
            $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
            $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
            
            $data['notify_url'] = base_url() . 'paypal_notification';
            $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
            $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
            $data['paypalfor'] = "Whois Silver";
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/whois/whoissilver', $data);
            $this->load->view('front/common/footer');
        } else {
            $option_id = 8;
            $data['optionPrice'] = $this->MembersModel->getOptionPrice($option_id);
            $optionPrice = $data['optionPrice']->option_price;
            $this->session->set_userdata('last_page', 'whois');
            $net = 'activewhoissilver/'.$optionPrice;
            $this->session->set_userdata('redirect', $net);
            //redirect('loginform');
            redirect('registrationform');
        }
    }

    public function activewhoisgold() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['amount'] = $this->uri->segment('2');
            $data['user_info'] = $this->MembersModel->memberinfo($member_id);
            $data['email'] = $data['user_info']->email;
            $data['item_name'] = "Whois Gold";
            $data['custom'] = $member_id;
            $data['package_id'] = 3;
            $data['option_id'] = 9;
            
            $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
            $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
            
            $data['notify_url'] = base_url() . 'paypal_notification';
            $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
            $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
            $data['paypalfor'] = "Whois Gold";
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/whois/whoisgold', $data);
            $this->load->view('front/common/footer');
            
        } else {
            $option_id = 9;
            $data['optionPrice'] = $this->MembersModel->getOptionPrice($option_id);
            $optionPrice = $data['optionPrice']->option_price;
            $this->session->set_userdata('last_page', 'whois');
            $net = 'activewhoisgold/'.$optionPrice;
            $this->session->set_userdata('redirect', $net);
            //redirect('loginform');
            redirect('registrationform');
        }
    }

    public function activewhoisplatinum() {
        if ($_SESSION['member_id'] != '') {
            $member_id = $_SESSION['member_id'];
            $data['amount'] = $this->uri->segment('2');
            $data['user_info'] = $this->MembersModel->memberinfo($member_id);
            $data['email'] = $data['user_info']->email;
            $data['item_name'] = "Whois Platinum";
            $data['package_id'] = 3;
            $data['custom'] = $member_id;
            $data['option_id'] = 10;
            
            $data['stripe_settings'] = $this->MembersModel->get_all_info('stripe_settings');
            $data['paypal_settings'] = $this->MembersModel->get_all_info('paypal_settings');
            
            $data['notify_url'] = base_url() . 'paypal_notification';
            $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
            $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
            $data['paypalfor'] = "Whois Platinum";;
            $this->load->view('front/common/header');
            $this->load->view('front/common/menu');
            $this->load->view('front/whois/whoisplatinum', $data);
            $this->load->view('front/common/footer');
            
        } else {
           $option_id = 10;
            $data['optionPrice'] = $this->MembersModel->getOptionPrice($option_id);
            $optionPrice = $data['optionPrice']->option_price;
            $this->session->set_userdata('last_page', 'whois');
            $net = 'activewhoisplatinum/'.$optionPrice;
            $this->session->set_userdata('redirect', $net);
            //redirect('loginform');
            redirect('registrationform');
        }
    }
    
     public function getwhoisinfo() {
        $uri_dom = base64_decode($this->uri->segment('2'));
        $pos = strpos($uri_dom, '.');
        $dom = substr($uri_dom, $pos + 1);
        $domain = substr($uri_dom, $pos + 1, -1);
        $username = 'ad47f381c01e3501a350f3b7f123be0a3';
        $password = 'publyfe123';
        //$template = 'http://api.whoxy.com/?key=' . $username . '&whois=' . $domain;
        $template = 'http://api.whoxy.com/?key=' . $username . '&history=' . $domain;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace('DOMAIN', $domain, $template));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP/' . phpversion());
        $useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        // Getting JSON result as string
        $response = curl_exec($ch);
        // echo '<pre>';
        // print_r($response);
        // Decode the JSON response into an Array
        $result = json_decode($response);
//        echo '<pre>';
//        print_r($result);die;
        $data['api_query'] = $result->api_query;
        $data['domain_name'] = $result->whois_records[0]->domain_name;
        
//        Registrant
        if(isset($result->whois_records[0]->registrant_contact->full_name)){
            $data['registrant_contact_full_name'] = $result->whois_records[0]->registrant_contact->full_name;
        } 
        if(isset($result->whois_records[0]->registrant_contact->company_name)){
            $data['registrant_contact_company_name'] = $result->whois_records[0]->registrant_contact->company_name;
        }
        if(isset($result->whois_records[0]->registrant_contact->country_name)){
            $data['registrant_contact_country_name'] = $result->whois_records[0]->registrant_contact->country_name;
        }
        
        if(isset($result->whois_records[0]->registrant_contact->mailing_address)){
            $data['registrant_contact_mailing_address'] = $result->whois_records[0]->registrant_contact->mailing_address;
        }
        
        if(isset($result->whois_records[0]->registrant_contact->city_name)){
            $data['registrant_contact_city_name'] = $result->whois_records[0]->registrant_contact->city_name;
        }
        
        if(isset($result->whois_records[0]->registrant_contact->state_name)){
            $data['registrant_contact_state_name'] = $result->whois_records[0]->registrant_contact->state_name;
        }
        
        if(isset($result->whois_records[0]->registrant_contact->zip_code)){
            $data['registrant_contact_zip_code'] = $result->whois_records[0]->registrant_contact->zip_code;
        }
        
        if(isset($result->whois_records[0]->registrant_contact->email_address)){
            $data['registrant_contact_email_address'] = $result->whois_records[0]->registrant_contact->email_address;
        }
        
        if(isset($result->whois_records[0]->registrant_contact->phone_number)){
            $data['registrant_contact_phone_number'] = $result->whois_records[0]->registrant_contact->phone_number;
        }
        
//       Administrative
        
        if(isset($result->whois_records[0]->administrative_contact->full_name)){
            $data['administrative_contact_full_name'] = $result->whois_records[0]->administrative_contact->full_name;
        } 
        
        if(isset($result->whois_records[0]->administrative_contact->company_name)){
            $data['administrative_contact_company_name'] = $result->whois_records[0]->administrative_contact->company_name;
        }
        if(isset($result->whois_records[0]->administrative_contact->country_name)){
            $data['administrative_contact_country_name'] = $result->whois_records[0]->administrative_contact->country_name;
        }
        
        if(isset($result->whois_records[0]->administrative_contact->mailing_address)){
            $data['administrative_contact_mailing_address'] = $result->whois_records[0]->administrative_contact->mailing_address;
        }
        
        if(isset($result->whois_records[0]->administrative_contact->city_name)){
            $data['administrative_contact_city_name'] = $result->whois_records[0]->administrative_contact->city_name;
        }
        
        if(isset($result->whois_records[0]->administrative_contact->state_name)){
            $data['administrative_contact_state_name'] = $result->whois_records[0]->administrative_contact->state_name;
        }
        
        if(isset($result->whois_records[0]->administrative_contact->zip_code)){
            $data['administrative_contact_zip_code'] = $result->whois_records[0]->administrative_contact->zip_code;
        }
        
        if(isset($result->whois_records[0]->administrative_contact->email_address)){
            $data['administrative_contact_email_address'] = $result->whois_records[0]->administrative_contact->email_address;
        }
        
        if(isset($result->whois_records[0]->administrative_contact->phone_number)){
            $data['administrative_contact_phone_number'] = $result->whois_records[0]->administrative_contact->phone_number;
        }
        
//        Technical
        if(isset($result->whois_records[1]->technical_contact->full_name)){
            $data['technical_contact_full_name'] = $result->whois_records[1]->technical_contact->full_name;
        } 
        
        if(isset($result->whois_records[1]->technical_contact->company_name)){
            $data['technical_contact_company_name'] = $result->whois_records[1]->technical_contact->company_name;
        }
        if(isset($result->whois_records[1]->technical_contact->country_name)){
            $data['technical_contact_country_name'] = $result->whois_records[1]->technical_contact->country_name;
        }
        
        if(isset($result->whois_records[1]->technical_contact->mailing_address)){
            $data['technical_contact_mailing_address'] = $result->whois_records[1]->technical_contact->mailing_address;
        }
        
        if(isset($result->whois_records[1]->technical_contact->city_name)){
            $data['technical_contact_city_name'] = $result->whois_records[1]->technical_contact->city_name;
        }
        
        if(isset($result->whois_records[1]->technical_contact->state_name)){
            $data['technical_contact_state_name'] = $result->whois_records[1]->technical_contact->state_name;
        }
        
        if(isset($result->whois_records[1]->technical_contact->zip_code)){
            $data['technical_contact_zip_code'] = $result->whois_records[1]->technical_contact->zip_code;
        }
        
        if(isset($result->whois_records[1]->technical_contact->email_address)){
            $data['technical_contact_email_address'] = $result->whois_records[1]->technical_contact->email_address;
        }
        
        if(isset($result->whois_records[1]->technical_contact->phone_number)){
            $data['technical_contact_phone_number'] = $result->whois_records[1]->technical_contact->phone_number;
        }
        
        
        if(isset($result->whois_records[0]->name_servers)){
            $data['name_servers'] = $result->whois_records[0]->name_servers;
        }
        if(isset($result->whois_records[0]->domain_status)){
            $data['domain_status'] = $result->whois_records[0]->domain_status;
        }
        
        $member_id = $_SESSION['member_id'];
        
        $checkUserPackage = $this->MembersModel->memberinfo($member_id);
        $userPackageId = $checkUserPackage->package_id;
        $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
        $permissionId = $userPermissionTblInfo->option_id;
//            echo '<pre>';print_r($permissionId);
        $permi = explode(',', $permissionId);
//            $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
        $getpermisetting = $this->MembersModel->get_all_access($member_id);
//            echo '<pre>';print_r($getpermisetting); exit;
        $string = array();
        foreach ($getpermisetting as $key => $get) {
            $string[$get['option_id']] = $get['option_id'];
        }
        $data['testpage'] = $string;
        
        $data['page_title'] = 'WHois Domain Info';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/affiliate/whoisdomaininfo', $data, TRUE);
        $this->load->view('front/affiliate/whois_master', $data);
       
        return $result;
       // print_r($response);
//print_r(whoisProperties('google.com'));
    }
    
    public function whoiscontactinfomodal(){
        $uri_dom = base64_decode($this->uri->segment('2'));
        $pos = strpos($uri_dom, '.');
        $dom = substr($uri_dom, $pos + 1);
        $domain = substr($uri_dom, $pos + 1, -1);
        $username = 'ad47f381c01e3501a350f3b7f123be0a3';
        $password = 'publyfe123';
        //$template = 'http://api.whoxy.com/?key=' . $username . '&whois=' . $domain;
        $template = 'http://api.whoxy.com/?key=' . $username . '&history=' . $domain;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, str_replace('DOMAIN', $domain, $template));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'PHP/' . phpversion());
        $useragent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        $response = curl_exec($ch);
        $result = json_decode($response);
        $data = array();
         if(isset($result->whois_records[0]->registrant_contact->full_name)){
        $data['registrant_contact_full_name'] = $result->whois_records[0]->registrant_contact->full_name;
         }
          if(isset($result->whois_records[0]->registrant_contact->company_name)){
        $data['registrant_contact_company_name'] = $result->whois_records[0]->registrant_contact->company_name;
          }
           if(isset($result->whois_records[0]->registrant_contact->country_name)){
        $data['registrant_contact_country_name'] = $result->whois_records[0]->registrant_contact->country_name;
           }
            if(isset($result->whois_records[0]->administrative_contact->company_name)){
        $data['administrative_contact_company_name'] = $result->whois_records[0]->administrative_contact->company_name;
            }
             if(isset($result->whois_records[0]->administrative_contact->mailing_address)){
        $data['administrative_contact_mailing_address'] = $result->whois_records[0]->administrative_contact->mailing_address;
             }
              if(isset($result->whois_records[0]->administrative_contact->email_address)){
        $data['administrative_contact_email_address'] = $result->whois_records[0]->administrative_contact->email_address;
              }
               if(isset($result->whois_records[0]->technical_contact->company_name)){
        $data['technical_contact_company_name'] = $result->whois_records[0]->technical_contact->company_name;
               }
                if(isset($result->whois_records[0]->technical_contact->mailing_address)){
        $data['technical_contact_mailing_address'] = $result->whois_records[0]->technical_contact->mailing_address;
                }
                 if(isset($result->whois_records[0]->technical_contact->email_address)){
        $data['technical_contact_email_address'] = $result->whois_records[0]->technical_contact->email_address;
                 }
        $this->load->view('front/affiliate/whoisContactModal', $data);
    }
    
    public function viewWhois() {
        
//        echo $whois_id;die;
        if ($_SESSION['member_id'] != '') {
            $option_id = $this->uri->segment(2);
            $member_id = $_SESSION['member_id'];
            //echo $option_id;die;
            $whois_data = $this->WhoisModel->get_whois_count('who_is_info_count',$option_id,$member_id);
            $whois__settings_data = $this->WhoisModel->get_info_by_id('whois_setting','option_id',$option_id);
//            echo '<pre>';print_r($whois__settings_data);die;
            $whois_count_data['member_id'] = $member_id;
            $whois_count_data['dns_record_lookup'] = $whois__settings_data[0]['dns_record_lookup'];
            $whois_count_data['domain_iP_whois'] = $whois__settings_data[0]['domain_iP_whois'];
            $whois_count_data['ip_history'] = $whois__settings_data[0]['ip_history'];
            $whois_count_data['ip_location_finder'] = $whois__settings_data[0]['ip_location_finder'];
            $whois_count_data['reverse_dns_lookup'] = $whois__settings_data[0]['reverse_dns_lookup'];
            $whois_count_data['reverse_ip_lookup'] = $whois__settings_data[0]['reverse_ip_lookup'];
            $whois_count_data['reverse_mx_lookup'] = $whois__settings_data[0]['reverse_mx_lookup'];
            $whois_count_data['reverse_ns_lookup'] = $whois__settings_data[0]['reverse_ns_lookup'];
            $whois_count_data['reverse_whois_lookup'] = $whois__settings_data[0]['reverse_whois_lookup'];
            $whois_count_data['url_string_decode'] = $whois__settings_data[0]['url_string_decode'];
            $whois_count_data['option_id'] = $option_id;
            if($whois_data == NULL){
                $this->WhoisModel->insertInfo('who_is_info_count',$whois_count_data);
            }
//            echo $member_id;die;
            $checkUserPackage = $this->MembersModel->memberinfo($member_id);
            $userPackageId = $checkUserPackage->package_id;
            $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
            $permissionId = $userPermissionTblInfo->option_id;
//            echo '<pre>';print_r($permissionId);
            $permi= explode(',', $permissionId);
//            $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
            $getpermisetting = $this->MembersModel->get_all_access($member_id);
//            echo '<pre>';print_r($getpermisetting); exit;
            $string = array();
            foreach ($getpermisetting as $key => $get) {
                $string[$get['option_id']] = $get['option_id'];
            }
            $data['testpage'] = $string;
//            echo '<pre>';print_r($data['testpage']); exit;
            $data['newsinfo'] = $this->MembersModel->getnews();
            $data['sponsorinfo'] = $this->MembersModel->getsponsor();
            //echo '<pre>'; print_r($_SESSION); exit;
            //$this->session->unset_userdata('some_name');
            $data['option_id'] = $option_id;
            $this->session->unset_userdata('redirect');
            $data['page_title'] = 'Whois';
            $data['header'] = $this->load->view('front/common/userheader', '', true);
            $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
            $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
            $data['footer'] = $this->load->view('front/common/userfooter', '', true);
            $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
            $data['front_maincontent'] = $this->load->view('front/whois/view_whois', $data, TRUE);
            $this->load->view('front/front_master', $data);
        }else{
            redirect("loginform");
        }
    }
    
    public function whoisDns() {
        $domain_name = $this->input->post('domain_name');
        $option_id = $this->input->post('option_id');
        $member_id = $this->session->userdata('member_id');
        if($this->input->post('DNS_Record')){
            $dns_count = $this->WhoisModel->get_count('who_is_info_count','dns_record_lookup',$option_id,$member_id);
            if($dns_count->dns_record_lookup > 0){
                $update_count = $dns_count->dns_record_lookup - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'dns_record_lookup', $update_count, $option_id, $member_id);

                $result = $this->dns_info($domain_name);
                $data = array();
                $data['a_type'] = $result['a_type']->response->records;
                $data['MX_type'] = $result['mx_type']->response->records;
            }
            else{
                $data['dns_message'] = 'You exceed the permission for this section';
            }
//            print_r($result);die;
        }
        if($this->input->post('IP_Whois')){
            $ip_whois_count = $this->WhoisModel->get_count('who_is_info_count','domain_iP_whois',$option_id,$member_id);
            if ($ip_whois_count->domain_iP_whois > 0) {
                $update_count = $ip_whois_count->domain_iP_whois - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'domain_iP_whois', $update_count, $option_id, $member_id);

                $ip_whois_result = $this->IP_Whois($domain_name);
                $data['ip_whois_result'] = $ip_whois_result;
            }
            else{
                $data['IP_Whois_message'] = 'You exceed the permission for this section';
            }
//            echo '<pre>';print_r($ip_whois_result);die;
        }
        if($this->input->post('IP_History')){
            $ip_history_count = $this->WhoisModel->get_count('who_is_info_count','ip_history',$option_id,$member_id);
            if ($ip_history_count->ip_history > 0) {
                $update_count = $ip_history_count->ip_history - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'ip_history', $update_count, $option_id, $member_id);

                $ip_history_result = $this->IP_History($domain_name);
                $data['ip_history_result'] = $ip_history_result;
            }
            else{
                $data['IP_History_message'] = 'You exceed the permission for this section';
            }
//            echo '<pre>';print_r($ip_history_result);die;
        }
        if($this->input->post('IP_Location')){
            $ip_location_count = $this->WhoisModel->get_count('who_is_info_count','ip_location_finder',$option_id,$member_id);
            if ($ip_location_count->ip_location_finder > 0) {
                $update_count = $ip_location_count->ip_location_finder - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'ip_location_finder', $update_count, $option_id, $member_id);

                $ip_location_result = $this->IP_Location($domain_name);
                $data['ip_location_result'] = $ip_location_result;
//            echo '<pre>';print_r($data['ip_location_result']);die;
            }
            else{
                $data['IP_Location_message'] = 'You exceed the permission for this section';
            }
        }
        if($this->input->post('Reverse_DNS')){
            $reverse_dns_count = $this->WhoisModel->get_count('who_is_info_count','reverse_dns_lookup',$option_id,$member_id);
            if ($reverse_dns_count->reverse_dns_lookup > 0) {
                $update_count = $reverse_dns_count->reverse_dns_lookup - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'reverse_dns_lookup', $update_count, $option_id, $member_id);

                $reverse_dns_result = $this->Reverse_DNS($domain_name);
                $data['reverse_dns_result'] = $reverse_dns_result;
            }
            else{
                $data['Reverse_DNS_message'] = 'You exceed the permission for this section';
            }
//            echo '<pre>';print_r($data['reverse_dns_result']);die;
        }
        if($this->input->post('Reverse_Ip')){
            $reverse_ip_count = $this->WhoisModel->get_count('who_is_info_count','reverse_ip_lookup',$option_id,$member_id);
            if ($reverse_ip_count->reverse_ip_lookup > 0) {
                $update_count = $reverse_ip_count->reverse_ip_lookup - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'reverse_ip_lookup', $update_count, $option_id, $member_id);

                $reverse_ip_result = $this->Reverse_IP($domain_name);
                $data['reverse_ip_result'] = $reverse_ip_result;
//            echo '<pre>';print_r($data['reverse_ip_result']);die;
            }
            else{
                $data['Reverse_Ip_message'] = 'You exceed the permission for this section';
            }
        }
        if($this->input->post('Reverse_MX')){
            $reverse_mx_count = $this->WhoisModel->get_count('who_is_info_count','reverse_mx_lookup',$option_id,$member_id);
            if ($reverse_mx_count->reverse_mx_lookup > 0) {
                $update_count = $reverse_mx_count->reverse_mx_lookup - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'reverse_mx_lookup', $update_count, $option_id, $member_id);

                $reverse_mx_result = $this->Reverse_MX($domain_name);
                $data['reverse_mx_result'] = $reverse_mx_result;
//            echo '<pre>';print_r($data['reverse_mx_result']);die;
            }
            
            else{
                $data['Reverse_MX_message'] = 'You exceed the permission for this section';
            }
        }
        if($this->input->post('Reverse_NS')){
            $reverse_ns_count = $this->WhoisModel->get_count('who_is_info_count','reverse_ns_lookup',$option_id,$member_id);
            if ($reverse_ns_count->reverse_ns_lookup > 0) {
                $update_count = $reverse_ns_count->reverse_ns_lookup - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'reverse_ns_lookup', $update_count, $option_id, $member_id);

                $reverse_ns_result = $this->Reverse_NS($domain_name);
                $data['reverse_ns_result'] = $reverse_ns_result;
//            echo '<pre>';print_r($data['reverse_ns_result']);die;
            }
            
            else{
                $data['Reverse_NS_message'] = 'You exceed the permission for this section';
            }
        }
        if($this->input->post('Reverse_Whois')){
            $reverse_whois_count = $this->WhoisModel->get_count('who_is_info_count', 'reverse_whois_lookup', $option_id, $member_id);
            if ($reverse_whois_count->reverse_whois_lookup > 0) {
                $update_count = $reverse_whois_count->reverse_whois_lookup - 1;
                $this->WhoisModel->update_count('who_is_info_count', 'reverse_whois_lookup', $update_count, $option_id, $member_id);

                $reverse_whois_result = $this->Reverse_Whois($domain_name);
                $data['reverse_whois_result'] = $reverse_whois_result;
//            echo '<pre>';print_r($data['reverse_whois_result']);die;
            }
            else{
                $data['Reverse_Whois_message'] = 'You exceed the permission for this section';
            }
        }
//        if($this->input->post('URL_Decode')){
//        }
        
        
//        echo '<pre>';print_r($data['MX_type']);die;
        $checkUserPackage = $this->MembersModel->memberinfo($member_id);
        $userPackageId = $checkUserPackage->package_id;
        $userPermissionTblInfo = $this->MembersModel->userPermission($userPackageId);
        $permissionId = $userPermissionTblInfo->option_id;
//            echo '<pre>';print_r($permissionId);
        $permi = explode(',', $permissionId);
//            $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
        $getpermisetting = $this->MembersModel->get_all_access($member_id);
//            echo '<pre>';print_r($getpermisetting); exit;
        $string = array();
        foreach ($getpermisetting as $key => $get) {
            $string[$get['option_id']] = $get['option_id'];
        }
        $data['testpage'] = $string;
        $data['domain_name'] = $domain_name;
//            echo '<pre>';print_r($data['testpage']); exit;
        $data['newsinfo'] = $this->MembersModel->getnews();
        $data['sponsorinfo'] = $this->MembersModel->getsponsor();
        $data['page_title'] = 'Whois';
        $data['header'] = $this->load->view('front/common/userheader', '', true);
        $data['headerlink'] = $this->load->view('front/common/headerlink', $data, true);
        $data['sidebar'] = $this->load->view('front/common/userhomesidebar', $data, true);
        $data['footer'] = $this->load->view('front/common/userfooter', '', true);
        $data['footerlink'] = $this->load->view('front/common/footerlink', '', true);
        $data['front_maincontent'] = $this->load->view('front/whois/whois_dns_info', $data, TRUE);
        $this->load->view('front/front_master', $data);
    }
    
    private function dns_info($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/dnsrecord/?domain=' . $domain_name . '&recordtype=A&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $template = 'http://api.viewdns.info/dnsrecord/?domain=' . $domain_name . '&recordtype=MX&apikey=' . $api.'&output=json';
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $template);
        curl_setopt($ch1, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch1, CURLOPT_USERPWD, $pass);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLINFO_HEADER_OUT, true);
        // Decode the JSON response into an Array
        $res = curl_exec($ch1);
//        curl_close($ch);
        curl_close($ch1);
        
        $result['a_type'] = json_decode($response);
        $result['mx_type'] = json_decode($res);
        return $result;
    }
    
    private function IP_Whois($domain_name){
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/whois/?domain=' . $domain_name . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_whois_result = json_decode($response);
        return $ip_whois_result;
    }
    
    private function IP_History($domain_name){
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/iphistory/?domain=' . $domain_name . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_history_result = json_decode($response);
        return $ip_history_result;
    }
    
    public function IP_Location($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $ip_history = $this->IP_History($domain_name);
        $ip = ($ip_history->response->records[0]->ip);
//        echo $ip;die;
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/iplocation/?ip=' . $ip . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_location_result = json_decode($response);
        return $ip_location_result;
    }
    
    public function Reverse_DNS($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $ip_history = $this->IP_History($domain_name);
        $ip = ($ip_history->response->records[0]->ip);
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/reversedns/?ip=' . $ip . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $reverse_dns_result = json_decode($response);
        return $reverse_dns_result;
    }
    
    private function Reverse_IP($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $ip_history = $this->IP_History($domain_name);
        $ip = ($ip_history->response->records[0]->ip);
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/reverseip/?host=' . $ip . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_history_result = json_decode($response);
        return $ip_history_result;
    }
    
    private function Reverse_MX($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/reversemx/?mx=' . $domain_name . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_history_result = json_decode($response);
        return $ip_history_result;
    }
    
    public function Reverse_NS($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/reversens/?ns=' . $domain_name . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_history_result = json_decode($response);
        return $ip_history_result;
    }
    
    private function Reverse_Whois($domain_name) {
        $api = "e089443ed72b5b8108351e60653b24df797fd262";
        $pass = 'publyfe123';
        $template = 'http://api.viewdns.info/reversewhois/?q=' . $domain_name . '&apikey=' . $api.'&output=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $template);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        $ip_history_result = json_decode($response);
        return $ip_history_result;
    }

}
