<?php
/*
* This is the PHP program will be the targeted when the facebook.php rediects this.
*/

require_once __DIR__.'/../vendor/autoload.php';
session_start();

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

if(isset($_GET['state'])) {
    $helper->getPersistentDataHandler()->set('state', $_GET['state']);
}

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if(!isset($accessToken)) {
    if($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "<p>Error: " . $helper->getError() . "</p>";
        echo "<p>Error Code: " . $helper->getErrorCode() . "</p>";
        echo "<p>Error Reason: " . $helper->getErrorReason() . "</p>";
        echo "<p>Error Description: " . $helper->getErrorDescription() . "</p>";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

// Logged in
echo '<h2>Access Token</h2>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($appId); // Replace {app-id} with your app id

// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();
if(!$accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
      $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
      echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
      exit;
    }
}

echo '<h2>Long-lived User Access Token</h2>';
echo '<strong>You have to add this user access token in api-key.ini</strong>';
echo '<strong>Then visit the link: https://your-domain.com/social-sync/examples/facebook_post.php to test the Facebook API posting feed correctly.</strong>';
var_dump($accessToken->getValue());

$_SESSION['fb_access_token'] = (string)$accessToken;
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
