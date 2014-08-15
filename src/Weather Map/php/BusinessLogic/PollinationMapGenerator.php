<?php namespace WeatherMap\BusinessLogic;

      require_once('php/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('php/UserInterface/PollinationMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/WeatherMapType.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              $filePath = \WeatherMap\BusinessLogic\PathManager::getCachedWeatherMapFile($date, \WeatherMap\WeatherMapType::Pollination);
              if (!\WeatherMap\BusinessLogic\ConfigurationReader::getMapsCache() || !file_exists($filePath)) {
                  // Get weather data
                  $weatherData = parent::getWeatherData($date);
                  
                  // Generate map
                  $mapGenerator = new \WeatherMap\UserInterface\PollinationMapGenerator($weatherData);
                  $mapToCache = $mapGenerator->generateMap($weatherData);

                  // Cache map
                  imagepng($mapToCache, $filePath);
              }
              
              // Get map from cache
              $map = imagecreatefrompng($filePath);
              
              // Enable transparency
              $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);

              // Return map
              return $map;
          }

      }

?>