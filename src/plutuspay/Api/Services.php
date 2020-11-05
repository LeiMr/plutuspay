<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class Services{

    protected $client;

    public function __construct(PayConfig $config)
    {
        $this->client = new Client($config);
    }

}