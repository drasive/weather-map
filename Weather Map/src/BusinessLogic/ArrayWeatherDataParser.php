<?php namespace WeatherMap\BusinessLogic;

      require_once('src/BusinessLogic/WeatherDataParser.php');
      
      require_once('src/WeatherData.php');
      require_once('src/Region.php');
      require_once('src/WeatherCondition.php');
      require_once('src/Temperature.php');
      require_once('src/Wind.php');
      require_once('src/CardinalDirection.php');
      require_once('src/Pollination.php');
      
      class ArrayWeatherDataParser extends WeatherDataParser {
          
          // Protected variables
          protected static function parseDate($dateAsString) {
              return strtotime($dateAsString);
          }
          
          
          protected static function parseRegion($regionAsInteger) {
              switch ($regionAsInteger) {
                  case 1:
                      return \WeatherMap\Region::Geneva;
                  case 2:
                      return \WeatherMap\Region::Valais;
                  case 3:
                      return \WeatherMap\Region::Ticino;
                  case 4:
                      return \WeatherMap\Region::Grisons;                  
                  case 5:
                      return \WeatherMap\Region::Zurich;
                  case 6:
                      return \WeatherMap\Region::Berne;
                  case 7:
                      return \WeatherMap\Region::Basle;   
              }
          }
          
          
          protected static function parseWeatherCondition($weatherConditionAsInteger) {
              switch ($weatherConditionAsInteger) {
                  case 1:
                      return \WeatherMap\WeatherCondition::Sunny;
                  case 2:
                      return \WeatherMap\WeatherCondition::Cloudy;
                  case 3:
                      return \WeatherMap\WeatherCondition::Rain;
                  case 4:
                      return \WeatherMap\WeatherCondition::Thunderstorm;                  
                  case 5:
                      return \WeatherMap\WeatherCondition::Snow; 
              }
          }
          
          
          protected static function parseTemperature($temperatureAsString) {
              $temperatureAsStringValues = explode('/', $temperatureAsString);
              
              $minimum = $temperatureAsStringValues[0];
              $maximum = $temperatureAsStringValues[1];
              
              return new \WeatherMap\Temperature($minimum, $maximum);
          }          
          
          
          protected static function parseWind($windAsString) {
              $windAsStringValues = explode('/', $windAsString);
              
              $directionAsString = $windAsStringValues[0];
              $direction = self::parseWindDirection($directionAsString);
              
              $strength = $windAsStringValues[1];
              
              return new \WeatherMap\Wind($direction, $strength);
          }
          
          protected static function parseWindDirection($directionAsString) {
              switch (strtoupper($directionAsString)) {
                  case 'NN':
                      return \WeatherMap\CardinalDirection::None;
                  case 'N':
                      return \WeatherMap\CardinalDirection::North;
                  case 'NO':
                      return \WeatherMap\CardinalDirection::NorthEast;
                  case 'O':
                      return \WeatherMap\CardinalDirection::East;
                  case 'SO':
                      return \WeatherMap\CardinalDirection::SouthEast;
                  case 'S':
                      return \WeatherMap\CardinalDirection::South;
                  case 'SW':
                      return \WeatherMap\CardinalDirection::SouthWest;
                  case 'W':
                      return \WeatherMap\CardinalDirection::West;
                  case 'NW':
                      return \WeatherMap\CardinalDirection::NorthEast;
              }
          }
          
          
          protected static function parsePollination($pollinationAsInteger) {
              switch ($pollinationAsInteger) {
                  case 0:
                      return \WeatherMap\Pollination::None;
                  case 1:
                      return \WeatherMap\Pollination::Weak;
                  case 2:
                      return \WeatherMap\Pollination::Moderate;
                  case 3:
                      return \WeatherMap\Pollination::Strong;
              }
          }
          
          // Public methods
          public function parse($dataAsArray) {
              $weatherData = array();
              
              foreach($dataAsArray as $row) {
                  $date = self::parseDate($row[0]);
                  $region = self::parseRegion($row[1]);
                  $weatherCondition = self::parseWeatherCondition($row[2]);
                  $temperature = self::parseTemperature($row[3]);
                  $wind = self::parseWind($row[4]);
                  $pollination = self::parsePollination($row[5]);
                  
                  $currentWeatherData = new \WeatherMap\WeatherData($date, $region, $weatherCondition, $temperature, $wind, $pollination);
                  array_push($weatherData, $currentWeatherData);
              }
              
              return $weatherData;
          }         
          
      }

?>