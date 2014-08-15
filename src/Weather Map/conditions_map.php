<?php

// Set the HTTP headers
header("Content-Type: image/png");

// Includes
require_once('php/BusinessLogic/ConditionsMapGenerator.php');
require_once('php/BusinessLogic/ParameterValidator.php');

// Get the HTTP parameters
$dateHttpParameter = $_GET['date'];
$date = null;

if (isset($dateHttpParameter) && \DimitriVranken\weather_map\HttpParameterHelper::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}

// Validate the HTTP parameters
if ($date == null || $date == false || date == '' || !\DimitriVranken\weather_map\BusinessLogic\ParameterValidator::isRequestedMapDateValid($date)) { // Date couldn't be obtained or is invalid
    $argumentInvalid = imagecreatefrompng('media/images/argument_invalid.png');
    imagepng($argumentInvalid);
    imagedestroy($argumentInvalid);
    
    exit();
}

// Generate the map
$mapGenerator = new \DimitriVranken\weather_map\BusinessLogic\ConditionsMapGenerator();
$map = $mapGenerator->generateMap($date);

// Return the map
imagepng($map);
imagedestroy($map);

?>