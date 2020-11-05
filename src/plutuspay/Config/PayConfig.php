<?php


namespace Plutuspay\Config;

use InvalidArgumentException;

class PayConfig
{

    private $devId = '';
    private $keyStr = '';
    private $requestUrl = 'https://api.plutuspay.com/';
    private $iv = '00000000000000000000000000000000';
    private $privateKey = '';
    private $publicKey = '';
    private $notifyUrl = '';
    private $log;

    public function __construct($config)
    {
        $this->devId = isset($config['devId']) ? $config['devId'] : '';
        $this->keyStr = isset($config['keyStr']) ? $config['keyStr'] : '';
        $this->privateKey = isset($config['privateKey']) ? $config['privateKey'] : '';
        $this->publicKey = isset($config['publicKey']) ? $config['publicKey'] : '';
        $this->notifyUrl = isset($config['notifyUrl']) ? $config['notifyUrl'] : '';
    }

    public function getDevId()
    {
        return $this->devId;
    }


    public function getKeyStr()
    {
        return $this->keyStr;
    }

    public function getRequestUrl()
    {
        return $this->requestUrl;
    }

    public function setRequestUrl($requestUrl)
    {
        $this->requestUrl = $requestUrl;
    }

    public function getIv()
    {
        return $this->iv;
    }

    public function setIv($iv)
    {
        $this->iv = $iv;
    }
    public function getPublicKey()
    {
        return $this->publicKey;
    }
    public function getPrivateKey()
    {
        return $this->privateKey;
    }
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function getLog()
    {
        return $this->log;
    }

    public function setLog($log)
    {
        if (!method_exists($log, "info")) {
            throw new InvalidArgumentException("logger need have method 'info(\$message)'");
        }
        if (!method_exists($log, "error")) {
            throw new InvalidArgumentException("logger need have method 'error(\$message)'");
        }
        $this->log = $log;
    }

}
