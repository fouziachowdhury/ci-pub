<?php

class StripeModel extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    public function insert_payment_info($data) {
        //echo "INSERT INTO payment (fee_amount, payment_type, date, payment_for) VALUES ('".$data['fee_amount']."', '".$data['payment_type']."', '".$data['date']."','".$data['payment_for']."')"; exit;
        $sql = "INSERT INTO payment (fee_amount, payment_type, date, payment_for) VALUES ('".$data['fee_amount']."', '".$data['payment_type']."', '".$data['date']."','".$data['payment_for']."')";

        if ($this->db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatememberstatus($m_email){
        $this->db->set('status', 1);
        $this->db->where('email', $m_email);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatememberstatusinactive($m_email){
        $this->db->set('status', 0);
        $this->db->where('email', $m_email);
        $query = $this->db->update('members');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getplanInfobyname($name, $plan_id){
        $this->db->select('*');
        $this->db->from('stripe_plan');
        $this->db->where('plan_name', $name);
        $this->db->where('plan_id', $plan_id);
         $query = $this->db->get();
         //echo $this->db->last_query(); exit;
           return $query->row();
    }
    
    public function getcustomerInfobyemail($email) {
        $this->db->select('*');
        
        $this->db->from('stripe_customer');
        $this->db->where('customer_email', $email);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    public function updatedata($invoice_details1,$invoice_insert_id){
        $this->db->set('invoice_code',$invoice_details1['invoice_code']);
        $this->db->set('subscribe_id',$invoice_details1['subscribe_id']);
        $this->db->set('plan_id',$invoice_details1['plan_id']);
        $this->db->set('customer_id',$invoice_details1['customer_id']);
        $this->db->set('status',$invoice_details1['status']);
        
        $this->db->where('invoice_id', $invoice_insert_id);
        $this->db->update('invoice');
        //echo $this->db->last_query(); exit; 
    }

}
