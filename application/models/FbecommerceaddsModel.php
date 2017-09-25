<?php

class FbecommerceaddsModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getAllBanners() {
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        $this->db->limit(8, 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_fbeco(){
        $this->db->select('*');
        
        $this->db->from('facebook_ecommerce_ads');
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_filters_fbeco($searchkey,$cat_id,$country_id) {
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        if($searchkey != NULL){
            $this->db->like('keyword',$searchkey);
        }
        
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function search_all_filter_data($limit, $start,$searchkey,$cat_id,$country_id) {
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        if($searchkey != NULL){
            $this->db->like('keyword',$searchkey);
        }
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        
        $this->db->order_by("fb_ecom_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_favorites_facebook_ecom($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = facebook_ecommerce_ads.fb_ecom_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }
    
     public function searchfbpageinfobymyfav($limit, $start,$member_id, $option_id){
         $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = facebook_ecommerce_ads.fb_ecom_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        
        $this->db->order_by("fb_ecom_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function count_all_comments_facebook($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = facebook_ecommerce_ads.fb_ecom_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $this->db->group_by('facebook_ecommerce_ads.fb_ecom_id');        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function searchfbpageinfobymycom($limit, $start,$member_id, $option_id){
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = facebook_ecommerce_ads.fb_ecom_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $this->db->group_by('facebook_ecommerce_ads.fb_ecom_id');
        
        $this->db->order_by("fb_ecom_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function getloadfbecom($column_name,$limit, $start) { 
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        
        $this->db->order_by($column_name, "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllCountry() {
        $this->db->select('*');
        $this->db->from('countries');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllCat() {
        $this->db->select('*');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllSize() {
        $this->db->select('width, height');
        $this->db->from('facebook_ecommerce_ads');
        $this->db->group_by('width', 'height');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function getAllTagByOptionId($option_id) {
        $this->db->select('*');
        $this->db->from('keyword_tags');
        $this->db->where('option_id', $option_id);
        $query = $this->db->get();
        return $query->result_array();
    }


     public function getbannermakefavorites($data) {
        $sql = "INSERT INTO make_favorite_tbl(adds_id, member_id, date, option_id) VALUES ('" . $data['adds_id'] . "', '" . $data['member_id'] . "', '" . $data['date'] . "', '".$data['option_id']."')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getfavbaninfo($member_id) {
        $this->db->select('adds_id');
        $this->db->from('make_favorite_tbl');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', 4);
        $query = $this->db->get();
        $res = $query->result_array();
        $rrr = array();
        foreach ($res as $resss) {
            $rrr[] = $resss['adds_id'];
        }
        return $rrr;
    }

    public function getoptionid() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->where('option_name', 'Banner Ads');
        $query = $this->db->get();
        return $query->row();
    }

    public function getbanTagsInfoForAutocomplete($q, $option_id) {
        $this->db->select('*');
        $this->db->from('keyword_tags');
        $this->db->where('option_id', $option_id);
        $this->db->like('keyword_tags', $q);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['keyword_tags']));
                $new_row['value'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row;
            }
              return $row_set;
        }
      
    }
    
    public function getbannercomments($option_id, $addsId){
        $this->db->select('*');
        $this->db->from('comment_tbl');
        $this->db->join('members', 'members.member_id = comment_tbl.member_id');
        $this->db->where('option_id', $option_id);
        $this->db->where('adds_id', $addsId);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchbannerpageinfo($searchval){
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
         $this->db->join('countries', 'countries.country_id = banner.country_id');
        $this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
        $this->db->join('category', 'category.cat_id = banner.cat_id');
        $this->db->limit($searchval, 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchbannerpageinfobykey($searchKey){
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        $this->db->join('keyword_tags', 'keyword_tags.id = facebook_ecommerce_ads.keyword');
        $this->db->where('keyword_tags.keyword_tags',$searchKey);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchfbecopageinfobycat($cat_id){
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        $this->db->where('cat_id',$cat_id);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    public function searchbannerpageinfobycountryid($country_id){
        $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        $this->db->where('country_id',$country_id);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    public function searchbannerpageinfobysize($width,$height){
         $this->db->select('*');
        $this->db->from('facebook_ecommerce_ads');
        $this->db->where('width',$width);
        $this->db->where('height',$height);
        $query = $this->db->get(); 
        return $query->result_array();
    }
}
