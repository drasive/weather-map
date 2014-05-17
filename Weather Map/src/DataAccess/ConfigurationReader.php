<?php namespace WeatherMap\DataAccess;

class ConfigurationReader {
    
    public static function readIniFile($filePath, $processSections) {
        return parse_ini_file($filePath, $processSections);
    }
    
}

?>