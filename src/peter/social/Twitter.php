<?php
/*
* The Twitter api is to post feed.
* And get user access token
*/

namespace peter\social;

class Twitter implements SocailInterface {

    private $message = '';
    private $link = '';
    private $oauthToken = '';
    private $oauthTokenSecret = '';
    private $consumerKey = '';
    private $twitter = null;

    public function postFeed(PostFeed $feed) {

        $settings = $feed->getSettings();
        $this->link = $feed->getLink() === '' ? '' : PHP_EOL.$feed->getLink();
        $this->message = $feed->getMessage().$this->link;
        $this->oauthToken = $settings['oauth_access_token'];
        $this->oauthTokenSecret = $settings['oauth_access_token_secret'];
        $this->consumerSecret = $settings['consumer_secret'];
        $this->consumerKey = $settings['consumer_key'];
        $this->iniTwitter();
        $result = $this->doPostFeed();
        $feed->setHttpStatusCode($result[1]);
        $feed->setResponseMessage($result[0]);
    }

    private function iniTwitter() {

        $settings = [
            'oauth_access_token' => $this->oauthToken,
            'oauth_access_token_secret' => $this->oauthTokenSecret,
            'consumer_key' => $this->consumerKey,
            'consumer_secret' => $this->consumerSecret,
        ];
        $this->twitter = new \TwitterAPIExchange($settings);
    }

    private function doPostFeed() {

        // URL for REST request, see: https://dev.twitter.com/docs/api/1.1
        $url = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';

        // POST fields required by the URL above. See relevant docs as above
        $postfields = [
            'status' => $this->message,
        ];

        $buildOauth = $this->twitter->buildOauth($url, $requestMethod);
        $buildOauth->setPostfields($postfields);

        $result = $buildOauth->performRequest();
        $response = json_decode($buildOauth->performRequest(), true);
        $httpCode = isset($response['created_at']) ? '200':'403';

        return [
            $result,
            $httpCode,
        ];
    }
}
