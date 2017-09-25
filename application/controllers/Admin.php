<?php


class Admin extends CI_Controller{

    public function __construct() {
        parent::__construct();
        
        $member_id =  $this->session->userdata('member_id');
        $type =  $this->session->userdata('type');
        if($type != 1)
        {
            redirect('login');
        }
        
        $this->load->model('admin_model');
        $this->load->library('pagination');
    }
    
    public function index() {
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['total_user'] = $this->admin_model->count_all_user('members');
        $data['total_banner'] = $this->admin_model->count_all_banner('banner');
        $data['total_facebook'] = $this->admin_model->count_all_facebook('facebook_ads');
//        echo '<pre>';print_r($data['total_banner']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/admin_dashboard',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function logout() {
        $this->session->unset_userdata('member_id');
        $this->session->unset_userdata('password');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('package_id ');
        $this->session->unset_userdata('type');
        $m_data = array();
        $m_data['message']='You Are Logged Out Successfully';
        $this->session->set_userdata($m_data);
        redirect('login');
    }
    
//    Category Section Starts
    
    public function allCategory() {
        $data['page_title'] = 'Category';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['all_category'] = $this->admin_model->get_all_info('category');
//        echo '<pre>';print_r($data['all_category']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/category/all_category',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveCategory() {
        $data['cat_name'] = $this->input->post('cat_name');
        $data['status'] = 1;
        
        $this->admin_model->insertInfo('category',$data);
        redirect('admin/allCategory');
    }
    
    public function updateCategory() {
        $cat_id = $this->input->post('cat_id');
        $data['cat_name'] = $this->input->post('cat_name');
        $data['status'] = 1;
        
        $this->admin_model->updateInfo('cat_id', $cat_id, 'category', $data);
        redirect('admin/allCategory');
    }
    
    public function changeCategoryStatus() {
        $id = $this->input->post('cat_id');
//        echo $id;die();
        $category = $this->admin_model->get_info_by_id('category','cat_id',$id);
//        echo '<pre>';print_r($user);die();
        if($category[0]['status'] == 1) {
            $this->admin_model->set_block_status('category','status','cat_id', $id);
            echo 0;
        }else {
            $this->admin_model->set_active_status('category','status','cat_id', $id);
            echo 1;
        }

//        redirect('admin/allCategory', 'refresh');
    }
    
    public function deleteCategory($id) {
        $this->admin_model->deleteInfo('category','cat_id',$id);
        redirect('admin/allCategory');
    }
    
//    Category Section Ends
    
//    Headline Tagging
    
    public function allHeadline() {
        $data['page_title'] = 'Headline';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
//        echo '<pre>';print_r($data['all_headline']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/headline/all_headline',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveHeadline() {
//        echo '<pre>';print_r($_POST);die();
        $headline = $this->input->post('headline');
        for($i = 0; $i < count($headline); $i++){
            $data['headline'] = $headline[$i];
            $data['cat_id'] = $this->input->post('category');
            $data['country_id'] = implode(',', $_POST['country']);
            $data['status'] = 1;
//            echo '<pre>';print_r($data);
            $this->admin_model->insertInfo('headline',$data);
        }
//        echo '<pre>';print_r($data);die();
//        $data['type'] = $this->input->post('type');
//        if($this->input->post('category')){
            
//        }
//        if($this->input->post('country')){
            //$this->input->post('country');
//        }
        
        redirect('admin/allHeadline');
    }
    
    public function changeHeadlineStatus() {
        $id = $this->input->post('headline_id');
        $headline = $this->admin_model->get_info_by_id('headline','headline_id',$id);
//        echo '<pre>';print_r($user);die();
        if($headline[0]['status'] == 1) {
            $this->admin_model->set_block_status('headline','status','headline_id', $id);
            echo 0;
        }else {
            $this->admin_model->set_active_status('headline','status','headline_id', $id);
            echo 1;
        }

//        redirect('admin/allHeadline', 'refresh');
    }
    
    public function updateHeadline() {
        $headline_id = $this->input->post('headline_id');
        $data['type'] = $this->input->post('type');
//        if($data['type'] == 1){
//            $data['cat_id'] = $this->input->post('cat_id');
//            $data['country_id'] = '';
//        }
//        if($data['type'] == 2){
//            $data['country_id'] = $this->input->post('country_id');
//            $data['cat_id'] = '';
//        }
        $data['cat_id'] = $this->input->post('cat_id');
        $data['country_id'] = implode(',', $_POST['country']);
        $data['headline'] = $this->input->post('headline');
        $data['status'] = 1;
//        print_r($data);die();
        $this->admin_model->updateInfo('headline_id', $headline_id, 'headline', $data);
        redirect('admin/allHeadline');
    }
    
    public function deleteMultipleHeadline() {
        $headline_id = $this->input->post('headline_id');
//        print_r($headline_id);die;
        for ($i = 0; $i < count($headline_id); $i++) {
            $this->admin_model->deleteInfo('headline', 'headline_id', $headline_id[$i]);
        }
        redirect('admin/allHeadline');
    }
    
    public function deleteHeadline($id) {
        $this->admin_model->deleteInfo('headline','headline_id',$id);
        redirect('admin/allHeadline');
    }
    
//    Headline Tagging Ends
    
//    User Management Starts
    
    public function addUser() {
        $data['page_title'] = 'Add User';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['affiliate_package'] = $this->admin_model->get_affiliate_package();
        $data['network_package'] = $this->admin_model->get_network_package();
        $data['whois_package'] = $this->admin_model->get_whois_package();
        $data['all_user'] = $this->admin_model->get_all_user('members');
        $data['all_country'] = $this->admin_model->get_all_country();
        
//        echo '<pre>';print_r($data['network_package']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/user/add_user',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_user() {
//        echo '<pre>';print_r($_POST);die;
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['address_1'] = $this->input->post('address1');
        $data['address_2'] = $this->input->post('address2');
        $data['city'] = $this->input->post('city');
        $data['state'] = $this->input->post('state');
        $data['country_id'] = $this->input->post('country_id');
        $data['zip'] = $this->input->post('zip');
        $data['type'] = 2;
        $data['status'] = 1;
        $affiliate_package = $this->input->post('affiliate_package');
        $network_package = $this->input->post('network_package');
        $whois_package = $this->input->post('whois_package');
        
        $data['package_id'] = implode(',', $this->input->post('package'));
//        echo '<pre>';print_r($data);die;
        $member_id = $this->admin_model->insertId('members',$data);
        
//        Affiliate Portion
        
        if($affiliate_package == 1){
           $affiliate = $this->admin_model->get_affiliate_package();
           foreach ($affiliate as $aff){
               $data_affiliate['member_id'] = $member_id;
               $data_affiliate['ads_type'] = $aff['option_id'];
               $data_affiliate['package_id'] = 1;
               $data_affiliate['price'] = 0;
               $data_affiliate['active'] = 0;
               $data_affiliate['trial'] = 1;
//               echo '<pre>';print_r($data_affiliate);
               $this->admin_model->insertInfo('access',$data_affiliate);
           }
//           echo '<pre>';print_r($data_affiliate);
        }
        if($affiliate_package == 2){
            $super_affiliate = $this->admin_model->get_info_by_id('membership_package_options','option_id',11);
            $data_affiliate['member_id'] = $member_id;
            $data_affiliate['ads_type'] = $super_affiliate[0]['option_id'];
            $data_affiliate['package_id'] = 1;
            $data_affiliate['price'] = $super_affiliate[0]['option_price'];
            $data_affiliate['active'] = 1;
            $data_affiliate['trial'] = 0;
//            echo '<pre>';print_r($data_affiliate);
            $this->admin_model->insertInfo('access',$data_affiliate);
        }
        if($affiliate_package == 3){
            $affiliate_option = $this->input->post('option_id');
            $affiliate_price = $this->input->post('option_price');
            for($i = 0; $i < count($affiliate_option); $i++){
                $data_affiliate['member_id'] = $member_id;
                $data_affiliate['ads_type'] = $affiliate_option[$i];
                $data_affiliate['package_id'] = 1;
                $data_affiliate['price'] = $affiliate_price[$i];
                $data_affiliate['active'] = 1;
                $data_affiliate['trial'] = 0;
//                echo '<pre>';print_r($data_affiliate);
                $this->admin_model->insertInfo('access',$data_affiliate);
            }
            
        }
        
//      End Affiliate Portion

//        Network Portion
        if($network_package == 1){
           $network = $this->admin_model->get_network_package();
//           echo '<pre>';print_r($affiliate);
           foreach ($network as $net){
               $data_network['member_id'] = $member_id;
               $data_network['ads_type'] = $net['option_id'];
               $data_network['package_id'] = 2;
               $data_network['price'] = 0;
               $data_network['active'] = 0;
               $data_network['trial'] = 1;
//               echo '<pre>';print_r($data_affiliate);
               $this->admin_model->insertInfo('access',$data_network);
           }
        }
        if($network_package == 2){
            $super_network = $this->admin_model->get_info_by_id('membership_package_options','option_id',12);
            $data_network['member_id'] = $member_id;
            $data_network['ads_type'] = $super_network[0]['option_id'];
            $data_network['package_id'] = 2;
            $data_network['price'] = $super_network[0]['option_price'];
            $data_network['active'] = 1;
            $data_network['trial'] = 0;
//            echo '<pre>';print_r($data_affiliate);
            $this->admin_model->insertInfo('access',$data_network);
        }
        if($network_package == 3){
            $network_option = $this->input->post('network_option');
            $network_price = $this->input->post('network_price');
//            print_r($network_option);die;
            for($i = 0; $i < count($network_option); $i++){
                $data_network['member_id'] = $member_id;
                $data_network['ads_type'] = $network_option[$i];
                $data_network['package_id'] = 2;
                $data_network['price'] = $network_price[$i];
                $data_network['active'] = 1;
                $data_network['trial'] = 0;
//                echo '<pre>';print_r($data_network);
                $this->admin_model->insertInfo('access',$data_network);
            }
//            echo '<pre>';print_r($data_network);
        }
        
//      End Network Portion
        
        if($whois_package == 3){
            if($this->input->post('whois_free') != ''){
                $data_whois['member_id'] = $member_id;
                $data_whois['ads_type'] = 19;
                $data_whois['package_id'] = 3;
                $data_whois['price'] = 0;
                $data_whois['active'] = 0;
                $data_whois['trial'] = 1;
            }
            else{
                $data_whois['member_id'] = $member_id;
                $data_whois['ads_type'] = $this->input->post('whois_option');
                $option_price = $this->admin_model->get_option_price($data_whois['ads_type']);
                $data_whois['package_id'] = 3;
                $data_whois['price'] = $option_price[0]['option_price'];
                $data_whois['active'] = 1;
                $data_whois['trial'] = 0;
            }
//            echo '<pre>';print_r($data_whois);die;
            $this->admin_model->insertInfo('access',$data_whois);
        }
        
        if($this->input->post('all_free') == 4){
            $data_all_free = $this->admin_model->get_all_info('trial_package');
            foreach ($data_all_free as $all_free){
                $data_free['member_id'] = $member_id;
                $data_free['ads_type'] = $all_free['option_id'];
                $data_free['price'] = 0;
                $data_free['active'] = 0;
                $data_free['trial'] = 1;
                
                $this->admin_model->insertInfo('access',$data_free);
//            echo '<pre>';print_r($data_free);
            }
//            echo '<pre>';print_r($data_free);die;
        }
        
        redirect('admin/allUser');
        
    }
    
    public function allUser() {
        $data['page_title'] = 'All User';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['all_user'] = $this->admin_model->get_all_user('members');
//        echo $this->db->last_query();
        //echo '<pre>';print_r($data['all_user']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/user/all_user',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function userStatus($id) {
        $user = $this->admin_model->get_info_by_id('members','member_id',$id);
//        echo '<pre>';print_r($user);die();
        if($user[0]['status'] == 1) {
            $this->admin_model->set_block_status('members','status','member_id', $id);
        }else {
            $this->admin_model->set_active_user('members','status','member_id', $id);
        }

        redirect('admin/allUser', 'refresh');
    }
    
