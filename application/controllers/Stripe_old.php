<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stripe extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('StripeModel');
    }

    public function stripeform() {
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/payment_method/stripe_form');
        $this->load->view('front/common/footer');
    }

    public function paymentwithstripe() {
        //echo '<pre>';print_r($_POST);die;
      
        
        // require('/stripe-php/init.php');
        include "$_SERVER[DOCUMENT_ROOT]/publyfe/stripe-php/init.php";
        \Stripe\Stripe::setApiKey("sk_test_2yVhOBQMxbBrsb7kJxXA5w0N");
        $token = $_POST['stripeToken'];
        $name = $_POST['plan_name'];
        $plan_id = $_POST['plan_id'];
        $amount = $_POST['amount'];
        $email = $_POST['email'];
        //INSERT DATA INTO INVOICE TBL
        $invoice['member_id'] = $_SESSION['member_id'];
        $invoice['amount'] = $amount;
        $invoice['date'] = date('m-d-Y');
        $invoice['status'] = 0;
        
        $this->db->insert('invoice', $invoice);
        $invoice_insert_id = $this->db->insert_id();
        
        if ($_POST['option_id'] != '') {
             $count = count($_POST['option_id']);
            //INSERT DATA INTO INVOICE DETAILS TBL
            for($i = 0; $i < $count; $i++){
                $invoice_details['invoice_id'] = $invoice_insert_id;
                $invoice_details['option_id'] = $_POST['option_id'][$i];
                $invoice_details['option_price'] = $_POST['option_price'][$i];
                $this->db->insert('invoice_details', $invoice_details);
            }
            
        }

        if ($_POST['option_id1'] != '') {
            //INSERT DATA INTO INVOICE DETAILS TBL
            $invoice_details['invoice_id'] = $invoice_insert_id;
            $invoice_details['option_id'] = $_POST['option_id1'];
            $this->db->insert('invoice_details', $invoice_details);
        }

        // echo $token;die;
        $data['planinfo'] = $this->StripeModel->getplanInfobyname($name, $plan_id);
        // print_r($email); exit;
        $data['customerinfo'] = $this->StripeModel->getcustomerInfobyemail($email);
        // $customer_id = $data['customerinfo']->customer_id;
        if(!empty($data['customerinfo'])){
            $customer_id = $data['customerinfo']->customer_id;
        }else{
            $customer_id = null;
        }
        // print_r($customer_id); exit;
        if (!empty($data['planinfo'])) {
            $id = $data['planinfo']->plan_id;

            //RETRIVE PLAN
            $retriveplan = \Stripe\Plan::retrieve($id);

            //RETRIVE CUSTOMER
            if($customer_id != null){
                $retrivecustomer = \Stripe\Customer::retrieve($customer_id);
            }
            else{
                $retrivecustomer = '';
            }
            
            
            if (empty($retrivecustomer)) {
                $customer = \Stripe\Customer::create(array(
                            "email" => $email,
                            "source" => $token 
                ));
                
                // echo '<pre>';echo $customer;die;
                $subscribe = \Stripe\Subscription::create(array(
                  "customer" => $customer->id,
                  "plan" => $plan_id
                ));
                
                // echo '<pre>';echo $subscribe;die;
                

                $invoice = \Stripe\Invoiceitem::create(array(
                            "customer" => $subscribe->customer,
                            "amount" => $subscribe['plan']->amount,
                            "currency" => $subscribe['plan']->currency,
                            "description" => "Invoice for Stripe payment for the package " . $name,
                ));
                
                $charge = \Stripe\Charge::create(array(
                  "amount" => $subscribe['plan']->amount,
                  "currency" => $subscribe['plan']->currency,
                  "description" => "Publyfe charge",
                  "customer" => $customer->id
                 // "source" => $token,
                ));
                    
                // Update Invoice table by Status            
                $invoice_details1['invoice_code'] = $invoice->id;
                $invoice_details1['subscribe_id'] = $subscribe->id;
                $invoice_details1['plan_id'] = $retriveplan->id;
                $invoice_details1['customer_id'] = $retrivecustomer->id;
                $invoice_details1['status'] = 1;

                $invoiceUpdate = $this->StripeModel->updatedata($invoice_details1, $invoice_insert_id);
                
                $data1['fee_amount'] = $_POST['amount'];
                $data1['payment_type'] = 2;
                $data1['paydate'] = date('Y-m-d');
                $data1['paypalfor'] = $_POST['plan_name'];
                $data1['package_id'] = $_POST['package_id'];
                $data1['member_id'] = $_SESSION['member_id'];
                $data1['subscribe_id'] = $subscribe->id;
                
                $this->db->insert('payment', $data1);
                
                // insert Into Access table
                for($i = 0; $i < $count; $i++){
                    $accessdata['member_id'] = $_SESSION['member_id'];
                    $accessdata['package_id'] = $_POST['package_id'];
                    $accessdata['ads_type'] = $_POST['option_id'][$i];
                    $accessdata['price'] = $_POST['option_price'][$i];
                    $accessdata['active'] = 1;
                    $accessdata['trial'] = 0;
                    
                    $this->db->insert('access', $accessdata);
                }
            } else {

                //CREATE SUBSCRIBE
                $subscribe = \Stripe\Subscription::create(array(
                  "customer" => $retrivecustomer->id,
                  "plan" => $plan_id
                ));
                // $subscribe = \Stripe\Subscription::create(array(
                //             "customer" => $retrivecustomer->id,
                //             "plan" => "$retriveplan->id",
                // ));


                $invoice = \Stripe\Invoiceitem::create(array(
                            "customer" => $subscribe->customer,
                            "amount" => $subscribe['plan']->amount,
                            "currency" => $subscribe['plan']->currency,
                            "description" => "Invoice for Stripe payment for the package " . $name,
                ));
                
                $charge = \Stripe\Charge::create(array(
                  "amount" => $subscribe['plan']->amount,
                  "currency" => $subscribe['plan']->currency,
                  "description" => "Publyfe charge",
                  "customer" => $customer->id
                 // "source" => $token,
                ));
//print_r($invoice); exit; 
                $invoice_details2['invoice_code'] = $invoice->id;
                $invoice_details2['subscribe_id'] = $subscribe->id;
                $invoice_details2['plan_id'] = $retriveplan->id;
                $invoice_details2['customer_id'] = $retrivecustomer->id;
                $invoice_details2['status'] = 1;
                //$this->db->update('invoice', $invoice_details2);
                $invoiceUpdate = $this->StripeModel->updatedata($invoice_details2, $invoice_insert_id);
                
                $data1['fee_amount'] = $_POST['amount'];
                $data1['payment_type'] = 2;
                $data1['paydate'] = date('Y-m-d');
                $data1['paypalfor'] = $_POST['plan_name'];
                $data1['package_id'] = $_POST['package_id'];
                $data1['member_id'] = $_SESSION['member_id'];
                $data1['subscribe_id'] = $subscribe->id;
                
                $this->db->insert('payment', $data1);
                
                // insert Into Access table
                for($i = 0; $i < $count; $i++){
                    $accessdata['member_id'] = $_SESSION['member_id'];
                    $accessdata['package_id'] = $_POST['package_id'];
                    $accessdata['ads_type'] = $_POST['option_id'][$i];
                    $accessdata['price'] = $_POST['option_price'][$i];
                    $accessdata['active'] = 1;
                    $accessdata['trial'] = 0;
                    
                    $this->db->insert('access', $accessdata);
                }
            }

            redirect('home');
        }

        redirect('home');
    }

    public function getwebhookresult() {
        require('/stripe-php/init.php');
        \Stripe\Stripe::setApiKey("sk_test_2yVhOBQMxbBrsb7kJxXA5w0N");
        $input = @file_get_contents("php://input");
        $event_json = json_decode($input);
        $event_id = $event_json->id;
        $event = Stripe_Event::retrieve($event_id);
        $type = $event->type;
        $customer = Stripe_Customer::retrieve($invoice->customer);
        $m_email = $customer->email;
        if ($type == 'invoice.payment_succeeded') {
            $m_status = $this->StripeModel->updatememberstatus($m_email);
        } else {
            $m_status_inactive = $this->StripeModel->updatememberstatusinactive($m_email);
        }
    }

    public function supaffpaymentwithstripe() {
        //echo '<pre>';print_r($_POST);die;
        
        // require('/stripe-php/init.php');
        include "$_SERVER[DOCUMENT_ROOT]/publyfe/stripe-php/init.php";
        \Stripe\Stripe::setApiKey("sk_test_tBvq3ndZ5agdWVtKOgg4vxfr");
        $token = $_POST['stripeToken'];
        $name = $_POST['plan_name'];
        $plan_id = $_POST['plan_id'];
        //$id = $_POST['plan_id'];
        $amount = $_POST['amount'];
        $email = $_POST['email'];
        //INSERT DATA INTO INVOICE TBL
        $invoice['member_id'] = $_SESSION['member_id'];
        $invoice['amount'] = $amount;
        $invoice['date'] = date('m-d-Y');
        $invoice['status'] = 0;
        //print_r($invoice); exit;
        $this->db->insert('invoice', $invoice);
        $invoice_insert_id = $this->db->insert_id();
        if ($_POST['option_id'] != '') {
            $count = count($_POST['option_id']);
            
            //INSERT DATA INTO INVOICE DETAILS TBL
            
            for($i = 0; $i < $count; $i++){
                $invoice_details['invoice_id'] = $invoice_insert_id;
                $invoice_details['option_id'] = $_POST['option_id'][$i];
                $invoice_details['option_price'] = $_POST['option_price'][$i];
                $this->db->insert('invoice_details', $invoice_details);
            }
            
            // print_r($invoice_details);
            //$this->db->insert('invoice_details', $invoice_details);
        }

        if ($_POST['option_id1'] != '') {
            //INSERT DATA INTO INVOICE DETAILS TBL
            $invoice_details['invoice_id'] = $invoice_insert_id;
            $invoice_details['option_id'] = $_POST['option_id1'];
            $invoice_details['option_id'] = $amount;
            
            $this->db->insert('invoice_details', $invoice_details);
        }

        $data['planinfo'] = $this->StripeModel->getplanInfobyname($name, $plan_id);
        $data['customerinfo'] = $this->StripeModel->getcustomerInfobyemail($email);
        //print_r($data['planinfo']);  exit;
        if(!empty($data['customerinfo'])){
            $customer_id = $data['customerinfo']->customer_id;
        }else{
            $customer_id = null;
        }
        if (!empty($data['planinfo'])) { 
            $id = $data['planinfo']->plan_id;

            //RETRIVE PLAN
            $retriveplan = \Stripe\Plan::retrieve($id);

            //RETRIVE CUSTOMER
            if($customer_id != null){
                $retrivecustomer = \Stripe\Customer::retrieve($customer_id);
            }
            else{
                $retrivecustomer = '';
            }
            
            if (empty($retrivecustomer)) {
                
                $customer = \Stripe\Customer::create(array(
                            "email" => $email,
                            "source" => $token 
                ));
                // $customer = \Stripe\Customer::create(array(
                //             "email" => $email,
                // ));

                $subscribe = \Stripe\Subscription::create(array(
                            "customer" => $customer->id,
                            "plan" => $plan_id,
                ));

                $invoice = \Stripe\Invoiceitem::create(array(
                            
                            "customer" => $subscribe->customer,
                            "amount" => $subscribe['plan']->amount,
                            "currency" => $subscribe['plan']->currency,
                            "description" => "Invoice for Stripe payment for the package " . $name,
                ));
                
                $charge = \Stripe\Charge::create(array(
                  "amount" => $subscribe['plan']->amount,
                  "currency" => $subscribe['plan']->currency,
                  "description" => "Publyfe charge",
                  "customer" => $customer->id
                 // "source" => $token,
                ));

                $invoice_details1['invoice_code'] = $invoice->id;
                $invoice_details1['subscribe_id'] = $subscribe->id;
                $invoice_details1['plan_id'] = $retriveplan->id;
                $invoice_details1['customer_id'] = $customer->id;
                $invoice_details1['status'] = 1;
                $invoiceUpdate = $this->StripeModel->updatedata($invoice_details1, $invoice_insert_id);
                
                $data1['fee_amount'] = $_POST['amount'];
                $data1['payment_type'] = 2;
                $data1['paydate'] = date('Y-m-d');
                $data1['paypalfor'] = $_POST['plan_name'];
                $data1['package_id'] = $_POST['package_id'];
                $data1['member_id'] = $_SESSION['member_id'];
                $data1['subscribe_id'] = $subscribe->id;
                
                $this->db->insert('payment', $data1);
                
                // insert Into Access table
                for($i = 0; $i < $count; $i++){
                    $accessdata['member_id'] = $_SESSION['member_id'];
                    $accessdata['package_id'] = $_POST['package_id'];
                    $accessdata['ads_type'] = $_POST['option_id'][$i];
                    $accessdata['price'] = $_POST['option_price'][$i];
                    $accessdata['active'] = 1;
                    $accessdata['trial'] = 0;
                    
                    $this->db->insert('access', $accessdata);
                }
            } else {

                //CREATE SUBSCRIBE
                $subscribe = \Stripe\Subscription::create(array(
                            "customer" => $retrivecustomer->id,
                            "plan" => $plan_id,
                ));


                $invoice = \Stripe\Invoiceitem::create(array(
                            "customer" => $subscribe->customer,
                            "amount" => $subscribe['plan']->amount,
                            "currency" => $subscribe['plan']->currency,
                            "description" => "Invoice for Stripe payment for the package " . $name,
                ));
                
                $charge = \Stripe\Charge::create(array(
                  "amount" => $subscribe['plan']->amount,
                  "currency" => $subscribe['plan']->currency,
                  "description" => "Publyfe charge",
                  "customer" => $customer->id
                 // "source" => $token,
                ));

                $invoice_details1['invoice_code'] = $invoice->id;
                $invoice_details1['subscribe_id'] = $subscribe->id;
                $invoice_details1['plan_id'] = $retriveplan->id;
                $invoice_details1['customer_id'] = $retrivecustomer->id;
                $invoice_details1['status'] = 1;
                $this->db->update('invoice', $invoice_details1);
                $invoiceUpdate = $this->StripeModel->updatedata($invoice_details1, $invoice_insert_id);
                
                $data1['fee_amount'] = $_POST['amount'];
                $data1['payment_type'] = 2;
                $data1['paydate'] = date('Y-m-d');
                $data1['paypalfor'] = $_POST['plan_name'];
                $data1['package_id'] = $_POST['package_id'];
                $data1['member_id'] = $_SESSION['member_id'];
                $data1['subscribe_id'] = $subscribe->id;
                
                $this->db->insert('payment', $data1);
                
                // insert Into Access table
                for($i = 0; $i < $count; $i++){
                    $accessdata['member_id'] = $_SESSION['member_id'];
                    $accessdata['package_id'] = $_POST['package_id'];
                    $accessdata['ads_type'] = $_POST['option_id'][$i];
                    $accessdata['price'] = $_POST['option_price'][$i];
                    $accessdata['active'] = 1;
                    $accessdata['trial'] = 0;
                    
                    $this->db->insert('access', $accessdata);
                }
            }

            redirect('home');
        }
        redirect('home');
    }

}
