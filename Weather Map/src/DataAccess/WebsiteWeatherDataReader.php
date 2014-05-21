<?php namespace WeatherMap\DataAccess;

      require_once('src/DataAccess/WeatherDataReader.php');
      
      class WebsiteWeatherDataReader extends WeatherDataReader {
          
          public function readData($websiteURL) {
              // Get data
              $weatherDataUnparsed = file($websiteURL);
              
              if ($weatherDataUnparsed == null || $weatherDataUnparsed == false || $weatherDataUnparsed = '') {
                  return null;
              }
              
              // Parse data
              $weatherDataParsed = array();
              
              foreach($weatherDataUnparsed as $rowUnparsed) {
                  $rowParsed = explode(';', $rowUnparsed);
                  array_push($weatherDataParsed, $rowParsed);
              }
              
              // Return converted data
              return $weatherDataParsed;
          }
          
      }

?>