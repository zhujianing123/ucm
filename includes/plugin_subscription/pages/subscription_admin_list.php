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


if(!module_config::can_i('edit','Settings')){
    redirect_browser(_BASE_HREF);
}

$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : array();
$subscriptions = module_subscription::get_subscriptions($search);

$pagination = process_pagination($subscriptions);

$heading = array(
    'title' => 'Subscriptions',
    'type' => 'h2',
        'main' => true,
);
if(module_subscription::can_i('create','Subscriptions')){
    $heading['button'] = array(
        'title' => "Create New Subscription",
        'type' => 'add',
        'url' => module_subscription::link_open('new'),
    );
}
print_heading($heading);

?>




<form action="" method="post">

<?php echo $pagination['summary'];?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="tableclass tableclass_rows">
	<thead>
	<tr class="title">
		<th><?php echo _l('Subscription Name'); ?></th>
		<th><?php echo _l('Repeat Every'); ?></th>
		<th><?php echo _l('Amount'); ?></th>
		<th><?php echo _l('Member Count'); ?></th>
		<th><?php echo _l('Customer Count'); ?></th>
		<th><?php echo _l('Website Count'); ?></th>
		<th><?php echo _l('Automatically Renew'); ?></th>
		<th><?php echo _l('Automatically Email'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
	$c=0;
	foreach($pagination['rows'] as $subscription){ ?>
        <tr class="<?php echo ($c++%2)?"odd":"even"; ?>">
            <td class="row_action">
	            <?php echo module_subscription::link_open($subscription['subscription_id'],true,$subscription); ?>
            </td>
            <td>
				<?php
                if(!$subscription['days']&&!$subscription['months']&&!$subscription['years']){
                    echo _l('Once off');
                }else{
                    $bits = array();
                    if($subscription['days']>0){
                        $bits[] = _l('%s days',$subscription['days']);
                    }
                    if($subscription['months']>0){
                        $bits[] = _l('%s months',$subscription['months']);
                    }
                    if($subscription['years']>0){
                        $bits[] = _l('%s years',$subscription['years']);
                    }
                    echo _l('Every %s',implode(', ',$bits));
                }
				?>
            </td>
            <td>
				<?php
                echo dollar($subscription['amount'],true,$subscription['currency_id']);
				?>
            </td>
            <td> <?php echo htmlspecialchars($subscription['member_count']); ?> </td>
            <td> <?php echo htmlspecialchars($subscription['customer_count']); ?> </td>
            <td> <?php echo htmlspecialchars($subscription['website_count']); ?> </td>
            <td><?php echo $subscription['automatic_renew'] ? _l('Yes') : _l('No');?></td>
            <td><?php echo $subscription['automatic_email'] ? _l('Yes') : _l('No');?></td>
        </tr>
	<?php } ?>
  </tbody>
</table>
<?php echo $pagination['links'];?>
</form>

<?php


module_config::print_settings_form(
    array(
        'title' => 'Subscription Options',
        'settings' => array(
            array(
                'key' => 'subscription_invoice_due_date',
                'default' => 0,
                'type' => 'text',
                'description' => 'Invoice Due Date Days',
                'help' => 'How many days after the invoice is created should the due date be set?',
            )
        )
    )
);

?>