<?php

class LandingModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function alllandingpage() {
        $this->db->select('');
        $this->db->from('landing_page');
        $this->db->join('countries', 'countries.country_id = landing_page.country_id');
        $this->db->join('category', 'category.cat_id = landing_page.cat_id');
        $this->db->join('keyword_tags', 'keyword_tags.id = landing_page.keyword');
        $query = $this->db->get();
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

}
