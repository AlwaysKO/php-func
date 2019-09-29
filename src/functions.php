<?php
/**
 * 2019-9-29
 */

namespace alwaysKo\phpFunc;

class Functions {
    /**
     * [dump2 打印函数]
     * @param  [type] $arr [description]
     * @return [type]      [description]
     */
    public static function dump2($arr) {
        echo '<pre>';
        var_dump($arr);
        exit;
    }

    /**
     * [request_get curl get请求]
     * @param  string  $url     [请求地址]
     * @param  integer $timeout [超时时间]
     * @param  integer $ssl     [是否跳过证书检查]
     * @param  string  $sslcert [证书地址]
     * @return [type]           [description]
     */
    public function request_get($url = '', $timeout = 1, $ssl = 0, $sslcert = '') {
        if (empty($url)) {
            return false;
        }

        $ch = curl_init(); //初始化curl

        if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSLCERT, $sslcert);
        } else {
            //跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        
        curl_setopt($ch, CURLOPT_URL, $url); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);

        return $data;
    }

    /**
     * [request_post curl post请求]
     * @param  string  $url     [请求地址]
     * @param  string  $param   [description]
     * @param  integer $timeout [超时时间]
     * @param  array   $header  [description]
     * @param  integer $ssl     [是否跳过证书检查]
     * @param  string  $sslcert [证书地址]
     * @return [type]           [description]
     */
    public function request_post($url = '', $param = '', $timeout = 1, $header = array(), $ssl = 0, $sslcert = '') {
        if (empty($url) || empty($param)) {
            return false;
        }

        $postUrl  = $url;
        $curlPost = $param;
        $ch       = curl_init(); //初始化curl

        if ($ssl) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
            curl_setopt($ch, CURLOPT_SSLCERT, $sslcert);
        } else {
            //跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }

        if (empty($header)) {
            curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        } else {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_URL, $postUrl); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);

        return $data;
    }
}
