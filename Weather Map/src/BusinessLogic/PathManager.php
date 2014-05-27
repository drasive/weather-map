<?php namespace WeatherMap\BusinessLogic;

      class PathManager {
          
          // Protected methods
          protected static function getDataFolder() {
              return './data/';
          }
          
          protected static function getWeatherDataFolder() {
              return self::getDataFolder() . 'weather_data/';
          }
          
          protected static function getWeatherMapsFolder() {
              return self::getDataFolder() . 'weather_maps/';
          }
          
          // Public methods
          public static function getCachedWeatherDataFile() {
              $filename = date('Y-m-d', time()) . '.csv';              
              return self::getWeatherDataFolder() . $filename;
          }
          
          public static function getCachedWeatherMapFile() {
              // TODO: Fix
              $filename = date('Y-m-d', time()) . '.csv';              
              return self::getWeatherDataFolder() . $filename;
          }
          
      }

?>