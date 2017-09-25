<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('BannersModel');
    }

   public function addComments(){
        //print_r($_POST);  exit;
        $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
             $this->session->set_flashdata('success', "Comment is add successfully");
             redirect('netivAddSec');
        } else {
             $this->session->set_flashdata('error', "There is an error in post comment");
              redirect('netivAddSec');
        }
    }
    
    
    public function addLandingComments(){
        //print_r($_POST);  exit;
        $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
             $this->session->set_flashdata('success', "Comment is add successfully");
             redirect('landingpage');
        } else {
             $this->session->set_flashdata('error', "There is an error in post comment");
              redirect('landingpage');
        }
    }

}
