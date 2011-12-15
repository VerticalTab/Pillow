<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2011, Rob Apodaca
 */

namespace PillowTest;

class Autoloader
{
  private $basePath;
  
  public function __construct($basePath) {
    $this->basePath = $basePath;
  }
  
  public function autoLoad($className) {
    $filename = $this->basePath . '/' 
      . str_replace('\\', '/', $className)
      . '.php';
    if(file_exists($filename)) {
      require $filename;
    }
  }
  
  public function register() {
    spl_autoload_register(array($this, 'autoload'));
  }
}

$pillowAutoLoader = new Autoloader(__DIR__ . '/../src/');
$pillowAutoLoader->register();