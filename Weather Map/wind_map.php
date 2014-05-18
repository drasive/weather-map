<?php

// Includes
require_once('src/BusinessLogic/WindMapGenerator.php');

// Get the HTTP parameters
$dateHttpParameter = $_GET['date'];

if (isset($dateHttpParameter) && \WeatherMap\BusinessLogic\HttpParameterValidator::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}

// Generate the map
$mapGenerator = new \WeatherMap\BusinessLogic\WindMapGenerator();
$map = $mapGenerator->generateMap($date);

// Set the HTTP headers
header("Content-Type: image/jpg");

// Return the map
imagejpeg($map);
imagedestroy($map);

?>