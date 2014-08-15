<?php namespace WeatherMap\UserInterface;

      require_once('php/UserInterface/WeatherMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      
      class TemperaturesMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getColorForTemperature($temperature) {
              $color = null;              
              $image = imagecreatetruecolor(1, 1);
              
              if ($temperature < 0) {
                  $color = imagecolorallocate($image, 25, 25, 255);
              }
              else if ($temperature > 35) {
                  $color = imagecolorallocate($image, 250, 40, 0);
              }
              else {
                  $color = parent::getNeutralFontColor();
              }
              
              imagedestroy($image);
              
              return $color;
          }          
          
          protected static function getHorizontalOffsetForText($string) {
              if (strlen($string) == 1) {
                  return -15;
              }
              else if (strlen($string) == 2) {
                  return -29;
              }
              else if (strlen($string) == 3) {
                  return -37;
              }
              else {
                  return null;
              }
          }
          
          // Public methods
          public function generateMap($weatherData) {
              // Get background image
              $map = parent::getBackgroundImage();

              // Add text
              foreach ($weatherData as $currentWeatherData) {
                  $destinationCoordinates = parent::getCoordinateForText($currentWeatherData->region);
                  
                  $fontFile = 'style/fonts/arial.ttf';
                  $fontSize = 18;
                  $textAngle = 0;
                  
                  // Draw minimum temperature
                  $minimumTemperatureText = $currentWeatherData->temperature->minimum;                  
                  $minimumTemperatureOffset = self::getHorizontalOffsetForText($minimumTemperatureText);
                  $minimumTemperatureFontColor = self::getColorForTemperature($currentWeatherData->temperature->minimum);
                  imagettftext($map, $fontSize, $textAngle,
                               $destinationCoordinates->x + $minimumTemperatureOffset, $destinationCoordinates->y,
                               $minimumTemperatureFontColor, $fontFile, $minimumTemperatureText);
                  
                  // Draw split character
                  $splitCharacterText = '/';
                  $splitCharacterFontColor = parent::getNeutralFontColor();
                  imagettftext($map, $fontSize, $textAngle,
                               $destinationCoordinates->x, $destinationCoordinates->y,
                               $splitCharacterFontColor, $fontFile, $splitCharacterText);
                  
                  // Draw maximum temperature
                  $maximumTemperatureText = $currentWeatherData->temperature->maximum;
                  $maximumTemperatureOffset = 11;
                  $maximimTemperatureFontColor = self::getColorForTemperature($currentWeatherData->temperature->maximum);
                  imagettftext($map, $fontSize, $textAngle,
                               $destinationCoordinates->x + $maximumTemperatureOffset, $destinationCoordinates->y,
                               $maximimTemperatureFontColor, $fontFile, $maximumTemperatureText);
              }

              // Enable transparency
              $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);              
              
              // Returns
              return $map;
          }

      }

?>