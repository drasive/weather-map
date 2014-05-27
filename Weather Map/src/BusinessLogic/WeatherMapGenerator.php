<?php namespace WeatherMap\BusinessLogic;
      
      require_once('src/Coordinate.php');      
      require_once('src/DataAccess/WebsiteWeatherDataReader.php');
      require_once('src/DataAccess/FileWeatherDataReader.php');
      require_once('src/DataAccess/FileManager.php');
      require_once('src/BusinessLogic/ConfigurationReader.php');
      require_once('src/BusinessLogic/ArrayWeatherDataParser.php');
      require_once('src/BusinessLogic/PathManager.php');      
      
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
              // TODO: SOMEHOW FORCE THIS CACHING SO NO CONCURRENT WRITES AND STUFF COULD HAPPEN
              
              $filePath = \WeatherMap\BusinessLogic\PathManager::getCachedWeatherDataFile();
              if (!\WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceUseCache() || !file_exists($filePath)) {                                    
                  $websiteDataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
                  $dataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();                  
                  $dataToCache = $websiteDataReader->readData($dataSource);
                  
                  $dataToWrite = implode($dataToCache);                  
                  \WeatherMap\DataAccess\FileManager::writeFile($filePath, $dataToWrite);
              }
              
              $dataUnparsed = \WeatherMap\DataAccess\FileManager::readFile($filePath);
              $fileDataReader = new \WeatherMap\DataAccess\FileWeatherDataReader();
              $data = $fileDataReader->readData($dataUnparsed);
              
              // Return
              return $data;
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