    public function deleteUser($id) {
        $this->admin_model->deleteInfo('members','member_id',$id);
        redirect('admin/allUser');
    }
    
    public function viewUser($member_id) {
        $data['page_title'] = 'View User';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['access_info'] = $this->admin_model->get_info_by_id('access','member_id',$member_id);
        $data['user_info'] = $this->admin_model->get_user_info_by_id($member_id);
        $data['invoice_info'] = $this->admin_model->get_invoice_by_id($member_id);
        
        
        if(!empty($data['access_info'])){
            foreach ($data['access_info'] as $key=>$get) {
                $string[] = $get['ads_type'];
    //            $access_info[] = $this->admin_model->get_ads_info('access','ads_type',$get['ads_type'],$member_id);
                
                 //echo '<pre>';print_r($data['access_info']);die;
            }

            foreach ($string as $str){
                $access_info[$str] = $this->admin_model->get_ads_info('access','ads_type',$str,$member_id);
            }
        
            $data['access_info'] = $access_info;
            $data['testpage'] = $string;
        }
        // echo '<pre>';print_r($data['invoice_info']);die;
        $data['admin_maincontent'] = $this->load->view('super_admin/user/view_user',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateAccessInfo() {
        // echo "<pre>";print_r($_POST);die();
        $type = $this->input->post('ads_type');
        $active = $this->input->post('active');
        $trial = $this->input->post('trial');
        $price = $this->input->post('price');
//        print_r($price);die;
        $member_id = $this->input->post('member_id');
        $this->admin_model->deleteInfo('access','member_id',$member_id);
        if(is_array($trial)){
            foreach ($trial as $key => $value){
                $data['member_id'] = $member_id;
                $data['trial'] = $value;
                $data['active'] = 0;
                $data['ads_type'] = $_POST['ads_type'][$key];
                $data['package_id'] = $_POST['package_id'][$key];
                $data['price'] = $_POST['price'][$key];
    //                echo '<pre>';print_r($data);
                $this->admin_model->insertInfo('access', $data);
            }
        }
//        echo '<pre>';print_r($data);die;
        if(is_array($active)){
            foreach ($active as $act => $act_value){
                $data['member_id'] = $member_id;
                $data['active'] = $act_value;
                $data['trial'] = 0;
                $data['ads_type'] = $_POST['ads_type'][$act];
                $data['package_id'] = $_POST['package_id'][$act];
                $data['price'] = $_POST['price'][$act];
    //                echo '<pre>';print_r($data);
                $this->admin_model->insertInfo('access', $data);
            }
        }
           // echo '<pre>';print_r($data);die;
            
        redirect('admin/viewUser/'.$member_id);
    }
    
    public function updateUserInfo() {
        $member_id = $this->input->post('member_id');
//        echo $member_id;die();
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['address_1'] = $this->input->post('address_1');
        if($_POST['password']){
            $data['password'] = md5($this->input->post('password'));
        }
//        print_r($data);die();
        $this->admin_model->updateInfo('member_id', $member_id, 'members', $data);
        
        redirect('admin/viewUser/'.$member_id);
//        print_r($data);die();
    }
    
    public function viewInvoice($id) {
        $data['page_title'] = 'View Invoice';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['invoice_details'] = $this->admin_model->get_invoice_details($id);
        // echo '<pre>';print_r($data['invoice_details']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/user/view_invoice',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function allInvoice($member_id) {
        $data['page_title'] = 'All Invoice';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['user_info'] = $this->admin_model->get_user_info_by_id($member_id);
        $data['invoice_info'] = $this->admin_model->get_invoice_by_id($member_id);
        // echo '<pre>';print_r($data['invoice_info']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/user/all_invoice',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
//    User Management Ends
    
    
//    Start Banner Option
    
    public function banner() {
        $data['page_title'] = 'Add Banner Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
//        echo '<pre>';print_r($data['all_category']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/banner/add_banner',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function uploadBannerAds() {
        // print_r($_FILES);
        // exit;
//        $this->load->library('upload');
        $files = $_FILES;
//        print_r($files['file']['name']);die();
//         $_FILES['userfile']['name'] = uniqid() . '_' . $files['file']['name'];
//         $_FILES['userfile']['type'] = $files['file']['type'];
//         $_FILES['userfile']['tmp_name'] = $files['file']['tmp_name'];
//         $_FILES['userfile']['error'] = $files['file']['error'];
//         $_FILES['userfile']['size'] = $files['file']['size'];

//         $this->upload->initialize($this->upload_options());
//         $this->upload->do_upload();
//         $img = $_FILES['userfile']['name'];
//         $output = array();
//         $output['image'] = $img;
// //        print_r ($output);
//         echo $img;
        
        if (isset($_FILES['uploadfile']) && !empty($_FILES['uploadfile']['name'])) {
            $_FILES['uploadfile']['name'] = uniqid() . '_' . $_FILES['uploadfile']['name'];
            $config['upload_path'] = 'uploads/banner_images';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '0';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
//                echo json_encode($msg);
            } else {
                $fileinfo = $this->upload->data();
                echo $fileinfo['file_name'];
            }
        }
    }
    
    
    public function saveBannerAds() {
        // echo '<pre>';print_r($_POST);die();
//      
        $image = $this->input->post('image');
        $keyword = $this->input->post('keyword');
        $uploads_dir = 'uploads/banner_images';
//        $this->upload->initialize($config);
        foreach ($image as $key => $value){
            $data['keyword'] = '';
            $data['image'] = $value;
            
            if(($_POST['bulk_country'])){
                $data['country_id'] = ','.implode(',', $_POST['bulk_country']).',';
            }
            else{
                $data['country_id'] = ','.implode(',', $_POST['country'][$key]).',';
            }
            if(($_POST['bulk_cat'])){
                $data['cat_id'] = ','.implode(',', $_POST['bulk_cat']).',';
            }
            else{
                $data['cat_id'] = ','.implode(',', $_POST['category'][$key]).',';
            }
//            $data['keyword'] = implode(',', $_POST['keyword']);
            
            $data['width'] = $_POST['width'][$key];
            $data['height'] = $_POST['height'][$key];
            
//            Save data In Keyword Tags Table
            if($_POST['bulk_keyword'][0]){
                $key_data['keyword_tags'] = implode(',', $_POST['bulk_keyword']);
            }
            else{
//                $data['keyword'] = 'hello';
                $key_data['keyword_tags'] = implode(',', $_POST['keyword'][$key]);
            }
            
            $all_keyword = explode(',', $key_data['keyword_tags']);

            foreach ($all_keyword as $key){
                $match_keyword = $this->admin_model->get_keyword_tags($key,1);
                if($match_keyword != NULL){
//                    echo '<pre>';print_r($match_keyword);
                }
                else{
                    $key_data['option_id'] = 1;
                    $key_data['keyword_tags'] = $key;
                    $keyword = $this->admin_model->insertId('keyword_tags',$key_data);
//                    echo $keyword;
                }
            }
            foreach ($all_keyword as $key){
                $match_keyword = $this->admin_model->get_keyword_tags($key,1);
//                echo '<pre>';print_r($match_keyword);
//                echo $match_keyword[0]['id'];
                $data['keyword'].= $match_keyword[0]['id'].',';
                
            }
                $data['keyword'] = ','.rtrim($data['keyword'],',').',';
//                echo '<pre>';print_r($data);  
            $this->admin_model->insertInfo('banner',$data);
        }
        // echo '';print_r($data);die();  
        
        redirect('admin/allBanner');
    }
    
    
    public function bannerSettings() {
        $data['page_title'] = 'Banner Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['banner_settings'] = $this->admin_model->get_info_by_id('settings','option_id',1);
//        echo '<pre>';print_r($data['banner_settings']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/banner/banner_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveBannersettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 1;
        
        $data1['get_banner_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_banner_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/bannerSettings');
//        print_r($data['get_banner_settings']);die();
    }
    
    public function allBanner() {
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_info'] = $this->admin_model->get_all_info('banner');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags','option_id',1);
        $data['allsize'] = $this->admin_model->getAllSize('banner');
//        echo '<pre>';print_r($data['allsize']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/banner/all_banner',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function changeBannerStatus() {
        $id = $this->input->post('banner_id');
//        echo $id;die();
        $banner = $this->admin_model->get_info_by_id('banner','banner_id',$id);
//        echo '<pre>';print_r($banner);die();
        if($banner[0]['status'] == 1) {
            $this->admin_model->set_block_status('banner','status','banner_id', $id);
            echo 0;
        }else {
            $this->admin_model->set_active_status('banner','status','banner_id', $id);
            echo 1;
        }

//        redirect('admin/allBanner', 'refresh');
    }
    
    public function editBanner($banner_id) {
        $data['page_title'] = 'Edit Banner Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_banner'] = $this->admin_model->get_info_by_id('banner', 'banner_id', $banner_id);
        $abc[] = $data['all_banner'];
        $data['banner'] = $abc;
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 1);
        $data['all_country'] = $this->admin_model->get_all_country();
//        echo '<pre>';print_r($data['banner']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/banner/edit_multiple_banner', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function editMultipleBanner() {
//        echo '<pre>';print_r($_POST);die();
        
        $banner_id = $this->input->post('banner_id');
//        print_r($banner_id);die();
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 1);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 1;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 1);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = ','.rtrim($data['keyword'],',').',';
            }
            
//            echo '<pre>';print_r($data);die();
            
            $abc = array();
            for ($i = 0; $i < count($banner_id); $i++) {
                $this->admin_model->updateInfo('banner_id', $banner_id[$i], 'banner', $data);
//                $data['all_banner'] = $this->admin_model->get_info_by_id('banner', 'banner_id', $banner_id[$i]);
//                $abc[] = $data['all_banner'];
            }
//            $data['banner'] = $abc;
//            echo '<pre>'; print_r($abc);die();
//            $data['page_title'] = 'Edit Banner Ads';
//            $data['header'] = $this->load->view('admin_template/header', '', true);
//            $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
//            $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
//            $data['footer'] = $this->load->view('admin_template/footer', '', true);
//            $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//
//            $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
//            $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 1);
//            $data['all_country'] = $this->admin_model->get_all_country();
////        echo '<pre>';print_r($data['all_keyword']);die();
//            $data['admin_maincontent'] = $this->load->view('super_admin/banner/edit_multiple_banner', $data, TRUE);
//            $this->load->view('super_admin/admin_master', $data);
            
            redirect('admin/allBanner');
        }
        if (isset($_POST['delete'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($banner_id); $i++) {
                $this->admin_model->deleteInfo('banner','banner_id',$banner_id[$i]);
            }
            redirect('admin/allBanner');
        }
        
        if (isset($_POST['status'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($banner_id); $i++) {
                $banner = $this->admin_model->get_info_by_id('banner','banner_id',$banner_id[$i]);
                if ($banner[0]['status'] == 1) {
                    $this->admin_model->set_block_status('banner', 'status', 'banner_id', $banner_id[$i]);
                    echo 0;
                } else {
                    $this->admin_model->set_active_status('banner', 'status', 'banner_id', $banner_id[$i]);
                    echo 1;
                }
//                print_r($banner);die();
            }
            redirect('admin/allBanner');
        }
    }
    
    public function updateBanner() {
        $banner_id = $this->input->post('banner_id');
        parse_str($_POST['str'], $searcharray);
        $key_data['keyword_tags'] = ($searcharray['keyword']);
        $data['cat_id'] = ','.implode(',', $searcharray['category']).',';
        $data['country_id'] = ','.implode(',', $searcharray['country']).',';
        
        $all_keyword = explode(',', $key_data['keyword_tags']);
        
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,1);
            if($match_keyword != NULL){
            }
            else{
                $key_data['option_id'] = 1;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags',$key_data);
            }
        }
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,1);
            $data['keyword'].= $match_keyword[0]['id'].',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'],',').',';
