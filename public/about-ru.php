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
    <h1>О сервисе Flagmark (<a href="/about-en.php">on english</a>)</h1>
    <p class="lead">
        Этот микро-сервис был создан из-за большого количества просьб людей в социальных сетях
        наложить поверх их фотографий флаг страны в графическом редакторе.
    </p>
    <p class="lead">
        Есть хорошая поговорка:
    </p>
    <blockquote class="lead">
        <em>&laquo;Хочешь сделать что-то хорошо &mdash; сделай это сам!&raquo;</em>
    </blockquote>
    <p class="lead">
        P.S.:
        Несмотря на тот факт что мы сделали этот сервис, <strong>мы не поддерживаем идею размещения флагов стран на фотографиях в социальных сетях</strong>.<br>
        Но люди вправе выбирать то, что они хотят делать...<br>
        Мы надеемся что вы будете помогать окружающим поступками, а не словами.
    </p>
    <p class="lead">
        <strong>Пользуясь сервисом вы подтверждаете тот факт,
        что вы сами несёте ответственность за использование обработанной фотографии.</strong>
    </p>
    <p>
        <a href="about:blank" class="btn btn-primary-outline">&times; Уйти с сайта</a>
        <a href="/generate.php" class="btn btn-danger-outline">Создать изоображение</a>
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
