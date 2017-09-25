<?php


class WhoisAdmin extends CI_Controller{

    public function __construct() {
        parent::__construct();
        
        $member_id =  $this->session->userdata('member_id');
        if($member_id == NULL)
        {
            redirect('login');
        }
        
        $this->load->model('admin_model');
        $this->load->model('WhoisAdminModel');
    }
    
    public function freeWhois() {
        $data['page_title'] = 'Free Whois Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $option_id = 19;
        $data['whoisdata'] = $this->WhoisAdminModel->getwhoissettingsinfo($option_id);
//        echo '<pre>';print_r($data['whoisdata']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/whois/free_whois',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateFreeWhois(){
//        echo '<pre>';print_r($_POST);die();
        $data['mothly_membership_price'] = $this->input->post('mothly_membership_price');
        $data['dns_record_lookup'] = $this->input->post('dns_record_lookup');
        $data['domain_iP_whois'] = $this->input->post('domain_iP_whois');
        $data['ip_history'] = $this->input->post('ip_history');
        $data['ip_location_finder'] = $this->input->post('ip_location_finder');
        $data['reverse_dns_lookup'] = $this->input->post('reverse_dns_lookup');
        $data['reverse_ip_lookup'] = $this->input->post('reverse_ip_lookup');
        $data['reverse_mx_lookup'] = $this->input->post('reverse_mx_lookup');
        $data['reverse_ns_lookup'] = $this->input->post('reverse_ns_lookup');
        $data['reverse_whois_lookup'] = $this->input->post('reverse_whois_lookup');
        $data['url_string_decode'] = $this->input->post('url_string_decode');
        
        $data['update_date'] = date('Y-m-d');
        $data['option_id'] = 19;
//        $data['admin_id'] = $_SESSION['member_id'];
        $update = $this->WhoisAdminModel->updatewhoisinfo($data,$data['option_id']);
//        echo $update;die();
        if($update) {
             $this->session->set_flashdata('success', 'Settings Update Successfully');
             redirect('WhoisAdmin/freeWhois');
        } else {
             $this->session->set_flashdata('error', 'There is an error in Settings Update');
             redirect('WhoisAdmin/freeWhois');
        }
    }
    
    
    public function silverWhois() {
        $data['page_title'] = 'Silver Whois Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $option_id = 8;
        $data['whoisdata'] = $this->WhoisAdminModel->getwhoissettingsinfo($option_id);
//        echo '<pre>';print_r($data['whoisdata']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/whois/silver_whois',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateSilverWhois(){
//        echo '<pre>';print_r($_POST);die();
        $data['mothly_membership_price'] = $this->input->post('mothly_membership_price');
        $data['dns_record_lookup'] = $this->input->post('dns_record_lookup');
        $data['domain_iP_whois'] = $this->input->post('domain_iP_whois');
        $data['ip_history'] = $this->input->post('ip_history');
        $data['ip_location_finder'] = $this->input->post('ip_location_finder');
        $data['reverse_dns_lookup'] = $this->input->post('reverse_dns_lookup');
        $data['reverse_ip_lookup'] = $this->input->post('reverse_ip_lookup');
        $data['reverse_mx_lookup'] = $this->input->post('reverse_mx_lookup');
        $data['reverse_ns_lookup'] = $this->input->post('reverse_ns_lookup');
        $data['reverse_whois_lookup'] = $this->input->post('reverse_whois_lookup');
        $data['url_string_decode'] = $this->input->post('url_string_decode');
        
        $data['update_date'] = date('Y-m-d');
        $data['option_id'] = 8;
//        $data['admin_id'] = $_SESSION['member_id'];
        $update = $this->WhoisAdminModel->updatewhoisinfo($data,$data['option_id']);
        $this->WhoisAdminModel->updateOptionInfo('option_id', $data['option_id'], 'membership_package_options', $data['mothly_membership_price']);
//        echo $update;die();
        if($update) {
             $this->session->set_flashdata('success', 'Settings Update Successfully');
             redirect('WhoisAdmin/silverWhois');
        } else {
             $this->session->set_flashdata('error', 'There is an error in Settings Update');
             redirect('WhoisAdmin/silverWhois');
        }
    }
    
    
    public function goldWhois() {
        $data['page_title'] = 'Gold Whois Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $option_id = 9;
        $data['whoisdata'] = $this->WhoisAdminModel->getwhoissettingsinfo($option_id);
//        echo '<pre>';print_r($data['whoisdata']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/whois/gold_whois',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateGoldWhois(){
//        echo '<pre>';print_r($_POST);die();
        $data['mothly_membership_price'] = $this->input->post('mothly_membership_price');
        $data['dns_record_lookup'] = $this->input->post('dns_record_lookup');
        $data['domain_iP_whois'] = $this->input->post('domain_iP_whois');
        $data['ip_history'] = $this->input->post('ip_history');
        $data['ip_location_finder'] = $this->input->post('ip_location_finder');
        $data['reverse_dns_lookup'] = $this->input->post('reverse_dns_lookup');
        $data['reverse_ip_lookup'] = $this->input->post('reverse_ip_lookup');
        $data['reverse_mx_lookup'] = $this->input->post('reverse_mx_lookup');
        $data['reverse_ns_lookup'] = $this->input->post('reverse_ns_lookup');
        $data['reverse_whois_lookup'] = $this->input->post('reverse_whois_lookup');
        $data['url_string_decode'] = $this->input->post('url_string_decode');
        
        $data['update_date'] = date('Y-m-d');
        $data['option_id'] = 9;
//        $data['admin_id'] = $_SESSION['member_id'];
        $update = $this->WhoisAdminModel->updatewhoisinfo($data,$data['option_id']);
        $this->WhoisAdminModel->updateOptionInfo('option_id', $data['option_id'], 'membership_package_options', $data['mothly_membership_price']);
//        echo $update;die();
        if($update) {
             $this->session->set_flashdata('success', 'Settings Update Successfully');
             redirect('WhoisAdmin/goldWhois');
        } else {
             $this->session->set_flashdata('error', 'There is an error in Settings Update');
             redirect('WhoisAdmin/goldWhois');
        }
    }
    
    
    public function platinumWhois() {
        $data['page_title'] = 'Platinum Whois Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $option_id = 10;
        $data['whoisdata'] = $this->WhoisAdminModel->getwhoissettingsinfo($option_id);
//        echo '<pre>';print_r($data['whoisdata']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/whois/platinum_whois',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updatePlatinumWhois(){
//        echo '<pre>';print_r($_POST);die();
        $data['mothly_membership_price'] = $this->input->post('mothly_membership_price');
        $data['dns_record_lookup'] = $this->input->post('dns_record_lookup');
        $data['domain_iP_whois'] = $this->input->post('domain_iP_whois');
        $data['ip_history'] = $this->input->post('ip_history');
        $data['ip_location_finder'] = $this->input->post('ip_location_finder');
        $data['reverse_dns_lookup'] = $this->input->post('reverse_dns_lookup');
        $data['reverse_ip_lookup'] = $this->input->post('reverse_ip_lookup');
        $data['reverse_mx_lookup'] = $this->input->post('reverse_mx_lookup');
        $data['reverse_ns_lookup'] = $this->input->post('reverse_ns_lookup');
        $data['reverse_whois_lookup'] = $this->input->post('reverse_whois_lookup');
        $data['url_string_decode'] = $this->input->post('url_string_decode');
        
        $data['update_date'] = date('Y-m-d');
        $data['option_id'] = 10;
//        $data['admin_id'] = $_SESSION['member_id'];
        $update = $this->WhoisAdminModel->updatewhoisinfo($data,$data['option_id']);
        $this->WhoisAdminModel->updateOptionInfo('option_id', $data['option_id'], 'membership_package_options', $data['mothly_membership_price']);
//        echo $update;die();
        if($update) {
             $this->session->set_flashdata('success', 'Settings Update Successfully');
             redirect('WhoisAdmin/platinumWhois');
        } else {
             $this->session->set_flashdata('error', 'There is an error in Settings Update');
             redirect('WhoisAdmin/platinumWhois');
        }
    }
   
}
