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


if(!module_config::can_i('view','Settings')){
    redirect_browser(_BASE_HREF);
}

print_heading('FAQ Settings');
$c = array();
$customers = module_customer::get_customers();
foreach($customers as $customer){
    $c[$customer['customer_id']] = $customer['customer_name'];
}

module_config::print_settings_form(
    array(
        array(
            'key'=>'faq_ticket_show_product_selection',
            'default'=>1,
            'type'=>'checkbox',
            'description'=>'Show product selection on ticket submit form.',
        ),
    )
);

?>

<?php

print_heading('FAQ Embed');
?>
<p>
    <?php _e('Place this in an iframe on your website, or as a link on your website, and people can view FAQ tickets.'); ?>
</p>
<p><a href="<?php echo module_faq::link_open_public(-1);?>?show_search=1&show_header=1&show_product=1" target="_blank"><?php echo module_faq::link_open_public(-1);?>?show_search=1&show_header=1&show_product=1</a></p>

<?php

print_heading('FAQ WordPress Plugin');
?>
<p>
    You can use this basic WordPress plugin to embed FAQ items onto your WordPress blog. Some PHP knowledge is required, this is a slightly advanced technique. https://github.com/dtbaker/ucm-wordpress
</p>
