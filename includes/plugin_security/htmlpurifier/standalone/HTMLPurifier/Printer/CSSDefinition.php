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

class HTMLPurifier_Printer_CSSDefinition extends HTMLPurifier_Printer
{

    protected $def;

    public function render($config) {
        $this->def = $config->getCSSDefinition();
        $ret = '';

        $ret .= $this->start('div', array('class' => 'HTMLPurifier_Printer'));
        $ret .= $this->start('table');

        $ret .= $this->element('caption', 'Properties ($info)');

        $ret .= $this->start('thead');
        $ret .= $this->start('tr');
        $ret .= $this->element('th', 'Property', array('class' => 'heavy'));
        $ret .= $this->element('th', 'Definition', array('class' => 'heavy', 'style' => 'width:auto;'));
        $ret .= $this->end('tr');
        $ret .= $this->end('thead');

        ksort($this->def->info);
        foreach ($this->def->info as $property => $obj) {
            $name = $this->getClass($obj, 'AttrDef_');
            $ret .= $this->row($property, $name);
        }

        $ret .= $this->end('table');
        $ret .= $this->end('div');

        return $ret;
    }

}

// vim: et sw=4 sts=4
