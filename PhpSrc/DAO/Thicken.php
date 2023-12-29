<?php

class Thicken
{
    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function encryptId($id)
    {
        // 使用 base64_encode 进行加密
        $encryptedId = base64_encode($id);
        return $encryptedId."+NA+=".$encryptedId."=MTA+NQ==";
    }

    public function decryptId($encryptedId) {
        // 使用 base64_decode 进行解密
        $result=$this->removePrefixAndSuffix($encryptedId,10,9);
        $decryptedId = base64_decode($result);
        return $decryptedId;
    }
    function removePrefixAndSuffix($inputString, $prefixLength, $suffixLength) {
        // 检查输入字符串的长度是否足够
        if (strlen($inputString) < $prefixLength + $suffixLength) {
            return false; // 或者根据实际需求进行处理，比如返回原字符串
        }
        // 使用 substr 去掉前面和后面的字符
        $resultString = substr($inputString, $prefixLength, strlen($inputString) - $prefixLength - $suffixLength);
        return $resultString;
    }

}
