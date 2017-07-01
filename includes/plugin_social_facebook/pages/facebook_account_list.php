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

if(!module_social::can_i('view','Facebook','Social','social')){
    die('No permissions to view Facebook accounts');
}

$facebook_accounts = module_social_facebook::get_accounts();

$header_buttons = array();
$header_buttons[] = array(
    'url' => module_social_facebook::link_open('new',false),
    'title' => 'Add New Facebook Account',
    'type' => 'add',
);

print_heading(array(
    'main' => true,
    'type' => 'h2',
    'title' => 'Facebook Accounts',
    'button' => $header_buttons,
));

?>

<table class="tableclass tableclass_full tableclass_rows">
    <thead>
    <tr class="title">
        <th><?php echo _l('Facebook Account Name'); ?></th>
        <th><?php echo _l('Last Checked'); ?></th>
        <!--<th><?php /*echo _l('Facebook Pages'); */?></th>-->
    </tr>
    </thead>
    <tbody>
    <?php
    $c=0;
    foreach($facebook_accounts as $facebook_account){ ?>
        <tr class="<?php echo ($c++%2)?"odd":"even"; ?>">
            <td class="row_action">
                <?php echo module_social_facebook::link_open($facebook_account['social_facebook_id'],true,$facebook_account); ?>
            </td>
            <td>
                <?php
                echo print_date($facebook_account['last_checked'],true);
                ?>
            </td>
            <!--<td>
                <?php
/*
                */?>
            </td>-->
        </tr>
    <?php } ?>
  </tbody>
</table>