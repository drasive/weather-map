<?php namespace WeatherMap\BusinessLogic;
      
      require_once('src/Coordinate.php');
      
      abstract class WeatherMapGenerator {
          
          // Protected variable
          protected $date;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
                    
          // Public methods
          public abstract function generateMap($date);
          
      }
      
?>