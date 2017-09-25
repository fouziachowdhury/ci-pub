<?php

class PaypalModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function savepaypallpaymentinfo($data1) {
        //echo "insert into `payment`(member_id,fee_amount, payment_type, date, package_id, payment_for, subscribe_id) VALUES('$member_id','$fee_amount','$payment_type','$paydate','$package_id','$paypalfor','$subscribe_id')"; exit;
        $sql = "insert into payment (member_id,fee_amount, payment_type, date, package_id, payment_for, subscribe_id) VALUES('".$data1['member_id']."','".$data1['fee_amount']."','".$data1['payment_type']."','".$data1['paydate']."','".$data1['package_id']."','".$data1['paypalfor']."','".$data1['subscribe_id']."')";
        $this->db->query($sql);
    }
    
    public function savepaypallaccessinfo($accessdata){ 
        
        $sqltest = "SELECT * FROM access WHERE member_id ='".$accessdata['member_id']."' AND  ads_type = '".$accessdata['ads_type']."' AND  trial = 1";
        $testresult = $this->db->query($sqltest);
        
        if(empty($testresult)){
        $sql = "insert into access (member_id,ads_type, price, active, trial) VALUES('".$accessdata['member_id']."','".$accessdata['ads_type']."','".$accessdata['price']."','".$accessdata['active']."','".$accessdata['trial']."')";
        $this->db->query($sql);
        } else {
             $delsql = "DELETE FROM access WHERE member_id ='".$accessdata['member_id']."' AND  ads_type = '".$accessdata['ads_type']."' AND  trial = 1";
             $this->db->query($delsql);
             
             $insertsql = "insert into access (member_id,ads_type, price, active, trial) VALUES('".$accessdata['member_id']."','".$accessdata['ads_type']."','".$accessdata['price']."','".$accessdata['active']."','".$accessdata['trial']."')";
             $this->db->query($insertsql);
        }
    }
    
    public function get_subscribe($subscribe_id){
        $this->db->select('*');
        $this->db->from('payment');
        
        $this->db->where('subscribe_id',$subscribe_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    

}
