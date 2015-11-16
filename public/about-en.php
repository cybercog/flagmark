<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Flagmark</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <!-- for Google -->
    <meta name="description" content="" />
    <meta name="keywords" content="Facebook, Flag, Flagmark" />

    <!-- for Facebook -->
    <meta property="og:title" content="Flagmark" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://flagmark.cybercog.su/" />
    <meta property="og:description" content="About Flagmark" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Flagmark" />
    <meta name="twitter:description" content="About Flagmark" />
    <meta name="twitter:image" content="" />
</head>
<body>
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter<?= getenv('YANDEX_METRIKA_ID') ?> = new Ya.Metrika({
                    id:<?= getenv('YANDEX_METRIKA_ID') ?>,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/<?= getenv('YANDEX_METRIKA_ID') ?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<div class="header jumbotron">
    <div class="container">
        <h1 class="display-3">Flagmark</h1>
    </div>
</div>
<div class="container">
    <h1>About Flagmark (<a href="/about-ru.php">на русском</a>)</h1>
    <p class="lead">
        This microservice was created because a lot of people in social networks asked for help
        to place flag of country as overlay (watermark) over their profile photos in graphical editors.
    </p>
    <p class="lead">
        There is a good proverb:
    </p>
    <blockquote class="lead">
        <em>&laquo;If you want a thing well done, do it yourself!&raquo;</em>
    </blockquote>
    <p class="lead">
        P.S.:
        Despite the fact that we made this service <strong>we are not supporting idea of placing flags over your photos in social networks</strong>.<br>
        But people are free to choose what they want...<br>
        We hope you will choose to help people around you with good deeds, not the words.
    </p>
    <p class="lead">
        <strong>Using the service, you agree that you are solely responsible for the use of processed photos.</strong>
    </p>
    <p>
        <a href="about:blank" onclick="yaCounter<?= getenv('YANDEX_METRIKA_ID') ?>.reachGoal('close'); window.close(); return true;" class="btn btn-primary-outline">&times; Close website</a>
        <a href="/generate.php" onclick="yaCounter<?= getenv('YANDEX_METRIKA_ID') ?>.reachGoal('getit'); return true;" class="btn btn-danger-outline">Generate image</a>
    </p>
</div>
<div class="footer">
    <div class="container">
        <p class="copyright pull-right">
            <a href="/about-en.php">About</a>
            |
            <a href="/about-ru.php">О сервисе</a>
        </p>
        <p class="copyright">
            Flagmark <?= date('Y') ?>
        </p>
    </div>
</div>
</body>
</html>
