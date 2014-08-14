<?php

// Set the HTTP headers
header("Content-Type: image/png");

// Includes
require_once('src/BusinessLogic/PollinationMapGenerator.php');
require_once('src/BusinessLogic/ParameterValidator.php');

// Get the HTTP parameters
$dateHttpParameter = $_GET['date'];
$date = null;

if (isset($dateHttpParameter) && \WeatherMap\HttpParameterHelper::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}

// Validate the HTTP parameters
if ($date == null || $date == false || date == '' || !\WeatherMap\BusinessLogic\ParameterValidator::isRequestedMapDateValid($date)) { // Date couldn't be obtained or is invalid
    $argumentInvalid = imagecreatefrompng('media/images/argument_invalid.png');
    imagepng($argumentInvalid);
    imagedestroy($argumentInvalid);
    
    exit();
}

// Generate the map
$mapGenerator = new \WeatherMap\BusinessLogic\PollinationMapGenerator();
$map = $mapGenerator->generateMap($date);

// Return the map
imagepng($map);
imagedestroy($map);

?>