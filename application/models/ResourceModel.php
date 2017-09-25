<?php

class ResourceModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }


    public function count_all_resource($table){
        $this->db->select('*');
        $this->db->from($table);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getloadaffiliatenetwork($table,$limit, $start) {
        $this->db->select('*');
        $this->db->from($table);
        
        
        if($table == "resources_tbl"){
            $this->db->order_by('resource_id', "DESC");
        }else{
            $this->db->order_by('id', "DESC");
        }
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getloadhostingrsc($limit, $start) {
        $this->db->select('*');
        $this->db->from('hosting');
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_filters($table,$searchkey) {
        $this->db->select('*');
        $this->db->from($table);
        
        if($searchkey != NULL){
            $this->db->like('title',$searchkey);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_network_filters($searchkey) {
        $this->db->select('*');
        $this->db->from('ad_networks');
        
        if($searchkey != NULL){
            $this->db->like('title',$searchkey);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function search_all_filter_data($table,$limit, $start,$searchkey) {
        $this->db->select('*');
        $this->db->from($table);
        
        if($searchkey != NULL){
            $this->db->like('title',$searchkey);
        }
        
        if($table == "resources_tbl"){
            $this->db->order_by('resource_id', "DESC");
        }else{
            $this->db->order_by('id', "DESC");
        }
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function search_all_network_filter_data($limit, $start,$searchkey) {
        $this->db->select('*');
        $this->db->from('ad_networks');
        
        if($searchkey != NULL){
            $this->db->like('title',$searchkey);
        }
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_info_by_search_key($table,$q) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->like('title', $q);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['title']));
                $new_row['value'] = htmlentities(stripslashes($row['title']));
                $row_set[] = $new_row;
            }
            return $row_set;
        }
    }
    
    public function count_all_favorites_data($table,$col_name,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = '.$table.'.'.$col_name);
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchpageinfobymyfav($table,$col_name,$limit, $start,$member_id, $option_id) {
        $this->db->select($table.'.*,make_favorite_tbl.adds_id,make_favorite_tbl.option_id');
        $this->db->from($table);
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = '.$table.'.'.$col_name);
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        
        if($table == "resources_tbl"){
            $this->db->order_by('resource_id', "DESC");
        }else{
            $this->db->order_by('id', "DESC");
        }
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }
    
    public function count_all_comments_data($table,$col_name,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = '.$table.'.'.$col_name);
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchpageinfobymycom($table,$col_name,$limit, $start,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = '.$table.'.'.$col_name);
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        
        if($table == "resources_tbl"){
            $this->db->group_by('resource_id');
            $this->db->order_by('resource_id', "DESC");
        }else{
            $this->db->group_by('id');
            $this->db->order_by('id', "DESC");
        }
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getfavafflires($member_id, $option_id) {
        $this->db->select('adds_id');
        $this->db->from('make_favorite_tbl');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $res = $query->result_array();
        $rrr = array();
        foreach ($res as $resss) {
            $rrr[] = $resss['adds_id'];
        }
        return $rrr;
    }


    
     public function getloadaddsnetwork($limit, $start) {
        $this->db->select('*');
        $this->db->from('ad_networks');
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function getloadhosting(){
        $this->db->select('*');
        $this->db->from('hosting');
        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function getloadtraking(){
        $this->db->select('*');
        $this->db->from('tracking');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    
    public function getloadforums(){
        $this->db->select('*');
        $this->db->from('forums');
        $query = $this->db->get();
        return $query->result_array();
    }
    

    
    public function getloadblogs(){
        $this->db->select('*');
        $this->db->from('blogs');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function getloadcoaching(){
        $this->db->select('*');
        $this->db->from('coaching');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getresourcemakefavorites($data){
        $sql = "INSERT INTO make_favorite_tbl(adds_id, member_id, date, option_id) VALUES ('" . $data['adds_id'] . "', '" . $data['member_id'] . "', '" . $data['date'] . "', '".$data['option_id']."')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
