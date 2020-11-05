<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class AccountSharingQuery extends  Services {
    
    /**
     * 账户分账查询接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'accountTradeId'=>$params['accountTradeId']
        ];
        return $this->client->sendData('open/v2/accountSharingQuery',$data);
    }

}