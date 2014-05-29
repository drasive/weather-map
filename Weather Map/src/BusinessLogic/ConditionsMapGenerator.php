<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('src/UserInterface/ConditionsMapGenerator.php');
      require_once('src/WeatherMapType.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              // TODO: _
              
              $filePath = \WeatherMap\BusinessLogic\PathManager::getCachedWeatherMapFile(\WeatherMap\WeatherMapType::Conditions);
              if (!\WeatherMap\BusinessLogic\ConfigurationReader::getMapsCache() || !file_exists($filePath)) {
                  // Get weather data
                  $weatherData = parent::getWeatherData($date);
                  
                  // Generate map
                  $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($weatherData);
                  $mapToCache = $mapGenerator->generateMap($weatherData);
                  
                  // Cache map
                  imagepng($mapToCache, $filePath);                  
              }
              
              // Get map from cache
              $map = imagecreatefrompng($filePath);

              // Return map
              return $map;
          }

      }

?>