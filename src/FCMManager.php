<?php

namespace Meunee\LaraFcm;

use GuzzleHttp\Client;
use Illuminate\Support\Manager;

class FCMManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->app[ 'config' ][ 'fcm.driver' ];
    }

    protected function createHttpDriver()
    {
        $config = $this->app[ 'config' ]->get('fcm', []);

        return new Client(['timeout' => $config[ 'timeout' ]]);
    }
}