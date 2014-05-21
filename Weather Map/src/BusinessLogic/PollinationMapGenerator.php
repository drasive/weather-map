<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('src/UserInterface/PollinationMapGenerator.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              // Get weather data
              $weatherData = parent::getWeatherData($date);

              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\PollinationMapGenerator($weatherData);
              $map = $mapGenerator->generateMap($weatherData);

              // Return map
              return $map;
          }

      }

?>