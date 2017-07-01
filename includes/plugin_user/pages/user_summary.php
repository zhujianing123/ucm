<table width="100%" border="0" cellspacing="0" cellpadding="2" class="tableclass tableclass_form">
	<tbody>
		<tr>
			<th>
				<?php 
/** 
  * Copyright: dtbaker 2012
  * Licence: Please check CodeCanyon.net for licence details. 
  * More licence clarification available here:  http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
  * Deploy: 10509 6566fbbc14e47c4c2873c255bd4c7a96
  * Envato: 1100806b-c9fc-484c-80fa-ee3b4b7a2080
  * Package Date: 2016-04-14 02:55:25 
  * IP Address: 1
  */ echo _l('Contact Name'); ?>
			</th>
			<td>
				<?php echo $user_data['name'];?>
				<a href="<?php echo $plugins['user']->link_open($user_id);?>">&raquo;</a>
			</td>
		</tr>
		<tr>
			<th>
				<?php echo _l('Phone'); ?>
			</th>
			<td>
				<?php echo $user_data['phone'];?>
			</td>
		</tr>
		<tr>
			<th>
				<?php echo _l('Mobile'); ?>
			</th>
			<td>
				<?php echo $user_data['mobile'];?>
			</td>
		</tr>
		<tr>
			<th>
				<?php echo _l('Fax'); ?>
			</th>
			<td>
				<?php echo $user_data['fax'];?>
			</td>
		</tr>
		<tr>
			<th>
				<?php echo _l('Email'); ?>
			</th>
			<td>
				<a href="mailto:<?php echo $user_data['email'];?>"><?php echo $user_data['email'];?></a>
			</td>
		</tr>
		<tr>
			<th>

			</th>
			<td>
                <a href="<?php echo $plugins['user']->login_link($user_id);?>">Login as this Administrator &raquo;</a>
			</td>
		</tr>
	</tbody>
</table>