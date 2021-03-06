<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flagmark</title>
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
    <meta property="og:description" content="" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Flagmark" />
    <meta name="twitter:description" content="" />
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
    <?php if (isLoggedIn()) : ?>

        <div class="clearfix">
            <?= renderCountryFlags() ?>
        </div>

        <?php
        $iu = new \Flagmark\Services\ImageUpload();
        if (isset($_GET['country_code'])) {
            $iu->setCountryCode($_GET['country_code']);
        } else {
            $iu->setCountryCode();
        }

        if (!empty($_FILES['avatar']['tmp_name'])) {
            $imageUrl = $iu->getUploadedPhoto($_FILES['avatar']['tmp_name']);
        } else {
            $imageUrl = $iu->getFacebookPhoto($_SESSION['user_id']);
            $_SESSION['image_url'] = $imageUrl;
        }
        ?>

        <p class="lead dear">
            Dear <strong><?= getUserName() ?></strong> we've done this
            unique and special <strong>Flagmark</strong> just for you!
        </p>

        <div>
            <img class="img-responsive" src="<?= $imageUrl ?>">
        </div>
        <div class="actions">
            <a href="<?= $imageUrl ?>" download="<?= $imageUrl ?>" class="btn btn-primary-outline" onclick="yaCounter<?= getenv('YANDEX_METRIKA_ID') ?>.reachGoal('download'); return true;">Download it!</a>
        </div>

    <?php else : ?>

        <p class="lead">Flagmark require your Facebook avatar to proceed.</p>

        <?php
        $fb = new Facebook\Facebook([
            'app_id' => getenv('FACEBOOK_APP_ID'),
            'app_secret' => getenv('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v2.5',
            //'default_access_token' => '{access-token}', // optional
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $accessToken = $helper->getAccessToken();
        // $permissions = ['email', 'user_likes']; // optional
        $permissions = [];
        $loginUrl = $helper->getLoginUrl(getenv('FACEBOOK_LOGIN_CALLBACK_ENDPOINT'), $permissions);
        $timestamp = time();
        ?>
        <a href="<?= $loginUrl ?>" onclick="yaCounter<?= getenv('YANDEX_METRIKA_ID') ?>.reachGoal('login'); return true;"><img src="assets/images/login-facebook.png" alt="Log in with Facebook!"></a>

    <?php endif; ?>
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