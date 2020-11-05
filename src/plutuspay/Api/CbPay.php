<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class CbPay extends  Services {
    
    /**
     * 请求订单二维码接口
     *
     * @param $params array 支付参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'sn'=>$params['sn'],
            'outTradeId'=>$params['outTradeId'],
            'tradeAmount'=>$params['tradeAmount'],
            'payTypeId'=>$params['payTypeId'],
            'isSharing'=>true,
            'subject' =>$params['subject'],
            'remark'=>isset($params['remark']) ? $params['remark'] : '',
            'notifyUrl'=>isset($params['notifyUrl']) ? $params['notifyUrl'] : $this->client->getNotifyUrl(),
        ];
        return $this->client->sendData('open/v2/preCreate',$data);
    }

}