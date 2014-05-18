<?php namespace WeatherMap\UserInterface;
      
      require_once('src/BusinessLogic/HttpParameterValidator.php');

      abstract class WeatherMapGenerator {
          
          // Protected variable
          protected $weatherData;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          public function __construct($weatherData) {
              $this->weatherData = $weatherData;
          }    
          
          // Public methods
          public abstract function generateMap();
          
          public static function getBackgroundImage() {
              return imagecreatefromjpeg('media/images/switzerland_map.jpg');
          }
          
          public static function getCoordinate($region, $iconSize) {
              // TODO: Improve
              
              // Get the base coordinates
              $baseCoordinate = '';
              switch ($region) {
                  case \WeatherMap\Region::Geneva:
                      $baseCoordinate = new \WeatherMap\Coordinate(75, 645);
                      break;
                  case \WeatherMap\Region::Valais:
                      $baseCoordinate = new \WeatherMap\Coordinate(430, 625);
                      break;
                  case \WeatherMap\Region::Ticino:
                      $baseCoordinate = new \WeatherMap\Coordinate(650, 520);
                      break;
                  case \WeatherMap\Region::Grisons:
                      $baseCoordinate = new \WeatherMap\Coordinate(1100, 480);
                      break;
                  case \WeatherMap\Region::Zurich:
                      $baseCoordinate = new \WeatherMap\Coordinate(772, 142);
                      break;
                  case \WeatherMap\Region::Berne:
                      $baseCoordinate = new \WeatherMap\Coordinate(458, 330);
                      break;
                  case \WeatherMap\Region::Basle:                      
                      $baseCoordinate = new \WeatherMap\Coordinate(495, 70);
                      break;
              }
              
              // Center the icon
              $xOffset =  - ($iconSize->width / 2);
              $yOffset =  - ($iconSize->height / 2);
              $coordinate =  new \WeatherMap\Coordinate($baseCoordinate->x + $xOffset, $baseCoordinate->y + $yOffset);
              
              // Return
              return $coordinate;
          }
          
      }
      
?>