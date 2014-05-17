<?php namespace WeatherMap\BusinessLogic;

      require_once('src/DataAccess/ConfigurationReader.php');
      
      class ConfigurationReader {
          
          // Variables
          protected static $m_configurationFile = 'configuration.ini';
          
          protected static $m_section_general = 'general';
          protected static $m_timezone = 'timezone';
          
          protected static $m_section_webservice = 'webservice';
          protected static $m_webservice_URL = 'URL';
          
          // General section
          public static function getTimezone(){ 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile($m_configurationFile, true)[$m_section_general][$m_timezone];
          }
          
          // Webservice section
          public static function getWebserviceURL(){ 
              return \WeatherMap\DataAccess\ConfigurationReader::readIniFile($m_configurationFile, true)[$m_section_webservice][$m_webservice_URL];
          }
          
      }

?>