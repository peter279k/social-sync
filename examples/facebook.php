<?php
/*
* This is about the Facebook posting feeed sample code
*/

require_once __DIR__.'/../vendor/autoload.php';

$key = parse_ini_file(__DIR__.'/../api-key.ini');
$appId = $key['app_id'];
$appSecret = $key['app_secret'];
$userToken = $key['user_access_token'];
$fb = new \Facebook\Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email', 'publish_actions']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://peterli.website/social-sync/examples/fb_callback.php', $permissions);
echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
