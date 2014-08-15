<?php namespace DimitriVranken\weather_map\BusinessLogic;

      require_once('php/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('php/UserInterface/PollinationMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/WeatherMapType.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              $filePath = \DimitriVranken\weather_map\BusinessLogic\PathManager::getCachedWeatherMapFile($date, \DimitriVranken\weather_map\WeatherMapType::Pollination);
              if (!\DimitriVranken\weather_map\BusinessLogic\ConfigurationReader::getMapsCache() || !file_exists($filePath)) {
                  // Get weather data
                  $weatherData = parent::getWeatherData($date);
                  
                  // Generate map
                  $mapGenerator = new \DimitriVranken\weather_map\UserInterface\PollinationMapGenerator($weatherData);
                  $mapToCache = $mapGenerator->generateMap($weatherData);

                  // Cache map
                  imagepng($mapToCache, $filePath);
              }
              
              // Get map from cache
              $map = imagecreatefrompng($filePath);
              
              // Enable transparency
              $map = \DimitriVranken\weather_map\UserInterface\ImageHelper::enableTransparency($map);

              // Return map
              return $map;
          }

      }

?>