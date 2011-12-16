<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

use VerticalTab\Pillow\Zestimate;

class ZestimateTest extends PHPUnit_Framework_TestCase
{
  
  /**
   * createFromXml
   * 
   * @test
   */
  public function mapsCorrectly() {
    $xml = simplexml_load_file(__DIR__ .'/responses/search_results.xml');
    $results = $xml->xpath('//results[1]/result/zestimate');
    $z = Zestimate::createFromXml($results[0]);
    
    $this->assertEquals('1219500', $z->amount);
    $this->assertEquals('11/03/2009', $z->lastUpdated);
    $this->assertEquals('-41500', $z->thirtyDayChange);
    $this->assertEquals('0', $z->percentile);
    $this->assertInstanceOf('\VerticalTab\Pillow\Range', $z->range);
  }
}