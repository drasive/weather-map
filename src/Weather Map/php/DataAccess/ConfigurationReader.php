<?php namespace DimitriVranken\weather_map\DataAccess;

class ConfigurationReader {
    
    public static function readIniFile($filePath, $processSections) {
        return parse_ini_file($filePath, $processSections);
    }
    
}

?>