//        print_r($data);die();
        $this->admin_model->updateInfo('banner_id', $banner_id, 'banner', $data);
//        $data['all_banner'] = $this->admin_model->get_info_by_id('banner','banner_id',$banner_id);
//        
    }
    
//    End Banner Option
    
//    Native Ads Starts
    
    public function native() {
        $data['page_title'] = 'Add Native Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
//        echo '<pre>';print_r($data['all_country']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/native/add_native',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function select_headline() {
        $cat_id = $this->input->post('cat_id');
        $country_id = implode(',', $_POST['country_id']);//$this->input->post('country_id');
//        print_r($cat_id);
//        print_r($country_id);die();
        $heading = array();
        if($cat_id){
            for ($i = 0; $i < count($cat_id); $i++) {
//                    $data['all_headline'] = $this->admin_model->get_headline_country_id($country_id[$i], 2);
                $data['all_headline'] = $this->admin_model->get_headline_by_id($cat_id[$i],$country_id);
                $heading[] = $data['all_headline'];
                    
//                $data['all_headline'] = $this->admin_model->get_headline_cat_id($cat_id[$i], 1);
//                $heading[] = $data['all_headline'];
            }
        }
        
//        if($country_id){
//            for($i = 0; $i < count($country_id); $i++){
//                $data['all_headline'] = $this->admin_model->get_headline_country_id($country_id[$i],2);
//                $heading[] =$data['all_headline'];
//            }
//        }
        
        $data['heading_tag'] = $heading;
//        print_r($data['heading_tag'][0]);die();
        if($data['heading_tag'] != NULL){
            echo "<option value='0' >Select Headline</option>";
            foreach ($data['heading_tag'][0] as $row){
                echo '<option value="' . $row['headline_id'] . '">' . $row['headline'] . '</option>';
            }
        }
    }
    
    public function uploadNativeAds() {
//        print_r($_FILES);
//        exit;
//        $this->load->library('upload');
        $files = $_FILES;
//        print_r($files);die();
        if (isset($_FILES['uploadfile']) && !empty($_FILES['uploadfile']['name'])) {
            $_FILES['uploadfile']['name'] = uniqid() . '_' . $_FILES['uploadfile']['name'];
            $config['upload_path'] = 'uploads/native_images';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '0';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
//                echo json_encode($msg);
            } else {
                $fileinfo = $this->upload->data();
                echo $fileinfo['file_name'];
            }
        }
//        $_FILES['userfile']['name'] = uniqid() . '_' . $files['file']['name'];
//        $_FILES['userfile']['type'] = $files['file']['type'];
//        $_FILES['userfile']['tmp_name'] = $files['file']['tmp_name'];
//        $_FILES['userfile']['error'] = $files['file']['error'];
//        $_FILES['userfile']['size'] = $files['file']['size'];
//
//        $this->upload->initialize($this->set_upload_options());
//        $this->upload->do_upload();
//        $img = $_FILES['userfile']['name'];
//        $output = array();
//        $output['image'] = $img;
////        print_r ($output);
//        echo $img;
    }
    
    public function saveNativeAds() {
//        echo '<pre>';print_r($_POST);die();
//      
        $image = $this->input->post('image');
//        $this->upload->initialize($config);
        foreach ($image as $key => $value){
            
            $data['image'] = $value;
            $data['keyword'] = '';
            if(($_POST['bulk_country'])){
                $data['country_id'] = ','.implode(',', $_POST['bulk_country']).',';
            }
            else{
                $data['country_id'] = ','.implode(',', $_POST['country'][$key]).',';
            }
            if(($_POST['bulk_cat'])){
                $data['cat_id'] = ','.implode(',', $_POST['bulk_cat']).',';
            }
            else{
                $data['cat_id'] = ','.implode(',', $_POST['category'][$key]).',';
            }
            
            if(($_POST['bulk_headline'])){
                $data['headline'] = ($_POST['bulk_headline']);
                $cnt = count($data['headline']);
//                shuffle($my_array);
//                echo mt_rand(0,($cnt-1));
                $data['headline'] = ($_POST['bulk_headline'][mt_rand(0,($cnt-1))]);
//                print_r($data['headline']);
            }
            else{
                $data['headline'] = implode(',', $_POST['headline'][$key]);
//                print_r($data['headline']);
            }
            $data['width'] = $_POST['width'][$key];
            $data['height'] = $_POST['height'][$key];
            
            if($_POST['bulk_keyword'][0]){
                $key_data['keyword_tags'] = implode(',', $_POST['bulk_keyword']);
            }
            else{
//                $data['keyword'] = 'hello';
                $key_data['keyword_tags'] = implode(',', $_POST['keyword'][$key]);
            }
            $all_keyword = explode(',', $key_data['keyword_tags']);
        
            foreach ($all_keyword as $key) {
                $match_keyword = $this->admin_model->get_keyword_tags($key, 2);
                if ($match_keyword != NULL) {
                    
                } else {
                    $key_data['option_id'] = 2;
                    $key_data['keyword_tags'] = $key;
                    $this->admin_model->insertInfo('keyword_tags', $key_data);
                }
            }
            foreach ($all_keyword as $key) {
                $match_keyword = $this->admin_model->get_keyword_tags($key, 2);
                $data['keyword'].= $match_keyword[0]['id'] . ',';
            }
            $data['keyword'] = ','.rtrim($data['keyword'], ',').',';

//            echo '<pre>';print_r($data);//die();
            $this->admin_model->insertInfo('native_ads',$data);
        }
//        echo '<pre>';print_r($data);die();
        redirect('admin/allNative');
    }
    
    public function nativeSettings() {
        $data['page_title'] = 'Banner Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['native_settings'] = $this->admin_model->get_info_by_id('settings','option_id',2);
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/native/native_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveNativesettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 2;
        
        $data1['get_banner_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_banner_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/nativeSettings');
//        print_r($data['get_banner_settings']);die();
    }
    
    public function allNative() {
        $data['page_title'] = 'All Native Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_info'] = $this->admin_model->get_all_info('native_ads');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags','option_id',2);
        $data['allsize'] = $this->admin_model->getAllSize('native_ads');
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
//        echo '<pre>';print_r($data['all_native_ads']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/native/all_native',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    
    public function changeNativeStatus() {
        $id = $this->input->post('native_ad');
//        echo $id;die();
        $native = $this->admin_model->get_info_by_id('native_ads','native_id',$id);
//        echo '<pre>';print_r($native);die();
        if($native[0]['status'] == 1) {
            $this->admin_model->set_block_status('native_ads','status','native_id', $id);
            echo 0;
        }else {
            $this->admin_model->set_active_status('native_ads','status','native_id', $id);
            echo 1;
        }

//        redirect('admin/allNative', 'refresh');
    }
    
    
    public function editNative($native_id) {
        $data['page_title'] = 'Edit Native Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_native'] = $this->admin_model->get_info_by_id('native_ads', 'native_id', $native_id);
        $abc[] = $data['all_native'];

        $data['native'] = $abc;

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_headline'] = $this->admin_model->get_all_Active_info('headline', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 2);
        $data['all_country'] = $this->admin_model->get_all_country();

        $data['admin_maincontent'] = $this->load->view('super_admin/native/edit_multiple_native', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function editMultipleNative() {
        $native_id = $this->input->post('native_id');
        
//        Change Multiple status 
        
        if (isset($_POST['status'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($native_id); $i++) {
                $native = $this->admin_model->get_info_by_id('native_ads','native_id',$native_id[$i]);
                if ($native[0]['status'] == 1) {
                    $this->admin_model->set_block_status('native_ads', 'status', 'native_id', $native_id[$i]);
                    echo 0;
                } else {
                    $this->admin_model->set_active_status('native_ads', 'status', 'native_id', $native_id[$i]);
                    echo 1;
                }
//                print_r($banner);die();
            }
            redirect('admin/allNative');
        }
        
        //        Edit Multiple Native 

        if (isset($_POST['edit'])) {
//            echo '<pre>';print_r($_POST);die();
            
            if(($_POST['bulk_country'])){
                $data['country_id'] = ','.implode(',', $_POST['bulk_country']).',';
            }
            
            if(($_POST['bulk_cat'])){
                $data['cat_id'] = ','.implode(',', $_POST['bulk_cat']).',';
            }
            
            if(($_POST['bulk_headline'])){
                $data['headline'] = ($_POST['bulk_headline']);
                $cnt = count($data['headline']);
//                shuffle($my_array);
//                echo mt_rand(0,($cnt-1));
                $data['headline'] = ($_POST['bulk_headline'][mt_rand(0,($cnt-1))]);
//                print_r($data['headline']);
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 2);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 2;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 2);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = ','.rtrim($data['keyword'],',').',';
            }
            
//            echo '<pre>';print_r($data);die();
            
            $abc = array();
            for ($i = 0; $i < count($native_id); $i++) {
                $this->admin_model->updateInfo('native_id', $native_id[$i], 'native_ads', $data);
//                $data['all_banner'] = $this->admin_model->get_info_by_id('banner', 'banner_id', $banner_id[$i]);
//                $abc[] = $data['all_banner'];
            }
            
            redirect('admin/allNative');
        }
        
//        Delete Multiple Native
        
        if (isset($_POST['delete'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($native_id); $i++) {
                $this->admin_model->deleteInfo('native_ads','native_id',$native_id[$i]);
            }
            redirect('admin/allNative');
        }
    }
    
    public function get_headline() {
        parse_str($_POST['country_id'], $searcharray);
        $data['cat_id'] = implode(',', $searcharray['category']);
        $data['country_id'] = implode(',', $searcharray['country']);
        $data['headen_head'] = implode(',', $searcharray['headen_head']);
//        print_r($data['country_id']);die(); 
        $data['cat_id'] = explode(',', $data['cat_id']);
//        $data['country_id'] = explode(',', $data['country_id']);
        $data['headen_head'] = explode(',', $data['headen_head']);
        for($i = 0; $i < count($data['cat_id']); $i++){
//            $data['all_headline'] = $this->admin_model->get_headline_cat_id($data['cat_id'][$i],1);
            $data['all_headline'] = $this->admin_model->get_headline_by_id($data['cat_id'][$i],$data['country_id']);
            $heading[] =$data['all_headline'];
        }
        
//        for($i = 0; $i < count($data['country_id']); $i++){
//            $data['all_headline'] = $this->admin_model->get_headline_country_id($data['country_id'][$i],2);
//            $heading[] =$data['all_headline'];
//        }
        
        $data['heading_tag'] = $heading;
//        print_r($data['heading_tag']);die();
        if($data['heading_tag']){
            echo "<option value='0' >Select Headline</option>";
            foreach ($data['heading_tag'] as $row){
                echo '<option value="' . $row[0]['headline_id'] . '">' . $row[0]['headline'] . '</option>';
            }
        }
    }
    
    public function updateNative() {
        $native_id = $this->input->post('native_id');
        parse_str($_POST['str'], $searcharray);
//        print_r($searcharray);die();
        $key_data['keyword_tags'] = ($searcharray['keyword']);
        $data['cat_id'] = ','.implode(',', $searcharray['category']).',';
        $data['country_id'] = ','.implode(',', $searcharray['country']).',';
        $data['headline'] = implode(',', $searcharray['headline']);
//        print_r($data);die();
        $all_keyword = explode(',', $key_data['keyword_tags']);
        
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,2);
            if($match_keyword != NULL){
            }
            else{
                $key_data['option_id'] = 2;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags',$key_data);
            }
        }
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,2);
            $data['keyword'].= $match_keyword[0]['id'].',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'],',').',';
//        print_r($data);die();
        $this->admin_model->updateInfo('native_id', $native_id, 'native_ads', $data);
    }
    
//    Native Ads Ends
    
