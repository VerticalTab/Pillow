<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \SimpleXMLElement;

class Comps extends ResultSet
{
  
  private static $defaultCompCount = 2;
  
  /**
   *
   * @return Property 
   */
  public function current() {
    $current = parent::current();
    
    if(!$current) {
      return new Property();
    } else {
      return $current;
    }
  }
  
  /**
   *
   * @param number $count 
   */
  public static function setDefaultCompCount($count) {
    self::$defaultCompCount = $count;
  }
  
  /**
   *
   * @return number 
   */
  public static function getDefaultCompCount() {
    return self::$defaultCompCount;
  }
  
  /**
   *
   * @param SimpleXMLElement $xml
   * @param Service $service
   * @return Comps
   */
  public static function createFromXml($xml, $service) {
    $comps = new Comps;
    
    foreach($xml->xpath('//response/properties/comparables/comp') as $xmlResult) {
      $comps[] = Property::createFromXml($xmlResult, $service);
    }
    
    return $comps;
  }
}