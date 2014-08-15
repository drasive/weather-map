<?php namespace DimitriVranken\weather_map\DataAccess;

      abstract class WeatherDataReader {
          
          // Documentaion: Gets raw data and converts it
          public abstract function readData($source);
          
      }

?>