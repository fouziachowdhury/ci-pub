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
        require('/stripe-php/init.php');
        \Stripe\Stripe::setApiKey("sk_test_tBvq3ndZ5agdWVtKOgg4vxfr");
        $token = $_POST['stripeToken'];

        $amount = $this->uri->segment('2');
        $charge = \Stripe\Charge::create(array(
                    "amount" => $amount,
                    "currency" => "usd",
                    "description" => "Membership Fee",
                    "source" => $token,
        ));

        $date = date('Y-m-d H:i:s');
        $data = array(
            'fee_amount' => $charge['amount'],
            'payment_type' => 2,
            'date' => $date,
            'payment_for' => $charge['description'],
        );
           
        $insert = $this->StripeModel->insert_payment_info($data);
        if($insert){
            redirect('home');
        } else {
             redirect('registrationform');
        }
                }

}
