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

class Stripe_Error extends Exception
{
  public function __construct($message=null, $http_status=null, $http_body=null, $json_body=null)
  {
    parent::__construct($message);
    $this->http_status = $http_status;
    $this->http_body = $http_body;
    $this->json_body = $json_body;
  }

  public function getHttpStatus()
  {
    return $this->http_status;
  }

  public function getHttpBody()
  {
    return $this->http_body;
  }

  public function getJsonBody()
  {
    return $this->json_body;
  }
}
