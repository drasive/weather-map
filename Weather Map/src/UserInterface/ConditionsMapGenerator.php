<?php namespace WeatherMap\UserInterface;

      // TODO:
      // If this file is located deeper than the root directory itself, "../[../]" has to be prepended to these require-paths (which makes sense).
      // But every require-path in a class used by this one then has to have the "../[../]" prefix too.
      // This becomes a problem when these classes get used by classes that lie directly in the root directory or at any other depth than this one.
      // How can I ceep the require-pathss in the used classes?
      //
      // Move this class to media/images/generated/ if the problem is fixes. Keep it here otherwise.
      //
      // Damn, that probably the longest meanigful comment I have ever written.
      require_once('src/UserInterface/WeatherMapGenerator.php');
      require_once('src/UserInterface/ImageHelper.php');
      require_once('src/Size.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForWeatherCondition($weatherCondition) {
              $icon = null;
              
              switch ($weatherCondition) {
                  case \WeatherMap\WeatherCondition::Sunny:
                      $icon = imagecreatefrompng('media/icons/weather/sunny.png');
                      break;
                  case \WeatherMap\WeatherCondition::Cloudy:
                      $icon = imagecreatefrompng('media/icons/weather/cloudy.png');
                      break;
                  case \WeatherMap\WeatherCondition::Rain:
                      $icon = imagecreatefrompng('media/icons/weather/rain.png');
                      break;
                  case \WeatherMap\WeatherCondition::Thunderstorm:
                      $icon = imagecreatefrompng('media/icons/weather/thunderstorm.png');
                      break;
                  case \WeatherMap\WeatherCondition::Snow:
                      $icon = imagecreatefrompng('media/icons/weather/snow.png');
                      break;
              }
              
              $icon = \WeatherMap\UserInterface\ImageHelper::enableTransparency($icon);
              
              return $icon;
          }
          
          // Public methods
          public function generateMap($weatherData) {
             $background = parent::getBackgroundImage();

             foreach ($weatherData as $currentWeatherData) {
                 $icon = self::getIconForWeatherCondition($currentWeatherData->weatherCondition);
                 $iconSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                 $destinationCoordinates = parent::getCoordinateForIcon($currentWeatherData->region, $iconSize);                  
                 
                 imagecopy($background, $icon,
                           $destinationCoordinates->x, $destinationCoordinates->y,
                           0, 0,
                           $iconSize->width, $iconSize->height);
                 imagedestroy($icon);
             }

             return $background;
          }

      }

?>