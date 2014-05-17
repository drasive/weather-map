<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <meta name="author" content="Dimitri Vranken" />

    <title>Error - Formular-Generator</title>
    <link rel="shortcut icon" href="media/icons/sun.ico">

    <script src="http://code.jquery.com/jquery.js"></script>

    <script src="scripts/js/bootstrap.min.js"></script>
    <link href="style/css/bootstrap.css" rel="stylesheet" media="screen" />

    <link href="style/css/style.css" rel="stylesheet" />
</head>
<body>
    <?php
    require_once('includes/warnings.inc.php');
    require_once('includes/navigation.inc.html');
    ?>

    <div class="content">
        <div class="container special-content">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <h1 class="error">Error.</h1>
                <h2 class="error">I fucked up, sorry!</h2>
                <p class="lead">
                    Back to the <a href="/generate_input_form.php">Homepage</a>.
                </p>
            </div>
            <aside class="hidden-xs col-sm-6 col-md-6 col-lg-6 pull-right">
                <div>
                    <p class="image-title">
                        Here, take this image as a compensation:
                    </p>
                    <img src="/media/images/batman_ironman_spider-man.jpg" style="height: 480px; width: 360px;" alt="Spider-Man: still poor." title="Spider-Man: still poor." /><br />
                    <p class="image-description">
                        Image source: <a href="http://www.uproxx.com/gammasquad/2012/07/batman-and-iron-man-infographics/">Uproxx.com</a><br />
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <?php require_once('includes/footer.inc.html'); ?>
</body>
</html>
