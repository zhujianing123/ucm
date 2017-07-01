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
//include("top_menu.php");




$module->page_title = _l('Finance');


$links = array();
$menu_position = 1;

array_unshift($links,array(
    "name"=>"Transactions",
    'm' => 'finance',
    'p' => 'finance',
    'default_page' => 'finance_list',
    'order' => $menu_position++,
    'menu_include_parent' => 0,
    'allow_nesting' => 0,
    'args' => array('finance_id'=>false),
));
if(module_finance::can_i('view','Finance Upcoming')){
    array_unshift($links,array(
        "name"=>"Upcoming Payments",
        'm' => 'finance',
        'p' => 'recurring',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        'args' => array('finance_id'=>false,'finance_recurring_id'=>false),
    ));
}

?>