<?php namespace DimitriVranken\weather_map\UserInterface;

      require_once('php/UserInterface/WeatherMapGenerator.php');
      require_once('php/UserInterface/ImageHelper.php');
      require_once('php/Size.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForPollinationStrength($pollination) {
              switch ($pollination) {
                  case \DimitriVranken\weather_map\Pollination::None:
                      return imagecreatefrompng('media/icons/pollination/none.png');
                  case \DimitriVranken\weather_map\Pollination::Weak:
                      return imagecreatefrompng('media/icons/pollination/weak.png');
                  case \DimitriVranken\weather_map\Pollination::Moderate:
                      return imagecreatefrompng('media/icons/pollination/moderate.png');
                  case \DimitriVranken\weather_map\Pollination::Strong:
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
                  
                  $iconSize = new \DimitriVranken\weather_map\Size(imagesx($icon), imagesy($icon));
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
              $map = \DimitriVranken\weather_map\UserInterface\ImageHelper::enableTransparency($map);
              
              // Return
              return $map;
          }

      }

?>