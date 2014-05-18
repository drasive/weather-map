<?php namespace WeatherMap;
      
      class WeatherData {
          
          // Protected variables
          protected $region;
          protected $weatherCondition;
          protected $temperature;
          protected $wind;
          protected $pollination;
          
          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->property;
              }
          }
          
          // Public constructors
          public function __construct($region, $weatherCondition, $temperature, $wind, $pollination) {
              $this->region = $region;
              $this->weatherCondition = $weatherCondition;
              $this->temperature = $temperature;
              $this->wind = $wind;
              $this->pollination = $pollination;
          }          
          
      }

?>