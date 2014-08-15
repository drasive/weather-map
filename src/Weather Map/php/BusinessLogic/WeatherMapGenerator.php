<?php namespace DimitriVranken\weather_map\BusinessLogic;
      
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
              $filePath = \DimitriVranken\weather_map\BusinessLogic\PathManager::getCachedWeatherDataFile();
              $dataUnparsed = \DimitriVranken\weather_map\DataAccess\IOManager::readFile($filePath);
              
              $fileDataReader = new \DimitriVranken\weather_map\DataAccess\FileWeatherDataReader();
              $data = $fileDataReader->readData($dataUnparsed);
              
              // Return
              return $data;
          }
          
          private static function parseWeatherData($dataUnparsed) {
              $parser = new \DimitriVranken\weather_map\BusinessLogic\ArrayWeatherDataParser();
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
              $filePath = \DimitriVranken\weather_map\BusinessLogic\PathManager::getCachedWeatherDataFile();
              if (!\DimitriVranken\weather_map\BusinessLogic\ConfigurationReader::getWebserviceUseCache() || !file_exists($filePath)) {                                    
                  $websiteDataReader = new \DimitriVranken\weather_map\DataAccess\WebsiteWeatherDataReader();
                  $dataSource = \DimitriVranken\weather_map\BusinessLogic\ConfigurationReader::getWebserviceURL();                  
                  $dataToCache = $websiteDataReader->readData($dataSource);
                  
                  $dataToWrite = implode($dataToCache);                  
                  \DimitriVranken\weather_map\DataAccess\IOManager::writeFile($filePath, $dataToWrite);
              }
          }
          
      }
      
?>