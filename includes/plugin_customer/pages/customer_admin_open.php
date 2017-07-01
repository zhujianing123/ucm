<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-04-14 02:55:25 
  * IP Address: 1
  */

$page_type = 'Customers';
$page_type_single = 'Customer';

$current_customer_type_id = module_customer::get_current_customer_type_id();
if($current_customer_type_id > 0){
	$customer_type = module_customer::get_customer_type($current_customer_type_id);
	if($customer_type && !empty($customer_type['type_name'])){
		$page_type = $customer_type['type_name_plural'];
		$page_type_single = $customer_type['type_name'];
	}
}


$module->page_title = $page_type_single;

if(!module_customer::can_i('view',$page_type)){
    redirect_browser(_BASE_HREF);
}

if(isset($customer_id)){
	// we're coming here a second time
}
$links = isset($links) ? $links : array();

$customer_id = $_REQUEST['customer_id'];
if($customer_id && $customer_id != 'new'){
	$customer = module_customer::get_customer($customer_id);
	// we have to load the menu here for the sub plugins under customer
	// set default links to show in the bottom holder area.

    if(!$customer || $customer['customer_id'] != $customer_id){
        redirect_browser('');
    }
    $class = '';
    if(isset($customer['customer_status'])){
         switch($customer['customer_status']){
             case _CUSTOMER_STATUS_OVERDUE:
                 $class = 'customer_overdue error_text';
                 break;
             case _CUSTOMER_STATUS_OWING:
                 $class = 'customer_owing';
                 break;
             case _CUSTOMER_STATUS_PAID:
                 $class = 'customer_paid success_text';
                 break;
         }
    }
	array_unshift($links,array(
		"name"=>_l(''.$page_type_single.': %s','<strong class="'.$class.'">'.htmlspecialchars($customer['customer_name']).'</strong>'),
		"icon"=>"images/icon_arrow_down.png",
		'm' => 'customer',
		'p' => 'customer_admin_open',
		'default_page' => 'customer_admin_edit',
		'order' => 1,
		'menu_include_parent' => 0,
	));
}else{
	$customer = array(
		'name' => 'New '.$page_type_single,
	);
	array_unshift($links,array(
		"name"=>'New '.$page_type_single.' Details',
		"icon"=>"images/icon_arrow_down.png",
		'm' => 'customer',
		'p' => 'customer_admin_open',
		'default_page' => 'customer_admin_edit',
		'order' => 1,
		'menu_include_parent' => 0,
	));
}
