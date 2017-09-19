<?php
/*
* The Plurk api is to post feed.
* And get token, help you logining the Plurk.
*/

namespace peter\social;

class Plurk implements SocialInterface {

    private $message = '';
    private $userId = '';
    private $userName = '';
    private $userPassword = '';
    private $curlResource = null;
    private $link = '';

    public function iniCurl() {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookie.txt');
        $this->setCurlResource($ch);
    }

    public function setCurlResource($ch) {

        $this->curlResource = $ch;
    }

    public function closeCurl() {

        curl_close($this->getCurlResource());
    }

    public function getCurlResource() {

        return $this->curlResource;
    }

    public function postFeed(PostFeed $feed) {

        $settings = $feed->getSettings();
        $this->message = urlencode($feed->getMessage());
        $this->link = $feed->getLink() === '' ? '' : PHP_EOL.$feed->getLink();
        $this->message .= $this->link;
        $this->userId = $settings['user_id'];
        $this->userName = $settings['user_name'];
        $this->userPassword = $settings['user_password'];
        $this->iniCurl();
        $curlResource = $this->doLogin();
        $result = $this->doPostFeed();
        $feed->setHttpStatusCode($result[1]);
        $feed->setResponseMessage($result[0]);
    }

    private function doLogin() {

        $ch = $this->getCurlResource();
        curl_setopt($ch, CURLOPT_URL, 'https://www.plurk.com/login');
        $response = curl_exec($ch);
        $posString = strpos($response, '<input type="hidden" name="login_token" value="') + 47;
        $token = substr($response, $posString, strpos($response, '"', $posString) - $posString);
        curl_setopt($ch, CURLOPT_URL, 'https://www.plurk.com/Users/login');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'nick_name='.$this->userName.'&password='.$this->userPassword.'&login_token='.$token);
        curl_exec($ch);
        $this->setCurlResource($ch);
    }

    private function doPostFeed() {

        $ch = $this->getCurlResource();
        curl_setopt($ch, CURLOPT_URL, 'https://www.plurk.com/TimeLine/addPlurk');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'qualifier=says&content='.$this->message.'&lang=tr_ch&no_comments=0&uid='.$this->userId);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch)['http_code'];

        $this->closeCurl();

        return [
            $result,
            $httpCode,
        ];
    }
}
