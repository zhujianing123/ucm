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

if(!module_social::can_i('edit','Twitter','Social','social')){
    die('No access to Twitter accounts');
}

$social_twitter_id = isset($_REQUEST['social_twitter_id']) ? (int)$_REQUEST['social_twitter_id'] : 0;
$twitter_account = new ucm_twitter_account($social_twitter_id);


?>
Manually refreshing twitter data...
<?php

$twitter_account->import_data(true);
