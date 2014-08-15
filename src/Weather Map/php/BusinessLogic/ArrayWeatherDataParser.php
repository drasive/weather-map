<?php namespace DimitriVranken\weather_map\BusinessLogic;

      require_once('php/BusinessLogic/WeatherDataParser.php');
      
      require_once('php/WeatherData.php');
      require_once('php/Region.php');
      require_once('php/WeatherCondition.php');
      require_once('php/Temperature.php');
      require_once('php/Wind.php');
      require_once('php/CardinalDirection.php');
      require_once('php/Pollination.php');
      
      class ArrayWeatherDataParser extends WeatherDataParser {
          
          // Protected variables
          protected static function parseDate($dateAsString) {
              return strtotime($dateAsString);
          }
          
          
          protected static function parseRegion($regionAsInteger) {
              switch ($regionAsInteger) {
                  case 1:
                      return \DimitriVranken\weather_map\Region::Geneva;
                  case 2:
                      return \DimitriVranken\weather_map\Region::Valais;
                  case 3:
                      return \DimitriVranken\weather_map\Region::Ticino;
                  case 4:
                      return \DimitriVranken\weather_map\Region::Grisons;                  
                  case 5:
                      return \DimitriVranken\weather_map\Region::Zurich;
                  case 6:
                      return \DimitriVranken\weather_map\Region::Berne;
                  case 7:
                      return \DimitriVranken\weather_map\Region::Basle;   
              }
          }
          
          
          protected static function parseWeatherCondition($weatherConditionAsInteger) {
              switch ($weatherConditionAsInteger) {
                  case 1:
                      return \DimitriVranken\weather_map\WeatherCondition::Sunny;
                  case 2:
                      return \DimitriVranken\weather_map\WeatherCondition::Cloudy;
                  case 3:
                      return \DimitriVranken\weather_map\WeatherCondition::Rain;
                  case 4:
                      return \DimitriVranken\weather_map\WeatherCondition::Thunderstorm;                  
                  case 5:
                      return \DimitriVranken\weather_map\WeatherCondition::Snow; 
              }
          }
          
          
          protected static function parseTemperature($temperatureAsString) {
              $temperatureAsStringValues = explode('/', $temperatureAsString);
              
              $minimum = $temperatureAsStringValues[0];
              $maximum = $temperatureAsStringValues[1];
              
              return new \DimitriVranken\weather_map\Temperature($minimum, $maximum);
          }          
          
          
          protected static function parseWind($windAsString) {
              $windAsStringValues = explode('/', $windAsString);
              
              $directionAsString = $windAsStringValues[0];
              $direction = self::parseWindDirection($directionAsString);
              
              $strength = $windAsStringValues[1];
              
              return new \DimitriVranken\weather_map\Wind($direction, $strength);
          }
          
          protected static function parseWindDirection($directionAsString) {
              switch (strtoupper($directionAsString)) {
                  case 'NN':
                      return \DimitriVranken\weather_map\CardinalDirection::None;
                  case 'N':
                      return \DimitriVranken\weather_map\CardinalDirection::North;
                  case 'NO':
                      return \DimitriVranken\weather_map\CardinalDirection::NorthEast;
                  case 'O':
                      return \DimitriVranken\weather_map\CardinalDirection::East;
                  case 'SO':
                      return \DimitriVranken\weather_map\CardinalDirection::SouthEast;
                  case 'S':
                      return \DimitriVranken\weather_map\CardinalDirection::South;
                  case 'SW':
                      return \DimitriVranken\weather_map\CardinalDirection::SouthWest;
                  case 'W':
                      return \DimitriVranken\weather_map\CardinalDirection::West;
                  case 'NW':
                      return \DimitriVranken\weather_map\CardinalDirection::NorthEast;
              }
          }
          
          
          protected static function parsePollination($pollinationAsInteger) {
              switch ($pollinationAsInteger) {
                  case 0:
                      return \DimitriVranken\weather_map\Pollination::None;
                  case 1:
                      return \DimitriVranken\weather_map\Pollination::Weak;
                  case 2:
                      return \DimitriVranken\weather_map\Pollination::Moderate;
                  case 3:
                      return \DimitriVranken\weather_map\Pollination::Strong;
              }
          }
          
          // Public methods
          public function parseWeatherData($dataAsArray) {
              $weatherData = array();
              
              foreach($dataAsArray as $row) {
                  $date = self::parseDate($row[0]);
                  $region = self::parseRegion($row[1]);
                  $weatherCondition = self::parseWeatherCondition($row[2]);
                  $temperature = self::parseTemperature($row[3]);
                  $wind = self::parseWind($row[4]);
                  $pollination = self::parsePollination($row[5]);
                  
                  $currentWeatherData = new \DimitriVranken\weather_map\WeatherData($date, $region, $weatherCondition, $temperature, $wind, $pollination);
                  array_push($weatherData, $currentWeatherData);
              }
              
              return $weatherData;
          }         
          
      }

?>