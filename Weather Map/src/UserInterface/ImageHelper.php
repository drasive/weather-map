<?php namespace WeatherMap\UserInterface;
      
      require_once('src/Size.php');

      class ImageHelper {
          
          // Public methods
          public static function enableTransparency($image) {
              $imageSize = new \WeatherMap\Size(imagesx($image), imagesy($image));
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
          
          // Source: http://php.net/manual/en/function.imagecopymerge.php
          public static function copyWithAlpha($destination, $source, $destinationX, $destinationY, $transparency, $sourceX = 0, $sourceY = 0) {
              $sourceSize = new \WeatherMap\Size(imagesx($source), imagesy($source));
              
              // Create a cut resource 
              $cut = imagecreatetruecolor($sourceSize->width, $sourceSize->height); 

              // Copy relevant section of background to the cut resource 
              imagecopy($cut, $destination, 0, 0, $destinationX, $destinationY, $sourceSize->width, $sourceSize->height); 
              
              // Copy relevant section from watermark to the cut resource 
              imagecopy($cut, $source, 0, 0, $sourceX, $sourceY, $sourceSize->width, $sourceSize->height); 
              
              // Insert cut resource to destination image 
              imagecopymerge($destination, $cut, $destinationX, $destinationY, 0, 0, $sourceSize->width, $sourceSize->height, $transparency); 
          }
          
      }
      
?>