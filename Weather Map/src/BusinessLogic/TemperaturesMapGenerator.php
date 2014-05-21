<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');
      
      require_once('src/UserInterface/TemperaturesMapGenerator.php');

      class TemperaturesMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              // Get weather data
              $weatherData = parent::getWeatherData($date);

              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\TemperaturesMapGenerator($weatherData);
              $map = $mapGenerator->generateMap($weatherData);

              // Return map
              return $map;
          }

      }

?>