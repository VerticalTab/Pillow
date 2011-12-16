<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

use VerticalTab\Pillow\Service;
use VerticalTab\Pillow\Proxy;

class ProxyTest extends PHPUnit_Framework_TestCase
{
  public function setUp() {
    $this->mockHttpClient = $this->getMock('\VerticalTab\Pillow\HttpClient');
    $this->service = new Service('foo', $this->mockHttpClient);
    
  }
  
  /**
   * @test
   */
  public function callsServiceMethodWithArgsWhenClassPropertyAccessed() {
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
    
    $proxy = new Proxy($this->service, 'getChart', array($zpid, $width, $height, $unitType, $chartDuration));
    $this->assertEquals('http://example.com', $proxy->url);
  }
}