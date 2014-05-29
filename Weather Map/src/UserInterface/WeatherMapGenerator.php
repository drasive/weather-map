<?php namespace WeatherMap\UserInterface;
      
      require_once('src/HttpParameterHelper.php');
      require_once('src/UserInterface/ImageHelper.php');

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
                  case \WeatherMap\Region::Geneva:
                      return new \WeatherMap\Coordinate(75, 645);
                  case \WeatherMap\Region::Valais:
                      return new \WeatherMap\Coordinate(430, 625);
                  case \WeatherMap\Region::Ticino:
                      return new \WeatherMap\Coordinate(892, 638);
                  case \WeatherMap\Region::Grisons:
                      return new \WeatherMap\Coordinate(1100, 480);
                  case \WeatherMap\Region::Zurich:
                      return new \WeatherMap\Coordinate(772, 138);
                  case \WeatherMap\Region::Berne:
                      return new \WeatherMap\Coordinate(458, 330);
                  case \WeatherMap\Region::Basle:                      
                      return new \WeatherMap\Coordinate(495, 70);
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
              $coordinate =  new \WeatherMap\Coordinate($baseCoordinate->x + $xOffset, $baseCoordinate->y + $yOffset);
              
              // Return
              return $coordinate;
          }
          
          public static function getCoordinateForText($region) {
              // TODO: Finish
              
              // Get the base coordinate
              $baseCoordinate = self::getBaseCoordinate($region);
              
              // Center the text
              $xOffset =  -25;
              $yOffset =  40;
              $coordinate =  new \WeatherMap\Coordinate($baseCoordinate->x + $xOffset, $baseCoordinate->y + $yOffset);
              
              // Return
              return $coordinate;
          }
          
          
          public static function getNeutralFontColor() {
              $whiteWage = 50;
              return imagecolorallocate($whiteWage, $whiteWage, $whiteWage);    
          }
          
      }
      
?>