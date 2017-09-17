<?php
/*
* The Facebook api is to post feed.
* And get user access token
*/

namespace peter\social;

class Facebook implements SocailInterface {

    private $message = '';
    private $appId = '';
    private $appSecret = '';
    private $userAccessToken = '';
    private $curlResource = null;

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
        $this->message = $feed->getMessage();
        $this->userId = $settings['app_id'];
        $this->userName = $settings['app_secret'];
        $this->userPassword = $settings['user_access_token'];
        $this->iniCurl();
        $curlResource = $this->doLogin();
        $result = $this->doPostFeed();
        $feed->setHttpStatusCode($result[1]);
        $feed->setResponseMessage($result[0]);
    }
}
