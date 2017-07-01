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




if(isset($_REQUEST['social_twitter_id']) && !empty($_REQUEST['social_twitter_id'])){
    $social_twitter_id = (int)$_REQUEST['social_twitter_id'];
	$social_twitter = module_social_twitter::get($social_twitter_id);
    include('twitter_account_edit.php');
}else{

	if(_DEMO_MODE){
		?>
		<p>Demo Mode Notice: <strong>This is a public demo. Please only use TEST accounts here as others will see them.</strong></p>
		<?php
	}

	print_heading('Twitter Settings');
	?>
	<p>Please go to <a href="https://apps.twitter.com/" target="_blank">https://apps.twitter.com/</a> and create an app. Enter your API Keys below: <?php _h('Signin with Twitter at https://apps.twitter.com/ and click the Create New App button. Enter a Name, Description, Website and in the Callback URL just put your website address. Once created, go to Permissions and choose "Read, write, and direct messages" then go to API Keys and copy your API Key and API Secret from here into the below form.'); ?></p>
	<?php
	module_config::print_settings_form(
	    array(
	         array(
	            'key'=>'social_twitter_api_key',
	            'default'=>'',
	             'type'=>'text',
	             'description'=>'App API Key ',
	             'help'=>'The API key obtained from creating your app on dev.twitter.com ',
	         ),
	         array(
	            'key'=>'social_twitter_api_secret',
	            'default'=>'',
	             'type'=>'text',
	             'description'=>'App API Secret ',
	             'help'=>'The API secret obtained from creating your app on dev.twitter.com ',
	         ),
	    )
	);

	// show twitter app settings here.
	include('twitter_account_list.php');
}