//    Start Facebook Ads
    
    public function addFacebook() {
        $data['page_title'] = 'Add Banner Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/add_facebook',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function uploadFacebookAds() {
        if (isset($_FILES['uploadfile']) && !empty($_FILES['uploadfile']['name'])) {
            $_FILES['uploadfile']['name'] = uniqid() . '_' . $_FILES['uploadfile']['name'];
            $config['upload_path'] = 'uploads/facebook_ads';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '0';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadfile')) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
//                echo json_encode($msg);
            } else {
                $fileinfo = $this->upload->data();
                echo $fileinfo['file_name'];
            }
        }
        
        // Load Library
      //$this->load->library('s3');

      // Create a Bucket
//      var_dump($this->s3->putBucket('My-Bucket', $this->s3->ACL_PUBLIC_READ));
//
//      // List Buckets
//      var_dump($this->s3->listBuckets());
      
//      $projectFileLoc = $_FILES['projectFile']['tmp_name'];
//      $projectFileName = $_FILES['projectFile']['name'];
//
//        if (!($this->upload->do_upload("previewImage")) && 
//                !($this->s3->putObject($projectFileLoc, '3dnation', $projectFileName, $this->s3->ACL_PUBLIC_READ))) {
//            echo "Something went wrong...";
//        } else {
//            $imgData = $this->upload->data();
//            $previewImage = $imgData['file_name'];
//            //TODO: Add image to DB
//        }
    }
    
    public function saveFacebookAds() {
        $data['cat_id'] = ','.implode(',', $this->input->post('bulk_cat')).',';
        $data['country_id'] = ','.implode(',', $this->input->post('bulk_country')).',';
        $data['embedded_code'] = $this->input->post('embedded_code');
        $data['landing_page_url'] = $this->input->post('landing_page_url');
        
        $key_data['keyword_tags'] = implode(',', $this->input->post('bulk_keyword'));
        $all_keyword = explode(',', $key_data['keyword_tags']);

//        print_r($all_keyword);
        
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 3);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 3;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 3);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'], ',').',';
//        echo '<pre>';print_r($data);die();
        $this->admin_model->insertInfo('facebook_ads',$data);
        redirect('admin/allFacebook');
    }
    
    public function facebookSettings() {
        $data['page_title'] = 'Facebook Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['facebook_settings'] = $this->admin_model->get_info_by_id('settings','option_id',3);
//        echo '<pre>';print_r($data['facebook_settings']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/facebook_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveFacebooksettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 3;
        
        $data1['get_facebook_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_facebook_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/facebookSettings');
    }
    
    public function allFacebook() {
        $data['page_title'] = 'All Facebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags','option_id',3);
        $data['allsize'] = $this->admin_model->getAllSize('facebook_images');
        
        $this->session->unset_userdata('cat_id');
        $this->session->unset_userdata('country_id');
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allFacebook";
        $total_row = $this->admin_model->record_count('facebook_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();
        $data['all_info'] = $this->admin_model->fetch_facebook_data('facebook_ads','id',$config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
//        $data['all_info'] = $this->admin_model->get_all_info('facebook_ads');
//        echo '<pre>';print_r($data['all_info']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/all_facebook_ads',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function search_by_limit() {
        $limit = $_POST['limit'];
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
        $page_link = $_POST['page_link'];
        
        $cat_id = '';
        if($this->session->userdata('cat_id') != ''){
            $cat_id = $this->session->userdata('cat_id');
        }
        
        $country_id = '';
        if($this->session->userdata('country_id') != ''){
            $country_id = $this->session->userdata('country_id');
        }
        
//        echo $limit;die();
//        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        
        $config = array();
        $config["base_url"] = base_url() . $page_link;
        $total_row = $this->admin_model->record_count($table);
        $config["total_rows"] = $total_row;
        $config["per_page"] = $limit;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();
        $data['all_info'] = $this->admin_model->get_filter_data($table, $limit,$page,$cat_id,$country_id);
//        $data['all_info'] = $this->admin_model->get_search_by_limit($table, $limit,$page);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
        
//        print_r($data['links']);die();
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function search_by_fb_country() {
//        print_r($_POST);die();
        $country_id = ','.$_POST['country_id'].',';
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
//        $page_link = $_POST['page_link'];
        
        $name_data['country_id'] = $_POST['country_id'];
        
        $this->session->set_userdata($name_data);
        
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allFacebookByCountry/".$country_id;
        $total_row = $this->admin_model->record_count('facebook_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;
        
        $data['all_info'] = $this->admin_model->get_search_fb_by_country($config["per_page"], $page,$table,$country_id);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
//        print_r($data['links']);die();
        
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function search_fb_by_category() {
        $cat_id = ','.$_POST['cat_id'].',';
        $country_id = ','.$_POST['country_id'].',';
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
//        $page_link = $_POST['page_link'];
        
        $name_data['cat_id'] = $_POST['cat_id'];
        $name_data['country_id'] = $_POST['country_id'];
        
        $this->session->set_userdata($name_data);
        
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allFacebookByCategory/".$cat_id;
        $total_row = $this->admin_model->record_count('facebook_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();        
        $data['all_info'] = $this->admin_model->get_search_fb_by_category($config["per_page"], $page,$table,$cat_id);
        $str_links = $this->pagination->create_links();
//        print_r($str_links);die();
        $data['links'] = explode('&nbsp;',$str_links );
        
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
        
    }
    
    public function allFacebookByCountry($country_id) {
        $data['page_title'] = 'All Fcaebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 3);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allFacebookByCountry/".$country_id;
        $total_row = $this->admin_model->record_count('facebook_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(4)){
            $page = (($this->uri->segment(4)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();        
        $data['all_info'] = $this->admin_model->get_search_fb_by_country($config["per_page"], $page,'facebook_ads',$country_id);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
        
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/all_facebook_ads',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function allFacebookByCategory($cat_id) {
        $data['page_title'] = 'All Fcaebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 3);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allFacebookByCategory/".$cat_id;
        $total_row = $this->admin_model->record_count('facebook_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(4)){
            $page = (($this->uri->segment(4)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
        //echo $page;die();        
        $data['all_info'] = $this->admin_model->get_search_fb_by_category($config["per_page"], $page,'facebook_ads',$cat_id);
        $str_links = $this->pagination->create_links();
//        print_r($str_links);die();
        $data['links'] = explode('&nbsp;',$str_links );
        
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/all_facebook_ads',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function search_ecom_fb_by_country() {
//        print_r($_POST);die();
        $country_id = ','.$_POST['country_id'].',';
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
//        $page_link = $_POST['page_link'];
        
        $name_data['country_id'] = $_POST['country_id'];
        
        $this->session->set_userdata($name_data);
        
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allEcomFacebookByCountry/".$country_id;
        $total_row = $this->admin_model->record_count('facebook_ecommerce_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;
        
        $data['all_info'] = $this->admin_model->get_search_fb_by_country($config["per_page"], $page,$table,$country_id);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
//        print_r($data['links']);die();
        
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function search_ecom_fb_by_category() {
        $cat_id = ','.$_POST['cat_id'].',';
        $country_id = ','.$_POST['country_id'].',';
        $table = $_POST['table'];
        $link = $_POST['link'];
        $option_id = $_POST['option_id'];
//        $page_link = $_POST['page_link'];
        
        $name_data['cat_id'] = $_POST['cat_id'];
        $name_data['country_id'] = $_POST['country_id'];
        
        $this->session->set_userdata($name_data);
        
        $data['page_title'] = 'All Banner';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allEcomFacebookByCategory/".$cat_id;
        $total_row = $this->admin_model->record_count('facebook_ecommerce_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();        
        $data['all_info'] = $this->admin_model->get_search_fb_by_category($config["per_page"], $page,$table,$cat_id);
        $str_links = $this->pagination->create_links();
//        print_r($str_links);die();
        $data['links'] = explode('&nbsp;',$str_links );
        
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
        
    }
    
    public function allEcomFacebookByCountry($country_id) {
        $data['page_title'] = 'All Fcaebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 4);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allEcomFacebookByCountry/".$country_id;
        $total_row = $this->admin_model->record_count('facebook_ecommerce_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(4)){
            $page = (($this->uri->segment(4)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();        
        $data['all_info'] = $this->admin_model->get_search_fb_by_country($config["per_page"], $page,'facebook_ecommerce_ads',$country_id);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
        
        $data['admin_maincontent'] = $this->load->view('super_admin/fb_ecommerce/all_facebook_ads',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function allEcomFacebookByCategory($cat_id) {
        $data['page_title'] = 'All Fcaebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 4);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allEcomFacebookByCategory/".$cat_id;
        $total_row = $this->admin_model->record_count('facebook_ecommerce_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(4)){
            $page = (($this->uri->segment(4)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $total_row;        
        $data['all_info'] = $this->admin_model->get_search_fb_by_category($config["per_page"], $page,'facebook_ecommerce_ads',$cat_id);
        $str_links = $this->pagination->create_links();
//        print_r($data['all_info']);die();
        $data['links'] = explode('&nbsp;',$str_links );
        
        $data['admin_maincontent'] = $this->load->view('super_admin/fb_ecommerce/all_facebook_ads',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function activatePreview() {
        $id = $this->input->post('facebook_ads_id');
//        $image = $this->input->post('image');
//        echo$id;echo $image;die();
        if (empty($_FILES['image']['name'])) {
            $image = $this->input->post('facebook_image');
        } else {
            $_FILES['image']['name'] = uniqid() . '_' . $_FILES['image']['name'];
            $config['upload_path'] = 'uploads/facebook_images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $error = array();
            $fdata = array();
            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                // echo $error;
            } else {
                $fdata = $this->upload->data();
                $image = $fdata['file_name'];
            }
        }
//        print_r($image);die();
        $this->admin_model->update_facebook_image($image,$id);
        redirect('admin/allFacebook');
    }
    
    public function updateFacebook() {
        $id = $this->input->post('id');
        
        $data['cat_id'] = implode(',', $this->input->post('bulk_cat'));
        $data['country_id'] = implode(',', $this->input->post('bulk_country'));
        $data['embedded_code'] = $this->input->post('embedded_code');
        $data['landing_page_url'] = $this->input->post('landing_page_url');
        
        $key_data['keyword_tags'] = implode(',', $this->input->post('bulk_keyword'));
        $all_keyword = explode(',', $key_data['keyword_tags']);

//        print_r($all_keyword);
        
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 3);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 3;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 3);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = rtrim($data['keyword'], ',');
        
        $this->admin_model->updateInfo('id', $id, 'facebook_ads', $data);
        redirect('admin/allFacebook');
//        print_r($data);die();
    }
    
    public function deleteFacebookImage($id) {
//        echo $id;die;
        $this->admin_model->deleteInfo('facebook_ads', 'id', $id);
        redirect('admin/allFacebook');
    }
    
    public function changeFacebookStatus() {
        $id = $this->input->post('fb_images_id');
//        echo $id;die();
        $facebook_images = $this->admin_model->get_info_by_id('facebook_images','fb_images_id',$id);
//        echo '<pre>';print_r($facebook_images);die();
        if($facebook_images[0]['status'] == 1) {
            $this->admin_model->set_block_status('facebook_images','status','fb_images_id', $id);
            echo 0;
        }else {
            $this->admin_model->set_active_status('facebook_images','status','fb_images_id', $id);
            echo 1;
        }

//        redirect('admin/allBanner', 'refresh');
    }
    
    public function editMultipleFacebook() {
        $fb_images_id = $this->input->post('fb_images_id');
//        print_r($banner_id);die();
        if (isset($_POST['status'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($fb_images_id); $i++) {
                $facebook_images = $this->admin_model->get_info_by_id('facebook_images','fb_images_id',$fb_images_id[$i]);
                if ($facebook_images[0]['status'] == 1) {
                    $this->admin_model->set_block_status('facebook_images', 'status', 'fb_images_id', $fb_images_id[$i]);
//                    echo 0;
                } else {
                    $this->admin_model->set_active_status('facebook_images', 'status', 'fb_images_id', $fb_images_id[$i]);
//                    echo 1;
                }
//                print_r($banner);die();
            }
            redirect('admin/allFacebook');
        }
        
        if (isset($_POST['edit'])) {
//            echo '<pre>';print_r($_POST);die();
            if (($_POST['bulk_country'])) {
                $data['country_id'] = implode(',', $_POST['bulk_country']);
            }
            if (($_POST['bulk_cat'])) {
                $data['cat_id'] = implode(',', $_POST['bulk_cat']);
            }
            if (($_POST['bulk_fb_type'])) {
                $data['facebook_type'] = $_POST['bulk_fb_type'];
            }
//            echo '<pre>';print_r($data);die();
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 3);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 3;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 3);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = rtrim($data['keyword'],',');
            }
//            echo '<pre>'; print_r($data);die();
            $abc = array();
            for ($i = 0; $i < count($fb_images_id); $i++) {
                $this->admin_model->updateInfo('fb_images_id', $fb_images_id[$i], 'facebook_images', $data);
            }
            redirect('admin/allFacebook');
        }
        if (isset($_POST['delete'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($fb_images_id); $i++) {
                $this->admin_model->deleteInfo('facebook_images','fb_images_id',$fb_images_id[$i]);
            }
            redirect('admin/allFacebook');
        }
    }
    
//    
    
    public function editFcaebookImage($fb_images_id) {
        $abc = array();
        for ($i = 0; $i < count($fb_images_id); $i++) {
            $data['all_facebook'] = $this->admin_model->get_fb_info_by_id('facebook_images', 'fb_images_id', $fb_images_id[$i]);
            $abc[] = $data['all_facebook'];
        }
        $data['all_facebook'] = $abc;
//          echo '<pre>'; print_r($data['all_facebook']);die();
        $data['page_title'] = 'Edit Facebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 3);
        $data['all_country'] = $this->admin_model->get_all_country();
//          echo '<pre>';print_r($data['all_keyword']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/edit_multiple_facebook', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateFbImages() {
        $fb_images_id = $this->input->post('fb_images_id');
        parse_str($_POST['str'], $searcharray);
//        print_r($searcharray);die();
        $key_data['keyword_tags'] = ($searcharray['keyword']);
        $data['facebook_type'] = ($searcharray['fb_type']);
        $data['cat_id'] = implode(',', $searcharray['category']);
        $data['country_id'] = implode(',', $searcharray['country']);
//        print_r($fb_images_id);die();
        $all_keyword = explode(',', $key_data['keyword_tags']);
        
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,3);
            if($match_keyword != NULL){
            }
            else{
                $key_data['option_id'] = 3;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags',$key_data);
            }
        }
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,3);
            $data['keyword'].= $match_keyword[0]['id'].',';
        }
        $data['keyword'] = rtrim($data['keyword'],',');
//        print_r($data);die();
        $this->admin_model->updateInfo('fb_images_id', $fb_images_id, 'facebook_images', $data);
    }
    
    public function updateFbLogo() {
        $id = $this->input->post('id');
        if (empty($_FILES['logo']['name'])) {
            $data1['logo'] = $this->input->post('logo1');
        } else {
            $_FILES['logo']['name'] = uniqid() . '_' . $_FILES['logo']['name'];
            $config['upload_path'] = 'uploads/facebook_images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $error = array();
            $fdata = array();
            if (!$this->upload->do_upload('logo')) {
                $error = $this->upload->display_errors();
                // echo $error;
            } else {
                $fdata = $this->upload->data();
                $data1['logo'] = $fdata['file_name'];
            }
        }
        
        $data1['fan_page'] = $this->input->post('fan_page');
        $data1['text'] = $this->input->post('text');
        $data1['headline'] = $this->input->post('headline');
        $data1['description'] = $this->input->post('description');
        $data1['fan_page_url'] = $this->input->post('fan_page_url');
        $data1['landing_page_url'] = $this->input->post('landing_page_url');
//        echo '<pre>';print_r($data1);die();
        $this->admin_model->updateInfo('id', $id, 'facebook_ads', $data1);
        redirect('admin/allFacebook');
    }
    
    public function editFacebook() {
        $data['page_title'] = 'Edit Facebook Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_country'] = $this->admin_model->get_all_country();
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/facebook/edit_facebook',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
//    End Facebook Ads
    
    
//    Start Facebook E-commerce Ads
    
    public function addFbEcom() {
        $data['page_title'] = 'Add Facebook E-commerce Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/fb_ecommerce/add_facebook',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveFbEcomAds() {
//        echo '<pre>';print_r($_POST);die();
        $data['cat_id'] = ','.implode(',', $this->input->post('bulk_cat')).',';
        $data['country_id'] = ','.implode(',', $this->input->post('bulk_country')).',';
        $data['embedded_code'] = $this->input->post('embedded_code');
        $data['landing_page_url'] = $this->input->post('landing_page_url');
        
        $key_data['keyword_tags'] = implode(',', $this->input->post('bulk_keyword'));
        $all_keyword = explode(',', $key_data['keyword_tags']);

//        print_r($all_keyword);
        
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 4);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 4;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 4);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'], ',').',';
//        echo '<pre>';print_r($data);die();
        $this->admin_model->insertInfo('facebook_ecommerce_ads',$data);
        redirect('admin/allFbEcom');
    }
    
    public function fbEcomSettings() {
        $data['page_title'] = 'Ecommerce Facebook Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['facebook_settings'] = $this->admin_model->get_info_by_id('settings','option_id',4);
//        echo '<pre>';print_r($data['facebook_settings']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/fb_ecommerce/facebook_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveEcoFbsettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 4;
        
        $data1['get_facebook_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_facebook_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/fbEcomSettings');
    }
    
    public function allFbEcom() {
        $data['page_title'] = 'All Facebook Ecommerce Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags','option_id',4);
        
        $config = array();
        $config["base_url"] = base_url() . "admin/allFbEcom";
        $total_row = $this->admin_model->record_count('facebook_ecommerce_ads');
        $config["total_rows"] = $total_row;
        $config["per_page"] = 5;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = $total_row;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config);
        if($this->uri->segment(3)){
            $page = (($this->uri->segment(3)) * 5) - 5 ;
          }
        else{
            $page = 0;
        }
//        echo $page;die();
        $data['all_info'] = $this->admin_model->fetch_facebook_data('facebook_ecommerce_ads','fb_ecom_id',$config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
//        echo '<pre>';print_r($data['links']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/fb_ecommerce/all_facebook_ads',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function activateEcommercePreview() {
        $id = $this->input->post('fb_ecom_id');
//        $image = $this->input->post('image');
//        echo$id;echo $image;die();
        if (empty($_FILES['image']['name'])) {
            $image = $this->input->post('facebook_image');
        } else {
            $_FILES['image']['name'] = uniqid() . '_' . $_FILES['image']['name'];
            $config['upload_path'] = 'uploads/facebook_images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $error = array();
            $fdata = array();
            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                // echo $error;
            } else {
                $fdata = $this->upload->data();
                $image = $fdata['file_name'];
            }
        }
//        print_r($image);die();
        $this->admin_model->update_ecommerce_facebook_image($image,$id);
        redirect('admin/allFbEcom');
    }
    
    public function changeFbEcomStatus() {
        $id = $this->input->post('fb_ecom_images_id');
//        echo $id;die();
        $facebook_images = $this->admin_model->get_info_by_id('facebook_ecom_images','fb_ecom_images_id',$id);
//        echo '<pre>';print_r($facebook_images);die();
        if($facebook_images[0]['status'] == 1) {
            $this->admin_model->set_block_status('facebook_ecom_images','status','fb_ecom_images_id', $id);
            echo 0;
        }else {
            $this->admin_model->set_active_status('facebook_ecom_images','status','fb_ecom_images_id', $id);
            echo 1;
        }

    }
    
    public function editMultipleFbEcom() {
        $fb_images_id = $this->input->post('fb_ecom_images_id');
//        print_r($banner_id);die();
        if (isset($_POST['status'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($fb_images_id); $i++) {
                $facebook_images = $this->admin_model->get_info_by_id('facebook_ecom_images','fb_ecom_images_id',$fb_images_id[$i]);
                if ($facebook_images[0]['status'] == 1) {
                    $this->admin_model->set_block_status('facebook_ecom_images', 'status', 'fb_ecom_images_id', $fb_images_id[$i]);
                } else {
                    $this->admin_model->set_active_status('facebook_ecom_images', 'status', 'fb_ecom_images_id', $fb_images_id[$i]);
                }
//                print_r($banner);die();
            }
            redirect('admin/allFbEcom');
        }
        
        if (isset($_POST['edit'])) {
//            echo '<pre>';print_r($_POST);die();
            if (($_POST['bulk_country'])) {
                $data['country_id'] = implode(',', $_POST['bulk_country']);
            }
            if (($_POST['bulk_cat'])) {
                $data['cat_id'] = implode(',', $_POST['bulk_cat']);
            }
            if (($_POST['bulk_fb_type'])) {
                $data['facebook_type'] = $_POST['bulk_fb_type'];
            }
//            echo '<pre>';print_r($data);die();
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 4);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 4;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 4);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = rtrim($data['keyword'],',');
            }
//            echo '<pre>'; print_r($data);die();
            $abc = array();
            for ($i = 0; $i < count($fb_images_id); $i++) {
                $this->admin_model->updateInfo('fb_ecom_images_id', $fb_images_id[$i], 'facebook_ecom_images', $data);
//                $data['all_facebook'] = $this->admin_model->get_info_by_id('facebook_images', 'fb_images_id', $fb_images_id[$i]);
//                $abc[] = $data['all_facebook'];
            }
//            $data['all_facebook'] = $abc;
//          echo '<pre>'; print_r($data['all_facebook']);die();
            redirect('admin/allFbEcom');
        }
        if (isset($_POST['delete'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($fb_images_id); $i++) {
                $this->admin_model->deleteInfo('facebook_ecom_images','fb_ecom_images_id',$fb_images_id[$i]);
            }
            redirect('admin/allFbEcom');
        }
    }
        
    
    public function editFbEcomImage($fb_images_id) {
        $abc = array();
        for ($i = 0; $i < count($fb_images_id); $i++) {
            $data['all_facebook'] = $this->admin_model->get_fb_ecom_info_by_id('facebook_ecom_images', 'fb_ecom_images_id', $fb_images_id[$i]);
            $abc[] = $data['all_facebook'];
        }
        $data['all_facebook'] = $abc;
//        echo '<pre>'; print_r($data['all_facebook']);die();
        $data['page_title'] = 'Edit Facebook Ecommerce Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);

        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 4);
        $data['all_country'] = $this->admin_model->get_all_country();
//          echo '<pre>';print_r($data['all_keyword']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/fb_ecommerce/edit_multiple_facebook', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function updateFbEcomImages() {
        $fb_ecom_images_id = $this->input->post('fb_ecom_images_id');
        parse_str($_POST['str'], $searcharray);
//        print_r($searcharray);die();
        $key_data['keyword_tags'] = ($searcharray['keyword']);
        $data['facebook_type'] = ($searcharray['fb_type']);
        $data['cat_id'] = implode(',', $searcharray['category']);
        $data['country_id'] = implode(',', $searcharray['country']);
//        print_r($fb_images_id);die();
        $all_keyword = explode(',', $key_data['keyword_tags']);
        
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,4);
            if($match_keyword != NULL){
            }
            else{
                $key_data['option_id'] = 4;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags',$key_data);
            }
        }
        foreach ($all_keyword as $key){
            $match_keyword = $this->admin_model->get_keyword_tags($key,4);
            $data['keyword'].= $match_keyword[0]['id'].',';
        }
        $data['keyword'] = rtrim($data['keyword'],',');
//        print_r($data);die();
        $this->admin_model->updateInfo('fb_ecom_images_id', $fb_ecom_images_id, 'facebook_ecom_images', $data);
    }
    
    public function updateFbEcomLogo() {
        $fb_ecom_id = $this->input->post('id');
        if (empty($_FILES['logo']['name'])) {
            $data1['logo'] = $this->input->post('logo1');
        } else {
            $_FILES['logo']['name'] = uniqid() . '_' . $_FILES['logo']['name'];
            $config['upload_path'] = 'uploads/facebook_images/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 0;
            $config['max_width'] = 0;
            $config['max_height'] = 0;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $error = array();
            $fdata = array();
            if (!$this->upload->do_upload('logo')) {
                $error = $this->upload->display_errors();
                // echo $error;
            } else {
                $fdata = $this->upload->data();
                $data1['logo'] = $fdata['file_name'];
            }
        }
        
        $data1['fan_page'] = $this->input->post('fan_page');
        $data1['text'] = $this->input->post('text');
        $data1['headline'] = $this->input->post('headline');
        $data1['description'] = $this->input->post('description');
        $data1['fan_page_url'] = $this->input->post('fan_page_url');
        $data1['landing_page_url'] = $this->input->post('landing_page_url');
//        echo '<pre>';print_r($data1);die();
        $this->admin_model->updateInfo('fb_ecom_id', $fb_ecom_id, 'facebook_ecommerce_ads', $data1);
        redirect('admin/allFbEcom');
    }
    
    public function updateEcommereceFacebook() {
        $id = $this->input->post('fb_ecom_id');
        
        $data['cat_id'] = implode(',', $this->input->post('bulk_cat'));
        $data['country_id'] = implode(',', $this->input->post('bulk_country'));
        $data['embedded_code'] = $this->input->post('embedded_code');
        $data['landing_page_url'] = $this->input->post('landing_page_url');
        
        $key_data['keyword_tags'] = implode(',', $this->input->post('bulk_keyword'));
        $all_keyword = explode(',', $key_data['keyword_tags']);

//        print_r($all_keyword);
        
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 4);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 4;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 4);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = rtrim($data['keyword'], ',');
        
        $this->admin_model->updateInfo('fb_ecom_id', $id, 'facebook_ecommerce_ads', $data);
        redirect('admin/allFbEcom');
//        print_r($data);die();
    }
    
    public function deleteFbEcomImage($id) {
//        echo $id;die;
        $this->admin_model->deleteInfo('facebook_ecommerce_ads', 'fb_ecom_id', $id);
        redirect('admin/allFbEcom');
    }
    
//    End Facebook E-commerce Ads
    
    
//    Settings Starts
    
    public function paypal() {
        $data['page_title'] = 'Paypal Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('paypal_settings');
//        echo '<pre>';print_r($data['all_info']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/settings/add_papypal_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function savePaypalSettings() {
        $data['paypal_type'] = $this->input->post('paypal_type');
        if($data['paypal_type'] == 1){
            $data['paypal_action'] = $this->input->post('paypal_action');
            $data['paypal_account'] = $this->input->post('paypal_account');
        }
        if($data['paypal_type'] == 2){
            $data['paypal_action'] = $this->input->post('sandbox_action');
            $data['paypal_account'] = $this->input->post('sandbox_account');
        }
        $data1['all_info'] = $this->admin_model->get_all_info('paypal_settings');
        if(empty($data1['all_info'])){
            $this->admin_model->insertInfo('paypal_settings',$data);
        }
        else{
            $this->admin_model->updateInfo('id', 1, 'paypal_settings', $data);
        }
        
        redirect('admin/paypal');
    }
    
    public function stripe() {
        $data['page_title'] = 'Stripe Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('stripe_settings');
//        echo '<pre>';print_r($data['all_info']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/settings/add_stripe_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveStripeSettings() {
        $data['stripe_type'] = $this->input->post('stripe_type');
        if($data['stripe_type'] == 1){
            $data['public_key'] = $this->input->post('test_public_key');
            $data['secret_key'] = $this->input->post('test_secret_key');
        }
        if($data['stripe_type'] == 2){
            $data['public_key'] = $this->input->post('live_public_key');
            $data['secret_key'] = $this->input->post('live_secret_key');
        }
        $data1['all_info'] = $this->admin_model->get_all_info('stripe_settings');
        if(empty($data1['all_info'])){
            $this->admin_model->insertInfo('stripe_settings',$data);
        }
        else{
            $this->admin_model->updateInfo('id', 1, 'stripe_settings', $data);
        }
        
        redirect('admin/stripe');
    }
    
    
    public function trial() {
        $data['page_title'] = 'Add Trial';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('trial_package');
//        print_r($data['all_info']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/settings/add_trial',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveTrialSettings() {
//        echo '<pre>';print_r($_POST);die();
        $option_id = $this->input->post('option_id');
        for($i = 0; $i < count($option_id); $i++){
            
            $data['option_id'] = $option_id[$i];
            $data['is_active'] = $_POST['is_active'][$i];
            
            $this->admin_model->updateInfo('option_id', $option_id[$i], 'trial_package', $data);
        }
        redirect('admin/trial');
//        echo '<pre>';print_r($data);die();
    }
    
    public function whois_setting() {
        $data['page_title'] = 'Add Whois Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('membership_package_options');
//        $data['all_info'] = $this->admin_model->get_all_info('trial_package');
//        echo '<pre>';print_r($data['all_info']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/settings/whois_setting',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveWhoIsSetting() {
//        echo '<pre>';print_r($_POST);die();
        $option_id = $this->input->post('option_id');
        $option_price = $_POST['option_price'];
        
        for($i = 0; $i < count($option_id); $i++){
            $data['option_price'] = $option_price[$i];
            $this->admin_model->updateInfo('option_id', $option_id[$i], 'membership_package_options', $data);
        }
        redirect('admin/whois_setting');
    }
    
//    Settings Ends
//    Affiliate Landing Page
    
    public function addAffiliateLanding() {
        $data['page_title'] = 'Add Affiliate Landing Page';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        //echo '<pre>'; print_r($data['all_category']); exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/affiliate/add_affiliate_landing', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function check_url() {
        $url = $this->input->post('url');
        $table = $this->input->post('table');

        $get_value = $this->admin_model->data_by_url($table,$url);
        if($get_value){
            echo $get_value[0]['url'];
        }
        else{
            echo 0;
        }
    }
    
    public function saveAffiliateLanding() {
        $url = $_POST['url'];
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $url;
//        echo $geturl;die();
//        $checkurl = $this->admin_model->checkurl($url);
        
        $data['url'] = $url;
        $data['zip_file_name'] = $geturl;
        $data['title'] = $this->input->post('title');
        $data['date'] = date('Y-m-d');
        $all_keyword = explode(',', $_POST['keyword'][0]);

        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 6);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 6;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 6);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = rtrim($data['keyword'], ',');

        if (($_POST['country_id'])) {
            $data['country_id'] = implode(',', $_POST['country_id']);
        }
        if (($_POST['cat_id'])) {
            $data['cat_id'] = implode(',', $_POST['cat_id']);
        }

        $landingInsert = $this->admin_model->insertInfo('affiliate_landing_page',$data);
        if ($landingInsert) {
            redirect('admin/allAffiliateLandingPages');
        } else {
            redirect('admin/allAffiliateLandingPages');
        }
    }
    
    public function allAffiliateLandingPages() {
        $data['page_title'] = 'All Affiliate Landing';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('affiliate_landing_page');
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 6);
        $data['all_country'] = $this->admin_model->get_all_country();
        //print_r($data['all_landing_info']); exit; 
        $data['admin_maincontent'] = $this->load->view('super_admin/affiliate/all_affiliate_landing', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function editAffiliateLanding() {
        $id = $this->uri->segment('3');
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['edit_landing_info'] = $this->admin_model->get_info_by_id('affiliate_landing_page','id',$id);
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 6);
        $data['all_country'] = $this->admin_model->get_all_country();
        
//        echo '<pre>';print_r($data['edit_landing_info']);  exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/affiliate/edit_affiliate_landing', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function updatelandingpage() {
//        print_r($_POST);die();
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $data['title'] = $this->input->post('title');
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $geturl;
        if (($_POST['country_id'])) {
            $data['country_id'] = implode(',', $_POST['country_id']);
        }
        if (($_POST['cat_id'])) {
            $data['cat_id'] = implode(',', $_POST['cat_id']);
        }
//        $keyword = $_POST['keyword'];
        $all_keyword = explode(',', $_POST['keyword'][0]);
//        print_r($all_keyword);die();
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 6);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 6;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 6);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = rtrim($data['keyword'], ',');
        
//        $data['keyword'] = $keywordinfo->id;
        $id = $this->uri->segment('3');
//        print_r($data); exit;
        $update = $this->admin_model->updateInfo('id', $id, 'affiliate_landing_page', $data);
        if($update) {
            $this->session->set_flashdata('success', 'Landing Page Update Successfully');
            redirect('admin/allAffiliateLandingPages');
        }else {
            $this->session->set_flashdata('error', 'There is an error in Landing Page Update');
            redirect('admin/allAffiliateLandingPages');
        }
    }
    
    public function delete_affiliate_landing($id) {
        $this->admin_model->deleteInfo('affiliate_landing_page','id',$id);
        redirect('admin/allAffiliateLandingPages');
    }
    
    public function affiliateSettings() {
        $data['page_title'] = 'Affiliate Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['affiliate_settings'] = $this->admin_model->get_info_by_id('settings','option_id',6);
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/affiliate/affiliate_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveAffiliatesettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 6;
        
        $data1['get_banner_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_banner_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/affiliateSettings');
//        print_r($data['get_banner_settings']);die();
    }
    
    public function editMultipleAffiliate() {
        
        $id = $this->input->post('id');
//        print_r($id);die();
        if (isset($_POST['edit'])) {
//            echo '<pre>';print_r($_POST);die();
            if(($_POST['bulk_country'])){
                $data['country_id'] = implode(',', $_POST['bulk_country']);
            }
            
            if(($_POST['bulk_cat'])){
                $data['cat_id'] = implode(',', $_POST['bulk_cat']);
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 6);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 6;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 6);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = rtrim($data['keyword'],',');
            }
            
//            echo '<pre>';print_r($data);die();
            
            $abc = array();
            for ($i = 0; $i < count($id); $i++) {
                $this->admin_model->updateInfo('id', $id[$i], 'affiliate_landing_page', $data);
            }
            
            redirect('admin/allAffiliateLandingPages');
        }
        
        if (isset($_POST['delete'])) {
//            print_r($banner_id);die();
            for ($i = 0; $i < count($id); $i++) {
                $this->admin_model->deleteInfo('affiliate_landing_page','id',$id[$i]);
            }
            redirect('admin/allAffiliateLandingPages');
        }
        
        
    }
    
//    Affiliate Landing Page End
    
//    PPV Ads
    
    public function addPpvAds() {
        $data['page_title'] = 'Add PPV Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        //echo '<pre>'; print_r($data['all_category']); exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/ppv/add_ppv_ads', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function savePpvAds() {
        $url = $_POST['url'];
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $url;
//        echo $geturl;die();
//        $checkurl = $this->admin_model->checkurl($url);
        
        $data['url'] = $url;
        $data['title'] = $this->input->post('title');
        $data['zip_file_name'] = $geturl;
        $data['date'] = date('Y-m-d');
        $all_keyword = explode(',', $_POST['keyword'][0]);

        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 5);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 5;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 5);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'], ',').',';

        if (($_POST['country_id'])) {
            $data['country_id'] = ','.implode(',', $_POST['country_id']).',';
        }
        if (($_POST['cat_id'])) {
            $data['cat_id'] = ','.implode(',', $_POST['cat_id']).',';
        }
        
        $config['upload_path'] = 'uploads/ppv';
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

        $landingInsert = $this->admin_model->insertInfo('ppv',$data);
        if ($landingInsert) {
            redirect('admin/allPpvAds');
        } else {
            redirect('admin/allPpvAds');
        }
    }
    
    public function allPpvAds() {
        $data['page_title'] = 'All PPV Ads';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('ppv');
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 5);
        $data['all_country'] = $this->admin_model->get_all_country();
        //print_r($data['all_landing_info']); exit; 
        $data['admin_maincontent'] = $this->load->view('super_admin/ppv/all_ppv_ads', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function editPpvAds() {
        $id = $this->uri->segment('3');
        $data['page_title'] = 'Dashboard';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['edit_landing_info'] = $this->admin_model->get_info_by_id('ppv','ppv_id',$id);
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 5);
        $data['all_country'] = $this->admin_model->get_all_country();
        
//        echo '<pre>';print_r($data['edit_landing_info']);  exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/ppv/edit_ppv_ads', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function updatePpvAds() {
//        print_r($_POST);die();
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $data['title'] = $this->input->post('title');
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $geturl;
        if (($_POST['country_id'])) {
            $data['country_id'] = ','.implode(',', $_POST['country_id']).',';
        }
        if (($_POST['cat_id'])) {
            $data['cat_id'] = ','.implode(',', $_POST['cat_id']).',';
        }
//        $keyword = $_POST['keyword'];
        $all_keyword = explode(',', $_POST['keyword'][0]);
//        print_r($all_keyword);die();
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 5);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 5;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 5);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = ','.rtrim($data['keyword'], ',').',';
        
