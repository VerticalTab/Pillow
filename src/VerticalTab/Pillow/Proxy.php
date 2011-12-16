<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2009, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \Iterator;

class Proxy implements Iterator
{
  private $service;
  
  private $method;
  
  private $args;
  
  private $obj;
  
  public function __construct($service, $method, $args) {
    $this->service = $service;
    $this->method = $method;
    $this->args = $args;
  }
  
  public function __get($name) {
    $obj = $this->getObject();
    
    return $obj->$name;
  }
  
  public function current() {
    $obj = $this->getObject();
    return $obj->current();
  }

  public function key() {
    $obj = $this->getObject();
    return $obj->key();
  }

  public function next() {
    $obj = $this->getObject();
    return $obj->next();
  }

  public function rewind() {
    $obj = $this->getObject();
    return $obj->rewind();
  }

  public function valid() {
    $obj = $this->getObject();
    return $obj->valid();
  }
  
  private function getObject() {
    if(!$this->obj) {
      $this->obj = call_user_func_array(array($this->service, $this->method), $this->args);
    }
    
    return $this->obj;
  }

}