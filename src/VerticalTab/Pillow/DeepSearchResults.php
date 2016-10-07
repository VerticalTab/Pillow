<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \SimpleXMLElement;
use \SplObjectStorage;
use \Iterator;
use \ArrayAccess;
use \Exception;

class DeepSearchResults extends ResultSet
{
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
   * @param SimpleXMLElement $xml 
   * @param Service $service
   * @return DeepSearchResults
   */
  public static function createFromXml(SimpleXMLElement $xml, $service) {
    $results = new DeepSearchResults();
    
    foreach($xml->xpath('response/results/result') as $xmlResult) {
      $results[] = Property::createFromXmlDeep($xmlResult, $service);
    }
    
    return $results;
  }
}