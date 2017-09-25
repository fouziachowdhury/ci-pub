<?php

class LandingPageAdmin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $member_id = $this->session->userdata('member_id');
        if ($member_id == NULL) {
            redirect('login');
        }

        $this->load->model('admin_model');
        $this->load->model('LandingPageAdminModel');
        
    }

    public function addLanding() {
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['all_country'] = $this->LandingPageAdminModel->getallcountry();
        $data['all_category'] = $this->LandingPageAdminModel->getallcategories();
        //echo '<pre>'; print_r($data['all_category']); exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/landing/add_landing', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function check_url() {
        $url = $this->input->post('url');

        $get_value = $this->LandingPageAdminModel->data_by_url($url);
//        print_r($get_value);die();
        if($get_value){
            echo $get_value[0]['url'];
        }
        else{
            echo 0;
        }
    }

   public function insertlandingpage() {
//       echo '<pre>';print_r($_POST);die();
        $url = $_POST['url'];
        
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $url;
//        echo $geturl;die();
        $checkurl = $this->LandingPageAdminModel->checkurl($url);
//        if ($checkurl == 1) {
//            $this->session->set_flashdata('urlcheck', 'This URL is already in our system. Do you want to continue');
//            $data1['checkurl'] = 1;
//            $data1['page_title'] = 'Insert Landing Page';
//            $data1['header'] = $this->load->view('admin_template/header', '', true);
//            $data1['headerlink'] = $this->load->view('admin_template/headerlink', $data1, true);
//            $data1['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
//            $data1['footer'] = $this->load->view('admin_template/footer', '', true);
//            $data1['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//            $data1['all_country'] = $this->LandingPageAdminModel->getallcountry();
//            $data1['all_category'] = $this->LandingPageAdminModel->getallcategories();
//            $data1['admin_maincontent'] = $this->load->view('super_admin/landing/add_landing', $data1, TRUE);
//            $this->load->view('super_admin/admin_master', $data1);
//        } else {
            //header("Content-Type: image/png");
            //$geturl = "https://image.thum.io/get/width/1000/crop/800/" . $url;
            //$ch = curl_init();
            //curl_setopt($ch, CURLOPT_URL, $geturl);
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
            //curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            //curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            //$result = curl_exec($ch);
            //$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            //curl_close($ch);
            //var_dump($result);
            //exit;
            $data['url'] = $url;
            $data['zip_file_name'] = $geturl;
            $data['title'] = $this->input->post('title');
            $data['date'] = date('Y-m-d');
            $all_keyword = explode(',', $_POST['keyword'][0]);
            
            foreach ($all_keyword as $key) {
                $match_keyword = $this->admin_model->get_keyword_tags($key, 13);
                if ($match_keyword != NULL) {
                    
                } else {
                    $key_data['option_id'] = 13;
                    $key_data['keyword_tags'] = $key;
                    $this->admin_model->insertInfo('keyword_tags', $key_data);
                }
            }
            foreach ($all_keyword as $key) {
                $match_keyword = $this->admin_model->get_keyword_tags($key, 13);
                $data['keyword'].= $match_keyword[0]['id'] . ',';
            }
            $data['keyword'] = ','.rtrim($data['keyword'], ',').',';

//            $keywordinfo = $this->LandingPageAdminModel->getkeywordid($all_keyword);
//            print_r($keywordinfo);
            if(($_POST['country_id'])){
                $data['country_id'] = ','.implode(',', $_POST['country_id']).',';
            }
            
            if(($_POST['cat_id'])){
                $data['cat_id'] = ','.implode(',', $_POST['cat_id']).',';
            }
            
            $config['upload_path'] = 'uploads/landing_page';
            $config['allowed_types'] = '*';
            $config['max_size'] = '';
            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } 
            else {
                $data['zip_file'] = $this->upload->data('file_name');
            }
            
            $landingInsert = $this->LandingPageAdminModel->insertlandingpage($data);
            if ($landingInsert) {
                redirect('landingPageAdmin/allLandingPages');
            } else {
                redirect('landingPageAdmin/allLandingPages');
            }
