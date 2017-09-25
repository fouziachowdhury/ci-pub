<?php

class BannersModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function getAllBanners() {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->join('countries', 'countries.country_id = banner.country_id');
        $this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
        $this->db->join('category', 'category.cat_id = banner.cat_id');
        $this->db->limit(8, 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getloadbanner($limit, $start) {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->join('countries', 'countries.country_id = banner.country_id');
        $this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
        $this->db->join('category', 'category.cat_id = banner.cat_id');
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
        $this->db->from('banner');
        $this->db->group_by('width', 'height');
        $query = $this->db->get();
        return $query->result_array();
        
       // $this->db->select('*');
        //$this->db->from('size_tbl');
        //$this->db->where('option_id', 1);
        //$query = $this->db->get();
        //return $query->result_array();
    }

    public function getAllTagByOptionId($option_id) {
        $this->db->select('*');
        $this->db->from('keyword_tags');
        $this->db->where('option_id', $option_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getSearchResult($data) {
        $keyword = $data['tag'];
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->join('countries', 'countries.country_id = banner.country_id');
        //$this->db->join('size_tbl', 'size_tbl.id = banner.');
        $this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
        $this->db->join('category', 'category.cat_id = banner.cat_id');
        if ($data['country'] != '') {
            $this->db->where('banner.country_id', $data['country']);
        }
        if ($data['category'] != '') {
            $this->db->where('banner.cat_id', $data['category']);
        }
        if ($data['tag'] != '') {
            $this->db->where("banner.keyword LIKE '%$keyword%'");
        }

        if ($data['width'] != '') {
            $this->db->where('banner.width', $data['width']);
        }
        if ($data['height'] != '') {
            $this->db->where('banner.height', $data['height']);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getbannermakefavorites($data) {
        $sql = "INSERT INTO make_favorite_tbl(adds_id, member_id, date) VALUES ('" . $data['adds_id'] . "', '" . $data['member_id'] . "', '" . $data['date'] . "')";
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

}
