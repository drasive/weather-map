<?php namespace DimitriVranken\weather_map\UserInterface;
      
      require_once('php/Size.php');

      class ImageHelper {
          
          // Public methods
          public static function enableTransparency($image) {
              $imageSize = new \DimitriVranken\weather_map\Size(imagesx($image), imagesy($image));
              $imageWithTransparencyEnabled = imagecreatetruecolor($imageSize->width, $imageSize->height);   
              
              imagealphablending($imageWithTransparencyEnabled, false);
              imagesavealpha($imageWithTransparencyEnabled, true);
              imagecopyresampled($imageWithTransparencyEnabled, $image, 
                                 0, 0,
                                 0, 0,
                                 $imageSize->width, $imageSize->height,
                                 $imageSize->width, $imageSize->height);
              
              return $imageWithTransparencyEnabled;
          }
          
      }
      
?>