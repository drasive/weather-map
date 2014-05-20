<?php namespace WeatherMap\UserInterface;

      require_once('src/UserInterface/WeatherMapGenerator.php');
      require_once('src/UserInterface/ImageHelper.php');
      require_once('src/Size.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForPollination($pollination) {
              $icon = null;
              
              switch ($pollination) {
                  case \WeatherMap\Pollination::None:
                  // TODO: Add image for no pollution                  
                  case \WeatherMap\Pollination::Weak:
                      $icon = imagecreatefrompng('media/icons/pollination/weak.png');
                      break;
                  case \WeatherMap\Pollination::Moderate:
                      $icon = imagecreatefrompng('media/icons/pollination/moderate.png');
                      break;
                  case \WeatherMap\Pollination::Strong:
                      $icon = imagecreatefrompng('media/icons/pollination/strong.png');
                      break;
              }
              
              $icon = \WeatherMap\UserInterface\ImageHelper::enableTransparency($icon);
              return $icon;
          }
          
          // Public methods
          public function generateMap($weatherData) {
              $background = parent::getBackgroundImage();

              foreach ($weatherData as $currentWeatherData) {
                  $icon = self::getIconForPollination($currentWeatherData->pollination);
                  
                  // TODO: remove null check when image for no pollution is added
                  if (iconv != null) {
                      $iconSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                      $destinationCoordinates = parent::getCoordinateForIcon($currentWeatherData->region, $iconSize);                  
                      
                      imagecopymerge($background, $icon,
                                     $destinationCoordinates->x, $destinationCoordinates->y,
                                     0, 0,
                                     $iconSize->width, $iconSize->height, 70);
                      imagedestroy($icon);
                  }
              }

              return $background;
          }

      }

?>