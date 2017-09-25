<?php

class LandingModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function alllandingpage() {
        $this->db->select('');
        $this->db->from('landing_page');
        //$this->db->join('countries', 'countries.country_id = landing_page.country_id');
        //$this->db->join('category', 'category.cat_id = landing_page.cat_id');
        //$this->db->join('keyword_tags', 'keyword_tags.id = landing_page.keyword');
        $this->db->limit(2, 0);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    
     public function getlandingcomments($option_id,$addsId) {
        $this->db->select('*');
        $this->db->from('comment_tbl');
        $this->db->join('members', 'members.member_id = comment_tbl.member_id');
        $this->db->where('option_id', $option_id);
        $this->db->where('adds_id', $addsId);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    
    public function getkeywordinfo($keyword){
        $this->db->select('keyword_tags');
        $this->db->from('keyword_tags');
        $this->db->where_in('id', $keyword);
        $query = $this->db->get();
        return $query->result_array();
    }

    
    public function getcountryinfo($countryArray){
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where_in('country_id', $countryArray);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getcategoryinfo($categoryArray){
        $this->db->select('cat_name');
        $this->db->from('category');
        $this->db->where_in('cat_id', $categoryArray);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchlandingpage($data1){ 
        $keyword = $data1['keyword_tags'];
        $country = $data1['country_name'];
        $category = $data1['cat_name'];
        $sorting = $data1['sorting'];
        $this->db->select('*');
        $this->db->from('landing_page');
        if ($data1['country_name'] != '') {
            $this->db->where("landing_page.country_id LIKE '%$country%'");
        }
        if ($data1['cat_name'] != '') {
            $this->db->where("landing_page.cat_id LIKE '%$category%'");
        }
        if ($data1['keyword_tags'] != '') {
            $this->db->where("landing_page.keyword LIKE '%$keyword%'");
        }
        
        if ($data1['sorting'] != '') {
            if($sorting == 1){
                $this->db->order_by("landing_page.landing_id","desc");
            } else {
                $this->db->order_by("landing_page.landing_id","asc");
            }
            
        }

        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchlandingpageinfo($searchval){
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->limit($searchval, 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}
