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
    $body = '';
    
    $fp = @fsockopen($this->host, 80, $errno, $errstr);
    if(!$fp) {
      $msg = "Failed to open connection {$this->host} $errno $errstr";
      throw new Exception($msg);
    }
    
    fwrite($fp, $this->buildHeader($url));
    $headerFound = false;
    while(!feof($fp)) {
      $line = fgets($fp);
      if($line === "\r\n") {
        $headerFound = true;
        $line = '';
      }
      if($headerFound) {
        $body .= $line;
      }
    }
    fclose($fp);
    
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
    $head = "GET $url HTTP/1.1\r\n"
          . "Host: {$this->host}\r\n"
          . "Content-type: text/xml\r\n"
          . "Connection: Close\r\n";
    return $head . "\r\n";
  }
}