<?php namespace WeatherMap\BusinessLogic;

      require_once('src/DataAccess/ConfigurationReader.php');
      
      class ConfigurationReader {
          
          // Variables
          protected static $m_configurationFile = 'configuration.ini';
          
          protected static $m_sectioRelease = 'release';
          protected static $m_debugMode = 'debugMode';
          protected static $m_releaseDate = 'releaseDate';
          
          protected static $m_sectionWebservice = 'webservice';
          protected static $m_webserviceURL = 'URL';
          protected static $m_webserviceUseCache = 'useCache';
          
          protected static $m_sectionMaps = 'maps';
          protected static $m_mapsUseCache = 'useCache';
          
          // Release section
          public static function getDebugMode() { 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectioRelease][self::$m_debugMode];
          }
          
          public static function getReleaseDate() { 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectioRelease][self::$m_releaseDate];
          }
          
          // Webservice section
          public static function getWebserviceURL() { 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectionWebservice][self::$m_webserviceURL];
          }
          
          public static function getWebserviceUseCache() { 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectionWebservice][self::$m_webserviceUseCache];
          }
          
          // Webservice section
          public static function getMapsCache() { 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile(self::$m_configurationFile, true)[self::$m_sectionMaps][self::$m_mapsUseCache];
          }
          
      }

?>