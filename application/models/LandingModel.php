<?php

class LandingModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function alllandingpage($column_name,$limit, $start) {
        $this->db->select('*');
        $this->db->from('landing_page');
        
        $this->db->order_by($column_name, "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_landing() {
        $this->db->select('*');
        
        $this->db->from('landing_page');
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_filters($searchkey,$cat_id,$country_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        
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
        $this->db->from('landing_page');
        
        if($searchkey != NULL){
            $this->db->like('keyword',$searchkey);
        }
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        $this->db->order_by("landing_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function getlandingcomments($option_id, $addsId) {
        $this->db->select('*');
        $this->db->from('comment_tbl');
        $this->db->join('members', 'members.member_id = comment_tbl.member_id');
        $this->db->where('option_id', $option_id);
        $this->db->where('adds_id', $addsId);
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getkeywordinfo($keyword) {
        $this->db->select('keyword_tags');
        $this->db->from('keyword_tags');
        $this->db->where_in('id', $keyword);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_keyword_by_key($key,$option_id) {
        $this->db->select('keyword_tags');
        $this->db->from('keyword_tags');
        
        $this->db->where('id', $key);
        $this->db->where('option_id', $option_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getcountryinfo($countryArray) {
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where_in('country_id', $countryArray);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getcategoryinfo($categoryArray) {
        $this->db->select('cat_name');
        $this->db->from('category');
        $this->db->where_in('cat_id', $categoryArray);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getcountryimageinfo($country_id) {
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function searchlandingpage($data1) {
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
            if ($sorting == 1) {
                $this->db->order_by("landing_page.landing_id", "desc");
            } else {
                $this->db->order_by("landing_page.landing_id", "asc");
            }
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchlandingpageinfo($searchval) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->limit($searchval, 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getlandingTagsInfoForAutocomplete($q, $option_id) {
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

    public function searchlandingpageinfobykey($searchKey) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->join('keyword_tags', 'keyword_tags.id = landing_page.keyword');
        $this->db->where('keyword_tags.keyword_tags', $searchKey);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_favorites_landing($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = landing_page.landing_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchlandingpageinfobymyfav($limit, $start,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = landing_page.landing_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        
        $this->db->order_by("landing_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_comments_landing($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = landing_page.landing_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchlandingpageinfobymycom($limit, $start,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = landing_page.landing_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        
        $this->db->group_by('landing_page.landing_id');
        $this->db->order_by("landing_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getdownloadinfo($item_id, $member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('downloadcount');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', $option_id);
        $this->db->where('item_id', $item_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function downloadsettings() {
        $this->db->select('*');
        $this->db->from('landing_page_setting');
        $query = $this->db->get();
        return $query->row();
    }

    public function getbanINfoById($item_id) {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('banner_id', $item_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function checkdownloadcountrow($item_id, $member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('downloadcount');
        $this->db->where('item_id', $item_id);
        $this->db->where('option_id', $option_id);
        $this->db->where('member_id', $member_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->row();
    }

    public function adddownloadcount($item_id, $member_id, $option_id) {
        $this->db->set('member_id', $member_id);
        $this->db->set('count', 1);
        $this->db->set('item_id', $item_id);
        $this->db->set('option_id', $option_id);
        $this->db->insert('downloadcount');
    }

    public function updatedownloadcount($id) {
        $this->db->set('count', 'count+1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('downloadcount');
    }
    
    public function count_all_landing_by_cat($cat_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->like('cat_id', $cat_id);
//        $this->db->where('cat_id',$cat_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_landing_by_cat_id($limit, $start, $cat_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->like('cat_id', $cat_id);
//        $this->db->where('cat_id',$cat_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function count_all_landing_by_country($country_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->like('country_id', $country_id);
//        $this->db->where('country_id',$country_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_landing_by_country_id($limit, $start, $country_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->like('country_id', $country_id);
//        $this->db->where('country_id',$country_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_landing_by_keyword($tag_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->like('keyword', $tag_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_landing_by_keyword_id($limit, $start, $tag_id) {
        $this->db->select('*');
        $this->db->from('landing_page');
        $this->db->like('keyword', $tag_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

}
