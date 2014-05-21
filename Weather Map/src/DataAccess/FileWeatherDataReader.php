<?php namespace WeatherMap\DataAccess;

      require_once('src/DataAccess/WeatherDataReader.php');
      
      class FileWeatherDataReader extends WeatherDataReader {
          
          public function readData($fileURL) {
              // Get data
              $weatherDataUnparsed = file($fileURL);
              
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