<?php namespace WeatherMap\DataAccess;
      
      class FileManager {
          
          public static function writeFile($filePath, $content) {
              $fileHandle = fopen($filePath, 'w');
              fwrite($fileHandle, $content);
              fclose($fileHandle);
          }
          
          
          public static function readFile($filePath) {
              $content = file($filePath);
              
              return $content;
          }
          
      }

?>