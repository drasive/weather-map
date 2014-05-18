<?php

// Includes
require_once('src/BusinessLogic/ConditionsMapGenerator.php');

// Get the HTTP parameters
$dateHttpParameter = $_GET['date'];

if (isset($dateHttpParameter) && \WeatherMap\BusinessLogic\HttpParameterValidator::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}

// Generate the map
$mapGenerator = new \WeatherMap\BusinessLogic\ConditionsMapGenerator($date);
$map = $mapGenerator->generateMap();

// Set the HTTP headers
header("Content-Type: image/jpg");

// Return the map
imagejpeg($map);
imagedestroy($map);

?>