//        $data['keyword'] = $keywordinfo->id;
        $ppv_id = $this->uri->segment('3');
//        print_r($ppv_id); exit;
        $update = $this->admin_model->updateInfo('ppv_id', $ppv_id, 'ppv', $data);
        if($update) {
            $this->session->set_flashdata('success', 'PPV Ads Update Successfully');
            redirect('admin/allPpvAds');
        }else {
            $this->session->set_flashdata('error', 'There is an error in PPV Ads Update');
            redirect('admin/allPpvAds');
        }
    }
    
    public function delete_ppv_ads($id) {
        $this->admin_model->deleteInfo('ppv','ppv_id',$id);
        redirect('admin/allPpvAds');
    }
    
    public function ppvSettings() {
        $data['page_title'] = 'Affiliate Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['ppv_settings'] = $this->admin_model->get_info_by_id('settings','option_id',5);
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/ppv/ppv_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function savePpvsettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 5;
        
        $data1['get_banner_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_banner_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/ppvSettings');
//        print_r($data['get_banner_settings']);die();
    }
    
    public function editMultiplePpv() {
        
        $ppv_id = $this->input->post('ppv_id');
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 5);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 5;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 5);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = ','.rtrim($data['keyword'],',').',';
            }
            
//            echo '<pre>';print_r($data);die();
            
            $abc = array();
            for ($i = 0; $i < count($ppv_id); $i++) {
                $this->admin_model->updateInfo('ppv_id', $ppv_id[$i], 'ppv', $data);
            }
            
            redirect('admin/allPpvAds');
        }
        
        if (isset($_POST['delete'])) {
//            print_r($ppv_id);die();
            for ($i = 0; $i < count($ppv_id); $i++) {
                $this->admin_model->deleteInfo('ppv','ppv_id',$ppv_id[$i]);
            }
            redirect('admin/allPpvAds');
        }
        
    }
    
