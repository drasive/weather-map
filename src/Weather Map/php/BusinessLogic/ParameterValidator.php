<?php namespace WeatherMap\BusinessLogic;
      
      class ParameterValidator {
          
          // Public methods
          public static function isRequestedMapDateValid($requestedMapDate) {
              $minimum = strtotime(date('Y-m-d', time()));
              $maximum = $minimum + ((60 * 60 * 24 * 7) - 1);
              
              return !($requestedMapDate < $minimum || $requestedMapDate > $maximum);
          }
          
      }
      
?>