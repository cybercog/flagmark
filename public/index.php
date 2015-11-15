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

if (!empty($_FILES["avatar"]["tmp_name"])) {
    $iu->setUploadedPhoto($_FILES["avatar"]["tmp_name"]);
} else {
    $iu->setFacebookPhoto($_SESSION['user_id']);
}

$image = $iu->getImage();
echo $image;