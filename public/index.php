<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__, '../.env');
$dotenv->load();

$fb = new Facebook\Facebook([
    'app_id' => getenv('FACEBOOK_APP_ID'),
    'app_secret' => getenv('FACEBOOK_APP_SECRET'),
    'default_graph_version' => 'v2.5',
    //'default_access_token' => '{access-token}', // optional
]);

if (empty($_SESSION['facebook_access_token'])) {
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl(getenv('FACEBOOK_LOGIN_CALLBACK_ENDPOINT'), $permissions);

    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    exit();
}

echo "Hello: {$_SESSION['user_name']}";

$iu = new \Flagmark\Services\ImageUpload();

if (!empty($_FILES['avatar']['tmp_name'])) {
    $imageUrl = $iu->getUploadedPhoto($_FILES['avatar']['tmp_name']);
} else {
    $imageUrl = $iu->getFacebookPhoto($_SESSION['user_id']);
}
?>

<script>
    function saveFile(url) {
        // Get file name from url.
        var filename = url.substring(url.lastIndexOf("/") + 1).split("?")[0];
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'blob';
        xhr.onload = function() {
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
</script>

<h1>Flagmark</h1>
<h2>Take your flag</h2>
<div>
    <img src="<?= $imageUrl ?>">
</div>
<div>
    <a href="<?= $imageUrl ?>" onclick="saveFile(<?= $imageUrl ?>)">Скачать!</a>
</div>
<div>Flagmark <?= date('Y') ?></div>