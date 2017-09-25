<?php


class ResourseAdminModel extends CI_Model{

    function __construct() {

        parent::__construct();
    }
    
    public function getaffiliateresourceinfo(){
        $this->db->select('*');
        $this->db->from('resources_tbl');
        $this->db->where('title', 'Affiliate Networks');
        $query = $this->db->get();
         return $query->row(); 
    }
    
    public function updateresourceinfo($data){
        $this->db->set('title', $data['title']);
        $this->db->set('url', $data['url']);
        $this->db->set('meta_description', $data['meta']);
        $this->db->set('admin_id', $data['admin_id']);
        $this->db->where('resource_id', 1);
        $query = $this->db->update('resources_tbl');
        if($query){
            return TRUE;
        } else {
            return FALSE; 
        }
    }
}
