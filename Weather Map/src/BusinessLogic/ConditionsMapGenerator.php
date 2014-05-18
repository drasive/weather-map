<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherMapGenerator.php');

      require_once('src/DataAccess/WebsiteWeatherDataReader.php');
      require_once('src/BusinessLogic/ConfigurationReader.php');
      require_once('src/BusinessLogic/ArrayWeatherDataBuilder.php');
      require_once('src/UserInterface/ConditionsMapGenerator.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Public constructors
          function __construct($date) {
              parent::__construct($date);
          }

          // Public methods
          public function generateMap() {
              // Get raw data
              $weatherDataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
              $weatherDataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();
              $weatherDataUnparsed = $weatherDataReader->readWeatherData($weatherDataSource);

              if (\WeatherMap\BusinessLogic\ConfigurationReader::getDebugMode()) {
                  // TODO: Print debug information
              }

              // Parse data
              $weatherDataBuilder = new \WeatherMap\BusinessLogic\ArrayWeatherDataBuilder();
              $weatherData = $weatherDataBuilder->buildWeatherData($weatherDataUnparsed);

              if (\WeatherMap\BusinessLogic\ConfigurationReader::getDebugMode()) {
                  // TODO: Print debug information
              }

              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($weatherData);
              $map = $mapGenerator->generateMap();

              // Return map
              return $map;
          }

      }

?>