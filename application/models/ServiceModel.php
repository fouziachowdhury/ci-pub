<?php

class ServiceModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }


    public function getloadbandesign() {
        $this->db->select('*');
        $this->db->from('services_tbl');
        $this->db->where('service_id', 1);
        $query = $this->db->get();
        return $query->row();
    }


    public function getloadprogramming() {
         $this->db->select('*');
        $this->db->from('services_tbl');
        $this->db->where('service_id', 2);
        $query = $this->db->get();
        return $query->row();
    }
    
    
    public function getloadmanagement(){
        $this->db->select('*');
        $this->db->from('services_tbl');
        $this->db->where('service_id', 4);
        $query = $this->db->get();
        return $query->row();
    }
    
    
    public function getloadtranslation(){
        $this->db->select('*');
        $this->db->from('services_tbl');
        $this->db->where('service_id', 3);
        $query = $this->db->get();
        return $query->row();
    }
    

}
