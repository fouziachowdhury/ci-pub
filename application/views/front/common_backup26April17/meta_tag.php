<?php 

$this->load->model('BookingModel');
$this->load->model('option');

$baseUrl = base_url();
$segment1 = $this->uri->segment(1);
$segment2 = $this->uri->segment(2);
//echo $baseUrl.$segment1.'/'.$segment2.'<br/>';

if($segment1 == '' || $segment1 == 'home') {

  $site_title = $this->option->get_by_id('shop_settings', 'settings_parameter_name', 'site_title');
  $title =  $site_title->value;
  $site_description = $this->option->get_by_id('shop_settings', 'settings_parameter_name', 'site_description');
  $description = substr($site_description->value, 0, 100).'.....';
  
}
if($segment1 == 'shoplist') {
  $title = 'All Shop List';
  $description = 'Short description of all shop';
}
if($segment1 == 'shopdetail') {

   $query = $this->db->get_where('shop_register', array('shop_id' => $segment2));
   $shop = $query->row();
   if($shop != '') {
   $title = $shop->shop_name_chinese;
   $description = substr($shop->shop_description, 0, 100).'.....';
   } else {
   $title = '';
   $description = '';
   }
}
if($segment1 == 'shopHotItems') {
  $title = 'All Hot Items';
  $description = 'Short description of all hot items';
}
if($segment1 == 'hotProductDetails') {
   $query = $this->db->get_where('shop_hot_item', array('shop_hot_item_id' => $segment2));
   $shop = $query->row();
   if($shop != '') {
   $title = $shop->item_title;
   $description = substr($shop->item_description, 0, 100);
   } else {
   $title = '';
   $description = '';
   }
}
if($segment1 == 'specialGuides') {
   //echo 'specialGuides';
}
if($segment1 == 'customerProfile') {
   $query = $this->db->get_where('shop_customer_member', array('customer_id' => $segment2));
   $shop = $query->row();
   if($shop !='') {
   $title = $shop->c_nick_name;
   $description = substr($shop->c_introduction, 0, 100).'.....';
   } else {
   $title = '';
   $description = ''; 
   }
}


?>