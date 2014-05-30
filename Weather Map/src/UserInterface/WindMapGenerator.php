<?php namespace WeatherMap\UserInterface;

      require_once('src/UserInterface/WeatherMapGenerator.php');
      require_once('src/UserInterface/ImageHelper.php');
      require_once('src/Size.php');
      require_once('src/CardinalDirection.php');

      class WindMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForWindDirection($windDirection) {
              $angle = \WeatherMap\CardinalDirection::getAngle($windDirection);
              
              if ($angle % 90 == 0) { // Is a quarter turn
                  // Get icon
                  $icon = imagecreatefrompng('media/icons/wind/arrow_0.png');
                  
                  // Rotate icon
                  $icon = imagerotate($icon, $angle, 0);
              }
              else { // Is not a quarter turn
                  // Get icon
                  $icon = imagecreatefrompng('media/icons/wind/arrow_45.png');
                  
                  // Rotate icon
                  $icon = imagerotate($icon, $angle - 45, 0);
              }
              
              // Return
              return $icon;
          }
          
          protected static function getHorizontalOffsetForText($string) {
              if (strlen($string) == 1) {
                  return -5;
              }
              else if (strlen($string) == 2) {
                  return -12;
              }
              else if (strlen($string) == 3) {
                  return -18;
              }
              else {
                  return null;
              }
          }
          
          // Public methods
          public function generateMap($weatherData) {
              // Get background image
              $map = parent::getBackgroundImage();

              // Add icons and text
              foreach ($weatherData as $currentWeatherData) {
                  // Draw icon
                  if (!$currentWeatherData->wind->direction == \WeatherMap\CardinalDirection::None) {
                      $icon = self::getIconForWindDirection($currentWeatherData->wind->direction);
                      $iconSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                      
                      $iconDestinationCoordinates = parent::getCoordinateForIcon($currentWeatherData->region, $iconSize);
                      $iconYOffset = -25;
                      
                      imagecopy($map, $icon,
                                $iconDestinationCoordinates->x, $iconDestinationCoordinates->y + $iconYOffset,
                                0, 0,
                                $iconSize->width, $iconSize->height);
                      imagedestroy($icon);
                  }
                  
                  // Draw strength
                  $fontFile = 'style/fonts/arial.ttf';
                  $fontSize = 18;
                  $fontColor = parent::getNeutralFontColor();
                  $textAngle = 0;
                  
                  $text = $currentWeatherData->wind->strength;
                  $textDestinationCoordinates = parent::getCoordinateForText($currentWeatherData->region);                 
                  $textXOffset = self::getHorizontalOffsetForText($text);
                  
                  imagettftext($map, $fontSize, $textAngle,
                               $textDestinationCoordinates->x + $textXOffset, $textDestinationCoordinates->y,
                               $fontColor, $fontFile, $text);
              }

              // Enable transparency
              $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);
              
              // Return
              return $map;
          }

      }

?>