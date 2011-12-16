<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

use VerticalTab\Pillow\Service;

class ServiceTest extends PHPUnit_Framework_TestCase
{
  public $service;
  
  public $mockHttpClient;
  
  public function setUp() {
    $this->mockHttpClient = $this->getMock('\VerticalTab\Pillow\HttpClient');
    $this->service = new Service('foo', $this->mockHttpClient);
    
  }
  
  /**
   * getSearchResults
   * 
   * @test
   */
  public function createResultSetWithOneResult() {
    $address = '555test';
    $zip = '444';
    $url = "/webservice/GetSearchResults.htm?zws-id=foo&address=$address&citystatezip=$zip";
    
    $response = simplexml_load_string(file_get_contents(__DIR__ .'/responses/search_results.xml'));
    $this->mockHttpClient->expects($this->once())
         ->method('get')
         ->with($this->equalTo($url))
         ->will($this->returnValue($response));
    
    $results = $this->service->getSearchResults($address, $zip);
    
    $this->assertEquals(1, count($results));
    $this->assertInstanceOf('\VerticalTab\Pillow\Property', $results->current());
  }
  
  /**
   * getChart
   * 
   * @test
   */
  public function createsChart() {
    $zpid = 'zpid';
    $unitType = 'ut';
    $width = '100';
    $height = '200';
    $chartDuration = '2year';
    $url = "/webservice/GetChart.htm?zws-id=foo&zpid=$zpid&unit-type=$unitType&width=$width&height=$height&chartDuration=$chartDuration";
    $response = simplexml_load_string(file_get_contents(__DIR__ .'/responses/chart.xml'));
    $this->mockHttpClient->expects($this->once())
         ->method('get')
         ->with($this->equalTo($url))
         ->will($this->returnValue($response));
    
    $chart = $this->service->getChart($zpid, $width, $height, $unitType, $chartDuration);
    
    $this->assertInstanceOf('\VerticalTab\Pillow\Chart', $chart);
  }
  
  /**
   * getComps
   * 
   * @test
   */
  public function createsComps() {
    $zpid = 'zpid';
    $count = 5;
    $url = "/webservice/GetComps.htm?zws-id=foo&zpid=$zpid&count=$count";
    $response = simplexml_load_string(file_get_contents(__DIR__ .'/responses/comps.xml'));
    $this->mockHttpClient->expects($this->once())
         ->method('get')
         ->with($this->equalTo($url))
         ->will($this->returnValue($response));
    
    $comps = $this->service->getComps($zpid, $count);
    $this->assertCount($count, $comps);
  }
}