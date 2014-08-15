<?php namespace WeatherMap\BusinessLogic;
      
      require_once('php/Coordinate.php');      
      require_once('php/DataAccess/WebsiteWeatherDataReader.php');
      require_once('php/DataAccess/FileWeatherDataReader.php');
      require_once('php/DataAccess/IOManager.php');
      require_once('php/BusinessLogic/ConfigurationReader.php');
      require_once('php/BusinessLogic/ArrayWeatherDataParser.php');
      require_once('php/BusinessLogic/PathManager.php');      
      
      abstract class WeatherMapGenerator {
          
          // Protected variable
          protected $date;
          
          // Public propertiesd
          public function __get($property) {
              if (property_exists($this, $property)) {
                  return $this->$property;
              }
          }
          
          // Private methods
          private static function getUnparsedWeatherData() {
              $filePath = \WeatherMap\BusinessLogic\PathManager::getCachedWeatherDataFile();
              $dataUnparsed = \WeatherMap\DataAccess\IOManager::readFile($filePath);
              
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
          
          public static function checkWeatherDataCache() {              
              $filePath = \WeatherMap\BusinessLogic\PathManager::getCachedWeatherDataFile();
              if (!\WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceUseCache() || !file_exists($filePath)) {                                    
                  $websiteDataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
                  $dataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();                  
                  $dataToCache = $websiteDataReader->readData($dataSource);
                  
                  $dataToWrite = implode($dataToCache);                  
                  \WeatherMap\DataAccess\IOManager::writeFile($filePath, $dataToWrite);
              }
          }
          
      }
      
?>