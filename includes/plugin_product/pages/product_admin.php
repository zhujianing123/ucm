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


if(isset($_REQUEST['product_id']) && $_REQUEST['product_id'] != ''){
    $product_id = (int)$_REQUEST['product_id'];
	$product = module_product::get_product($product_id);
    include('product_admin_edit.php');
}else{
	include('product_admin_list.php');
}
