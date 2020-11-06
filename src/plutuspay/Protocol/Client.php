<?php

namespace Plutuspay\Protocol;

use Exception;
use Plutuspay\Config\PayConfig;

class Client
{

    private $devId = '';
    private $keyStr = '';
    private $requestUrl = '';
    private $iv = '';
    private $privateKey = '';
    private $publicKey = '';
    private $notifyUrl = '';
    private $log;


    public function __construct(PayConfig $config)
    {
        $this->devId = $config->getDevId();
        $this->keyStr = $config->getKeyStr();
        $this->requestUrl = $config->getRequestUrl();
        $this->log = $config->getLog();
        $this->iv = $config->getIv();
        $this->privateKey = $config->getPrivateKey();
        $this->publicKey = $config->getPublicKey();
        $this->notifyUrl = $config->getNotifyUrl();
    }

    public function sendData($method, $params)
    {
        $url = $this->requestUrl . $method;
        $params = json_encode($params);
        $content = $this->aes128cbcOpensslEncrypt($params, $this->iv, $this->keyStr);
        $datas = [
            'devId' => $this->devId,
            'content' => $content,
            'signature' => $this->signData($this->privateKey, $content)
        ];
        $result = json_decode($this->postRequest($url, $datas), true);
        if (is_null($result) && !isset($result['code'])) {
            throw new Exception("Interface request failed", 400);
        }
        if (isset($result['signature'])) {
            if (!$this->verifySign($this->publicKey, $result['content'], $result['signature'])) {
                throw new Exception("Signature error", 10032);
            }
        }
        if (isset($result['content'])) {
            $response = $this->aes128cbcOpensslDecrypt($result['content'], $this->keyStr, $this->iv);
            $responseData = json_decode($response, true);
            if (!$responseData) {
                throw new Exception("Unable to parse data", 10033);
            }
        }
        $result['data'] = isset($responseData) ? $responseData : [];
        return $result;
    }

    public function aes128cbcOpensslEncrypt($string, $iv, $key)
    {
        return openssl_encrypt($string, 'AES-128-CBC', hex2bin($key), 0, hex2bin($iv));
    }

    public function aes128cbcOpensslDecrypt($string, $key, $iv)
    {

        return openssl_decrypt($string, 'AES-128-CBC', hex2bin($key), 0, hex2bin($iv));
    }

    public function signData($privateKey, $data)
    {
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($privateKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        $binary_signature = "";
        $algo = "SHA256";
        openssl_sign(base64_decode($data), $binary_signature, $privateKey, $algo);
        return base64_encode($binary_signature);
    }

    public function verifySign($publicKey, $content, $sign)
    {
        $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
            wordwrap($publicKey, 64, "\n", true) .
            "\n-----END PUBLIC KEY-----";
        return (bool)openssl_verify(base64_decode($content), base64_decode($sign), $publicKey, 'SHA256');
    }

    private function postRequest($url, $params)
    {
        $params_string = json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    public function getNotifyUrl(){
        return $this->notifyUrl;
    }

    public function verifyData($result){

        if (isset($result['signature']) && isset($result['content'])) {
            if (!$this->verifySign($this->publicKey, $result['content'], $result['signature'])) {
                throw new Exception("Signature error", 10032);
            }
            $response = $this->aes128cbcOpensslDecrypt($result['content'], $this->keyStr, $this->iv);
            $responseData = json_decode($response, true);
            if (!$responseData) {
                throw new Exception("Unable to parse data", 10033);
            }
            $result['data'] = isset($responseData) ? $responseData : [];
            return $result;
        }
        return false;
    }
}
