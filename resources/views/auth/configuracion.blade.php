<?php
require_once 'vendor/autoload.php';

$googleClientId = getenv('GOOGLE_CLIENT_ID');
$googleClientSecret = getenv('GOOGLE_CLIENT_SECRET');
$redirectUri = 'http://project.mysocialhub.xyz/dashboard';


$client = new Google_Client();
$client->setClientId($clientId);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

if(isset($_GET['code'])){
    $token = $client->fetchAccessToeknWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email= $google_account_info->email;
    $name= $google_account_info->name;
    
}

?>