//    PPV Ads End
    
//    Advertiser Offer Feed Starts
    
    public function addAdvertiserOffer() {
        $data['page_title'] = 'Add Advertiser Offer Feed';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
        //echo '<pre>'; print_r($data['all_category']); exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/advertiser/add_advertiser_offer', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveAdvertiserOffer() {
        $url = $_POST['url'];
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $url;
        
        $data['url'] = $url;
        $data['title'] = $this->input->post('title');
        $data['zip_file_name'] = $geturl;
        $data['date'] = date('Y-m-d');
        $all_keyword = explode(',', $_POST['keyword'][0]);

        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 7);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 7;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 7);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = rtrim($data['keyword'], ',');

        if (($_POST['country_id'])) {
            $data['country_id'] = implode(',', $_POST['country_id']);
        }
        if (($_POST['cat_id'])) {
            $data['cat_id'] = implode(',', $_POST['cat_id']);
        }
//        print_r($data);die();

        $landingInsert = $this->admin_model->insertInfo('advertise_offer_feed',$data);
        if ($landingInsert) {
            redirect('admin/allAdvertiserOffer');
        } else {
            redirect('admin/allAdvertiserOffer');
        }
    }
    
    public function allAdvertiserOffer() {
        $data['page_title'] = 'All Advertiser Offer Feed';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['all_info'] = $this->admin_model->get_all_info('advertise_offer_feed');
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 7);
        $data['all_country'] = $this->admin_model->get_all_country();
        //print_r($data['all_landing_info']); exit; 
        $data['admin_maincontent'] = $this->load->view('super_admin/advertiser/all_advertiser_offer', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function editAdvertiserOffer() {
        $id = $this->uri->segment('3');
        $data['page_title'] = 'Edit Advertiser Offer Feed';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['edit_landing_info'] = $this->admin_model->get_info_by_id('advertise_offer_feed','id',$id);
        
        $data['all_category'] = $this->admin_model->get_all_Active_info('category', 'status');
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', 7);
        $data['all_country'] = $this->admin_model->get_all_country();
        
//        echo '<pre>';print_r($data['edit_landing_info']);  exit;
        $data['admin_maincontent'] = $this->load->view('super_admin/advertiser/edit_advertiser_offer', $data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }

    public function updateAdvertiserOffer() {
//        print_r($_POST);die();
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $geturl = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $geturl;
        if (($_POST['country_id'])) {
            $data['country_id'] = implode(',', $_POST['country_id']);
        }
        if (($_POST['cat_id'])) {
            $data['cat_id'] = implode(',', $_POST['cat_id']);
        }
//        $keyword = $_POST['keyword'];
        $all_keyword = explode(',', $_POST['keyword'][0]);
//        print_r($all_keyword);die();
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 7);
            if ($match_keyword != NULL) {
                
            } else {
                $key_data['option_id'] = 7;
                $key_data['keyword_tags'] = $key;
                $this->admin_model->insertInfo('keyword_tags', $key_data);
            }
        }
        foreach ($all_keyword as $key) {
            $match_keyword = $this->admin_model->get_keyword_tags($key, 7);
            $data['keyword'].= $match_keyword[0]['id'] . ',';
        }
        $data['keyword'] = rtrim($data['keyword'], ',');
        
//        $data['keyword'] = $keywordinfo->id;
        $id = $this->uri->segment('3');
//        print_r($data); exit;
        $update = $this->admin_model->updateInfo('id', $id, 'advertise_offer_feed', $data);
        if($update) {
            $this->session->set_flashdata('success', 'PPV Ads Update Successfully');
            redirect('admin/allAdvertiserOffer');
        }else {
            $this->session->set_flashdata('error', 'There is an error in PPV Ads Update');
            redirect('admin/allAdvertiserOffer');
        }
    }
    
    public function delete_advertiser_offer($id) {
        $this->admin_model->deleteInfo('advertise_offer_feed','id',$id);
        redirect('admin/allAdvertiserOffer');
    }
    
    
    public function advertiserOfferSettings() {
        $data['page_title'] = 'Affiliate Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        $data['advertiser_settings'] = $this->admin_model->get_info_by_id('settings','option_id',7);
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/advertiser/advertiser_offer_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function saveAdvertiserOfferSettings() {
        $data['membership_price'] = $this->input->post('membership_price');
        $data['view_count'] = $this->input->post('view_count');
        $data['download_count'] = $this->input->post('download_count');
        $data['option_id'] = 7;
//        print_r($data);die();
        $data1['get_banner_settings'] = $this->admin_model->get_info_by_id('settings','option_id',$data['option_id']);
        if($data1['get_banner_settings']){
            $this->admin_model->updateInfo('option_id', $data['option_id'], 'settings', $data);
            $this->admin_model->updateOptionInfo('membership_package_options',$data['option_id'],$data['membership_price']);
        }
        else{
            $this->admin_model->insertInfo('settings',$data);
        }
        redirect('admin/advertiserOfferSettings');
//        print_r($data['get_banner_settings']);die();
    }
    
    public function editMultipleAdvertiser() {
        
        $id = $this->input->post('id');
//        print_r($id);die();
        if (isset($_POST['edit'])) {
//            echo '<pre>';print_r($_POST);die();
            if(($_POST['bulk_country'])){
                $data['country_id'] = implode(',', $_POST['bulk_country']);
            }
            
            if(($_POST['bulk_cat'])){
                $data['cat_id'] = implode(',', $_POST['bulk_cat']);
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
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 7);
                    if ($match_keyword != NULL) {
//                    echo '<pre>';print_r($match_keyword);
                    } else {
                        $key_data['option_id'] = 7;
                        $key_data['keyword_tags'] = $key;
//                        print_r($key_data);die();
                        $keyword = $this->admin_model->insertId('keyword_tags', $key_data);
                    }
                }

                foreach ($all_keyword as $key) {
                    $match_keyword = $this->admin_model->get_keyword_tags($key, 7);
                    $data['keyword'].= $match_keyword[0]['id'] . ',';
                }
                $data['keyword'] = rtrim($data['keyword'],',');
            }
            
//            echo '<pre>';print_r($data);die();
            
            $abc = array();
            for ($i = 0; $i < count($id); $i++) {
                $this->admin_model->updateInfo('id', $id[$i], 'advertise_offer_feed', $data);
            }
            
            redirect('admin/allAdvertiserOffer');
        }
        
        if (isset($_POST['delete'])) {
//            print_r($id);die();
            for ($i = 0; $i < count($id); $i++) {
                $this->admin_model->deleteInfo('advertise_offer_feed','id',$id[$i]);
            }
            redirect('admin/allAdvertiserOffer');
        }
        
    }
    
