<?php
/*
* This PHP program is to post the feed via Facebook graph API.
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
    'default_access_token' => $userToken,
]);

$response = $fb->post('/me/feed', [
    'message' => 'Fooooo message is from PHP Graph SDKv5',
    $userToken,
]);

// more details about accessing the $response object
// https://developers.facebook.com/docs/php/FacebookResponse/5.0.0
var_dump($response);
