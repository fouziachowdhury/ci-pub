<?php


class WhoisAdminModel extends CI_Model{

    function __construct() {

        parent::__construct();
    }
    
    public function getwhoissettingsinfo($id){
        $this->db->select('*');
        $this->db->from('whois_setting');
        $this->db->where('option_id', $id);
        
        $query = $this->db->get();
         return $query->row(); 
    }
    
    public function updatewhoisinfo($data,$id){
        $this->db->where('option_id', $id);
        $query = $this->db->update('whois_setting',$data);
        if($query){
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    public function updateOptionInfo($columnName, $columnVal, $tableName, $data) {
        $this->db->set('option_price',$data);
        $this->db->where($columnName, $columnVal);
        $this->db->update($tableName); 
    }
}
