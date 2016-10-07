<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace VerticalTab\Pillow;

class Service
{
  /**
   *
   * @var string
   */
  private $zwsId;
  
  /**
   *
   * @var HttpClient 
   */
  private $httpClient;
  
  /**
   *
   * @var array[string]string
   */
  private $cache;
  
  /**
   *
   * @param string $zwsId
   * @param HttpClient $opt_httpClient 
   */
  public function __construct($zwsId, $opt_httpClient = null) {
    $this->zwsId = $zwsId;
    $this->httpClient = ($opt_httpClient) ? $opt_httpClient : new HttpClient();
    $this->cache = array();
  }
  
  /**
   * Gets Search Result http://www.zillow.com/howto/api/GetSearchResults.htm
   * 
   * @param string $address
   * @param string $cityStateZip
   * @return SearchResults 
   */
  public function getSearchResults($address, $cityStateZip) {
    $url = '/webservice/GetSearchResults.htm?'
         . 'zws-id='       . $this->zwsId . '&'
         . 'address='      . urlencode( $address ) . '&'
         . 'citystatezip=' . urlencode( $cityStateZip );
    
    return $this->fetch($url, 'VerticalTab\Pillow\SearchResults');
  }

  public function getDeepSearchResults($address, $cityStateZip) {
    $url = '/webservice/GetDeepSearchResults.htm?'
         . 'zws-id='       . $this->zwsId . '&'
         . 'address='      . urlencode( $address ) . '&'
         . 'citystatezip=' . urlencode( $cityStateZip );

    return $this->fetch($url, 'VerticalTab\Pillow\DeepSearchResults');
  }
  
  /**
   * Gets Chart http://www.zillow.com/howto/api/GetChart.htm
   * 
   * @param string $zpid
   * @param number $width
   * @param number $height
   * @param string $unitType
   * @param string $chartDuration
   * @return Chart 
   */
  public function getChart($zpid, $width, $height, $unitType, $chartDuration) {
    $url = '/webservice/GetChart.htm?'
         . 'zws-id='         . $this->zwsId . '&'
         . 'zpid='           . $zpid . '&'
         . 'unit-type='      . $unitType . '&'
         . 'width='          . $width . '&'
         . 'height='         . $height . '&'
         . 'chartDuration='  . $chartDuration;
    
    return $this->fetch($url, 'VerticalTab\Pillow\Chart');
  }
  
  /**
   * Gets Comparables http://www.zillow.com/howto/api/GetComps.htm
   * 
   * @param string $zpid
   * @param number $count
   * @return Comps
   */
  public function getComps($zpid, $count) {
    $url = '/webservice/GetComps.htm?'
         . 'zws-id='    . $this->zwsId . '&'
         . 'zpid='      . $zpid . '&'
         . 'count='     . $count
         ;
    
    return $this->fetch($url, 'VerticalTab\Pillow\Comps');
  }
  
  /**
   * Uses httpClient to fetch results and map to an object of type $className
   * 
   * @param string $url
   * @param string $className
   * @return obj
   */
  private function fetch($url, $className) {
    $key = sha1($url);
    
    if(! isset($this->cache[$key])) {
      $xml = $this->httpClient->get($url);
      $this->cache[$key] = call_user_func_array(
              array($className, 'createFromXml'), array($xml, $this));
    }
    
    return $this->cache[$key];
  }
}