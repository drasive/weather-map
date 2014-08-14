<?php namespace WeatherMap;
      
      class Coordinate {
          
          // Protected variables
          protected $x;
          protected $y;
          
          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          public function __construct($x, $y) {
              $this->x = $x;
              $this->y = $y;
          }          
          
      }

?>