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
      require_once('src/Size.php');

      class ConditionsMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getImageForWeatherCondition($weatherCondition) {
              switch ($weatherCondition) {
                  case \WeatherMap\WeatherCondition::Sunny:
                      return imagecreatefrompng('media/icons/sunny.png');
                  case \WeatherMap\WeatherCondition::Cloudy:
                      return imagecreatefrompng('media/icons/cloudy.png');
                  case \WeatherMap\WeatherCondition::Rain:
                      return imagecreatefrompng('media/icons/rain.png');
                  case \WeatherMap\WeatherCondition::Thunderstorm:
                      return imagecreatefrompng('media/icons/thunderstorm.png');
                  case \WeatherMap\WeatherCondition::Snow:
                      return imagecreatefrompng('media/icons/snow.png');
              }
          }
          
          // Public constructors
          function __construct($weatherData) {
              parent::__construct($weatherData);
          }

          // Public methods
          public function generateMap() {
              $background = parent::getBackgroundImage();

              foreach ($this->weatherData as $currentWeatherData) {
                  $destinationDoordinates = parent::getCoordinates($currentWeatherData->region);
                  $icon = self::getImageForWeatherCondition($currentWeatherData->weatherCondition);
                  $imageSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                  
                  imagecopy($background, $icon, $destinationDoordinates->x, $destinationDoordinates->y, 0, 0, $imageSize->width, $imageSize->height);
                  imagedestroy($icon);
              }

              return $background;
          }

      }

?>