<?php

class NativaddModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getcomments() {
        $this->db->select('*');
        $this->db->from('comment_tbl');
        $this->db->join('members', 'members.member_id = comment_tbl.member_id');
        $this->db->where('option_id', 2);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_native(){
         $this->db->select('*');
        $this->db->from('native_ads');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getAllnativadds($column_name,$limit, $start) {
        $this->db->select('*');
        $this->db->from('native_ads');
        
        $this->db->order_by($column_name, "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_filters_native($searchkey,$cat_id,$country_id,$width,$height) {
        $this->db->select('*');
        $this->db->from('native_ads');
        
        if($searchkey != NULL){
            $this->db->like('keyword',$searchkey);
        }
        
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        
        if($width != NULL){
            $this->db->where('width', $width);
        }
        
        if($height != NULL){
            $this->db->where('height', $height);
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function search_all_filter_data($limit, $start,$searchkey,$cat_id,$country_id,$width,$height) {
        $this->db->select('*');
        $this->db->from('native_ads');
        
        if($searchkey != NULL){
            $this->db->like('keyword',$searchkey);
        }
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        
        if($width != NULL){
            $this->db->where('width',$width);
        }
        if($height != NULL){
            $this->db->where('height',$height);
        }
        
        $this->db->order_by("native_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getoptionid() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->where('option_name', 'Native Ads');
        $query = $this->db->get();
        return $query->row();
    }

    public function getfavaddsinfo($member_id) {
        $this->db->select('adds_id');
        $this->db->from('make_favorite_tbl');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', 2);
        $query = $this->db->get();
        $res = $query->result_array();
        $rrr = array();
        foreach ($res as $resss) {
            $rrr[] = $resss['adds_id'];
        }
        return $rrr;
    }

    public function getaddsmakefavorites($data) {
        $sql = "INSERT INTO make_favorite_tbl(adds_id, member_id, date, option_id) VALUES ('" . $data['adds_id'] . "', '" . $data['member_id'] . "', '" . $data['date'] . "', '" . $data['option_id'] . "')";
        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function getloadnativadds($limit, $start) {
        $this->db->select('*');
        $this->db->from('native_ads');
        $this->db->join('headline', 'headline.headline_id = native_ads.headline');
        $this->db->join('countries', 'countries.country_id = native_ads.country_id');
        $this->db->join('category', 'category.cat_id = native_ads.cat_id');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllSize() {
        $this->db->select('width, height');
        $this->db->from('native_ads');
        $this->db->group_by('width', 'height');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSearchResult($data) {
        $keyword = $data['tag'];
        $this->db->select('*');
         $this->db->from('native_ads');
        $this->db->join('headline', 'headline.headline_id = native_ads.headline');
        $this->db->join('countries', 'countries.country_id = native_ads.country_id');
        $this->db->join('category', 'category.cat_id = native_ads.cat_id');
        if($data['country'] !=''){
        $this->db->where('native_ads.country_id', $data['country']);
        } 
        if($data['category'] !=''){
        $this->db->where('native_ads.cat_id', $data['category']);
        }
        if($data['tag'] !=''){
        $this->db->where("native_ads.keyword LIKE '%$keyword%'");
        //$this->db->where_in('native_ads.keyword', $data['tag']);
        }
        if($data['width'] !=''){
        $this->db->where('native_ads.width', $data['width']);
        }
        if($data['height'] !=''){
        $this->db->where('native_ads.height', $data['height']);
        }
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }
    public function getHeading($heidingArray){
         $this->db->select('*');
        $this->db->from('headline');
        $this->db->where_in('headline_id', $heidingArray);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchnativpageinfobymyfav($limit, $start,$member_id, $option_id){
        $this->db->select('*');
        $this->db->from('native_ads');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = native_ads.native_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        
        $this->db->order_by("native_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_favorites_native($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('native_ads');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = native_ads.native_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function searchnativpageinfobymycom($limit, $start,$member_id, $option_id){
        $this->db->select('*');
        $this->db->from('native_ads');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = native_ads.native_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        
        $this->db->group_by('native_ads.native_id');
        $this->db->order_by("native_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function count_all_comments_native($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('native_ads');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = native_ads.native_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $this->db->group_by('native_ads.native_id');
                
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function getnativTagsInfoForAutocomplete($q, $option_id) {
        $this->db->select('*');
        $this->db->from('keyword_tags');
        $this->db->where('option_id', $option_id);
        $this->db->like('keyword_tags', $q);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['keyword_tags']));
                $new_row['value'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row;
            }
              return $row_set;
        }
      
    }
    
    public function searchnativpageinfobykey($searchKey){
        $this->db->select('*');
        $this->db->from('native_ads');
        $this->db->join('keyword_tags', 'keyword_tags.id = native_ads.keyword');
        $this->db->where('keyword_tags.keyword_tags',$searchKey);
        $query = $this->db->get();
        return $query->result_array();
    }
}