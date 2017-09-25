<?php

class MainfrontModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getuserpageviewcountdata($member_id, $page_id) {
        $this->db->select('count');
        $this->db->from('pageviewcount');
        $this->db->where('member_id', $member_id);
        $this->db->where('page_id', $page_id);
        $query = $this->db->get();
        $res = $query->num_rows(); 
            return $res;
    }

    public function updatepageview($member_id, $page_id) {
        $this->db->set('count', 'count+1', FALSE);
        $this->db->where('member_id', $member_id);
        $this->db->where('page_id', $page_id);
        $this->db->update('pageviewcount');
    }
    
     public function getallcountryinfo(){
        $this->db->select('*');
        $this->db->from('countries');
        $query = $this->db->get();
         return $query->result_array();
    }
    
     public function getviewaccess($page_id) {
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('option_id', $page_id);
        $query = $this->db->get();
        return $query->row();
    }


 public function getviewaccesslanding($page_id){
        $this->db->select('*');
        $this->db->from('landing_page_setting');
        $query = $this->db->get();
        return $query->row();
    }


public function getuserpageviewcountinfo($member_id, $page_id) {
        $this->db->select('count');
        $this->db->from('pageviewcount');
        $this->db->where('member_id', $member_id);
        $this->db->where('page_id', $page_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function deleteCommentById($comment_id){
        $this->db->where('comment_id', $comment_id);
        $comdel = $this->db->delete('comment_tbl');
        if($comdel){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
