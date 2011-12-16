<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2009, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \SimpleXMLElement;

class Links
{
  public $homedetails;
  
  public $graphsanddata;
  
  public $mapthishome;
  
  public $myestimator;
  
  public $comparables;
  
  /**
   *
   * @param SimpleXMLElement $xml
   * @return Links 
   */
  public static function createFromXml(SimpleXMLElement $xml) {
    $links = new Links;
    
    $links->homedetails = Xml::xstring($xml, 'homedetails');
    $links->graphsanddata = Xml::xstring($xml, 'graphsanddata');
    $links->mapthishome = Xml::xstring($xml, 'mapthishome');
    $links->myestimator = Xml::xstring($xml, 'myestimator');
    $links->comparables = Xml::xstring($xml, 'comparables');
    
    return $links;
  }
}