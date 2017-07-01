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
/*
  Copyright (C) 2006 Google Inc.

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/**
 * Classes used to generate XML data
 * Based on sample code available at http://simon.incutio.com/code/php/XmlWriter.class.php.txt 
 */

  /**
   * Generates xml data
   */
  class gc_XmlBuilder {
    var $xml;
    var $indent;
    var $stack = array();

    function gc_XmlBuilder($indent = '  ') {
      $this->indent = $indent;
      $this->xml = '<?xml version="1.0" encoding="utf-8"?>'."\n";
    }

    function _indent() {
      for ($i = 0, $j = count($this->stack); $i < $j; $i++) {
        $this->xml .= $this->indent;
      }
    }

    //Used when an element has sub-elements
    // This function adds an open tag to the output
    function Push($element, $attributes = array()) {
      $this->_indent();
      $this->xml .= '<'.$element;
      foreach ($attributes as $key => $value) {
        if(!empty($value))
          $this->xml .= ' '.$key.'="'.htmlentities($value).'"';
      }
      $this->xml .= ">\n";
      $this->stack[] = $element;
    }

    //Used when an element has no subelements.
    //Data within the open and close tags are provided with the 
    //contents variable
    function Element($element, $content, $attributes = array()) {
      $this->_indent();
      $this->xml .= '<'.$element;
      foreach ($attributes as $key => $value) {
        $this->xml .= ' '.$key.'="'.htmlentities($value).'"';
      }
      $this->xml .= '>'.htmlentities($content).'</'.$element.'>'."\n";
    }

    function EmptyElement($element, $attributes = array()) {
      $this->_indent();
      $this->xml .= '<'.$element;
      foreach ($attributes as $key => $value) {
        $this->xml .= ' '.$key.'="'.htmlentities($value).'"';
      }
      $this->xml .= " />\n";
    }

    //Used to close an open tag
    function Pop($pop_element) {
      $element = array_pop($this->stack);
      $this->_indent();
      if($element !== $pop_element) 
        die('XML Error: Tag Mismatch when trying to close "'. $pop_element. '"');
      else
        $this->xml .= "</$element>\n";
    }

    function GetXML() {
      if(count($this->stack) != 0)
        die ('XML Error: No matching closing tag found for " '. array_pop($this->stack). '"');
      else
        return $this->xml;
    }
  }
?>
