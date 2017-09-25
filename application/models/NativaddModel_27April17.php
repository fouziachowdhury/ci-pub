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

    public function getAllnativadds() {
        $this->db->select('*');
        $this->db->from('native_ads');
        $this->db->join('headline', 'headline.headline_id = native_ads.headline');
        $this->db->join('countries', 'countries.country_id = native_ads.country_id');
        $this->db->join('category', 'category.cat_id = native_ads.cat_id');
        $this->db->limit(8, 1);
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

}
