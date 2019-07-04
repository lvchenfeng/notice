<?php

namespace rongwen\notice\Sender;

/**
 * Class XwSmsServer
 * @package rongwen\notice\Sender
 * @author gwdong
 * @date 2019/7/4
 */
class SmsSender
{
    //http rest地址
    public $url = null;
    public $account = null;
    public $password = null;
    public $message = null;

    public function __construct($url,$account,$password)
    {
        $this->url = $url;
        $this->account = $account;
        $this->password = $password;
    }

    /**
     * 返回Authorization
     * @return string
     */
    public function Authorization()
    {
        return base64_encode($this->account . ':' . md5($this->password));
    }

    public function send($batchName, $phone, $content){
        $arr = [
            "batchName" => $batchName,
            "items" => [["to" => $phone]],
            "content" => $content,
            "msgType" => "sms",
            "bizType" => "100"
        ];
        $data = json_encode($arr);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$curlopt_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post设置头
        //curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8080');//设置代理服务器
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Content-Length:' . strlen($data), 'Accept: application/json', 'Authorization:' . $this->Authorization()));

        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

}