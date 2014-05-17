<!DOCTYPE html>

<?php
// TODO: Debug flag
$debug = true;

// Includes
require_once('src/DateTimeHelper.php');
require_once('src/BusinessLogic/ConfigurationReader.php');
require_once('src/BusinessLogic/HttpParameterValidator.php');

// Configure the default timezone
$default_timezone = WeatherMap\BusinessLogic\ConfigurationReader::getTimezone();
date_default_timezone_set($default_timezone);

// Get the HTTP parameters
$date = '';

if (isset($_GET['date'])) {
    $dateHttpParameter = $_GET['date'];
    if (WeatherMap\BusinessLogic\HttpParameterValidator::hasValue($dateHttpParameter)) {
        $date = strtotime($dateHttpParameter);
    }
}

if ($date == '') { // Date couldn't be obtained from HTTP parameter
    $date = time();
}

// Process HTTP parameters
$dateString = '';

if (WeatherMap\DateTimeHelper::isToday($date)) {
    $dateString = 'Today';
}
else if (WeatherMap\DateTimeHelper::isTomorrow($date)) {
    $dateString = 'Tomorrow';
}
else {
    $dateString = getdate($date)['weekday'];
}

?>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>
    <?php echo $dateString; ?> - Weather Map
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
            $('.flexslider').flexslider({
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
    if ($debug) {
        echo 'Parsed date: ' . $dateString . ' (' . date('Y-m-d', $date) . ')';
    }
    ?>

    <div class="content">
        <div class="title-box text-center">
            <h1>Today</h1>
        </div>
        <div class="container">
            <article>
                <section>
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <h2>Conditions</h2>
                                <img src="media/images/batman_ironman_spider-man.jpg" />
                            </li>
                            <li>
                                <h2>Temperature</h2>
                                <img src="media/images/kid_lolly_cat.jpg" />
                            </li>
                            <li>
                                <h2>Wind</h2>
                                <img src="media/images/kid_lolly_cat.jpg" />
                            </li>
                            <li>
                                <h2>Pollen</h2>
                                <img src="media/images/kid_lolly_cat.jpg" />
                            </li>
                        </ul>
                    </div>
                </section>
            </article>
        </div>
    </div>

    <?php require_once('includes/footer.inc.html'); ?>
</body>
</html>
