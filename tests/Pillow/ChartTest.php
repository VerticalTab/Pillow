<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

use VerticalTab\Pillow\Chart;

class ChartTest extends PHPUnit_Framework_TestCase
{
    /**
   * createFromXml
   * 
   * @test
   */
  public function mapsCorrectly() {
    $xml = simplexml_load_file(__DIR__ .'/responses/chart.xml');
    $chart = Chart::createFromXml($xml);
    
    $this->assertEquals('300', $chart->width);
    $this->assertEquals('150', $chart->height);
    $this->assertEquals('percent', $chart->unitType);
    
    $this->assertEquals('http://example.com', $chart->url);
  }
}