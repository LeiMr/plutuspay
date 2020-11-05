<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class SharingQuery extends  Services {
    
    /**
     * 交易分账查询接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'sn'=>$params['sn'],
            'tradeId'=>$params['tradeId']
        ];
        return $this->client->sendData('open/v2/sharingQuery',$data);
    }

}