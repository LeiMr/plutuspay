<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class BcPay extends  Services {
    
    /**
     * 二维码刷卡交易接口
     *
     * @param $params array 支付参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'sn'=>$params['sn'],
            'outTradeId'=>$params['outTradeId'],
            'authCode'=>$params['authCode'],
            'tradeAmount'=>$params['tradeAmount'],
            'payTypeId'=>$params['payTypeId'],
            'isSharing'=>true,
            'subject' =>$params['subject'],
            'remark'=>isset($params['remark']) ? $params['remark'] : '',
            'goodsDetail'=>$params['goodsDetail']
        ];
        return $this->client->sendData('open/v2/pay',$data);
    }

}