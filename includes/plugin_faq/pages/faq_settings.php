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

if(!module_config::can_i('view','Settings') || !module_faq::can_i('edit','FAQ')){
    redirect_browser(_BASE_HREF);
}

$module->page_title = 'FAQ Settings';

$links = array(
    array(
        "name"=>'FAQ Products',
        'm' => 'faq',
        'p' => 'faq_products',
        'force_current_check' => true,
        'order' => 1, // at start.
        'menu_include_parent' => 1,
        'allow_nesting' => 1,
        'args'=>array('faq_id'=>false,'faq_product_id'=>false),
    ),
    array(
        "name"=>'Questions & Answers',
        'm' => 'faq',
        'p' => 'faq_questions',
        'force_current_check' => true,
        'order' => 2, // at start.
        'menu_include_parent' => 1,
        'allow_nesting' => 1,
        'args'=>array('faq_id'=>false,'faq_product_id'=>false),
    ),
    array(
        "name"=>'Settings',
        'm' => 'faq',
        'p' => 'faq_settings_basic',
        'force_current_check' => true,
        'order' => 3, // at start.
        'menu_include_parent' => 1,
        'allow_nesting' => 1,
        'args'=>array('faq_id'=>false,'faq_product_id'=>false),
    ),
);
