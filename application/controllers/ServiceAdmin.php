<?php


class ServiceAdmin extends CI_Controller{

    public function __construct() {
        parent::__construct();
        
        $member_id =  $this->session->userdata('member_id');
        if($member_id == NULL)
        {
            redirect('login');
        }
        
        $this->load->model('admin_model');
        $this->load->model('ServiceAdminModel');
    }
    
    public function showservicebanner() {
        $data['page_title'] = 'Banner/Creative';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $service_name = 'Banner/Creative';
        $data['servicedata'] = $this->ServiceAdminModel->getserviceinfo($service_name);
        $data['admin_maincontent'] = $this->load->view('super_admin/services/service_banner',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateserviceinfo(){
        $update_date = date('Y-m-d');
        $data['service_details'] = $_POST['service_details'];
        $data['service_name'] = $_POST['service_name'];
        $data['update_date'] = $update_date;
        $data['admin_id'] = $_SESSION['member_id'];
        $update = $this->ServiceAdminModel->updateserviceinfo($data);
        if($update) {
            $this->session->set_flashdata('success', 'Service Update Successfully');
            if ($_POST['service_name'] == 'Banner/Creative') {
                redirect('serviceAdmin/showservicebanner');
            } else if ($_POST['service_name'] == 'Programing Integration') {
                redirect('serviceAdmin/showProgrammingIntegration');
            } else if ($_POST['service_name'] == 'Translation') {
                redirect('serviceAdmin/translation');
            }
        } else {
             $this->session->set_flashdata('error', 'There is an error in Service Update');
             redirect('serviceAdmin/showservicebanner');
        }
    }
    
    public function showProgrammingIntegration() {
        $data['page_title'] = 'Programming And Integration';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $service_name = 'Programing Integration';
        $data['servicedata'] = $this->ServiceAdminModel->getserviceinfo($service_name);
        $data['admin_maincontent'] = $this->load->view('super_admin/services/service_progreamintegration', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function translation() {
        $data['page_title'] = 'Translation';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $service_name = 'Translation';
        $data['servicedata'] = $this->ServiceAdminModel->getserviceinfo($service_name);
        $data['admin_maincontent'] = $this->load->view('super_admin/services/translation', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
   
}
