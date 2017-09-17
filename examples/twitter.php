<?php
/*
* The program is to post the Twitter feed via Twitter API.
*/

require_once __DIR__.'/../vendor/autoload.php';

$apiKey = parse_ini_file(__DIR__.'/../api-key.ini');
$oauthToken = $apiKey['oauth_access_token'];
$oauthTokenSecret = $apiKey['oauth_access_token_secret'];
$consumerSecret = $apiKey['consumer_secret'];
$consumerKey = $apiKey['consumer_key'];
$userName = $apiKey['user_name_block'];

// Set access tokens here - see: https://dev.twitter.com/apps
$settings = [
    'oauth_access_token' => $oauthToken,
    'oauth_access_token_secret' => $oauthTokenSecret,
    'consumer_key' => $consumerKey,
    'consumer_secret' => $consumerSecret
];

$message = "Ha!the someone's birtyday gift";
$message .= PHP_EOL.'https://imgur.com/gallery/y4za6';

// URL for REST request, see: https://dev.twitter.com/docs/api/1.1
$url = 'https://api.twitter.com/1.1/statuses/update.json';
$requestMethod = 'POST';

// POST fields required by the URL above. See relevant docs as above
$postfields = [
    'status' => $message,
];

// Perform the request and echo the response
$twitter = new TwitterAPIExchange($settings);
$buildOauth = $twitter->buildOauth($url, $requestMethod);
$buildOauth->setPostfields($postfields);

$result = json_decode($buildOauth->performRequest(), true);

echo $createdTime = $result['created_at'];
echo PHP_EOL;
