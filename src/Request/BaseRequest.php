<?php

namespace Meunee\LaraFcm\Request;

use Google\Client as GClient;
use Google\Service\FirebaseCloudMessaging;

abstract class BaseRequest
{
    /**
     * @internal
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @internal
     *
     * @var array
     */
    protected $config;

    /**
     * BaseRequest constructor.
     */
    public function __construct()
    {
        $this->config = app('config')->get('fcm', []);
    }

    /**
     * Build the header for the request.
     *
     * @return array
     */
    protected function buildRequestHeader()
    {
        return [
            'Authorization' => 'Bearer ' . $this->configureClient(),
            'Content-Type' => 'application/json',
            'access_token_auth' => true,
        ];
    }

    /**
     * Build the body of the request.
     *
     * @return mixed
     */
    abstract protected function buildBody();

    /**
     * Return the request in array form.
     *
     * @return array
     */
    public function build()
    {
        return [
            'headers' => $this->buildRequestHeader(),
            'json' => $this->buildBody(),
        ];
    }

    public static function configureClient()
    {
        $path = config('fcm.fcm_json_path');

        $client = new GClient();
        try {
            $client->setAuthConfig($path);
            $client->addScope(FirebaseCloudMessaging::CLOUD_PLATFORM);

            $accessToken = self::generateToken($client);

            $client->setAccessToken($accessToken);

            $oauthToken = $accessToken["access_token"];

            return $oauthToken;
        } catch (Google_Exception $e) {
            return $e;
        }
    }

    private static function generateToken($client)
    {
        $client->fetchAccessTokenWithAssertion();
        $accessToken = $client->getAccessToken();

        return $accessToken;
    }
}