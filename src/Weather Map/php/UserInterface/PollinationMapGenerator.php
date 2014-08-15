<?php namespace WeatherMap\UserInterface;

      require_once('php/UserInterface/WeatherMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/Size.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForPollinationStrength($pollination) {
              switch ($pollination) {
                  case \WeatherMap\Pollination::None:
                      return imagecreatefrompng('media/icons/pollination/none.png');
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
                                 65);
                  imagedestroy($icon);
              }
              
              // Enable transparency
              $map = \WeatherMap\UserInterface\ImageHelper::enableTransparency($map);
              
              // Return
              return $map;
          }

      }

?>