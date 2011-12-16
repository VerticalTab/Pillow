<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2009, Rob Apodaca
 */

namespace VerticalTab\Pillow;

use \DateTime;

class Date extends DateTime
{
  public function __toString() {
    return $this->format('m/d/Y');
  }
}