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
          
          public static function getCoordinates($region) {
              // TODO: Improve
              
              switch ($region) {
                  case \WeatherMap\Region::Geneva:
                      return new \WeatherMap\Coordinate(0, 0);
                  case \WeatherMap\Region::Valais:
                      return new \WeatherMap\Coordinate(50, 0);
                  case \WeatherMap\Region::Ticino:
                      return new \WeatherMap\Coordinate(100, 0);
                  case \WeatherMap\Region::Grisons:
                      return new \WeatherMap\Coordinate(0, 50);
                  case \WeatherMap\Region::Zurich:
                      return new \WeatherMap\Coordinate(0, 100);
                  case \WeatherMap\Region::Berne:
                      return new \WeatherMap\Coordinate(150, 150);
                  case \WeatherMap\Region::Basle:
                      return new \WeatherMap\Coordinate(200, 200);
              }
          }
          
      }
      
?>