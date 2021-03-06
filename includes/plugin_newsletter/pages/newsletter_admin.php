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

$newsletter_id = (isset($_REQUEST['newsletter_id'])) ? (int)$_REQUEST['newsletter_id'] : false;

$links = array();
$menu_position = 1;

array_unshift($links,array(
    "name"=>"Overview",
    'm' => 'newsletter',
    'p' => 'newsletter_admin',
    'default_page' => 'newsletter_dashboard',
    'order' => $menu_position++,
    'menu_include_parent' => 0,
    'allow_nesting' => 0,
    'args' => array('newsletter_id'=>false),
));
if(module_newsletter::can_i('view','Send Newsletter')){
    $pending = module_newsletter::get_newsletters(array('pending'=>1));
    if(mysql_num_rows($pending)){
        array_unshift($links,array(
            "name"=>"Pending <span class='menu_label'>".mysql_num_rows($pending)."</span> ",
            'm' => 'newsletter',
            'p' => 'newsletter_list_pending',
            'order' => $menu_position++,
            'menu_include_parent' => 0,
            'allow_nesting' => 1,
            'args' => array('newsletter_id'=>false),
        ));
    }
}   
if(module_newsletter::can_i('create','Newsletters')){
    array_unshift($links,array(
        "name"=>"Create Newsletter",
        'm' => 'newsletter',
        'p' => 'newsletter_create',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        'args' => array('newsletter_id'=>false),
    ));
}
if(module_newsletter::can_i('edit','Newsletters')){
    $drafts = module_newsletter::get_newsletters(array('draft'=>1));
    if(mysql_num_rows($drafts)){
        array_unshift($links,array(
            "name"=>"Drafts <span class='menu_label'>".mysql_num_rows($drafts)."</span> ",
            'm' => 'newsletter',
            'p' => 'newsletter_list_draft',
            'order' => $menu_position++,
            'menu_include_parent' => 0,
            'allow_nesting' => 1,
            'args' => array('newsletter_id'=>false),
        ));
    }
    mysql_free_result($drafts);
}

if(isset($load_pages[1]) && $load_pages[1] == 'newsletter_edit' && $newsletter_id){
    array_unshift($links,array(
        "name"=>"Edit",
        'm' => 'newsletter',
        'p' => 'newsletter_edit',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        //'args' => array('newsletter_id'=>false),
    ));
}
if(isset($load_pages[1]) && $load_pages[1] == 'newsletter_send'){
    array_unshift($links,array(
        "name"=>"Send",
        'm' => 'newsletter',
        'p' => 'newsletter_send',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        //'args' => array('newsletter_id'=>false),
    ));
}
if(isset($load_pages[1]) && $load_pages[1] == 'newsletter_queue'){
    array_unshift($links,array(
        "name"=>"Send",
        'm' => 'newsletter',
        'p' => 'newsletter_queue',
        'order' => $menu_position++,
        'menu_include_parent' => 1,
        'allow_nesting' => 1,
        'args' => array('send_id'=>(int)$_REQUEST['send_id']),
    ));
}
if(isset($load_pages[1]) && $load_pages[1] == 'newsletter_queue_watch'){
    array_unshift($links,array(
        "name"=>"Sending",
        'm' => 'newsletter',
        'p' => 'newsletter_queue_watch',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        'args' => array('send_id'=>(int)$_REQUEST['send_id']),
    ));
}
if(isset($load_pages[1]) && $load_pages[1] == 'newsletter_statistics'){
    array_unshift($links,array(
        "name"=>"Statistics",
        'm' => 'newsletter',
        'p' => 'newsletter_statistics',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        'args' => array('newsletter_id'=>(int)$_REQUEST['newsletter_id'],'send_id'=>(int)$_REQUEST['send_id']),
    ));
}
if(isset($load_pages[1]) && $load_pages[1] == 'newsletter_preview'){
    array_unshift($links,array(
        "name"=>"Preview",
        'm' => 'newsletter',
        'p' => 'newsletter_preview',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        //'args' => array('newsletter_id'=>false),
    ));
}
$past = module_newsletter::get_newsletters();
if(mysql_num_rows($past)){
    $past_label = _l('Past Newsletters').'<span class="menu_label">'.mysql_num_rows($past).'</span>';
}else{
    $past_label = _l('Past Newsletters');
}
array_unshift($links,array(
    "name"=>$past_label,
    'm' => 'newsletter',
    'p' => 'newsletter_list',
    'order' => $menu_position++,
    'menu_include_parent' => 0,
    'allow_nesting' => 1,
    'args' => array('newsletter_id'=>false),
));
/*if(module_newsletter::can_i('view','Newsletter Campaigns')){
    array_unshift($links,array(
        "name"=>"Campaigns",
        'm' => 'newsletter',
        'p' => 'newsletter_campaign',
        'order' => $menu_position++,
        'menu_include_parent' => 1,
        'allow_nesting' => 1,
        'args' => array('newsletter_id'=>false),
    ));
}
array_unshift($links,array(
    "name"=>"Members",
    'm' => 'newsletter',
    'p' => 'newsletter_member',
    'order' => $menu_position++,
    'menu_include_parent' => 1,
    'allow_nesting' => 1,
    'args' => array('newsletter_id'=>false),
));*/
if(module_newsletter::can_i('view','Newsletter Templates')){
    array_unshift($links,array(
        "name"=>"Templates",
        'm' => 'newsletter',
        'p' => 'newsletter_template',
        'order' => $menu_position++,
        'menu_include_parent' => 0,
        'allow_nesting' => 1,
        'args' => array('newsletter_id'=>false,'newsletter_template_id'=>false),
    ));
}
/*array_unshift($links,array(
    "name"=>"Settings",
    'm' => 'newsletter',
    'p' => 'newsletter_setting',
    'order' => $menu_position++,
    'menu_include_parent' => 1,
    'allow_nesting' => 1,
    'args' => array('newsletter_id'=>false),
));*/


$module->page_title = _l('Newsletter');