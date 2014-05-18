<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');

      require_once('src/DataAccess/WebsiteWeatherDataReader.php');
      require_once('src/BusinessLogic/ConfigurationReader.php');
      require_once('src/BusinessLogic/ArrayWeatherDataBuilder.php');
      require_once('src/UserInterface/ConditionsMapGenerator.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Public methods
          public function generateMap($date) {
              // Get all raw data
              $weatherDataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
              $weatherDataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();
              $weatherDataUnparsed = $weatherDataReader->readWeatherData($weatherDataSource);
              
              // Parse data
              $weatherDataBuilder = new \WeatherMap\BusinessLogic\ArrayWeatherDataBuilder();
              $weatherDataUnfiltered = $weatherDataBuilder->buildWeatherData($weatherDataUnparsed);
              
              // Filter data
              $weatherData = array();
              foreach ($weatherDataUnfiltered as $currentWeatherData) {
                  if ($currentWeatherData->date == $date) {
                      array_push($weatherData, $currentWeatherData);
                  }
              }

              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($weatherData);
              $map = $mapGenerator->generateMap();

              // Return map
              return $map;
          }

      }

?>