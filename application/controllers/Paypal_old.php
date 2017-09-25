<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paypal extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('PaypalModel');
    }

    public function paypalform() {
        // print_r($_POST); exit;
        $data['amount'] = $this->uri->segment('2');
        $data['notify_url'] = base_url() . 'paypal_notification';
        $data['paypal_return_notify'] = base_url() . 'paypal_return_notify';
        $data['paypal_cancle_notify'] = base_url() . 'paypal_cancle_notify';
        $data['paypalfor'] = "membership fee";
        $this->load->view('front/common/header');
        $this->load->view('front/common/menu');
        $this->load->view('front/payment_method/paypal_form', $data);
        $this->load->view('front/common/footer');
    }

    public function paypalnotification() {
        
        $req = 'cmd=_notify-validate';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value);
            $req .= "&$key=$value";
        }
        reset($_POST);
        $data = print_r($_POST, true);
          
        $fee_amount = $_POST['mc_currency'];
        $payer_email = $_POST['payer_email'];
        $payment_type = 1;
        $paydate = date('Y-m-d H:i:s');
        $paypalfor = $_POST['item_name'];
        $package_id = 10;
        $member_id = $_POST['custom'];
        /* -------------NEW CODE---------------- */
        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cURL, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($cURL, CURLOPT_URL, "https://www.sandbox.paypal.com/cgi-bin/webscr");
        curl_setopt($cURL, CURLOPT_ENCODING, 'gzip');
        curl_setopt($cURL, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POST, true); // POST back
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $IPN); // the $IPN
        curl_setopt($cURL, CURLOPT_HEADER, false);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($cURL, CURLOPT_FORBID_REUSE, true);
        curl_setopt($cURL, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($cURL, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($cURL, CURLOPT_TIMEOUT, 60);
        curl_setopt($cURL, CURLINFO_HEADER_OUT, true);
        curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
            'Connection: close',
            'Expect: ',
        ));
        $Response = curl_exec($cURL);
        $Status = (int) curl_getinfo($cURL, CURLINFO_HTTP_CODE);
        curl_close($cURL);
        if (empty($Response) or ! preg_match('~^(VERIFIED|INVALID)$~i', $Response = trim($Response)) or ! $Status) {
            $mm = "ERROR";
        }
        
        if (intval($Status / 100) != 2) {
            reset($_POST);
            $data = print_r($_POST, true);
            $cust = explode("/",$_POST['custom']);
            $data1 = array();
            $data1['fee_amount'] = $_POST['amount3'];
            $data1['payer_email'] = $_POST['payer_email'];
            $data1['payment_type'] = 1;
            $data1['paydate'] = date('Y-m-d');
            $data1['paypalfor'] = $_POST['item_name'];
            $data1['package_id'] = 10;
            $data1['member_id'] = $cust[0];
            $data1['subscribe_id'] = $_POST['subscr_id'];
            $datann = print_r($data1, true);
             
          if($_POST['txn_type'] =='subscr_signup'){   
         $insert = $this->PaypalModel->savepaypallpaymentinfo($data1);
         
          }
          $accessdata = array();
          
            $accessdata['member_id'] = $cust[0];
            $accessdata['ads_type'] = $cust[1];
            $accessdata['price'] = $_POST['amount3'];
            $accessdata['active'] = 1;
            $accessdata['trial'] = 0;

            $newdatann = print_r($accessdata, true);
            
           if($_POST['txn_type'] =='subscr_signup'){  
           $newinsert = $this->PaypalModel->savepaypallaccessinfo($accessdata);
           
          //mail("rsuserfouzia@gmail.com", "access tbl insert", $newdatann, "From: admin@aklic.com");
          
          }
         
         
        }
        
        return !strcasecmp($Response, 'VERIFIED');
    }

    public function paypalreturnnotify() {
        echo "Success";
        redirect('home');
    }

    public function paypalcanclenotify() {
        echo "cancle";
        redirect('home');
    }

}
