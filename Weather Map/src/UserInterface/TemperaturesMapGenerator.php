<?php namespace WeatherMap\UserInterface;

      require_once('src/UserInterface/WeatherMapGenerator.php');

      class TemperaturesMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getColorForTemperature($temperature) {
              if ($temperature < 0) {
                  return imagecolorallocate(25, 25, 255);
              }
              else if ($temperature > 30) {
                  return imagecolorallocate(250, 70, 0);
              }
              else {
                  return parent::getNeutralFontColor();
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
                  // TODO: Improve positioning
                  
                  $fontTemperatureMinimum = self::getColorForTemperature($currentWeatherData->temperature->minimum);
                  $fontSplitCharacter = parent::getNeutralFontColor();
                  $fontTemperatureMaximum = self::getColorForTemperature($currentWeatherData->temperature->maximum);
                  $destinationCoordinates = parent::getCoordinateForText($currentWeatherData->region);
                  
                  $fontFile = 'style/fonts/arial.ttf';
                  $fontSize = 18;
                  $textAngle = 0;
                  $splitCharacterOffset = 15;
                  
                  // Draw minimum temperature
                  imagettftext($background, $fontSize, $textAngle, $destinationCoordinates->x, $destinationCoordinates->y,
                               $fontTemperatureMinimum, $fontFile, $currentWeatherData->temperature->minimum);
                  
                  // Draw split character
                  imagettftext($background, $fontSize, $textAngle, $destinationCoordinates->x + $splitCharacterOffset, $destinationCoordinates->y,
                               $fontSplitCharacter, $fontFile, '/');
                  
                  // Draw maximum temperature
                  imagettftext($background, $fontSize, $textAngle, $destinationCoordinates->x + 25, $destinationCoordinates->y,
                               $fontTemperatureMaxmimum, $fontFile, $currentWeatherData->temperature->maximum);
              }

              return $background;
          }

      }

?>