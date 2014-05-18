<?php namespace WeatherMap;
      
      class Size {
          
          // Protected variables
          protected $width;
          protected $height;
          
          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          public function __construct($width, $height) {
              $this->width = $width;
              $this->height = $height;
          }          
          
      }

?>