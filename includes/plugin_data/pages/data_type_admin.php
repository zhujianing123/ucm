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

if(module_data::can_i('edit',_MODULE_DATA_NAME)){

	// show all datas.
	if(isset($_REQUEST['data_field_id']) && $_REQUEST['data_field_id'] && isset($_REQUEST['data_type_id']) && $_REQUEST['data_type_id']){
		
		include("data_type_admin_field_open.php");
		
	}else if(isset($_REQUEST['data_field_group_id']) && $_REQUEST['data_field_group_id']){
		
		include("data_type_admin_group_open.php");
		
	}else if(isset($_REQUEST['data_type_id']) && $_REQUEST['data_type_id']){
		
		include("data_type_admin_open.php");
		
	}else{
		
		include("data_type_admin_list.php");
	}
	
}