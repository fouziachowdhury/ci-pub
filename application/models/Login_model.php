<?php


class Login_model extends CI_Model{
    
    public function admin_login_check($email,$password) {
        
        $this->db->select('*');
        $this->db->from('members');
        $this->db->where('email',$email);
        $this->db->where('password',md5($password));
        $this->db->where('type',1);
        
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
}
