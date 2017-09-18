<?php
/*
* The Facebook api is to post feed.
* And get user access token
*/

namespace peter\social;

class Facebook implements SocailInterface {

    private $message = '';
    private $link = '';
    private $appId = '';
    private $appSecret = '';
    private $userAccessToken = '';
    private $postField = [];
    private $fb = null;

    public function postFeed(PostFeed $feed) {

        $settings = $feed->getSettings();
        $this->message = $feed->getMessage();
        $this->link = $feed->getLink();
        $this->appId = $settings['app_id'];
        $this->appSecret = $settings['app_secret'];
        $this->userAccessToken = $settings['user_access_token'];
        $this->iniFacebook();
        $result = $this->doPostFeed();
        $feed->setHttpStatusCode($result[1]);
        $feed->setResponseMessage($result[0]);
    }

    private function iniFacebook() {

        $fb = new \Facebook\Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v2.10',
            'default_access_token' => $userToken,
        ]);
        $this->fb = $fb;
    }

    private function doPostFeed() {

        $this->postField['message'] = $this->message;
        $this->postField[] = $this->userAccessToken;
        if($this->link !== '') {
            $this->postField['link'] = $this->link;
        }

        $response = $this->fb->post('/me/feed', $this->postField);

        return [
            $response->getBody(),
            $response->getHttpStatusCode(),
        ];
    }
}
