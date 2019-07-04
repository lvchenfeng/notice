<?php
/**
 * Created by PhpStorm.
 * Author: gwdong
 * Date: 2019/7/4
 * Time: 16:43
 */

namespace rongwen\notice;


use rongwen\notice\Sender\SmsSender;

class notice
{
    public static $sms = null;

    //获取发送器
    public static function getSender($type,array $config){

    }

    //获取短信发送器
    public static function sms(array $config){
        if(empty(self::$sms)){
            self::$sms = new SmsSender($config['url'],$config['account'],$config['password']);
        }
        return self::$sms;
    }


}