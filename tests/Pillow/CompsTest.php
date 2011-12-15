<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

use Pillow\Comps;
use Pillow\Service;

class CompsTest extends PHPUnit_Framework_TestCase
{
  public $service;
  
  public $mockHttpClient;
  
  public function setUp() {
    $this->mockHttpClient = $this->getMock('\Pillow\HttpClient');
    $this->service = new Service('foo', $this->mockHttpClient);
    
  }
  
  /**
   * createFromXml
   * 
   * @test
   */
  public function mapsCorrectly() {
    $xml = simplexml_load_file(__DIR__ .'/responses/comps.xml');
    $chart = Comps::createFromXml($xml, $this->service);
    
    $this->assertCount(5, $chart);
  }
}