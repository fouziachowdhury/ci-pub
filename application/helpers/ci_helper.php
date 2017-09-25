<?php

function getservicepricenotice(){
$ci = &get_instance();
      //$type = $ci->session->userdata('type');
      $id = $ci->session->userdata('member_id');
      $getserviceinfo = $ci->option->getcustomerservicepriceinfo($id);
            if($getserviceinfo == 0){
                 return true; 
            } else {
                return false;
            }
}
