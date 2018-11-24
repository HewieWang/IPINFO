<?php 

require 'vendor/autoload.php';

use itbdw\Ip\IpLocation;

$qqwry_filepath = __DIR__.'/vendor/itbdw/ip-database/src/qqwry.dat';

function getip(){
        $unknown = 'unknown'; 
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){ 
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) { 
            $ip = $_SERVER['REMOTE_ADDR']; 
        } 
        /**
         * 处理多层代理的情况
         * 或者使用正则方式：$ip = preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : $unknown;
         */
        if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip)); 
        return $ip; 
}

$ip=getip();

echo json_encode(IpLocation::getLocation($ip, $qqwry_filepath), JSON_UNESCAPED_UNICODE);

 ?>