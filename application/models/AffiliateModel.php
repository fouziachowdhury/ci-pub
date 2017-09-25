<?php

class AffiliateModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getaffiliatecomments() {
        $this->db->select('*');
        $this->db->from('comment_tbl');
        $this->db->join('members', 'members.member_id = comment_tbl.member_id');
        $this->db->where('option_id', 7);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getfavafflibaninfo($member_id) {
        $this->db->select('adds_id');
        $this->db->from('make_favorite_tbl');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', 6);
        $query = $this->db->get();
        $res = $query->result_array();
        $rrr = array();
        foreach ($res as $resss) {
            $rrr[] = $resss['adds_id'];
        }
        return $rrr;
    }
    
    public function getfavaofferinfo($member_id){
        $this->db->select('adds_id');
        $this->db->from('make_favorite_tbl');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', 7);
        $query = $this->db->get();
        $res = $query->result_array();
        $rrr = array();
        foreach ($res as $resss) {
            $rrr[] = $resss['adds_id'];
        }
        return $rrr;
    }

    public function getfavouriteinfo($member_id, $option_id) {
        $this->db->select('adds_id');
        $this->db->from('make_favorite_tbl');
        
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', $option_id);
        
        $query = $this->db->get();
        $res = $query->result_array();
        $rrr = array();
        foreach ($res as $resss) {
            $rrr[] = $resss['adds_id'];
        }
        return $rrr;
    }

    public function getAllAffiliateFeedInfo($limit, $start) {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_affiFeed() {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchafffeedpageinfobymyfav($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = affiliate_landing_page.id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }

    public function searchafffeedpageinfobymycom($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = affiliate_landing_page.id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }

    public function searchafffeedpageinfobycat($cat_id) {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchafffeedpageinfobycountryid($country_id) {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchafffeedpageinfo($searchval) {
        $this->db->select('*');
        $this->db->from('affiliate_landing_page');
        $this->db->limit($searchval, 0);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getafffeedTagsInfoForAutocomplete($q, $option_id) {
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

    public function searchafffeedpageinfobykey($searchKey) {
        $this->db->select('id');
        $this->db->from('keyword_tags');
        $this->db->where('keyword_tags', $searchKey);
        $query = $this->db->get();
        $key = $query->row();
        $keyword = $key->id;
        if ($keyword) {
            $this->db->select('*');
            $this->db->from('affiliate_landing_page');
            $this->db->like('keyword', $keyword);
            $query1 = $this->db->get();
            return $query1->result_array();
        }
    }

    public function count_all_offerFeed() {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_data($table) {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_filters($table,$searchkey,$cat_id,$country_id) {
        $this->db->select('*');
        $this->db->from($table);
        
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
    
    public function search_all_filter_data($table,$limit, $start,$searchkey,$cat_id,$country_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        if($searchkey != NULL){
            $this->db->like('keyword',$searchkey);
        }
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        
        $this->db->order_by('id', "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_favorites_data($table,$member_id, $option_id) {
        $this->db->select($table.'.*,make_favorite_tbl.adds_id,member_id,option_id');
        $this->db->from($table);
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = '.$table.'.id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchinfobymyfav($table,$limit, $start,$member_id, $option_id) {
        $this->db->select($table.'.*,make_favorite_tbl.adds_id,member_id,option_id');
        $this->db->from($table);
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = '.$table.'.id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        
        $this->db->order_by($table.'.id', "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_comments_data($table,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = '.$table.'.id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $this->db->group_by($table.'.id');
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchinfobymycom($table,$limit, $start,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = '.$table.'.id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        
        $this->db->group_by($table.'.id');
        $this->db->order_by($table.'.id', "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAllOfferFeedInfo($table,$limit, $start) {
        $this->db->select('*');
        $this->db->from($table);
        
        $this->db->order_by('id', "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchofferpageinfobymyfav($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = advertise_offer_feed.id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }

    public function searchofferpageinfobymycom($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = advertise_offer_feed.id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }

    public function searchofferpageinfobycat($cat_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->where('cat_id', $cat_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchofferpageinfobycountryid($country_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchofferpageinfo($searchval) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->limit($searchval, 0);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getofferTagsInfoForAutocomplete($q, $option_id) {
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

    public function searchofferpageinfobykey($searchKey) {
        $this->db->select('id');
        $this->db->from('keyword_tags');
        $this->db->where('keyword_tags', $searchKey);
        $query = $this->db->get();
        $key = $query->row();
        $keyword = $key->id;
        if ($keyword) {
            $this->db->select('*');
            $this->db->from('advertise_offer_feed');
            $this->db->like('keyword', $keyword);
            $query1 = $this->db->get();
            return $query1->result_array();
        }
    }
    
    
    public function count_all_offer_by_cat($cat_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->like('cat_id', $cat_id);
//        $this->db->where('cat_id',$cat_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_offer_by_cat_id($limit, $start, $cat_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->like('cat_id', $cat_id);
//        $this->db->where('cat_id',$cat_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function count_all_offer_by_country($country_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->like('country_id', $country_id);
//        $this->db->where('country_id',$country_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_offer_by_country_id($limit, $start, $country_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->like('country_id', $country_id);
//        $this->db->where('country_id',$country_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_offer_by_keyword($tag_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->like('keyword', $tag_id);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function all_offer_by_keyword_id($limit, $start, $tag_id) {
        $this->db->select('*');
        $this->db->from('advertise_offer_feed');
        $this->db->like('keyword', $tag_id);
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_trial_package($member_id,$package_id){
        $this->db->where('member_id', $member_id);
        $this->db->where('package_id', $package_id);
        $this->db->group_by('package_id');
        $this->db->from("access");
        return $this->db->count_all_results();
    }
    
    public function deleteInfo($tableName,$columnName,$id) {
        $this->db->where($columnName, $id);
        $this->db->delete($tableName);
    }

}
