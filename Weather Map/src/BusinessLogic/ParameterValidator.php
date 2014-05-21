<?php namespace WeatherMap\BusinessLogic;
      
      class ParameterValidator {
          
          // Protected methods
          protected static function isRequestedMapDateValid($requestedMapDate) {
             $minimum = strtotime(date('Y-m-d', time()));
             $maximum = $minimum + ((60 * 60 * 24 * 7) - 1);
                  
             return ($requestedMapDate < $minimum || $requestedMapDate > $maximum);
          }
          
          // Public methods
          public static function validateRequestedMapDate($requestedMapDate, $defaultValue) {
              if (self::isRequestedMapDateValid($requestedMapDate)) {
                  return $defaultValue;
              }
              
              return $requestedMapDate;
          }
          
      }
      
?>