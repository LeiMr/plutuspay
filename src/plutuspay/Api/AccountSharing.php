<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class AccountSharing extends  Services {
    
    /**
     * 账户分账接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'merchantId'=>$params['merchantId'],
            'tradeAmount'=>$params['tradeAmount'],
            'receivers'=>$params['receivers'],
            'commodityInfo'=>$params['commodityInfo'],
        ];
        return $this->client->sendData('open/v2/accountSharing',$data);
    }

}