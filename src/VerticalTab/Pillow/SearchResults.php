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

class SearchResults extends ResultSet
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
   * @return SearchResults
   */
  public static function createFromXml(SimpleXMLElement $xml, $service) {
    $results = new SearchResults();
    
    foreach($xml->xpath('response/results/result') as $xmlResult) {
      $results[] = Property::createFromXml($xmlResult, $service);
    }
    
    return $results;
  }
}