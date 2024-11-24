<?php
namespace App\Services;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\GenericProvider;

class MastodonService
{
    private $provider;

    public function __construct()
    {
        $this->provider = new GenericProvider([
            'clientId'                => config('services.mastodon.client_id'),
            'clientSecret'            => config('services.mastodon.client_secret'),
            'redirectUri'             => config('services.mastodon.redirect'),
            'urlAuthorize'            => config('services.mastodon.instance_uri') . '/oauth/authorize',
            'urlAccessToken'          => config('services.mastodon.instance_uri') . '/oauth/token',
            'urlResourceOwnerDetails' => config('services.mastodon.instance_uri') . '/api/v1/accounts/verify_credentials',
        ]);
    }

    public function getAuthorizationUrl()
    {
        return $this->provider->getAuthorizationUrl();
    }

    public function getAccessToken($code)
    {
        return $this->provider->getAccessToken('authorization_code', ['code' => $code]);
    }

    public function getResourceOwner($accessToken)
    {
        return $this->provider->getResourceOwner($accessToken);
    }
}