//    Advertiser Offer Feed End
    
//    Resources Starts
    
    public function resourceAffiliate() {
        $data['page_title'] = 'Affiliate Networks';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/resource_affiliate',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
//    Resources Ends
    
//    Services Starts
    
    public function serviceBanner() {
        $data['page_title'] = 'Banner/Creative Design';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/services/service_banner',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
//    Services Ends
    
//    whois Section Starts
    
    public function whoisSettings() {
        $data['page_title'] = 'Facebook Settings';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
//        echo '<pre>';print_r($data['total_visitor']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/whois/whois_settings',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
//    Whois Section Ends
    
//    Resources Starts
    public function resourceAdNetworks() {
        $data['page_title'] = 'Ad Networks';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['comment_data'] = $this->admin_model->get_info_by_id('comment_tbl','option_id',21);
        $data['favourite_data'] = $this->admin_model->get_info_by_id('make_favorite_tbl','option_id',21);
        $data['resource_data'] = $this->admin_model->get_all_info('ad_networks');
//        print_r($data['favourite_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/ad_networks',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_ad_networks() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('ad_networks',$data);
        redirect('admin/resourceAdNetworks');
//        print_r($data);die();
    }
    
    public function add_comments() {
        $data['member_id'] = $this->session->userdata('member_id');
        $data['comment'] = $this->input->post('comments');
        $data['adds_id'] = $this->input->post('id');
        $data['option_id'] = 21;
        $data['date'] = date('Y-m-d');
        $comment = $this->admin_model->get_comment_by_id($data['option_id'],$data['adds_id']);
        
        if($comment){
            $this->admin_model->update_comment($data,$data['adds_id'],$data['option_id']);
        }
        else{
            $this->admin_model->insertInfo('comment_tbl',$data);
        }
        
        redirect('admin/resourceAdNetworks');
//        print_r($data);die();
    }
    
    public function addFavourite($id) {
        $data['member_id'] = $this->session->userdata('member_id');
        $data['adds_id'] = $id;
        $data['option_id'] = 21;
        $data['date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('make_favorite_tbl',$data);
        redirect('admin/resourceAdNetworks');
    }
    
    public function update_ad_networks() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $update = $this->admin_model->updateInfo('id', $id, 'ad_networks', $data);
        redirect('admin/resourceAdNetworks');
        
    }
    
    public function deleteAdNetwork($id) {
        $this->admin_model->deleteInfo('ad_networks','id',$id);
        redirect('admin/resourceAdNetworks');
    }
    
    public function resourceHosting() {
        $data['page_title'] = 'Hosting';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('hosting');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/hosting',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_hosting() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('hosting',$data);
        redirect('admin/resourceHosting');
//        print_r($data);die();
    }
    
    public function update_hosting() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'hosting', $data);
        redirect('admin/resourceHosting');
        
    }
    
    public function deleteHosting($id) {
        $this->admin_model->deleteInfo('hosting','id',$id);
        redirect('admin/resourceHosting');
    }
    
    
    public function resourceTracking() {
        $data['page_title'] = 'Tracking';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('tracking');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/tracking',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_tracking() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('tracking',$data);
        redirect('admin/resourceTracking');
//        print_r($data);die();
    }
    
    public function update_tracking() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'tracking', $data);
        redirect('admin/resourceTracking');
        
    }
    
    public function deleteTracking($id) {
        $this->admin_model->deleteInfo('tracking','id',$id);
        redirect('admin/resourceTracking');
    }
    
    
    public function resourceCoaching() {
        $data['page_title'] = 'Coaching';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('coaching');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/coaching',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_coaching() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('coaching',$data);
        redirect('admin/resourceCoaching');
//        print_r($data);die();
    }
    
    public function update_coaching() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'coaching', $data);
        redirect('admin/resourceCoaching');
        
    }
    
    public function deleteCoaching($id) {
        $this->admin_model->deleteInfo('coaching','id',$id);
        redirect('admin/resourceCoaching');
    }
    
    
    public function resourceFulfilment() {
        $data['page_title'] = 'Fulfilment';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('fulfillment');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/fulfillment',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_fulfilment() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('fulfillment',$data);
        redirect('admin/resourceFulfilment');
//        print_r($data);die();
    }
    
    public function update_fulfilment() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'fulfillment', $data);
        redirect('admin/resourceFulfilment');
        
    }
    
    public function deleteFulfilment($id) {
        $this->admin_model->deleteInfo('fulfillment','id',$id);
        redirect('admin/resourceFulfilment');
    }
    
    
    public function resourceCallCenters() {
        $data['page_title'] = 'Call Center';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('call_center');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/call_center',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_call_center() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('call_center',$data);
        redirect('admin/resourceCallCenters');
//        print_r($data);die();
    }
    
    public function update_call_center() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'call_center', $data);
        redirect('admin/resourceCallCenters');
        
    }
    
    public function deleteCallCenter($id) {
        $this->admin_model->deleteInfo('call_center','id',$id);
        redirect('admin/resourceCallCenters');
    }
    
    public function resourceForums() {
        $data['page_title'] = 'Forums';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('forums');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/forums',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_forums() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('forums',$data);
        redirect('admin/resourceForums');
//        print_r($data);die();
    }
    
    public function update_forums() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'forums', $data);
        redirect('admin/resourceForums');
        
    }
    
    public function deleteForums($id) {
        $this->admin_model->deleteInfo('forums','id',$id);
        redirect('admin/resourceForums');
    }
    
    public function resourceBlogs() {
        $data['page_title'] = 'Blogs';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['resource_data'] = $this->admin_model->get_all_info('blogs');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/resources/blogs',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_blogs() {
        $data['url'] = $this->input->post('url');
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $this->input->post('title');
        $data['meta_description'] = $this->input->post('meta');
        $data['update_date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('blogs',$data);
        redirect('admin/resourceBlogs');
//        print_r($data);die();
    }
    
    public function update_blogs() {
        $id = $this->input->post('id');
        
        $update_date = date('Y-m-d');
        $data['url'] = $_POST['url'];
        $get_image = "https://image.thum.io/get/auth/431-publyfe/width/1000/crop/800/" . $data['url'];
        $data['zip_file_name'] = $get_image;
        $data['title'] = $_POST['title'];
        $data['meta_description'] = $_POST['meta'];
        $data['update_date'] = $update_date;
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'blogs', $data);
        redirect('admin/resourceBlogs');
        
    }
    
    public function deleteBlogs($id) {
        $this->admin_model->deleteInfo('blogs','id',$id);
        redirect('admin/resourceBlogs');
    }
    
    
    
