<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2009, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \SimpleXMLElement;

class Chart
{
  const UNIT_DOLLAR = 'dollar';
  const UNIT_PERCENT = 'percent';
  
  private static $defaultUnitType = self::UNIT_DOLLAR;
  
  private static $defaultWidth = '200';
  
  private static $defaultHeight = '100';
  
  private static $defaultDuration = '5years';
  
  
  /**
   *
   * @var number
   */
  public $width;
  
  /**
   *
   * @var number
   */
  public $height;
  
  /**
   *
   * @var string
   */
  public $unitType;
  
  /**
   *
   * @var url $url
   */
  public $url;
  
  public static function setDefaultUnitType($unitType) {
    self::$defaultUnitType = $unitType;
  }
  
  public static function setDefaultWidth($width) {
    self::$defaultWidth = $width;
  }
  
  public static function setDefaultHeight($height) {
    self::$defaultHeight = $height;
  }
  
  public static function setDefaultDuration($duration) {
    self::$defaultDuration = $duration;
  }
  
  public static function getDefaultUnitType() {
    return self::$defaultUnitType;
  }
  
  public static function getDefaultWidth() {
    return self::$defaultWidth;
  }
  
  public static function getDefaultHeight() {
    return self::$defaultHeight;
  }
  
  public static function getDefaultDuration() {
    return self::$defaultDuration;
  }
  
  /**
   *
   * @param SimpleXMLElement $xml 
   */
  public static function createFromXml(SimpleXMLElement $xml) {
    $c = new Chart();
    
    $c->width = Xml::xstring($xml, 'request/width');
    $c->height = Xml::xstring($xml, 'request/height');
    $c->unitType = Xml::xstring($xml, 'request/unit-type');
    $c->url = Xml::xstring($xml, 'response/url');
    
    return $c;
  }
}

