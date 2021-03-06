<?php namespace DimitriVranken\weather_map\BusinessLogic;

      require_once('php/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('php/UserInterface/WindMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/WeatherMapType.php');

      class WindMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              $filePath = \DimitriVranken\weather_map\BusinessLogic\PathManager::getCachedWeatherMapFile($date, \DimitriVranken\weather_map\WeatherMapType::Wind);
              if (!\DimitriVranken\weather_map\BusinessLogic\ConfigurationReader::getMapsCache() || !file_exists($filePath)) {
                  // Get weather data
                  $weatherData = parent::getWeatherData($date);

                  // Generate map
                  $mapGenerator = new \DimitriVranken\weather_map\UserInterface\WindMapGenerator($weatherData);
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