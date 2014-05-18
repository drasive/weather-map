<?php namespace WeatherMap\UserInterface;

      require_once('src/UserInterface/WeatherMapGenerator.php');
      require_once('src/Size.php');

      class PollinationMapGenerator extends WeatherMapGenerator {

          // Protected methods
          protected static function getIconForPollination($pollination) {
              switch ($pollination) {
                  case \WeatherMap\Pollination::None:
                  // TODO: Add image for no pollution
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
              $background = parent::getBackgroundImage();

              foreach ($weatherData as $currentWeatherData) {
                  $icon = self::getIconForPollination($currentWeatherData->pollination);
                  // TODO: remove null check when image for no pollution is added
                  if (iconv != null) {
                      $iconSize = new \WeatherMap\Size(imagesx($icon), imagesy($icon));
                      $destinationCoordinates = parent::getCoordinateForIcon($currentWeatherData->region, $iconSize);                  
                      
                      imagecopy($background, $icon, $destinationCoordinates->x, $destinationCoordinates->y, 0, 0, $iconSize->width, $iconSize->height);
                      imagedestroy($icon);
                  }
              }

              return $background;
          }

      }

?>