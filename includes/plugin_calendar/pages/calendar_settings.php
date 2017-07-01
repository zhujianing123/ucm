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

print_heading('Google Calendar Integration');

?>

<p><?php _e('<a href="%s" target="_blank">Click here</a> to see how to add a URL to your Google Calendar. You can choose which calendars to import below:','https://support.google.com/calendar/answer/37100');?></p>

<p><?php _e('Full Calendar Export ');?></p>
<ul>
    <li>
	    All Calendar Entries - Admin: <a href="<?php echo module_calendar::link_calendar('full',array());?>" target="_blank">Copy ical URL</a>
    </li>
	<?php
	$staff_members = module_user::get_staff_members();
	if(count($staff_members)) {
		?>
		<li>
			Individual Staff Member ical URLs are below:
		</li>
		<?php
		foreach ( $staff_members as $staff_member ) {
			?>
			<li>
				Staff: <?php echo $staff_member['name'] . ' ' . $staff_member['last_name'];?>: <a
					href="<?php echo module_calendar::link_calendar( 'full', array(
						'staff_id'   => $staff_member['user_id'],
						'staff_hash' => module_calendar::staff_hash( $staff_member['user_id'] )
					) );?>" target="_blank">Copy ical URL</a>
			</li>
		<?php
		}
	}
	?>
</ul>
<hr>

<p><?php _e('Here is the URL for <strong>Your Alerts</strong> (ie: the listing from the dashbaord).');?></p>
<p>
    <a href="<?php echo module_calendar::link_calendar('alerts',array());?>" target="_blank"><?php echo module_calendar::link_calendar('alerts',array());?></a>
</p>
<hr>

<?php if(is_file('includes/plugin_finance/pages/finance.php')){ ?>
<p><?php _e('Here are the URL\'s for <strong>Completed Finance Transactions</strong> (ie: ones you see in the <a href="%s">transaction listing</a> page).',module_finance::link_open(false));?></p>
<p>
    Credit Transactions: <a href="<?php echo module_calendar::link_calendar('finance_transactions',array('credit'=>1));?>" target="_blank"><?php echo module_calendar::link_calendar('finance_transactions',array('credit'=>1));?></a> <br/>
    Debit Transactions: <a href="<?php echo module_calendar::link_calendar('finance_transactions',array('debit'=>1));?>" target="_blank"><?php echo module_calendar::link_calendar('finance_transactions',array('debit'=>1));?></a>
</p>
<hr>

<p><?php _e('Here are the URL\'s for <strong>Recurring Finance Transactions</strong> (ie: anything upcoming in the <a href="%s">recurring transactions listing</a> page).',module_finance::link_open_recurring(false));?></p>
<p>
    Credit Transactions: <a href="<?php echo module_calendar::link_calendar('finance_recurring',array('credit'=>1));?>" target="_blank"><?php echo module_calendar::link_calendar('finance_recurring',array('credit'=>1));?></a> <br/>
    Debit Transactions: <a href="<?php echo module_calendar::link_calendar('finance_recurring',array('debit'=>1));?>" target="_blank"><?php echo module_calendar::link_calendar('finance_recurring',array('debit'=>1));?></a>
</p>
<hr>
<p><?php _e('Here is the URL for <strong>Weekly Finance Summary</strong> (ie: amount invoiced, earnt and spent at the end of each week).');?></p>
<p>
    <a href="<?php echo module_calendar::link_calendar('finance_summary',array());?>" target="_blank"><?php echo module_calendar::link_calendar('finance_summary',array());?></a>
</p>

<?php }else{ ?>

    <p>
        <?php _e('Please install the <a href="%s" target="_blank">Finance Plugin</a> to receive more financial reporting in the calendar.','http://codecanyon.net/item/ucm-plugin-finance-manager/1396831?ref=dtbaker');?>
    </p>

<?php } ?>



    