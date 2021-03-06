<?php

class PpvModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getAllBanners() {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->limit(8, 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_ppv(){
        $this->db->select('*');
        $this->db->from('ppv');
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function getloadppv($limit, $start) { 
        $this->db->select('*');
        $this->db->from('ppv');
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
        $this->db->where('option_id', 1);
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

    public function getppvTagsInfoForAutocomplete($q, $option_id) {
        $this->db->select('*');
        $this->db->from('keyword_tags');
        $this->db->where('option_id', $option_id);
        $this->db->like('keyword_tags', $q);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['label'] = htmlentities(stripslashes($row['keyword_tags']));
                $new_row['value'] = htmlentities(stripslashes($row['keyword_tags']));
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
        $this->db->from('ppv');
        $this->db->limit($searchval, 0);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchppvpageinfobykey($searchKey){
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->join('keyword_tags', 'keyword_tags.id = ppv.keyword');
        $this->db->like('keyword_tags.keyword_tags',$searchKey);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchppvpageinfobycat($cat_id){
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->where('cat_id',$cat_id);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    public function searchppvpageinfobycountryid($country_id){
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('country_id',$country_id);
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    public function searchppvpageinfobymyfav($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = ppv.ppv_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }

    public function searchppvpageinfobymycom($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = ppv.ppv_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function count_all_ppv_by_cat($cat_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('cat_id', $cat_id);
//        $this->db->where('cat_id',$cat_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_ppv_by_cat_id($limit, $start, $cat_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('cat_id', $cat_id);
//        $this->db->where('cat_id',$cat_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_ppv_by_country($country_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('country_id', $country_id);
//        $this->db->where('country_id',$country_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_ppv_by_country_id($limit, $start, $country_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('country_id', $country_id);
//        $this->db->where('country_id',$country_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_ppv_by_keyword($tag_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('keyword', $tag_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_ppv_by_keyword_id($limit, $start, $tag_id) {
        $this->db->select('*');
        $this->db->from('ppv');
        $this->db->like('keyword', $tag_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
}
