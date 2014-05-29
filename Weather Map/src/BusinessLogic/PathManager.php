<?php namespace WeatherMap\BusinessLogic;

       require_once('src/DataAccess/IOManager.php');
      
      class PathManager {
          
          // Protected methods
          protected static function getDataFolder() {
              $dataFolder = './data/';
              
              \WeatherMap\DataAccess\IOManager::checkFolder($dataFolder);
              
              return $dataFolder;
          }
          
          protected static function getCacheFolder() {              
              $cacheFolder = self::getDataFolder() . 'cache/';
              
              \WeatherMap\DataAccess\IOManager::checkFolder($cacheFolder);
              
              return $cacheFolder;
          }
          
          
          protected static function getCachedWeatherDataFolder() {
              $cachedWeatherDataFolder = self::getCacheFolder() . 'weather_data/';
              
              \WeatherMap\DataAccess\IOManager::checkFolder($cachedWeatherDataFolder);
              
              return $cachedWeatherDataFolder;
          }
          
          // Public methods
          public static function getCachedWeatherDataFile() {
              $filePath = date('Y-m-d', time()) . '.csv';
              return self::getCachedWeatherDataFolder() . $filePath;
          }
          
          
          public static function getCachedWeatherMapsFolder() {
              $cachedWeatherMapsFolder = self::getCacheFolder() . 'weather_maps/';
              \WeatherMap\DataAccess\IOManager::checkFolder($cachedWeatherMapsFolder);
               
              $cachedWeatherMapsSubfolder = $cachedWeatherMapsFolder . date('Y-m-d', time()) . '/';
              \WeatherMap\DataAccess\IOManager::checkFolder($cachedWeatherMapsSubfolder);
              
              return $cachedWeatherMapsSubfolder;
          }
          
          public static function getCachedWeatherMapFile($weatherMapType) {
              $fileName = null;
              
              switch ($weatherMapType) {
                  case \WeatherMap\WeatherMapType::Conditions:
                      $fileName = 'conditions';
                      break;
                  case \WeatherMap\WeatherMapType::Temperatures:
                      $fileName = 'temperatures';
                      break;
                  case \WeatherMap\WeatherMapType::Wind:
                      $fileName = 'wind';
                      break;
                  case \WeatherMap\WeatherMapType::Pollination:
                      $fileName = 'pollination';
                      break;
              }
              
              $fileName .= '.png';              
              return self::getCachedWeatherMapsFolder() . $fileName;
          }
          
      }

?>