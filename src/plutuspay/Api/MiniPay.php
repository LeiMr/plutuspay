<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class MiniPay extends  Services {

    /**
     * 小程序支付接口
     *
     * @param $params array 支付参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'appId'=>$params['appId'],
            'openId'=>$params['openId'],
            'sn'=>$params['sn'],
            'outTradeId'=>$params['outTradeId'],
            'isMiniProgram'=>1,
            'tradeAmount'=>$params['tradeAmount'],
            'payTypeId'=>1003,
            'isSharing'=>true,
            'remark'=>isset($params['remark']) ? $params['remark'] : '',
            'notifyUrl'=>isset($params['notifyUrl']) ? $params['notifyUrl'] : $this->client->getNotifyUrl(),
        ];
        return $this->client->sendData('open/v2/jsPay',$data);
    }

}