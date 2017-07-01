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

class Stripe_AttachedObject extends Stripe_Object
{
  public function replaceWith($properties)
  {
    $removed = array_diff(array_keys($this->_values), array_keys($properties));
    // Don't unset, but rather set to null so we send up '' for deletion.
    foreach ($removed as $k) {
      $this->$k = null;
    }

    foreach ($properties as $k => $v) {
      $this->$k = $v;
    }
  }
}