//        }
    }


public function insertlandingpagewithcheckurl() {
//    print_r($_POST);die();
        $url = $_POST['url'];
        $data['cat_id'] = $_POST['cat_id'];
        $data['country_id'] = $_POST['country_id'];
        $data['keyword'] = '';
        $all_keyword = explode(',', $_POST['keyword']);
        header("Content-Type: image/png");
        $geturl = "https://image.thum.io/get/width/1000/crop/800/" . $url;
        // header("Content-Type: image/png");
        // $geturl = "https://image.thum.io/get/width/1000/crop/800/" . $url;
        // $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, $geturl);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        //curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        //$result = curl_exec($ch);
        //$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE); 
        //curl_close($ch);
        //var_dump($result);
        $data['url'] = $url;
            $data['zip_file_name'] = $geturl;
            $data['date'] = date('Y-m-d');
            $all_keyword = explode(',', $_POST['keyword']);
//            print_r($_POST['keyword']);die();
            $keywordinfo = $this->LandingPageAdminModel->getkeywordid($all_keyword);
            if(($_POST['country_id'])){
                $data['country_id'] = implode(',', $_POST['country_id']);
            }
            
            if(($_POST['cat_id'])){
                $data['cat_id'] = implode(',', $_POST['cat_id']);
            }
            
//            if(($_POST['cat_id'])){
//                $data['cat_id'] = implode(',', $_POST['cat_id']);
//            }
           
            $data['keyword'] = $keywordinfo;
//            print_r($keywordinfo);die();
        $landingInsert = $this->LandingPageAdminModel->insertlandingpage($data);
        $json = array();
        if ($landingInsert) {
            $json['success'] = 1;
        } else {
            $json['error'] = 0;
        }
        echo json_encode($json);
    }
    
    
    public function landingSettings() {
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['landing_settings'] = $this->LandingPageAdminModel->getlandingpagesettinginfo();
        $data['admin_maincontent'] = $this->load->view('super_admin/landing/landing_settings', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function updatelandingpagesetting() {
        $update_date = date('Y-m-d');
        $data['mothly_membership_price'] = $_POST['mothly_membership_price'];
        $data['view_page_count'] = $_POST['view_page_count'];
        $data['download_count'] = $_POST['download_count'];
        $data['update_date'] = $update_date;
        $data['admin_id'] = $_SESSION['member_id'];
        $data['option_id'] = 13;
//        print_r($data);die();
        $update = $this->LandingPageAdminModel->updatesettinginfo($data);
        $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['mothly_membership_price']);
        if ($update) {
            $this->session->set_flashdata('success', 'Landing Settings Update Successfully');
            redirect('landingPageAdmin/landingSettings');
        } else {
            $this->session->set_flashdata('error', 'There is an error in Landing Setting Update');
            redirect('landingPageAdmin/landingSettings');
        }
    }

    public function allLandingPages() {
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 13);
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_info'] = $this->LandingPageAdminModel->getalllandingpage();
        //print_r($data['all_landing_info']); exit; 
        $data['admin_maincontent'] = $this->load->view('super_admin/landing/all_landing', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function editLanding() {
        $landing_id = $this->uri->segment('3');
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags','option_id',13);
        $data['edit_landing_info'] = $this->LandingPageAdminModel->geteditedlandingpageinfo($landing_id);
        $data['all_country'] = $this->LandingPageAdminModel->getallcountry();
        $data['all_category'] = $this->LandingPageAdminModel->getallcategories();
//        echo '<pre>';print_r($data['edit_landing_info']);  exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/landing/edit_landing', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function updatelandingpage() {
        print_r($_POST);
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $geturl;
        $data['cat_id'] = $_POST['cat_id'];
        $data['country_id'] = $_POST['country_id'];
        $data['title'] = $_POST['title'];
        $keyword = $_POST['keyword'];
        
        if (isset($data['country_id'])) {
            $data['country_id'] = ','.implode(',', $data['country_id']).',';
        }

        if (isset($data['cat_id'])) {
            $data['cat_id'] = ','.implode(',', $data['cat_id']).',';
        }
//        $keywordinfo = $this->LandingPageAdminModel->getkeywordid($keyword);
//        print_r($keyword); exit;
        //$data['keyword'] = $keywordinfo->id;
        $data['landing_page_id'] = $this->uri->segment('3');
        
        $all_keyword = explode(',', $keyword[0]);
//        print_r($all_keyword);die();
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 13);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 13;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 13);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'], ',').',';

//        print_r($data);die;
        if (empty($_FILES['userfile']['name'])) {
            $data['zip_file'] = $this->input->post('userfile1');
        } else {
            $config['upload_path'] = 'uploads/landing_page';
            $config['allowed_types'] = '*';
            $config['max_size'] = '';

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
//            print_r ($error);die;
            } else {
                $data['zip_file'] = $this->upload->data('file_name');
            }
        }
        $update = $this->LandingPageAdminModel->updatelandingeditinfoinfo($data);
        if ($update) {
            $this->session->set_flashdata('success', 'Landing Page Update Successfully');
            redirect('landingPageAdmin/allLandingPages');
        } else {
            $this->session->set_flashdata('error', 'There is an error in Landing Page Update');
            redirect('landingPageAdmin/allLandingPages');
        }
    }
    
    public function delete_landing($id) {
        $this->admin_model->deleteInfo('landing_page','landing_id',$id);
        redirect('landingPageAdmin/allLandingPages');
    }
    
    public function editMultipleLanding() {
        
        $id = $this->input->post('landing_id');
//        print_r($id);die();
        if (isset($_POST['edit'])) {
//            echo '<pre>';print_r($_POST);die();
            if(($_POST['bulk_country'])){
                $data['country_id'] = ','.implode(',', $_POST['bulk_country']).',';
            }
            
            if(($_POST['bulk_cat'])){
                $data['cat_id'] = ','.implode(',', $_POST['bulk_cat']).',';
            }
            
            if($_POST['bulk_keyword'][0]){
                $key_data['keyword_tags'] = ($_POST['bulk_keyword'][0]);
            }
            else{
                $key_data['keyword_tags'] = '';
            }
            
            $all_keyword = explode(',', $key_data['keyword_tags']);
//            echo '<pre>';print_r($all_keyword);die();
            
            if ($all_keyword[0]) {
                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 13);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 13;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 13);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = ','.rtrim($data['keyword'],',').',';
            }
            
//            echo '<pre>';print_r($data);die();
            
            $abc = array();
            for ($i = 0; $i < count($id); $i++) {
                $this->admin_model->updateInfo('landing_id', $id[$i], 'landing_page', $data);
//                $data['all_banner'] = $this->admin_model->get_info_by_id('banner', 'banner_id', $banner_id[$i]);
//                $abc[] = $data['all_banner'];
            }
            
            redirect('landingPageAdmin/allLandingPages');
        }
        
        if (isset($_POST['delete'])) {
//            print_r($id);die();
            for ($i = 0; $i < count($id); $i++) {
                $this->admin_model->deleteInfo('landing_page','landing_id',$id[$i]);
            }
            redirect('landingPageAdmin/allLandingPages');
        }
        
        
    }
    
    public function searchbycountry() {
//        print_r($_POST);die();
        $country_id = $_POST['country_id'];
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
        
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_info'] = $this->admin_model->get_search_by_country($table,$country_id);
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
//        print_r($data['all_info']);die();
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function searchbycategory(){
        $cat_id = ','.$_POST['cat_id'].',';
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
        
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_info'] = $this->admin_model->get_search_by_category($table,$cat_id);
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }

}
