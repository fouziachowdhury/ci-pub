<?php


class ResourceAdmin extends CI_Controller{

    public function __construct() {
        parent::__construct();
        
        $member_id =  $this->session->userdata('member_id');
        if($member_id == NULL)
        {
            redirect('login');
        }
        
        $this->load->model('admin_model');
        $this->load->model('ResourseAdminModel');
    }
    
    public function showaffiliateresource() {
        $data['page_title'] = 'Affiliate Networks';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['resource_data'] = $this->admin_model->get_all_info('resources_tbl');
//        print_r($data['resourcedata']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/resource_affiliate',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function get_url(){
        $url = $this->input->post('url');
        // echo $url;
        $tags = get_meta_tags($url);
        echo $tags['description']; 
        //print_r($tags);die();
        //echo $tags['keywords'];
    }
    
    public function get_title(){
        $url = $this->input->post('url');
        $urlContents = file_get_contents($url);
        preg_match("/<title>(.*)<\/title>/i", $urlContents, $matches);
        
        print($matches[1] . "\n");
    }
    
    public function save_affiliate_network() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/width/1000/crop/600/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('resources_tbl',$data);
        redirect('resourceAdmin/showaffiliateresource');
//        print_r($data);die();
    }
    
    public function update_affiliate_network() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/width/1000/crop/600/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('resource_id', $id, 'resources_tbl', $data);
        redirect('resourceAdmin/showaffiliateresource');
        
    }
    
    public function deleteAffiliateNetwork($id) {
        $this->admin_model->deleteInfo('resources_tbl','resource_id',$id);
        redirect('resourceAdmin/showaffiliateresource');
    }
    
   
}
