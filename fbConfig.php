<?php
if(!session_id())
{
    session_start();
}

// Include the autoloader provided in the SDK
require_once __DIR__ . '/Facebook/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuration and setup Facebook SDK
 */
$appId         = '295360117657631'; //Facebook App ID
$appSecret     = '438f43dc1f3cf7fb2570079407f92895'; //Facebook App Secret
$redirectURL   = 'http://localhost/facebook-php-sdk/'; //Callback URL
$fbPermissions = array('email');  //Optional permissions

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.2',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
        $accessToken = $_SESSION['facebook_access_token'];
    }
    else
    {
          $accessToken = $helper->getAccessToken();
    }
} catch(FacebookResponseException $e) 
{
     echo 'Graph returned an error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) 
{
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
}

?>