//    Resources Ends
    
//    News Section
    
    public function news() {
        $data['page_title'] = 'News';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['news_data'] = $this->admin_model->get_all_info('news');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/news/all_news',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function save_news() {
        $data['news'] = $this->input->post('news');
        $data['date'] = date('Y-m-d');
        
        $this->admin_model->insertInfo('news',$data);
        redirect('admin/news');
    }
    
    public function update_news() {
        $id = $this->input->post('id');
        
        $data['news'] = $this->input->post('news');
        $data['date'] = date('Y-m-d');
//        $data['admin_id'] = $_SESSION['member_id'];
        $this->admin_model->updateInfo('id', $id, 'news', $data);
        redirect('admin/news');
    }
    
    public function deleteNews($id) {
        $this->admin_model->deleteInfo('news','id',$id);
        redirect('admin/news');
    }
    
//    News Section End
    
//    Sponsor Starts

    public function addSponsorMsg() {
        $data['page_title'] = 'Sponsor Message';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
        
        $data['news_data'] = $this->admin_model->get_all_info('sponsor');
//        print_r($data['network_data']);die();
        $data['admin_maincontent'] = $this->load->view('super_admin/sponsor/all_sponsor_message',$data, TRUE);
        $this->load->view('super_admin/admin_master', $data);
    }
    
    public function addSponsor() {
        $files = $_FILES;
//        echo '<pre>';print_r($files);die();
        $cpt = count($_FILES['userfile']['name']);
//        echo $cpt;die();
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name'] = uniqid() . '_' . $files['userfile']['name'][$i];
            $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
            $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

            $this->upload->initialize($this->set_upload_options());
//            $this->upload->do_upload();
            if (!$this->upload->do_upload('userfile')) {
                $error = $this->upload->display_errors();
                echo $error;
            }
            else {
                $fdata = $this->upload->data();
                $data1['sponsor_image'] = $fdata['file_name'];
            }
            $data1['sponsor_txt'] = $_POST['sponsor_txt'][$i];
            
//            echo '<pre>';print_r($data1);
            $this->admin_model->insertInfo('sponsor', $data1);
        }
        
        redirect('admin/addSponsorMsg');
//        echo '<pre>';print_r($data1);die();
    }
    
    
    public function update_sponsor() {
        $id = $this->input->post('id');
        $data['sponsor_txt'] = $this->input->post('sponsor_txt');
//        echo $sponsor_id;die();
        $files = $_FILES;
        if (empty($_FILES['sponsor_image']['name'])) {
            $data['sponsor_image'] = $this->input->post('sponsor_image1');
        } else {
            $_FILES['sponsor_image']['name'] = uniqid() . '_' . $files['sponsor_image']['name'];
            $_FILES['sponsor_image']['type'] = $files['sponsor_image']['type'];
            $_FILES['sponsor_image']['tmp_name'] = $files['sponsor_image']['tmp_name'];
            $_FILES['sponsor_image']['error'] = $files['sponsor_image']['error'];
            $_FILES['sponsor_image']['size'] = $files['sponsor_image']['size'];

            $this->upload->initialize($this->set_upload_options());
//            $this->upload->do_upload();
            if (!$this->upload->do_upload('sponsor_image')) {
                $error = $this->upload->display_errors();
                echo $error;
            }
            else {
                $fdata = $this->upload->data();
                $data['sponsor_image'] = $fdata['file_name'];
            }
        }

//        print_r($data);die();

        $this->admin_model->updateInfo('id', $id, 'sponsor', $data);
        redirect('admin/addSponsorMsg');
    }
    
    public function deleteSponsor($id) {
        $this->admin_model->deleteInfo('sponsor','id',$id);
        redirect('admin/addSponsorMsg');
    }

//    Sponsor Ends
    
    private function set_upload_options() {
        //upload an image options
//        $url = base_url();
        $config = array();
        $config['upload_path'] = 'uploads/sponsor_icon';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
//        print_r($config);die();
        return $config;
    }
    
    private function upload_options() {
        //upload an image options
//        $url = base_url();
        $config = array();
        $config['upload_path'] = 'uploads/banner_images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '0';
        $config['overwrite'] = FALSE;
//        print_r($config);die();
        return $config;
    }
    
    public function search_headline_by_country() {
        $country_id = $_POST['country_id'];
        $table = $_POST['table'];
        $link = $_POST['link'];
        
        $data['page_title'] = 'Headline';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
//        $data['all_headline'] = $this->admin_model->get_all_info('headline');
        
        $data['all_headline'] = $this->admin_model->get_headline_by_country($table,$country_id);
//        echo '<pre>';print_r($data['all_headline']);die();
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function search_headline_by_category() {
        $cat_id = $_POST['cat_id'];
        $table = $_POST['table'];
        $link = $_POST['link'];
        
        $data['page_title'] = 'Headline';
        $data['header'] = $this->load->view('admin_template/header', '', true);
        $data['headerlink'] = $this->load->view('admin_template/headerlink', $data, true);
        $data['leftnav'] = $this->load->view('admin_template/leftnav', '', true);
        $data['footer'] = $this->load->view('admin_template/footer', '', true);
        $data['footerlink'] = $this->load->view('admin_template/footerlink', '', true);
//        
        $data['all_country'] = $this->admin_model->get_all_country();
        $data['all_category'] = $this->admin_model->get_all_Active_info('category','status');
//        $data['all_headline'] = $this->admin_model->get_all_info('headline');
        
        $data['all_headline'] = $this->admin_model->get_headline_by_category($table,$cat_id);
//        echo '<pre>';print_r($data['all_headline']);die();
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
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
//        print_r($data['all_info']);die;
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbystatus(){
        $status_id = $_POST['status_id'];
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
        $data['all_info'] = $this->admin_model->get_search_by_status($table,$status_id);
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    public function searchbysize(){
        $width = $_POST['width'];
        $height = $_POST['height'];
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
        $data['all_headline'] = $this->admin_model->get_all_info('headline');
        $data['all_info'] = $this->admin_model->get_search_by_size($table,$width,$height);
        $data['all_keyword'] = $this->admin_model->get_info_by_id('keyword_tags', 'option_id', $option_id);
//        print_r($data['all_info']);die();
        $json = array();
        $json['bannerdiv'] = $this->load->view($link, $data, TRUE);
        echo json_encode($json);
    }
    
    
    public function get_url(){
        
        $url = $this->input->post('url');
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $data = curl_exec($ch);
        curl_close($ch);
        $html = $data;

//parsing begins here:
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $nodes = $doc->getElementsByTagName('title');

//get and display what you need:
        $title = $nodes->item(0)->nodeValue;

        $metas = $doc->getElementsByTagName('meta');

        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
            if ($meta->getAttribute('name') == 'description')
                $description = $meta->getAttribute('content');
            if ($meta->getAttribute('name') == 'keywords')
                $keywords = $meta->getAttribute('content');
        }

//        echo "Title: $title" . '<br/><br/>';
        echo "$description" ;
//        echo "Keywords: $keywords";
    }
    
    
    public function get_title(){
        $url = $this->input->post('url');
        $ch = curl_init();

// set url 
        curl_setopt($ch, CURLOPT_URL, $url);

//return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string 
        $output = curl_exec($ch);

        $pattern = '/[<]title[>]([^<]*)[<][\/]titl/i';

        preg_match($pattern, $output, $matches);

        print_r($matches[1]);

// close curl resource to free up system resources 
        curl_close($ch);

//        $url = $this->input->post('url');
//        $urlContents = file_get_contents($url);
//        preg_match("/<title>(.*)<\/title>/i", $urlContents, $matches);
//        
//        print($matches[1] . "\n");
    }
    
    
}
