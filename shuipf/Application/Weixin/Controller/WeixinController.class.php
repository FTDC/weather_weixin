<?php
// +----------------------------------------------------------------------
// | 微信自定义菜单
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\ShuipFCMS;

class WeixinController extends ShuipFCMS
{
    //菜单字符串处理
    function _deal_data($d)
    {
        $res ['name'] = str_replace('├──', '', $d ['title']);
        if (!empty ($d ['url'])) {
            $res ['type'] = 'view';
            $res ['url'] = $d ['url'];
        } else {
            $res ['type'] = 'click';
            $res ['key'] = $d ['title'];
        }
        return $res;
    }

    public function json_encode_cn($data)
    {
        $data = json_encode($data);
        return preg_replace("/\\\u([0-9a-f]{4})/ie", "iconv('UCS-2BE', 'UTF-8', pack('H*', '$1'));", $data);
    }

    //自定义菜单
    public function sendMenu()
    {
        //生成自定义菜单
        $appid = C('WX_APP_ID');
        $secret = C('WX_SECRET');

        //获取菜单列表
        $menu = M('custom_menu');
        $data = $menu->order('pid asc, sort asc')->select();

        foreach ($data as $k => &$d) {
            if (!empty($d['url'])) $d['url'] = $d['url'];
            if ($d ['pid'] == 0) {
                $tree ['button'] [$d ['id']] = $this->_deal_data($d);
            } else {
                $tree ['button'] [$d ['pid']] ['sub_button'] [] = $this->_deal_data($d);
            }
        }

        $tree2 = array();
        $tree2 ['button'] = array();
        foreach ($tree ['button'] as $k => $d) {
            $tree2 ['button'] [] = $d;
        }
        $tree = $this->json_encode_cn($tree2);

        $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $secret;
        $map ['token'] = C('WX_TOKEN');
        $ch1 = curl_init();
        $timeout = 5;
        curl_setopt($ch1, CURLOPT_URL, $url_get);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
        $accesstxt = curl_exec($ch1);
        curl_close($ch1);
        $access = json_decode($accesstxt, true);

        if (empty ($access ['access_token'])) {
            $this->error('获取access_token失败,请确认AppId和Secret配置是否正确,然后再重试。');
        }

        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $access ['access_token'];
        $header [] = "content-type: application/x-www-form-urlencoded; charset=UTF-8";
        file_put_contents('./log1.txt', $tree);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $tree);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);
        if ($res ['errcode'] == 0) {
            $this->success('发送菜单成功');
        } else {
            $this->success('发送菜单失败，错误的返回码是：' . $res ['errcode'] . ', 错误的提示是：' . $res ['errmsg']);
        }
    }

    /**
     *    获取Accesstoken
     * @pram $remote_server  string   提交地址
     * @pram $post_string    string   提交的参数
     */
    public function request_by_other($remote_server, $post_string)
    {
        $context = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded' .
                    '\r\n' . 'User-Agent : Jimmy\'s POST Example beta' .
                    '\r\n' . 'Content-length:' . strlen($post_string) + 8,
                'content' => 'mypost=' . $post_string)
        );
        $stream_context = stream_context_create($context);
        $data = file_get_contents($remote_server, true, $stream_context);
        return $data;
    }
}

?>