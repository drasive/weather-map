<?php

// Includes
require_once('src/BusinessLogic/ConditionsMapGenerator.php');

// Get the HTTP parameters
// TODO: Ceck if date is smaller than today or bigger than allowed -> use today (currect URL if possible)

$dateHttpParameter = $_GET['date'];

if (isset($dateHttpParameter) && \WeatherMap\BusinessLogic\HttpParameterValidator::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}
// TODO: Else -> throw exception or something

// Generate the map
$mapGenerator = new \WeatherMap\BusinessLogic\ConditionsMapGenerator();
$map = $mapGenerator->generateMap($date);

// Set the HTTP headers
header("Content-Type: image/jpg");

// Return the map
imagepng($map);
imagedestroy($map);

?>