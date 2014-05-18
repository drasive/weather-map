<?php namespace WeatherMap\BusinessLogic;

      require_once('src/DataAccess/ConfigurationReader.php');
      
      class ConfigurationReader {
          
          // Variables
          protected static $m_configurationFile = 'configuration.ini';
          
          protected static $m_sectionGeneral = 'general';
          protected static $m_debugMode = 'debugMode';
          protected static $m_timezone = 'timezone';
          
          protected static $m_sectionWebservice = 'webservice';
          protected static $m_webserviceURL = 'URL';
          
          // General section
          public static function getDebugMode(){ 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectionGeneral][self::$m_debugMode];
          }
          
          public static function getTimezone(){ 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectionGeneral][self::$m_timezone];
          }
          
          // Webservice section
          public static function getWebserviceURL(){ 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectionWebservice][self::$m_webserviceURL];
          }
          
      }

?>