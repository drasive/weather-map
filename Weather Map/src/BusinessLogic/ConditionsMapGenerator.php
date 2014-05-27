<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('src/UserInterface/ConditionsMapGenerator.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              // TODO: __
              // TODO: _ Implement caching
              
              //$filePath = \WeatherMap\BusinessLogic\PathManager::getCachedWeatherMapFile();
              //if (!\WeatherMap\BusinessLogic\ConfigurationReader::getMapsCache() || !file_exists($filePath)) {
              //    // Get weather data
              //    $weatherData = parent::getWeatherData($date);
              //    
              //    // Generate map
              //    $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($weatherData);
              //    $map = $mapGenerator->generateMap($weatherData);
              //    
              //    // Cache map
              //    \WeatherMap\DataAccess\FileManager::writeFile($filePath, $dataToWrite);
              //}              
              
              // Get weather data
              $weatherData = parent::getWeatherData($date);
              
              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($weatherData);
              $map = $mapGenerator->generateMap($weatherData);

              // Return map
              return $map;
          }

      }

?>