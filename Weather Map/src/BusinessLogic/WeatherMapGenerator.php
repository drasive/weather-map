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
          private static function getUnparsedWeatherData() {
              // TODO: _ DO ALL THE CACHE THINGS
              // SOMEHOW FORCE THIS CACHING SO NO CONCURRENT WRITES AND STUFF COULD HAPPEN
              
              if ('! does todays file exist') {
                // get todays file from website and store it
              }
              
              // get file from hdd
              
              // TODO: _ Change to FilerREADER-STUFF..
              $dataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
              $dataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();
              
              return $dataReader->readData($dataSource);
          }
          
          private static function parseWeatherData($dataUnparsed) {
              $parser = new \WeatherMap\BusinessLogic\ArrayWeatherDataParser();
              return $parser->parseWeatherData($dataUnparsed);
          }
          
          private static function filterWeatherData($dataUnfiltered, $date) {
              $filteredData = array();
              
              foreach ($dataUnfiltered as $currentWeatherData) {
                  if ($currentWeatherData->date == $date) {
                      array_push($filteredData, $currentWeatherData);
                  }
              }
              
              return $filteredData;
          }
          
          // Protected methods
          protected static function getWeatherData($date) {
              $unparsedData = self::getUnparsedWeatherData();
              $parsedData = self::parseWeatherData($unparsedData);
              $filteredDate = self::filterWeatherData($parsedData, $date);
                  
              return $filteredDate;
          }
                    
          // Public methods
          public abstract function generateMap($date);
          
      }
      
?>