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

if(!module_config::can_i('view','Settings') || !module_security::can_i('view','Security Roles','Security')){
    redirect_browser(_BASE_HREF);
}
if(isset($_REQUEST['security_role_id'])){

	include("security_role_edit.php");

}else{

	include("security_role_list.php");

}

