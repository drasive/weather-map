<!DOCTYPE html>

<?php
// TODO: Use the same weather data for all the maps (and possibly all the days)

// TODO: Check if the webservice can be reached or show an error


// Includes
require_once('src/BusinessLogic/DateTimeHelper.php');
require_once('src/BusinessLogic/ConfigurationReader.php');
require_once('src/HttpParameterHelper.php');

// Get the HTTP parameters
$dateHttpParameter = $_GET['date'];
$date = null;

if (isset($dateHttpParameter) && \WeatherMap\HttpParameterHelper::hasValue($dateHttpParameter)) {
    $date = strtotime($dateHttpParameter);
}

// Validate the HTTP parameters
$minimumDate = strtotime(date('Y-m-d', time()));
$maximumDate = $minimumDate + (60 * 60 * 24 * 7);
$defaultDate = time();

if ($date == null || $date == false || date == '') { // Date couldn't be obtained
    $date = $defaultDate;
}
else if ($date < $minimumDate || $date >= $maximumDate) { // Date out of valid range
    $date = $defaultDate;
}

// Process the HTTP parameters
$dateISO8601 = date('Y-m-d', $date);
$dateHumanReadable = date('d. M Y', $date);
$dateDayOfWeek = null;

if (\WeatherMap\BusinessLogic\DateTimeHelper::isToday($date)) {
    $dateDayOfWeek = 'Today';
}
else if (\WeatherMap\BusinessLogic\DateTimeHelper::isTomorrow($date)) {
    $dateDayOfWeek = 'Tomorrow';
}
else {
    $dateDayOfWeek = getdate($date)['weekday'];
}

?>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>
        <?php echo "$dateDayOfWeek - "; ?>Weather Map
    </title>
    <link rel="shortcut icon" href="media/icons/sun.ico" />

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="scripts/js/jquery.easing.min.js"></script>

    <!-- Bootstrap -->
    <script src="scripts/js/bootstrap.min.js"></script>
    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <!-- Style -->
    <link href="style/css/style.css" rel="stylesheet" />
    <script src="scripts/js/style.js" type="text/javascript"></script>

    <!-- Flex Slider -->
    <link rel="stylesheet" href="style/css/flexslider.css" type="text/css" />
    <script src="scripts/js/jquery.flexslider.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
        $(window).load(function () {
            $(".flexslider").flexslider({
                slideshow: false,
                animation: "slide",
                easing: "easeInElastic",
                animationLoop: true
            });
        });

        // easeInOutCubic
    </script>
</head>
<body>
    <?php
    require_once('includes/warnings.inc.php');
    require_once('includes/navigation.inc.html');
    ?>

    <?php
    if (WeatherMap\BusinessLogic\ConfigurationReader::getDebugMode()) {
        echo "Parsed date: $dateDayOfWeek ($dateISO8601)";
    }
    ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>
                <?php echo "$dateDayOfWeek, $dateHumanReadable"; ?>
            </h1>
        </div>
        <div class="container">
            <article>
                <section class="flexslider">
                    <?php
                    function generateMapImageElement($mapImageGeneratorUrl) {
                        $parameterName = 'date';
                        global $dateISO8601;
                        $parameterValue = $dateISO8601;

                        return "<img src='$mapImageGeneratorUrl?$parameterName=$parameterValue' />";
                    }
                    ?>

                    <ul class="slides">
                        <li>
                            <h2 class="image-title">Conditions</h2>
                            <?php echo generateMapImageElement('conditions_map.php'); ?>
                        </li>
                        <li>
                            <h2 class="image-title">Temperatures</h2>
                            <?php echo generateMapImageElement('temperatures_map.php'); ?>
                        </li>
                        <li>
                            <h2 class="image-title">Wind</h2>
                            <?php //echo generateMapImageElement('wind_map.php'); ?>
                        </li>
                        <li>
                            <h2 class="image-title">Pollination</h2>
                            <?php echo generateMapImageElement('pollination_map.php'); ?>
                        </li>
                    </ul>
                </section>
            </article>
        </div>
    </div>

    <?php require_once('includes/footer.inc.html'); ?>
</body>
</html>
