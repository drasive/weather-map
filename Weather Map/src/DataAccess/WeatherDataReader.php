<?php namespace WeatherMap\DataAccess;

      abstract class WeatherDataReader {
          
          // Documentaion: Gets raw data and converts it
          public abstract function readWeatherData($source);
          
      }

?>