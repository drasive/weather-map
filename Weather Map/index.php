<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Wetterkarte</title>
    <link rel="shortcut icon" href="media/icons/form.ico" />

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery.js"></script>

    <!-- Bootstrap -->
    <script src="scripts/javascript/bootstrap.min.js"></script>
    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <!-- Style -->
    <link href="style/css/style.css" rel="stylesheet" />
    <script src="scripts/javascript/style.js" type="text/javascript"></script>

    <!-- Cookies -->
    <script src="scripts/javascript/jquery.cookies.min.js" type="text/javascript"></script>
    <script src="scripts/javascript/storage.js" type="text/javascript"></script>

    <!-- Flex Slider -->
    <link rel="stylesheet" href="style/css/flexslider.css" type="text/css">
    <script src="scripts/javascript/jquery.flexslider.js"></script>

    <script type="text/javascript" charset="utf-8">
        $(window).load(function () {
            $('.flexslider').flexslider();
        });
    </script>
</head>
<body>
    <?php
    // TODO: Debug flag
    $debug = false;
    ?>

    <?php 
    require('includes/warnings.inc.php');
    require('includes/navigation.inc.html');
    ?>

    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="media/images/batman_ironman_spider-man.jpg" />
                Test
            </li>
            <li>
                <img src="media/images/kid_lolly_cat.jpg" />
                Test 2
            </li>
        </ul>
    </div>

</body>
</html>
