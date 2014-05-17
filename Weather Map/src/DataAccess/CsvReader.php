<?php namespace WeatherMap\DataAccess;

class CsvReader {
    
    public static function readFile($fileHandle, $maximumLineLength = 0, $valueDelimiter = ';') {
        $content = array();
        
        while (($currentRow = fgetcsv($fileHandle, $maximumLineLength, $valueDelimiter)) !== false) {
            $content[count($content)] = $currentRow;
        }

        return $content;
    }
    
}

?>