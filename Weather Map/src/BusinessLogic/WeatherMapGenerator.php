<?php namespace WeatherMap\BusinessLogic;
      
      require_once('src/Coordinate.php');      
      require_once('src/DataAccess/WebsiteWeatherDataReader.php');
      require_once('src/BusinessLogic/ConfigurationReader.php');
      require_once('src/BusinessLogic/ArrayWeatherDataParser.php');
      
      abstract class WeatherMapGenerator {
          
          // Protected variable
          protected $date;
          
          // Public properties
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Private methods
          private static function getUnparsedData() {
              $dataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
              $dataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();
              
              return $dataReader->read($dataSource);
          }
          
          private static function parseData($dataUnparsed) {
              $parser = new \WeatherMap\BusinessLogic\ArrayWeatherDataParser();
              return $parser->parse($dataUnparsed);
          }
          
          private static function filterData($dataUnfiltered, $date) {
              $filteredData = array();
              
              foreach ($dataUnfiltered as $currentWeatherData) {
                  if ($currentWeatherData->date == $date) {
                      array_push($filteredData, $currentWeatherData);
                  }
              }
              
              return $filteredData;
          }
          
          // Protected methods
          protected static function getData($date) {
              $unparsedData = self::getUnparsedData();
              $parsedData = self::parseData($unparsedData);
              $filteredDate = self::filterData($parsedData, $date);
                  
              return $filteredDate;
          }
                    
          // Public methods
          public abstract function generateMap($date);
          
      }
      
?>