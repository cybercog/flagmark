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

try {
    // Get the Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me', $_SESSION['facebook_access_token']);
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$me = $response->getGraphUser();
echo 'Logged in as ' . $me->getName();

exit();

if (!empty($_FILES["avatar"]["tmp_name"])) {
    $inputImage = $_FILES["avatar"]["tmp_name"];
} else {
    // :TODO: Here get image from facebook
    $inputImage = facebook_profile_image_tag("billclinton");
    var_dump($inputImage);
    die;
}

exit();

$iu = new \ImageUpload();
$iu->upload($inputImage);
$image = $iu->getImage();
echo $image;