<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class Notify extends  Services {
    
    /**
     * 回调通知数据解密接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {

        return $this->client->verifyData($params);
    }

}