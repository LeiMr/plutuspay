<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class Refund extends  Services {
    
    /**
     * 交易退款接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'sn'=>$params['sn'],
            'outTradeId'=>$params['outTradeId'],
            'outRefundId'=>$params['outRefundId'],
            'refundAmount'=>$params['refundAmount']
        ];
        return $this->client->sendData('open/v2/refund',$data);
    }

}