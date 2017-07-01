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

$user_id = (int)$_SESSION['_user_id'];
	
if($user_id){ 
	$user = $module->get_user($user_id);
	//$user_notes = $module->get_user_notes($user_id);
	?>
	
	<h2><?php echo _l('Your Details'); ?></h2>
	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="2" class="tableclass">
	  <tr>
	  	<td width="13%"><?php echo _l('Full Name'); ?></td>
	    <td width="37%"><?php echo ($user['name']); ?></td>
	     <td width="13%">
	     
	     </td>
	    <td width="37%"> </td>
	  </tr>
	  <tr>
	    <td><?php echo _l('Email Address'); ?></td>
	    <td><?php echo ($user['email']); ?></td>
	    <td></td>
	    <td></td>
	  </tr>
	  
	 
	  <tr>
	    <td><?php echo _l('Phone'); ?></td>
	    <td><?php echo ($user['phone']); ?></td>
	  </tr>
	  <tr>
	    <td><?php echo _l('Fax'); ?></td>
	    <td><?php echo ($user['fax']); ?></td>
	  </tr>
	  <tr>
	    <td><?php echo _l('Mobile'); ?></td>
	    <td><?php echo ($user['mobile']); ?></td>
	  </tr>
	 
	</table>
	
<?php  }  ?>