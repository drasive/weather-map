<?php namespace WeatherMap\UserInterface;

      require_once('src/UserInterface/WeatherMapGenerator.php');
      require_once('src/UserInterface/ImageHelper.php');
      require_once('src/Size.php');

      class WindMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForWindDirection($windDirection) {
              $icon = imagecreatefrompng('media/icons/wind/arrow.png');
              $angle = null;
              
              switch ($windDirection) {
                  case \WeatherMap\CardinalDirection::North:
                      $angle = 0;
                      break;
                  case \WeatherMap\CardinalDirection::NorthEast:
                      $angle = 45;
                      break;
                  case \WeatherMap\CardinalDirection::East:
                      $angle = 90;
                      break;
                  case \WeatherMap\CardinalDirection::SouthEast:
                      $angle = 120;
                      break;
                  case \WeatherMap\CardinalDirection::South:
                      $angle = 180;
                      break;
                  case \WeatherMap\CardinalDirection::SouthWest:
                      $angle = 225;
                      break;
                  case \WeatherMap\CardinalDirection::West:
                      $angle = 270;
                      break;
                  case \WeatherMap\CardinalDirection::NorthWest:
                      $angle = 315;
                      break;
              }
              
              // Rotate icon
              $icon = imagerotate($icon, $angle, 0);
              
              // Return
              return $icon;
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
                  
                  $textDestinationCoordinates = parent::getCoordinateForText($currentWeatherData->region);                 
                  $textYOffset = 0;
                  
                  imagettftext($map, $fontSize, $textAngle,
                               $textDestinationCoordinates->x, $textDestinationCoordinates->y + $textYOffset,
                               $fontColor, $fontFile, $currentWeatherData->wind->strength);
              }

              // Enable transparency
              $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);
              
              // Return
              return $map;
          }

      }

?>