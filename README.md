Pillow - Zillow PHP client
==========================

This library provides a PHP interface for the Zillow API. 

See: [zillow.com](http://www.zillow.com/howto/api/APIOverview.htm) for more information.

Requirements
------------

PHP >= 5.3

Installation
------------

The preferred method of installation is [composer](http://getcomposer.org/). In
you project root (not web root), create a minimum [composer.json](http://packagist.org/) file:

    {
        "require": {
            "VerticalTab/Pillow": "x.x.x"
        }
    }

Replace "x.x.x" above with the tag number you want to use. Note: see 
[VeriticalTab/Pillow Packagist page](http://packagist.org/packages/VerticalTab/Pillow) 
for latest release information.

Next, get composer and use it to install (again, in your project root)

    $ wget http://getcomposer.org/composer.phar
    $ php composer.phar install

This will put the library into your vendors directory.

Updating
--------

To update after installation, edit the "require" section in composer.json. Then
update:

    $ php composer.phar update

Examples
--------

File: simple.php

    <?php
    require 'vendor/.composer/autoload.php';
    
    use VerticalTab\Pillow\Service;
    
    $key = 'your zillow api key';
    $s = new Service($key);
    $results = $s->getSearchResults('2114 Bigelow Ave', '98109');
    $property = $results->current();
    
    "Results:" . PHP_EOL;
    echo "zpid      : " . $property->zpid . PHP_EOL;
    echo "city      : " . $property->city . PHP_EOL;

Run simple example

    $ php simple.php

File: chart.php

    <?php
    require 'vendor/.composer/autoload.php';
    
    use VerticalTab\Pillow\Service;
    
    $key = 'your zillow api key';
    $s = new Service($key);
    $results = $s->getSearchResults('2114 Bigelow Ave', '98109');
    $property = $results->current();
    
    echo "chart url : " . $property->chart->url . PHP_EOL;

Run chart example:

    $ php chart.php

File: comps.php

    <?php
    require 'vendor/.composer/autoload.php';

    use VerticalTab\Pillow\Service;

    $key = 'your zillow api key';
    $s = new Service($key);
    $results = $s->getSearchResults('2114 Bigelow Ave', '98109');
    $property = $results->current();
    
    foreach($property->comps as $i => $comp) {
      echo "\tcomp      : " . $i . PHP_EOL;
      echo "\tzpid      : " . $comp->zpid . PHP_EOL;
      echo "\tzestimate : " . $comp->zestimate->amount . PHP_EOL;
      echo PHP_EOL;
    }

Run comps example:

    $ php comps.php
