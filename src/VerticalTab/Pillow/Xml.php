<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \SimpleXMLElement;

class Xml
{
  /**
   *
   * @param \SimpleXMLElement $root
   * @param string $xpath 
   */
  public static function xstring(SimpleXMLElement $root, $xpath) {
    $el = $root->xpath($xpath);
    if(!$el || count($el) < 1) {
      return '';
    }
    
    return trim((string) $el[0]);
  }
}