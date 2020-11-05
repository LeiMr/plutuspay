<?php

namespace Plutuspay\Api;

use Plutuspay\Config\PayConfig;
use Plutuspay\Protocol\Client;

class AccountQuery extends  Services {
    
    /**
     * 余额查询接口
     *
     * @param $params array 参数
     * @return mixed
     */
    public function index($params)
    {
        $data = [
            'merchantId'=>$params['merchantId']
        ];
        return $this->client->sendData('open/v2/accountQuery',$data);
    }

}