<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('src/UserInterface/ConditionsMapGenerator.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              // TODO: _ Implement caching
              
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