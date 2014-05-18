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
              // Get all raw data
              $weatherDataReader = new \WeatherMap\DataAccess\WebsiteWeatherDataReader();
              $weatherDataSource = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();
              $weatherDataUnparsed = $weatherDataReader->readWeatherData($weatherDataSource);

              if (\WeatherMap\BusinessLogic\ConfigurationReader::getDebugMode()) {
                  // TODO: Print debug information
              }
              
              // Parse data
              $weatherDataBuilder = new \WeatherMap\BusinessLogic\ArrayWeatherDataBuilder();
              $weatherDataUnfiltered = $weatherDataBuilder->buildWeatherData($weatherDataUnparsed);

              if (\WeatherMap\BusinessLogic\ConfigurationReader::getDebugMode()) {
                  // TODO: Print debug information
              }
              
              // Filter data
              $weatherData = array();
              foreach ($weatherDataUnfiltered as $currentWeatherData) {
                  if ($currentWeatherData->date == $this->date) {
                      array_push($weatherData, $currentWeatherData);
                  }
              }
              
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