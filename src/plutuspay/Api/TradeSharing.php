<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class TradeSharing extends  Services {
    
    /**
     * 交易分账接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'sn'=>$params['sn'],
            'tradeId'=>$params['tradeId'],
            'receivers'=>$params['receivers'],
        ];
        return $this->client->sendData('open/v2/tradeSharing',$data);
    }

}