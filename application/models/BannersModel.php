<?php

class BannersModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }
    
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('banner');
        
        
        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        //get records
        $query = $this->db->get();
        //return fetched data
        return ($query->num_rows() > 0)?$query->result_array():FALSE;
    }

    public function getAllBanners() {
        $this->db->select('*');
        $this->db->from('banner');
        //$this->db->join('countries', 'countries.country_id = banner.country_id');
       /// $this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
        //$this->db->join('category', 'category.cat_id = banner.cat_id');
        $this->db->limit(8, 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_all_banners(){
        $this->db->select('*');
        $this->db->from('banner');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_filters_banner($searchkey,$cat_id,$country_id,$width,$height) {
        $this->db->select('*');
        $this->db->from('banner');
        
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
    
    public function getloadbanner($column_name,$limit, $start) { 
        $this->db->select('*');
        $this->db->from('banner');
       // $this->db->join('countries', 'countries.country_id = banner.country_id');
        //$this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
        //$this->db->join('category', 'category.cat_id = banner.cat_id');
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
        //echo $this->db->last_query(); exit;
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

     public function getbannermakefavorites($data) { //echo "INSERT INTO make_favorite_tbl(adds_id, member_id, date, option_id) VALUES ('" . $data['adds_id'] . "', '" . $data['member_id'] . "', '" . $data['date'] . "', '".$data['option_id']."')"; exit;
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

    public function getbanTagsInfoForAutocomplete($q, $option_id) {
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
    
    public function getbannercomments($option_id, $addsId, $member_id){
        $this->db->select('*');
        $this->db->from('comment_tbl');
        $this->db->join('members', 'members.member_id = comment_tbl.member_id');
        $this->db->where('comment_tbl.option_id', $option_id);
        $this->db->where('comment_tbl.adds_id', $addsId);
        $this->db->where('comment_tbl.member_id', $member_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchbannerpageinfo($limit, $start,$searchkey,$cat_id,$country_id,$width,$height){
        $this->db->select('*');
        $this->db->from('banner');
        
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
//        $this->db->join('countries', 'countries.country_id = banner.country_id');
//        $this->db->join('keyword_tags', 'keyword_tags.id = banner.keyword');
//        $this->db->join('category', 'category.cat_id = banner.cat_id');

        $this->db->order_by("banner_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_keyword_banner($searchKey,$cat_id,$country_id,$width,$height) {
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->like('keyword',$searchKey);
        
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
    
    public function searchbannerpageinfobykey($limit, $start,$searchKey,$cat_id,$country_id,$width,$height){
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->like('keyword',$searchKey);
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
        
        $this->db->order_by("banner_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function get_all_filter_banner($limit, $start,$searchKey,$cat_id,$country_id,$width,$height) {
        $this->db->select('*');
        $this->db->from('banner');
        
        if($searchKey != NULL){
            $this->db->like('keyword',$searchKey);
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
        
        $this->db->order_by("banner_id", "DESC");
        $this->db->limit($limit, $start);
//        if($country_id != NULL){
//            $this->db->where('country_id',$country_id);
//        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchbannerpageinfobycat($limit, $start,$searchKey,$cat_id,$country_id,$width,$height){
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->like('cat_id',$cat_id);
        if($searchKey != NULL){
            $this->db->like('keyword',$searchKey);
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
        
        $this->db->order_by("banner_id", "DESC");
        $this->db->limit($limit, $start);
//        if($country_id != NULL){
//            $this->db->where('country_id',$country_id);
//        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function searchbannerpageinfobycountryid($country_id,$cat_id,$width,$height){
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->like('country_id',$country_id);
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        
        if($width != NULL){
            $this->db->where('width',$width);
        }
        if($height != NULL){
            $this->db->where('height',$height);
        }
//        $this->db->where('country_id',$country_id);
//        if($cat_id != NULL){
//            $this->db->where('cat_id',$cat_id);
//        }
        
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    public function searchbannerpageinfobysize($width,$height,$cat_id,$country_id){
         $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->where('width',$width);
        $this->db->where('height',$height);
        
        if($cat_id != NULL){
            $this->db->like('cat_id',$cat_id);
        }
        if($country_id != NULL){
            $this->db->like('country_id',$country_id);
        }
        
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
     public function count_all_fav_banners($member_id) {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = banner.banner_id');
        $this->db->where('make_favorite_tbl.option_id', 1);
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getfavbannerbyuser($limit, $start, $member_id) {
        $this->db->select('*');
        $this->db->from('banner');
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = banner.banner_id');
        $this->db->where('make_favorite_tbl.option_id', 1);
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function count_all_favorites_banner($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = banner.banner_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
                
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchbannerpageinfobymyfav($limit, $start,$member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->join('make_favorite_tbl', 'make_favorite_tbl.adds_id = banner.banner_id');
        $this->db->where('make_favorite_tbl.member_id', $member_id);
        $this->db->where('make_favorite_tbl.option_id', $option_id);
        
        $this->db->order_by("banner_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function count_all_comments_banner($member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = banner.banner_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        $this->db->group_by('banner.banner_id');
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function searchbannerpageinfobymycom($limit, $start, $member_id, $option_id) {
        $this->db->select('*');
        $this->db->from('banner');
        
        $this->db->join('comment_tbl', 'comment_tbl.adds_id = banner.banner_id');
        $this->db->where('comment_tbl.member_id', $member_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        
        $this->db->group_by('banner.banner_id');
        $this->db->order_by("banner_id", "DESC");
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
    public function getdownloadinfo($item_id,$member_id,$option_id){
        $this->db->select('*');
        $this->db->from('downloadcount');
        $this->db->where('member_id', $member_id);
        $this->db->where('option_id', $option_id);
        $this->db->where('item_id', $item_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function downloadsettings($option_id){
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('option_id', $option_id);
         $query = $this->db->get();
           return $query->row();
    }
    
    public function getbanINfoById($item_id){
         $this->db->select('*');
        $this->db->from('banner');
        $this->db->where('banner_id', $item_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    
    public function checkdownloadcountrow($item_id,$member_id,$option_id){
        $this->db->select('*');
        $this->db->from('downloadcount');
        $this->db->where('item_id',$item_id);
        $this->db->where('option_id',$option_id);
        $this->db->where('member_id',$member_id);
        $query = $this->db->get();
         return $query->row();
    }
    
    public function adddownloadcount($item_id,$member_id,$option_id){
        $this->db->set('member_id',$member_id);
        $this->db->set('count',1);
        $this->db->set('item_id',$item_id);
        $this->db->set('option_id',$option_id);
        $this->db->insert('downloadcount');
        echo $this->db->last_query();
    }
    
    public function updatedownloadcount($id){
        $this->db->set('count','count+1', FALSE);
        $this->db->where('id',$id);
        $this->db->update('downloadcount');
        echo $this->db->last_query();
    }
}
