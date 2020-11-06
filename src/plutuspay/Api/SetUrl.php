<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class SetUrl extends  Services {
    
    /**
     * 设置异步通知地址
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'url'=>$params['url']
        ];
        return $this->client->sendData('open/setUrl',$data);
    }

}