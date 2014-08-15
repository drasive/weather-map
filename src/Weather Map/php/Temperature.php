<?php namespace DimitriVranken\weather_map;
      
      class Temperature {
          
          // Protected variables
          protected $minimum;
          protected $maximum;
          
          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Public constructors
          public function __construct($minimum, $maximum) {
              $this->minimum = $minimum;
              $this->maximum = $maximum;
          }          
          
      }

?>