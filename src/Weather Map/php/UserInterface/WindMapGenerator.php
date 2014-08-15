<?php namespace DimitriVranken\weather_map\UserInterface;

      require_once('php/UserInterface/WeatherMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/Size.php');
      require_once('php/CardinalDirection.php');

      class WindMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForWindDirection($windDirection) {
              $angle = \DimitriVranken\weather_map\CardinalDirection::getAngle($windDirection);
              
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
                  if (!$currentWeatherData->wind->direction == \DimitriVranken\weather_map\CardinalDirection::None) {
                      $icon = self::getIconForWindDirection($currentWeatherData->wind->direction);
                      $iconSize = new \DimitriVranken\weather_map\Size(imagesx($icon), imagesy($icon));
                      
                      $iconDestinationCoordinates = parent::getCoordinateForIcon($currentWeatherData->region, $iconSize);
                      $iconYOffset = -18;
                      
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
              $map = \DimitriVranken\weather_map\UserInterface\ImageHelper::enableTransparency($map);
              
              // Return
              return $map;
          }

      }

?>