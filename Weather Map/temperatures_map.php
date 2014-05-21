<?php

// Includes
require_once('src/BusinessLogic/TemperaturesMapGenerator.php');

// Get the HTTP parameters
$dateHttpParameter = $_GET['date'];

if (isset($dateHttpParameter) && \WeatherMap\HttpParameterHelper::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}

// Generate the map
$mapGenerator = new \WeatherMap\BusinessLogic\TemperaturesMapGenerator();
$map = $mapGenerator->generateMap($date);

// Set the HTTP headers
header("Content-Type: image/jpg");

// Return the map
imagepng($map);
imagedestroy($map);

?>