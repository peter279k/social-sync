<?php
/*
* This is about the Plurk posting feeed sample code
*/
    $key = parse_ini_file(__DIR__.'/../api-key.ini');
    define('NICKNAME', $key['user_name']);
    define('PASSWORD', $key['user_password']);
    define('USER_ID', $key['user_id']);

    $encodeLineBreak = '%0A';

    $message = urlencode('HTTP code testing from Plurk Bot.');
    $shareLink = '';
    $message = $message.$encodeLineBreak.$shareLink;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

    // get login token and try to login the Plurk website
    curl_setopt($ch, CURLOPT_URL, 'https://www.plurk.com/login');
    $response = curl_exec($ch);
    $posString = strpos($response, '<input type="hidden" name="login_token" value="') + 47;
    $token = substr($response, $posString, strpos($response, '"', $posString) - $posString);
    curl_setopt($ch, CURLOPT_URL, 'https://www.plurk.com/Users/login');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'nick_name='.NICKNAME.'&password='.PASSWORD.'&login_token='.$token);
    curl_exec($ch);

    // post the feed
    curl_setopt($ch, CURLOPT_URL, 'https://www.plurk.com/TimeLine/addPlurk');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'qualifier=says&content='.$message.'&lang=tr_ch&no_comments=0&uid='.USER_ID);
    curl_exec($ch);
    echo $httpCode = curl_getinfo($ch)['http_code'].PHP_EOL;

    curl_close($ch);
