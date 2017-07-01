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

$quote_safe = true; // stop including files directly.
if(!module_quote::can_i('view','Quotes')){
    echo 'permission denied';
    return;
}

if(isset($_REQUEST['quote_id'])){

    if(isset($_REQUEST['email_staff'])){
        include(module_theme::include_ucm("includes/plugin_quote/pages/quote_admin_email_staff.php"));

    }else if(isset($_REQUEST['email'])){
        include(module_theme::include_ucm("includes/plugin_quote/pages/quote_admin_email.php"));

    }else if((int)$_REQUEST['quote_id'] > 0){
        include(module_theme::include_ucm("includes/plugin_quote/pages/quote_admin_edit.php"));
        //include("quote_admin_edit.php");
    }else{
        include(module_theme::include_ucm("includes/plugin_quote/pages/quote_admin_create.php"));
        //include("quote_admin_create.php");
    }

}else{

    include(module_theme::include_ucm("includes/plugin_quote/pages/quote_admin_list.php"));
	//include("quote_admin_list.php");
	
} 

