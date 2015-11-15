<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__, '../.env');
$dotenv->load();

function isLoggedIn()
{
    return !empty($_SESSION['facebook_access_token']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Flagmark</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <!-- for Google -->
    <meta name="description" content="Take your flag" />
    <meta name="keywords" content="Facebook, Flag, Flagmark" />

    <!-- for Facebook -->
    <meta property="og:title" content="Flagmark" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="http://flagmark.cybercog.su/" />
    <meta property="og:description" content="" />

    <!-- for Twitter -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="Flagmark" />
    <meta name="twitter:description" content="Take your flag" />
    <meta name="twitter:image" content="" />

    <script>
        function saveFile(url) {
            // Get file name from url.
            var filename = url.substring(url.lastIndexOf("/") + 1).split("?")[0];
            var xhr = new XMLHttpRequest();
            xhr.responseType = 'blob';
            xhr.onload = function () {
                var a = document.createElement('a');
                a.href = window.URL.createObjectURL(xhr.response); // xhr.response is a blob
                a.download = filename; // Set the file name.
                a.style.display = 'none';
                document.body.appendChild(a);
                a.click();
                delete a;
            };
            xhr.open('GET', url);
            xhr.send();
        }
    </script>
    <style>
        body {
            font-family: Roboto, sans-serif;
        }
        .header {
            margin-top: 1em;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Flagmark</h1>
        <h2>Take your flag</h2>
    </div>

    <?php if (isLoggedIn()) : ?>

        <?php
        $iu = new \Flagmark\Services\ImageUpload();

        if (!empty($_FILES['avatar']['tmp_name'])) {
            $imageUrl = $iu->getUploadedPhoto($_FILES['avatar']['tmp_name']);
        } else {
            $imageUrl = $iu->getFacebookPhoto($_SESSION['user_id']);
        }
        ?>

    <p class="lead">
        Dear <strong><?= $_SESSION['user_name'] ?></strong> we've done this
        unique and special <strong>Flagmark</strong> just for you!
        Feel free to use it.
    </p>

    <div>
        <img src="<?= $imageUrl ?>">
    </div>
    <div>
        <a href="<?= $imageUrl ?>" onclick="saveFile('<?= $imageUrl ?>')">Download it!</a>
    </div>

    <?php else : ?>

        <p class="lead">Flagmark require use your Facebook avatar to proceed.</p>

    <?php
    $fb = new Facebook\Facebook([
        'app_id' => getenv('FACEBOOK_APP_ID'),
        'app_secret' => getenv('FACEBOOK_APP_SECRET'),
        'default_graph_version' => 'v2.5',
        //'default_access_token' => '{access-token}', // optional
    ]);



    $helper = $fb->getRedirectLoginHelper();
    $accessToken = $helper->getAccessToken();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl(getenv('FACEBOOK_LOGIN_CALLBACK_ENDPOINT'), $permissions);

    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    exit();
    ?>

    <?php endif; ?>
    <div class="footer">
        <p>
            Flagmark <?= date('Y') ?>
        </p>
    </div>
</div>
</body>
</html>