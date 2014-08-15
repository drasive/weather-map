<?php namespace DimitriVranken\weather_map\UserInterface;
      
      require_once('php/HttpParameterHelper.php');
      require_once('php/UserInterface/ImageHelper.php');

      abstract class WeatherMapGenerator {
          
          // Protected variable
          protected $weatherData;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Protected methods
          protected static function getBaseCoordinate($region) {
              switch ($region) {
                  case \DimitriVranken\weather_map\Region::Geneva:
                      return new \DimitriVranken\weather_map\Coordinate(70, 645);
                  case \DimitriVranken\weather_map\Region::Valais:
                      return new \DimitriVranken\weather_map\Coordinate(429, 625);
                  case \DimitriVranken\weather_map\Region::Ticino:
                      return new \DimitriVranken\weather_map\Coordinate(892, 638);
                  case \DimitriVranken\weather_map\Region::Grisons:
                      return new \DimitriVranken\weather_map\Coordinate(1090, 480);
                  case \DimitriVranken\weather_map\Region::Zurich:
                      return new \DimitriVranken\weather_map\Coordinate(767, 138);
                  case \DimitriVranken\weather_map\Region::Berne:
                      return new \DimitriVranken\weather_map\Coordinate(452, 330);
                  case \DimitriVranken\weather_map\Region::Basle:                      
                      return new \DimitriVranken\weather_map\Coordinate(495, 70);
              }
          }
          
          // Public methods
          public abstract function generateMap($weatherData);
          
          
          public static function getBackgroundImage() {
              return imagecreatefrompng('media/images/switzerland_map.png');
          }
          
          
          public static function getCoordinateForIcon($region, $iconSize) {
              // Get the base coordinate
              $baseCoordinate = self::getBaseCoordinate($region);
              
              // Center the icon
              $xOffset =  - ($iconSize->width / 2);
              $yOffset =  - ($iconSize->height / 2);
              $coordinate =  new \DimitriVranken\weather_map\Coordinate($baseCoordinate->x + $xOffset, $baseCoordinate->y + $yOffset);
              
              // Return
              return $coordinate;
          }
          
          public static function getCoordinateForIconCentered($region, $iconSize) {
              // Get the base coordinate
              $baseCoordinate = self::getBaseCoordinate($region);
              
              // Center the icon
              $xOffset =  - ($iconSize->width / 2);
              $yOffset =  -5;
              $coordinate =  new \DimitriVranken\weather_map\Coordinate($baseCoordinate->x + $xOffset, $baseCoordinate->y + $yOffset);
              
              // Return
              return $coordinate;
          }
          
          public static function getCoordinateForText($region) {
              // Get the base coordinate
              $baseCoordinate = self::getBaseCoordinate($region);
              
              // Center the text
              $yOffset =  42;
              $coordinate =  new \DimitriVranken\weather_map\Coordinate($baseCoordinate->x, $baseCoordinate->y + $yOffset);
              
              // Return
              return $coordinate;
          }
          
          
          public static function getNeutralFontColor() {
              $whiteWage = 50;
              return imagecolorallocate($whiteWage, $whiteWage, $whiteWage);    
          }
          
      }
      
?>