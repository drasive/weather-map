<?php namespace DimitriVranken\weather_map\DataAccess;
      
      class IOManager {
          
          public static function readFile($filePath) {
              $content = file($filePath);
              
              return $content;

          }
          
          public static function writeFile($filePath, $content) {
              $fileHandle = fopen($filePath, 'w');
              fwrite($fileHandle, $content);
              fclose($fileHandle);
          }
          
          
          public static function checkFolder($folderPath) {
              if (!file_exists($folderPath)) {
                  mkdir($folderPath);
              }
          }
          
      }

?>