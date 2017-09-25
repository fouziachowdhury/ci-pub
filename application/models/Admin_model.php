<?php


class Admin_model extends CI_Model{

    public function count_all_user($table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('type',2);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_banner($table) {
        $this->db->select('*');
        $this->db->from($table);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all_facebook($table) {
        $this->db->select('*');
        $this->db->from($table);
        
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    
    public function get_all_country() {
        $this->db->select('*');
        $this->db->from('countries');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function insertInfo($table,$data) {
        $this->db->insert($table,$data);
    }
    
    public function insertId($table,$data) {
        $this->db->insert($table,$data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    
    public function get_all_info($table) {
        $this->db->select('*');
        $this->db->from($table);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_Active_info($table,$columnName) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($columnName,1);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function updateInfo($columnName, $columnVal, $tableName, $data) {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }
    
    public function data_by_url($table,$url) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('url', $url);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function deleteInfo($tableName,$columnName,$id) {
        $this->db->where($columnName, $id);
        $this->db->delete($tableName);
    }
    
    public function get_info_by_id($table,$column_name,$id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column_name,$id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function set_block_status($table,$status,$column_name,$id) {
        $this->db->set($status,0);
        $this->db->where($column_name, $id);
        $this->db->update($table); 
    }
    
    public function set_active_status($table,$status,$column_name,$id) {
        $this->db->set($status,1);
        $this->db->where($column_name, $id);
        $this->db->update($table); 
    }
    
    public function set_active_user($table,$status,$column_name,$id) {
//        echo $id;die();
        $this->db->set($status,'1');
        $this->db->where($column_name, $id);
        $this->db->update($table); 
    }
    
//    User Info
    
    public function get_all_user($table) {
        $this->db->select($table.'.*,payment.fee_amount,payment_type,date');
        $this->db->from($table);
        $this->db->join('payment','payment.member_id = '.$table.'.member_id','left');
        
        $this->db->where($table.'.type',2);
        $this->db->group_by($table.'.member_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_affiliate_package() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        
        $this->db->join('trial_package','trial_package.option_id = membership_package_options.option_id','left');
        
        $this->db->where('membership_package_options.ads_type',1);
        $this->db->where('trial_package.is_active',1);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_network_package() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        
        $this->db->join('trial_package','trial_package.option_id = membership_package_options.option_id','left');
        
        $this->db->where('ads_type',2);
        $this->db->where('trial_package.is_active',1);
//        $where = "ads_type='2' OR ads_type='3,2'";
//        $this->db->where($where);
        
//        $this->db->where('ads_type',3);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_whois_package() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        
        $this->db->where('ads_type',3);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_option_price($option_id) {
        $this->db->select('option_price');
        $this->db->from('membership_package_options');
        
        $this->db->where('option_id',$option_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_user_info_by_id($id) {
        $this->db->select('members.*,countries.*,payment.fee_amount,payment_type,date');
        $this->db->from('members');
        $this->db->join('countries','countries.country_id = members.country_id','left');
        $this->db->join('payment','payment.member_id = members.member_id','left');
        
        $this->db->where('members.member_id',$id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_ads_info($table,$column_name,$str,$member_id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($column_name,$str);
        $this->db->where('member_id',$member_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_invoice_by_id($member_id) {
        $this->db->select('*');
        $this->db->from('invoice');
        
        $this->db->join('invoice_details','invoice_details.invoice_id = invoice.invoice_id','left');
        $this->db->join('payment','payment.member_id = invoice.member_id','left');
        $this->db->join('payment_type','payment_type.id = payment.payment_type','left');
        
        $this->db->where('invoice.member_id',$member_id);
        $this->db->group_by('invoice.invoice_id');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_invoice_details($id) {
        $this->db->select('invoice.*,invoice_details.*,payment.package_id,payment_type.name,membership_package_options.option_name,members.name as member_name,email,packages.package_name 	');
        // $this->db->select('invoice.*,invoice_details.*,members.name as member_name,email');
        $this->db->from('invoice');
        
        $this->db->join('members','members.member_id = invoice.member_id','left');
        $this->db->join('invoice_details','invoice_details.invoice_id = invoice.invoice_id','left');
        // $this->db->join('payment','payment.member_id = invoice.member_id','left');
        $this->db->join('payment','payment.subscribe_id = invoice.subscribe_id','left');
        $this->db->join('payment_type','payment_type.id = payment.payment_type','left');
        $this->db->join('membership_package_options','membership_package_options.option_id = invoice_details.option_id','left');
        $this->db->join('packages','packages.package_id = payment.package_id','left');
        
        $this->db->where('invoice.invoice_id',$id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
//    User Info End
    
    public function get_all_banner() {
        $this->db->select('*');
        $this->db->from('banner');
        
//        $this->db->join('category','category.cat_id = banner.cat_id','left');
//        $this->db->join('countries','countries.country_id = banner.country_id','left');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getAllSize($table) {
        $this->db->select('width, height');
        $this->db->from($table);
        
        $this->db->group_by('width', 'height');
        
        $query = $this->db->get();
        return $query->result_array();
    }
        
    public function get_headline_cat_id($id,$type) {
        $this->db->select('*');
        $this->db->from('headline');
        
        $this->db->where('cat_id',$id);
        $this->db->where('type',$type);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_headline_country_id($id,$type) {
        $this->db->select('*');
        $this->db->from('headline');
        
        $this->db->where('country_id',$id);
        $this->db->where('type',$type);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_headline_by_id($cat_id,$country_id) {
        $this->db->select('*');
        $this->db->from('headline');
        
        $this->db->where('country_id',$country_id);
        $this->db->where('cat_id',$cat_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_keyword_tags($key,$option) {
        $this->db->select('*');
        $this->db->from('keyword_tags');
        
        $this->db->where('keyword_tags',$key);
        $this->db->where('option_id',$option);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
//    Facebook Portion
    
    public function get_fb_info_by_id($table,$column_name,$id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('facebook_ads','facebook_ads.id = '.$table.'.fb_ads_id','left');
        
        $this->db->where($column_name,$id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_facebook_info($table) {
        $this->db->select('*');
        $this->db->from('facebook_ads');
        $this->db->join($table,$table.'.fb_ads_id = facebook_ads.id','left');
//        $this->db->join('facebook_ads','facebook_ads.id = '.$table.'.fb_ads_id','left');
                
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_embed_fb_info($table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('type',1);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_fb_ecom_info_by_id($table,$column_name,$id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('facebook_ecommerce_ads','facebook_ecommerce_ads.fb_ecom_id = '.$table.'.fb_ecom_id','left');
        
        $this->db->where($column_name,$id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function record_count($table) {
        return $this->db->count_all($table);
    }
    
    public function fetch_facebook_data($table,$limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    public function get_search_by_limit($table,$limit,$start) {
        $this->db->select("*");
        $this->db->from($table);
        
        $this->db->limit($limit,$start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_filter_data($table, $limit,$start,$cat_id,$country_id) {
        $this->db->limit($limit, $start);
        if($cat_id != NULL){
//            $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id');
            $this->db->like('cat_id', $cat_id);
        }
        
        if($country_id != NULL){
//            $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
            $this->db->like('country_id', $country_id);
        }
        
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
    
    public function get_search_fb_by_country($limit,$start,$table,$country_id){
        $this->db->limit($limit, $start);
//        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
        $this->db->like('country_id', $country_id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
//        $this->db->select("*");
//        $this->db->from($table);
//        
//        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
//        $this->db->where('coun.country_id', $country_id);
//        $this->db->limit($limit,$start);
//        
//        $query = $this->db->get();
//        return $query->result_array();
    }
    
    public function get_search_fb_by_category($limit, $start,$table,$cat_id) {
        $this->db->limit($limit, $start);
//        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id');
//        if($country_id != NULL){
//            $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
//            $this->db->where('coun.country_id', $country_id);
//        }
        $this->db->like('cat_id', $cat_id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
//        $this->db->select("*");
//        $this->db->from($table);
//        
//        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id');
//        $this->db->where('cat.cat_id', $cat_id);
//        $this->db->limit($limit,$start);
//        
//        $query = $this->db->get();
//        return $query->result_array();
        
    }
    
    public function update_facebook_image($data,$id) {
        $this->db->set('facebook_image',$data);
        $this->db->where('id', $id);
        $this->db->update('facebook_ads');
    }
    
    public function update_ecommerce_facebook_image($data,$id) {
        $this->db->set('facebook_image',$data);
        $this->db->where('fb_ecom_id', $id);
        $this->db->update('facebook_ecommerce_ads');
    }
    
//    Facebook Portion End
    public function get_comment_by_id($option_id,$adds_id) {
        $this->db->select('*');
        $this->db->from('comment_tbl');
        
        $this->db->where('comment_tbl.adds_id', $adds_id);
        $this->db->where('comment_tbl.option_id', $option_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function update_comment($data,$adds_id,$option_id) {
        
        $this->db->where('adds_id', $adds_id);
        $this->db->where('option_id', $option_id);
        
        $this->db->update('comment_tbl', $data);
    }
    public function get_all_ad_networks_info($id) {
        $this->db->select('*');
        $this->db->from('ad_networks');
        
//        $this->db->join('comment_tbl','comment_tbl.adds_id = ad_networks.id','left');
        $this->db->join('make_favorite_tbl','make_favorite_tbl.adds_id = ad_networks.id','left');
        
        $this->db->where('make_favorite_tbl.option_id', 21);
        $this->db->where('ad_networks.id', $id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function updateOptionInfo($table,$id,$data) {
        $this->db->set('option_price',$data);
        $this->db->where('option_id', $id);
        $this->db->update($table); 
    }
    
    public function get_headline_by_country($table,$country_id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
        $this->db->where('coun.country_id',$country_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_headline_by_category($table,$cat_id) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id');
        $this->db->where('cat.cat_id', $cat_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_search_by_country($table,$country_id){
        $this->db->select($table.'.*,coun.*,key.*,cat.cat_id,cat.cat_name');
        $this->db->from($table);
        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id','LEFT');
        $this->db->join('keyword_tags as key', 'key.id = '.$table.'.keyword','LEFT');
        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id','LEFT');
        $this->db->where('coun.country_id', $country_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_search_by_category($table,$cat_id){
        $this->db->select($table.'.*');
        $this->db->from($table);
        $this->db->like('cat_id',$cat_id);
//        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id','LEFT');
//        $this->db->join('keyword_tags as key', 'key.id = '.$table.'.keyword','LEFT');
//        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id','LEFT');
//        $this->db->where('cat.cat_id', $cat_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function get_search_by_status($table,$status_id){
        $this->db->select($table.'.*,coun.*,key.*,cat.cat_id,cat.cat_name');
        $this->db->from($table);
        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
        $this->db->join('keyword_tags as key', 'key.id = '.$table.'.keyword');
        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id');
        $this->db->where($table.'.status', $status_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_search_by_size($table,$width,$height){
        $this->db->select($table.'.*,coun.*,key.*,cat.cat_id,cat.cat_name');
        $this->db->from($table);
        $this->db->join('countries as coun', 'coun.country_id = '.$table.'.country_id');
        $this->db->join('keyword_tags as key', 'key.id = '.$table.'.keyword');
        $this->db->join('category as cat', 'cat.cat_id = '.$table.'.cat_id');
        $this->db->where($table.'.width', $width);
        $this->db->where($table.'.height', $height);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
