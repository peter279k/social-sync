# social-sync
This is the simplest way to sync the feed for the multiple social websites.

# social website lists

- [Facebook](https://facebook.com)
- [Twitter](https://twitter.com)
- [Plurk](https://plurk.com)

# Scenairo

- using the e-mail client to send the mail to the [cloudmailin](https://www.cloudmailin.com) address.
- The web service is to receive the mail and process the contents.
- The web service will post the feed to the specified social websites after checking the mail content is successful.

# Request the Facebook and Twitter developer APP

- [Facebook](https://developers.facebook.com)
- [Twitter](https://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1/15314662#15314662)

# Usage

- Set the [cloudmailin](http://docs.cloudmailin.com/getting_started/) service.
- Set the ```receive.php``` to the receiving mail endpoint.
- Visit the ```facebook_user_token.php``` from web browser to get the short-lived user access token and add it in ```api-key.ini```.
- Refer this [link](https://developers.facebook.com/docs/facebook-login/access-tokens/expiration-and-extension/) to get the long-lived token.
- Remember that the Facebook user access token is valid for 60 days.After 60 days, you have to request the new access token from ```facebook_user_token.php```.
- In order to build the service easily, we use the Composer to manage the required packages.

- Firstly, clone the repo: ``` git clone https://github.com/peter279k/social-sync.git```.
- Then download the composer.phar: ```curl -sS https://getcomposer.org/installer | php```.
- Then install the required packages: ```php composer.phar install```.
- Create the ```api-key.ini``` in this project root path.

```
[Facebook]
app_id="facebook_id"
app_secret="facebook_secret"
user_access_token="facebook_user_token"
[Twitter]
api_key="api_key"
[Plurk]
user_name="user_name"
user_password="password"
user_id="user_id"
```

- Complete the service building. Have fun!

- P.S: The PHP program in ```examples``` folder just present the posting feed examples.

- The socail api lists references


> - [Twitter API reference](https://stackoverflow.com/questions/12916539/simplest-php-example-for-retrieving-user-timeline-with-twitter-api-version-1-1/15314662#15314662)
> - [Facebook API reference](https://developers.facebook.com/docs/php/FacebookResponse/5.0.0)
> - [Plurk Bot sample code](https://gist.github.com/pingyen/53380) 
