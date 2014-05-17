<?php namespace WeatherMap;
      
      class Wind {
          
          // Protected variables
          protected $direction;
          protected $strength;
          
          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          public function __construct($direction, $strength) {
              $this->$direction = $direction;
              $this->$strength = $strength;
          }          
          
      }

?>