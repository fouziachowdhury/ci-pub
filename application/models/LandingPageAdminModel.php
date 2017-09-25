<?php

class LandingPageAdminModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getallcountry() {
        $this->db->select('*');
        $this->db->from('countries');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getlandingpagesettinginfo() {
        $this->db->select('*');
        $this->db->from('landing_page_setting');
        $query = $this->db->get();
        return $query->row();
    }

    public function updatesettinginfo($data) {
        $this->db->set('mothly_membership_price', $data['mothly_membership_price']);
        $this->db->set('view_page_count', $data['view_page_count']);
        $this->db->set('download_count', $data['download_count']);
        $this->db->set('update_date', $data['update_date']);
        $this->db->set('admin_id', $data['admin_id']);
        $this->db->where('id', 1);
        $query = $this->db->update('landing_page_setting');
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getalllandingpage() {
        $this->db->select('*');
        $this->db->from('landing_page');
        //$this->db->join('category', 'category.cat_id = landing_page.cat_id');
        //$this->db->join('countries', 'countries.country_id = landing_page.country_id');
        //$this->db->join('keyword_tags', 'keyword_tags.id = landing_page.keyword');
        $this->db->order_by('landing_id','DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function geteditedlandingpageinfo($landing_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->join('category', 'category.cat_id = landing_page.cat_id','LEFT');
        $this->db->join('countries', 'countries.country_id = landing_page.country_id','LEFT');
        $this->db->join('keyword_tags', 'keyword_tags.id = landing_page.keyword','LEFT');
        $this->db->where('landing_page.landing_id', $landing_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getallcategories() {
        $this->db->select('*');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updatelandingeditinfoinfo($data) {
        $this->db->set('url', $data['url']);
        $this->db->set('title', $data['title']);
        $this->db->set('zip_file', $data['zip_file']);
        $this->db->set('cat_id', $data['cat_id']);
        $this->db->set('country_id', $data['country_id']);
        $this->db->set('keyword', $data['keyword']);
        $this->db->where('landing_id', $data['landing_page_id']);
        $query = $this->db->update('landing_page');
        if ($query) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getkeywordid($keyword) {
        $option_id = 5; 
        $this->db->select('id');
        $this->db->from('keyword_tags');
        $this->db->where_in('keyword_tags', $keyword);
        $query = $this->db->get();
        if (!empty($query->row())) { 
            return $query->row();
        } else {  
            foreach($keyword as $key){
            $sql = "INSERT INTO keyword_tags(keyword_tags, option_id) VALUES ('" . $key . "', '" . $option_id . "')";
            $query_result = $this->db->query($sql);
            $key_id[] = $this->db->insert_id();
            }
            return $key_id; 
            
        }
    }
    
    public function insertlandingpage($data){
        $sql = "INSERT INTO landing_page(title,zip_file, url, cat_id, country_id, keyword, zip_file_name) VALUES ('" . $data['title'] . "','" . $data['zip_file'] . "','" . $data['url'] . "', '" . $data['cat_id'] . "', '" . $data['country_id'] . "', '" . $data['keyword'] . "', '" . $data['zip_file_name'] . "')";
            $query_result = $this->db->query($sql);
            if ($query_result === TRUE) {
                return true;
            } else {
                return false;
            }
    }
    
    public function checkurl($url) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->where('url', $url);
         $query = $this->db->get();
          if ($query->result_array()){
              return TRUE;
          }else {
              return FALSE;
          }
    }
    
    public function data_by_url($url) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->where('url', $url);
        
        $query = $this->db->get();
        return $query->result_array();
    }

}
