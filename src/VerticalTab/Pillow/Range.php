<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2009, Rob Apodaca
 */

namespace VerticalTab\Pillow;

class Range
{
  public $low;
  
  public $high;
  
  public static function createFromXml($xml) {
    $r = new Range;
    
    $r->low = Xml::xstring($xml, 'low');
    $r->high = Xml::xstring($xml, 'high');
    
    return $r;
  }
}