<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class Query extends  Services {
    
    /**
     * 交易查询接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'sn'=>$params['sn'],
            'outTradeId'=>$params['outTradeId']
        ];
        return $this->client->sendData('open/v2/query',$data);
    }

}