<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \SimpleXMLElement;
use \SplObjectStorage;
use \Iterator;
use \ArrayAccess;
use \Exception;

class ResultSet implements Iterator, ArrayAccess
{
  /**
   *
   * @var array[int]Object 
   */
  private $results;
  
  private $key;
  
  public function __construct() {
    $this->results = array();
    $this->key = 0;
  }
  
  /**
   *
   * @return mixed false if none exist 
   */
  public function current() {
    if(isset($this->results[$this->key])) {
      return $this->results[$this->key];
    } else {
      return false;
    }
  }

  public function key() {
    return $this->key;
  }

  public function next() {
    $this->key++;
  }

  public function rewind() {
    $this->key = 0;
  }

  public function valid() {
    return (isset($this->results[$this->key]));
  }
  
  public function offsetExists($offset) {
    return (isset($this->results[$offset]));
  }

  public function offsetGet($offset) {
    return (isset($this->results[$offset])) ? $this->results[$offset] : null;
  }

  public function offsetSet($offset, $value) {
    if(is_null($offset)) {
      $this->results[] = $value;
    } else {
      $this->results[$offset] = $value;
    }
  }

  public function offsetUnset($offset) {
    unset($this->results[$offset]);
  }
}