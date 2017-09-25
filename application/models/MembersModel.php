<?php

class MembersModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function memberlogin($data) {
        $query = $this->db->query("SELECT * FROM members WHERE (`email` = '" . $data['email'] . "' AND `password` = '" . $data['password'] . "' AND `status` = '1')");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $session = array(
                    'member_id' => $row->member_id,
                    'member_name' => $row->name,
                    'type' => $row->type,
                    'package_id' => $row->package_id,
                );
            }
            $this->session->set_userdata($session);
            $return = 1;
        } else {
            $return = 0;
        }

        return $return;
    }

    public function updatemember($actual_link, $member_id) {
        $this->db->set('activation_link', $actual_link);
        $this->db->where('member_id', $member_id);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function activatememberstatus($member_id) {
        $this->db->set('status', '1');
        $this->db->where('member_id', $member_id);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function memberinfo($member_id) {
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where('member_id', $member_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function updateInfo($columnName, $columnVal, $tableName, $data) {
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName, $data);
    }
    
    public function getcountrynamebyid($country_id) {
        $this->db->select('*');
        $this->db->from('countries');
        $this->db->where('country_id', $country_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function get_all_access_info($member_id) {
        $this->db->select('*');
        $this->db->from('access');
        $this->db->join('membership_package_options', 'membership_package_options.option_id = access.ads_type');
        
        $this->db->where('member_id', $member_id);
        
        $query = $this->db->get();
        //echo $this->db->last_query(); 
        return $query->result();
    }
    
    public function get_all_access($member_id) {
        $this->db->select('*');
        $this->db->from('access');
        $this->db->join('membership_package_options', 'membership_package_options.option_id = access.ads_type');
        
        $this->db->where('access.member_id', $member_id);
//        $this->db->where('access.active !=', 0);
//        $this->db->where('access.trial !=', 0);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_invoice_info($member_id) {
        $this->db->select('*');
        $this->db->from('invoice');
        
        $this->db->join('invoice_details','invoice_details.invoice_id = invoice.invoice_id','left');
//        $this->db->join('payment','payment.payment_id = invoice_details.payment_id','left');
        $this->db->join('payment_type','payment_type.id = invoice_details.payment_id','left');
        $this->db->join('membership_package_options','membership_package_options.option_id = invoice_details.option_id','left');
        
        $this->db->where('invoice.member_id',$member_id);
//        $this->db->group_by('invoice.invoice_id');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function sectionpermission($package_options) {
        foreach ($package_options as $row) {
            $this->db->select('*');
            $this->db->from('membership_package_options');
            $this->db->where_in('option_id', $package_options);
            $query = $this->db->get();
            $arr[] = $query->row();
        }
        //print_r($arr); exit;
        return $arr;
    }

    public function memberpaymentinfo($member_id) {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->join('payment_type', 'payment_type.id = payment.payment_type');
        $this->db->join('membership_package_options', 'membership_package_options.option_id = payment.package_id');
        $this->db->where('member_id', $member_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updatememberpassword($password, $member_id) {
        $this->db->set('password', $password);
        $this->db->where('member_id', $member_id);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getallmembershipoptions() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updatememberaccount($data, $member_id) {
        //print_r($data); exit; 
         $this->db->set('name', $data['name']);
        $this->db->set('email', $data['email']);
        $this->db->set('address_1', $data['address_1']);
        $this->db->set('address_2', $data['address_2']);
        $this->db->set('city', $data['city']);
        $this->db->set('state', $data['state']);
        $this->db->set('country_id', $data['country_id']);
        $this->db->set('zip', $data['zip']);
        $this->db->set('password', $data['password']);
        $this->db->where('member_id', $member_id);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

public function getmemberaccessbymemberid($member_id){
      $this->db->select('*');
        $this->db->from('access');
        //$this->db->where('ads_type', '1');
        $this->db->where('member_id', $member_id);
        $this->db->where('trial', '1');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
}
    public function getoptionbypackagesnew($access) {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->where_in('option_id', $access);
        $query = $this->db->get();
         //echo $this->db->last_query(); exit; 
        return $query->result_array();
    }
    
     public function getoptionbypackages() {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->like('ads_type', '1');
       $query = $this->db->get();
        return $query->result_array();
    }

    public function getoptionbyid($form_array) {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->where_in('option_id', $form_array);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getoptionbynetpack(){
        $this->db->select('*');
        $this->db->from('membership_package_options');
         $this->db->like('ads_type', '2', 'after');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getoptionbynetwhoispack(){
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->like('ads_type', ',2', 'before');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit; 
        return $query->result_array();
        
    }
    public function getsuperpackageinfo($pack){
         $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->like('option_id', $pack);
        $query = $this->db->get();
       // echo $this->db->last_query(); exit;
        return $query->row();
    }
    
    public function checkpermissiontblentry($member_id, $package_id){
        
        $this->db->select('*');
        $this->db->from('access');
        $this->db->where('member_id', $member_id);
        $this->db->where('ads_type', $package_id);
          $query = $this->db->get();
            return $query->row();
        
        //$this->db->select('*');
       // $this->db->from('user_permission_tbl');
        //$this->db->where('member_id', $member_id);
        //$this->db->where('package_id', $package_id);
        //  $query = $this->db->get();
          //echo $this->db->last_query(); exit;
           // return $query->row();
        
    }
    
    public function haspermissiontblentry($permission_option_id){
        $this->db->select('*');
        $this->db->from('trial_package');
        $this->db->where_in('option_id', $permission_option_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getOptionPrice($option_id){
        $this->db->select('option_price');
        $this->db->from('membership_package_options');
        $this->db->where('option_id', $option_id);
          $query = $this->db->get();
            return $query->row(); 
    }

    public function setpackageid($package_id, $member_id){
        $this->db->set('package_id',$package_id);
        $this->db->where('member_id', $member_id);
        $this->db->update('members');
    }
    
     public function userPermission($userPackageId){
        $this->db->select('*');
        $this->db->from('user_permission_tbl');
        $this->db->where('package_id', $userPackageId);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function etpermisettinginfo($permi){
        $this->db->select('*');
        
        $this->db->from('trial_package');
        $this->db->where_in('option_id', $permi);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
     public function getnews() {
        $this->db->select('*');
        $this->db->from('news');
        $this->db->order_by('date', 'ASC');
        $this->db->limit('5');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getsponsor(){
        $this->db->select('*');
        $this->db->from('sponsor');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function getoptionidbytype($optype){
        //print_r($optype); exit;
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->where_in('option_id', $optype);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }
    
    public function getoptionidbyadmin($optype){
        $this->db->select('option_id');
        $this->db->from('trial_package');
        $this->db->where_in('option_id', $optype);
        $this->db->where_in('is_active', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_option_info_by_id($options) {
        $this->db->select('*');
        $this->db->from('membership_package_options');
        $this->db->where('option_id', $options);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_info($table) {
        $this->db->select('*');
        $this->db->from($table);
        
        $query = $this->db->get();
        return $query->result_array();
    }
}
