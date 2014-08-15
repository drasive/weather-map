<?php namespace DimitriVranken\weather_map\DataAccess;

      require_once('php/DataAccess/WeatherDataReader.php');
      
      class FileWeatherDataReader extends WeatherDataReader {
          
          public function readData($weatherDataUnparsed) {
              // Parse data
              $weatherDataParsed = array();
              
              foreach($weatherDataUnparsed as $rowUnparsed) {
                  $rowParsed = explode(';', $rowUnparsed);
                  array_push($weatherDataParsed, $rowParsed);
              }
              
              // Return parsed data
              return $weatherDataParsed;
          }
          
      }

?>