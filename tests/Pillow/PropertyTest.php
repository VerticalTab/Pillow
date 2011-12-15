<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

use Pillow\Property;

class PropertyTest extends PHPUnit_Framework_TestCase
{
  /**
   * createFromXml
   * 
   * @test
   */
  public function mapsCorrectly() {
    $xml = simplexml_load_file(__DIR__ .'/responses/search_results.xml');
    $results = $xml->xpath('response/results/result');
    $prop = Property::createFromXml($results[0], $this->getMock('\Pillow\Service', null, array(), '', false));
    
    $this->assertEquals('48749425', $prop->zpid);
    
    $this->assertEquals('2114 Bigelow Ave N', $prop->street);
    $this->assertEquals('98109', $prop->zipcode);
    $this->assertEquals('Seattle', $prop->city);
    $this->assertEquals('WA', $prop->state);
    $this->assertEquals('47.63793', $prop->latitude);
    $this->assertEquals('-122.347936', $prop->longitude);
    
    $this->assertInstanceOf('\Pillow\Links', $prop->links);
    $this->assertEquals("http://www.zillow.com/homedetails/2114-Bigelow-Ave-N-Seattle-WA-98109/48749425_zpid/", $prop->links->homedetails);
    $this->assertEquals('http://www.zillow.com/homedetails/charts/48749425_zpid,1year_chartDuration/?cbt=7522682882544325802%7E9%7EY2EzX18jtvYTCel5PgJtPY1pmDDLxGDZXzsfRy49lJvCnZ4bh7Fi9w**', $prop->links->graphsanddata);
    $this->assertEquals('http://www.zillow.com/homes/map/48749425_zpid/', $prop->links->mapthishome);
    $this->assertEquals('http://www.zillow.com/myestimator/Edit.htm?zprop=48749425', $prop->links->myestimator);
    $this->assertEquals('http://www.zillow.com/homes/comps/48749425_zpid/', $prop->links->comparables);
    
    $this->assertInstanceOf('\Pillow\Zestimate', $prop->zestimate);
    
    $this->assertInstanceOf('\Pillow\Proxy', $prop->chart);
  }
}