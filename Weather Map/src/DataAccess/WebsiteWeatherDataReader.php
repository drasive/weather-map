<?php namespace WeatherMap\DataAccess;

      require_once('src/DataAccess/WeatherDataReader.php');
      
      class WebsiteWeatherDataReader extends WeatherDataReader {
          
          public function readData($websiteURL) {
              // Get data
              $weatherDataUnconverted = file($websiteURL);
              
              // Convert data
              $weatherData = array();
              
              foreach($weatherDataUnconverted as $rowUnconverted) {
                  $rowConverted = explode(';', $rowUnconverted);
                  array_push($weatherData, $rowConverted);
              }
              
              // Return converted data
              return $weatherData;
          }
          
      }

?>