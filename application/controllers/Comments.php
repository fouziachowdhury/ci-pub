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
        $this->load->model('MainfrontModel');
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
       // print_r($_POST);  exit;
        $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        //print_r($data);  exit;
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
            $this->session->set_flashdata('success', "Comment is add successfully");
             if( $data['option_id'] == 13){
                  redirect('landingpage');
             }
             if( $data['option_id'] == 7){
                  redirect('offerfeed');
             }
             
             if( $data['option_id'] == 6){
                  redirect('affiliatefeed');
             }
             if( $data['option_id'] == 20){
                  redirect('showaffiliatenetwork');
             }
             if( $data['option_id'] == 21){
                  redirect('showaddnetwork');
             }
             if( $data['option_id'] == 22){
                  redirect('showhosting');
             }
             if( $data['option_id'] == 23){
                  redirect('showtraking');
             }
             if( $data['option_id'] == 24){
                  redirect('showcoaching');
             }
             if( $data['option_id'] == 25){
                  redirect('showforums');
             }
             if( $data['option_id'] == 26){
                  redirect('showblogs');
             }
             
              if( $data['option_id'] == 27){
                  redirect('showforums');
             }
             
             if( $data['option_id'] == 28){
                  redirect('showblogs');
             }
        } else {
            $this->session->set_flashdata('error', "There is an error in post comment");
             if( $data['option_id'] == 13){
                  redirect('landingpage');
             }
             if( $data['option_id'] == 7){
                  redirect('offerfeed');
             }
             if( $data['option_id'] == 6){
                  redirect('affiliatefeed');
             }
             if( $data['option_id'] == 20){
                  redirect('showaffiliatenetwork');
             }
             if( $data['option_id'] == 21){
                  redirect('showaddnetwork');
             }
             if( $data['option_id'] == 22){
                  redirect('showhosting');
             }
             if( $data['option_id'] == 23){
                  redirect('showtraking');
             }
             if( $data['option_id'] == 24){
                  redirect('showcoaching');
             }
             if( $data['option_id'] == 27){
                  redirect('showforums');
             }
             if( $data['option_id'] == 28){
                  redirect('showblogs');
             }
             
        }
    }
    
    
    public function addEcoComments(){
        $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
             $this->session->set_flashdata('success', "Comment is add successfully");
             redirect('faceecomerceSec');
        } else {
             $this->session->set_flashdata('error', "There is an error in post comment");
              redirect('faceecomerceSec');
        }
    }
    public function addBannerComments(){
        //print_r($_POST);  exit;
        $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
             $this->session->set_flashdata('success', "Comment is add successfully");
             redirect('allbanners');
        } else {
             $this->session->set_flashdata('error', "There is an error in post comment");
              redirect('allbanners');
        }
    }
    
    public function addPPVComments(){
        $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
             $this->session->set_flashdata('success', "Comment is add successfully");
             redirect('ppvAddSec');
        } else {
             $this->session->set_flashdata('error', "There is an error in post comment");
              redirect('ppvAddSec');
        }
    }
    
    
    public function deleteComment(){
         $comment_id = $this->uri->segment('3');
         $redi = $this->uri->segment('2');
        $delete = $this->MainfrontModel->deleteCommentById($comment_id);
        if($delete){
             $this->session->set_flashdata('success', "Comment is deleted successfully");
             redirect($redi);
        } else {
            $this->session->set_flashdata('error', "There is an error in delete comment");
             redirect($redi);
        }
    }
    
    public function addFBComments(){
         $data['member_id'] = $_SESSION['member_id'];
        $data['comment'] = $_POST['comment'];
        $data['option_id'] = $_POST['option_id'];
        $data['adds_id'] = $_POST['adds_id'];
        $data['date'] = date('Y-m-d');
        $insert = $this->db->insert('comment_tbl', $data);
        if($insert){
             $this->session->set_flashdata('success', "Comment is add successfully");
             redirect('facebookSec');
        } else {
             $this->session->set_flashdata('error', "There is an error in post comment");
              redirect('facebookSec');
        }
    }

}
