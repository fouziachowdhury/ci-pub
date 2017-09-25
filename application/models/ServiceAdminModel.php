<?php


class ServiceAdminModel extends CI_Model{

    function __construct() {

        parent::__construct();
    }
    
    public function getserviceinfo($service_name){
        $this->db->select('*');
        $this->db->from('services_tbl');
        $this->db->where('service_name', $service_name);
        $query = $this->db->get();
         return $query->row(); 
    }
    
    public function updateserviceinfo($data){
        $this->db->set('service_details', $data['service_details']);
        $this->db->set('update_date', $data['update_date']);
        $this->db->set('admin_id', $data['admin_id']);
        $this->db->where('service_name', $data['service_name']);
        $query = $this->db->update('services_tbl');
        if($query){
            return TRUE;
        } else {
            return FALSE; 
        }
    }
}
