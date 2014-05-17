<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Wetterkarte</title>
    <link rel="shortcut icon" href="media/icons/form.ico" />

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
    <script src="scripts/js/jquery.flexslider.js"></script>

    <script type="text/javascript" charset="utf-8">
        $(window).load(function () {
            $('.flexslider').flexslider({
                slideshow: false,
                animation: "slide",
                easing: "easeInElastic",
                animationLoop: true,
                controlNav: "thumbnails"
            });
        });

        // easeInOutCubic
    </script>
</head>
<body>
    <?php

    // TODO: Debug flag
    $debug = false;

    require_once('includes/warnings.inc.php');
    require_once('includes/navigation.inc.html');

    require_once('src/BusinessLogic/ConfigurationReader.php');

    ?>

    <?php



    ?>

    <div class="flexslider">
        <ul class="slides">
            <li data-thumb="media/images/batman_ironman_spider-man.jpg">
                <img src="media/images/batman_ironman_spider-man.jpg" />
                Test
            </li>
            <li data-thumb="media/images/kid_lolly_cat.jpg">
                <img src="media/images/kid_lolly_cat.jpg" />
                <p class="flex-caption">Test 2</p>
            </li>
        </ul>
    </div>

</body>
</html>
