<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Wetterkarte</title>
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
    // TODO: Debug flag
    $debug = false;
        
    require_once('src/BusinessLogic/ConfigurationReader.php');
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
</body>
</html>
