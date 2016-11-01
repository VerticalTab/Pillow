<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \Exception;

class HttpClient
{
  /**
   *
   * @var string
   */
  private $host;
  
  /**
   *
   * @param string $host 
   */
  public function __construct($host = 'www.zillow.com') {
    $this->host = $host;
  }
  
  /**
   * Gets the url (relative to host)
   * 
   * @param string $url
   * @return \SimpleXMLElement 
   */
  public function get($url) {
    $opts = ['http' =>
      [
        'method'  => 'GET',
        'header'  => $this->buildHeader($url),
      ]
    ];
    $context  = stream_context_create($opts);

    $body = file_get_contents('http://'.$this->host.$url, false, $context);
    if($body === false) {
        throw new Exception('Unable to retrieve results');
    }

    $xml = @simplexml_load_string($body);
    if(!$xml) {
      throw new Exception('Unable to load xml result');
    }

    return $xml;
  }
  
  /**
   * Builds and returns the request head string
   * 
   * @param string $url
   * @return string
   */
  private function buildHeader($url) {
    $head = "Content-type: text/xml\r\n"
          . "Connection: Close\r\n";
    return $head . "\r\n";
  }
}
