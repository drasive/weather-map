<?php namespace WeatherMap\UserInterface;

      require_once('src/UserInterface/WeatherMapGenerator.php');
      require_once('src/UserInterface/ImageHelper.php');
      require_once('src/Size.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForPollinationStrength($pollination) {
              switch ($pollination) {
                  case \WeatherMap\Pollination::None:
                      // TODO: Add image for no pollution
                      return null;
                  case \WeatherMap\Pollination::Weak:
                      return imagecreatefrompng('media/icons/pollination/weak.png');
                  case \WeatherMap\Pollination::Moderate:
                      return imagecreatefrompng('media/icons/pollination/moderate.png');
                  case \WeatherMap\Pollination::Strong:
                      return imagecreatefrompng('media/icons/pollination/strong.png');
              }
          }
          
          // Public methods
          public function generateMap($weatherData) {
              // Get background image
              $map = parent::getBackgroundImage();

              // Add icons
              foreach ($weatherData as $currentWeatherData) {
                  $icon = self::getIconForPollinationStrength($currentWeatherData->pollination);
                  
                  // TODO: remove null check when image for no pollution is added
                  if ($icon != null) {
                      $iconSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                      $destinationCoordinates = parent::getCoordinateForIconCentered($currentWeatherData->region, $iconSize);                  
                      
                      // Set white to transparent
                      $transparentColor = imagecolorallocate($icon, 255, 255, 255);
                      imagecolortransparent($icon, $transparentColor);
                      
                      // Merge images
                      imagecopymerge($map, $icon,
                                     $destinationCoordinates->x, $destinationCoordinates->y,
                                     0, 0,
                                     $iconSize->width, $iconSize->height,
                                     60);
                      imagedestroy($icon);
                  }
              }
              
              // Enable transparency
              $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);
              
              // Return
              return $map;
          }

      }

?>