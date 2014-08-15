<?php namespace DimitriVranken\weather_map\BusinessLogic;

      require_once('php/DataAccess/IOManager.php');
      
      class PathManager {
          
          // Protected methods
          protected static function getDataFolder() {
              $dataFolder = './data/';
              
              \DimitriVranken\weather_map\DataAccess\IOManager::checkFolder($dataFolder);
              
              return $dataFolder;
          }
          
          protected static function getCacheFolder() {              
              $cacheFolder = self::getDataFolder() . 'cache/';
              
              \DimitriVranken\weather_map\DataAccess\IOManager::checkFolder($cacheFolder);
              
              return $cacheFolder;
          }
          
          
          protected static function getCachedWeatherDataFolder() {
              $cachedWeatherDataFolder = self::getCacheFolder() . 'weather_data/';
              
              \DimitriVranken\weather_map\DataAccess\IOManager::checkFolder($cachedWeatherDataFolder);
              
              return $cachedWeatherDataFolder;
          }
          
          
          protected static function getCachedWeatherMapsFolder($date) {
              $cachedWeatherMapsFolder = self::getCacheFolder() . 'weather_maps/';
              \DimitriVranken\weather_map\DataAccess\IOManager::checkFolder($cachedWeatherMapsFolder);
              
              $cachedWeatherMapsDataFolder = $cachedWeatherMapsFolder . date('Y-m-d', time()) . '/';
              \DimitriVranken\weather_map\DataAccess\IOManager::checkFolder($cachedWeatherMapsDataFolder);
              
              $cachedWeatherMapsDateFolder = $cachedWeatherMapsDataFolder . date('Y-m-d', $date) . '/';
              \DimitriVranken\weather_map\DataAccess\IOManager::checkFolder($cachedWeatherMapsDateFolder);
              
              return $cachedWeatherMapsDateFolder;
          }
          
          // Public methods
          public static function getCachedWeatherDataFile() {
              $filePath = date('Y-m-d', time()) . '.csv';
              return self::getCachedWeatherDataFolder() . $filePath;
          }
          
          
          public static function getCachedWeatherMapFile($date, $weatherMapType) {
              $fileName = null;
              
              switch ($weatherMapType) {
                  case \DimitriVranken\weather_map\WeatherMapType::Conditions:
                      $fileName = 'conditions';
                      break;
                  case \DimitriVranken\weather_map\WeatherMapType::Temperatures:
                      $fileName = 'temperatures';
                      break;
                  case \DimitriVranken\weather_map\WeatherMapType::Wind:
                      $fileName = 'wind';
                      break;
                  case \DimitriVranken\weather_map\WeatherMapType::Pollination:
                      $fileName = 'pollination';
                      break;
              }
              
              $fileName .= '.png';              
              return self::getCachedWeatherMapsFolder($date) . $fileName;
          }
          
      }

?>