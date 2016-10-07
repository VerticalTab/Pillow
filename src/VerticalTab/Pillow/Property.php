<?php
/**
 * @author Rob Apodaca <rob.apodaca@gmail.com>
 * @copyright Copyright (c) 2009, Rob Apodaca
 */

namespace VerticalTab\Pillow;

class Property
{
  /**
   * zpid
   * @var string $zpid
   */
  public $zpid;

  /**
   * Group of zillow links for the property
   * @var Links $links
   */
  public $links;

  /**
   * Street
   * @var string $street
   */
  public $street;

  /**
   * Zip
   * @var string $zipcode
   */
  public $zipcode;

  /**
   * City
   * @var string $city
   */
  public $city;

  /**
   * State
   * @var string $state
   */
  public $state;

  /**
   * latitude
   * @var string $latitude
   */
  public $latitude;

  /**
   * longitude
   * @var string $longitude
   */
  public $longitude;

  /**
   * fips county
   * @var string $fipsCounty
   */
  public $fipsCounty;

  /**
   * number of bathrooms
   * @var string $bathrooms
   */
  public $bathrooms;

  /**
   * number of bedrooms
   * @var string $bedrooms
   */
  public $bedrooms;

  /**
   * The use code
   * @var string $useCode
   */
  public $useCode;

  /**
   * year prop was built
   * @var string $yearBuilt
   */
  public $yearBuilt;

  /**
   * lot size
   * @var string $lotSizeSqFt
   */
  public $lotSizeSqFt;

  /**
   * finished size
   * @var string $finishedSqFt
   */
  public $finishedSqFt;

  /**
   * date last sold
   * @var string $lastSoldDate
   */
  public $lastSoldDate;

  /**
   * Price last sold
   * @var string $lastSoldPrice
   */
  public $lastSoldPrice;

  /**
   * The zestimate which accompanies the property
   * @var Zestimate $zestimate
   */
  public $zestimate;
  
  /**
   *
   * @var Chart
   */
  public $chart;
  
  /**
   *
   * @var Comps
   */
  public $comps;
  
  /**
   *
   * @param SimpleXMLElement $xml
   * @param Service $service
   * @return Property 
   */
  public static function createFromXml($xml, $service) {
    $prop = new Property();
    
    $prop->zpid = Xml::xstring($xml, 'zpid');
    $prop->street = Xml::xstring($xml, 'address/street');
    $prop->zipcode = Xml::xstring($xml, 'address/zipcode');
    $prop->city = Xml::xstring($xml, 'address/city');
    $prop->state = Xml::xstring($xml, 'address/state');
    $prop->latitude = Xml::xstring($xml, 'address/latitude');
    $prop->longitude = Xml::xstring($xml, 'address/longitude');
    
    $links = $xml->xpath('links');
    if(count($links) == 1) {
      $prop->links = Links::createFromXml($links[0]);
    }
    
    $zestimates = $xml->xpath('zestimate');
    if(count($zestimates) == 1) {
      $prop->zestimate = Zestimate::createFromXml($zestimates[0]);
    }
    
    $prop->chart = new Proxy($service, 'getChart', array(
        $prop->zpid, 
        Chart::getDefaultWidth(), 
        Chart::getDefaultHeight(), 
        Chart::getDefaultUnitType(), 
        Chart::getDefaultDuration()
    ));
    
    $prop->comps = new Proxy($service, 'getComps', array(
        $prop->zpid, 
        Comps::getDefaultCompCount()
    ));
    
    return $prop;
  }

  public static function createFromXmlDeep($xml, $service) {
    $prop = new Property();
    
    $prop->zpid = Xml::xstring($xml, 'zpid');
    $prop->street = Xml::xstring($xml, 'address/street');
    $prop->zipcode = Xml::xstring($xml, 'address/zipcode');
    $prop->city = Xml::xstring($xml, 'address/city');
    $prop->state = Xml::xstring($xml, 'address/state');
    $prop->latitude = Xml::xstring($xml, 'address/latitude');
    $prop->longitude = Xml::xstring($xml, 'address/longitude');

    $prop->fipsCounty = Xml::xstring($xml, 'FIPScounty');
    $prop->useCode = Xml::xstring($xml, 'useCode');
    $prop->yearBuilt = Xml::xstring($xml, 'yearBuilt');
    $prop->lotSizeSqFt = Xml::xstring($xml, 'lotSizeSqFt');
    $prop->finishedSqFt = Xml::xstring($xml, 'finishedSqFt');
    $prop->bathrooms = Xml::xstring($xml, 'bathrooms');
    $prop->bedrooms = Xml::xstring($xml, 'bedrooms');
    $prop->lastSoldDate = Xml::xstring($xml, 'lastSoldDate');
    $prop->lastSoldPrice = Xml::xstring($xml, 'lastSoldPrice');
    
    $links = $xml->xpath('links');
    if(count($links) == 1) {
      $prop->links = Links::createFromXml($links[0]);
    }
    
    $zestimates = $xml->xpath('zestimate');
    if(count($zestimates) == 1) {
      $prop->zestimate = Zestimate::createFromXml($zestimates[0]);
    }
    
    $prop->chart = new Proxy($service, 'getChart', array(
        $prop->zpid, 
        Chart::getDefaultWidth(), 
        Chart::getDefaultHeight(), 
        Chart::getDefaultUnitType(), 
        Chart::getDefaultDuration()
    ));
    
    $prop->comps = new Proxy($service, 'getComps', array(
        $prop->zpid, 
        Comps::getDefaultCompCount()
    ));
    
    return $prop;
  }
}
