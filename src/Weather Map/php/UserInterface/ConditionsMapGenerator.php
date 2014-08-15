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
      require_once('php/UserInterface/WeatherMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/Size.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForWeatherCondition($weatherCondition) {
              switch ($weatherCondition) {
                  case \WeatherMap\WeatherCondition::Sunny:
                      return imagecreatefrompng('media/icons/weather/sunny.png');
                  case \WeatherMap\WeatherCondition::Cloudy:
                      return imagecreatefrompng('media/icons/weather/cloudy.png');
                  case \WeatherMap\WeatherCondition::Rain:
                      return imagecreatefrompng('media/icons/weather/rain.png');
                  case \WeatherMap\WeatherCondition::Thunderstorm:
                      return imagecreatefrompng('media/icons/weather/thunderstorm.png');
                  case \WeatherMap\WeatherCondition::Snow:
                      return imagecreatefrompng('media/icons/weather/snow.png');
              }
          }
          
          // Public methods
          public function generateMap($weatherData) {
             // Get background image
             $map = parent::getBackgroundImage();

             // Add icons
             foreach ($weatherData as $currentWeatherData) {
                 $icon = self::getIconForWeatherCondition($currentWeatherData->weatherCondition);
                 $iconSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                 $destinationCoordinates = parent::getCoordinateForIcon($currentWeatherData->region, $iconSize);
                 
                 imagecopy($map, $icon,
                           $destinationCoordinates->x, $destinationCoordinates->y,
                           0, 0,
                           $iconSize->width, $iconSize->height);
                 imagedestroy($icon);
             }

             // Enable transparency
             $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);
             
             // Return
             return $map;
          }

      }

?>