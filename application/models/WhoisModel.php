<?php

class WhoisModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getwhoisinfoG() {
        $this->db->select('*');
        $this->db->from('whois_setting');
        $this->db->where('option_id', 9);
        $query = $this->db->get();
        return $query->row();
    }

    public function getwhoisinfoS(){
       $this->db->select('*');
       $this->db->from('whois_setting');
       $this->db->where('option_id', 8);
        $query = $this->db->get();
        return $query->row();
   }
   
    public function getwhoisinfoP(){
       $this->db->select('*');
       $this->db->from('whois_setting');
       $this->db->where('option_id', 10);
        $query = $this->db->get();
        return $query->row();
   }
    
    public function updatememberstatus($m_email){
        $this->db->set('status', 1);
        $this->db->where('email', $m_email);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatememberstatusinactive($m_email){
        $this->db->set('status', 0);
        $this->db->where('email', $m_email);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_info_by_id($table,$column_name,$id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column_name,$id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_whois_count($table,$option_id,$member_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->where('option_id', $option_id);
        $this->db->where('member_id', $member_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function insertInfo($table,$data) {
        $this->db->insert($table,$data);
    }
    
    public function get_count($table,$column_name,$option_id,$member_id) {
        $this->db->select($column_name);
        $this->db->from($table);
        
        $this->db->where('option_id', $option_id);
        $this->db->where('member_id', $member_id);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    public function update_count($table,$column_name,$column_value,$option_id,$member_id) {
        $this->db->set($column_name,$column_value);
        $this->db->where('option_id', $option_id);
        $this->db->where('member_id', $member_id);
        $this->db->update($table);
    }

}
