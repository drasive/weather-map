<?php namespace WeatherMap\BusinessLogic;

       require_once('src/BusinessLogic/WeatherMapGenerator.php');
       require_once('src/BusinessLogic/ConfigurationReader.php');       
       require_once('src/BusinessLogic/WeatherDataFromCsvBuilder.php');
       require_once('src/DataAccess/CsvFileReader.php');
       require_once('src/UserInterface/ConditionsMapGenerator.php');
      
      class ConditionsMapGenerator extends WeatherMapGenerator {
          
          // Public constructors
          function __construct($date) {
              parent::__construct($date);
          }
          
          // Public methods
          public function generateMap() {
              $webserviceURL = \WeatherMap\BusinessLogic\ConfigurationReader::getWebserviceURL();
              // TODO: Fix read
              $weatherDataFile = file_get_contents($webserviceURL);
              $weatherDataArray = \WeatherMap\DataAccess\CsvFileReader::readFile($weatherDataFile);
              $weatherData = \WeatherMap\BusinessLogic\WeatherDataFromCsvBuilder::buildWeatherData($weatherDataArray);
              
              // Generate map
              $mapGenerator = new \WeatherMap\UserInterface\ConditionsMapGenerator($this->date);
              $map = $mapGenerator->generateMap($weatherData);
              
              // Return map
              return $map;
          }
          
      }

?>