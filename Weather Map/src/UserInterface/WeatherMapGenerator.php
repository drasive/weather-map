<?php namespace WeatherMap\UserInterface;
      
      require_once('src/BusinessLogic/HttpParameterValidator.php');

      abstract class WeatherMapGenerator {
          
          // Protected variable
          protected $date;

          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          public function __construct($date) {
              $this->date = $date;
          }    
          
          // Public methods
          public abstract function generateMap();
          
      }
      
?>