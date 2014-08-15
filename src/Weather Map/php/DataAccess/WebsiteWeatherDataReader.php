<?php namespace DimitriVranken\weather_map\DataAccess;

      require_once('php/DataAccess/WeatherDataReader.php');
      
      class WebsiteWeatherDataReader extends WeatherDataReader {
          
          public function readData($websiteURL) {
              // Get unparsed data
              $weatherDataUnparsed = file($websiteURL);
              
              if ($weatherDataUnparsed == null || $weatherDataUnparsed == false || $weatherDataUnparsed == '') {
                  return null;
              }
              
              // Return unparsed data
              return $weatherDataUnparsed;
          }
          
      }

?>