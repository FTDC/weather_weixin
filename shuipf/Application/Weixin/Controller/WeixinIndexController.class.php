<?php
// +----------------------------------------------------------------------
// | 微信接口
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\ShuipFCMS;

class WeixinIndexController extends ShuipFCMS
{

    public function __construct()
    {
//        define("TOKEN", C('WX_TOKEN'));
        $this->valid();
    }

    //微信验证功能
    public function index()
    {
        // echo 11;die;
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)) {
            $resultStr = R('Weixin/response/responseMsg', array($postStr));
            file_put_contents('./aaa.txt', $resultStr);
            if (!empty($resultStr)) {
                echo $resultStr;
            } else {
                $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
                //extract post data
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($postObj);
                $datas = json_decode($json, true);

                $this->replay($datas);
                //$this->indexs();
            }
        } else {
            echo '';
            exit;
        }
    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if ($this->checkSignature()) {
            echo $echoStr;
        } else
            //$this->indexs();
            echo '';
    }

    public function indexs()
    {
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        //extract post data
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $MsgType = trim($postObj->MsgType);
        $time = time();

        // voice : 接收语音消息识别为文字匹配
        if ($MsgType == 'voice') {
            $data = array(
                'content' => $keyword,
                'openid' => $fromUsername,
                'crdate' => time(),
            );
            $res = M('voice_msg')->add($data);
            if ($res) {
                $keyword = "OK";
            }
            die;
        }

        //file_put_contents('./xj/weixin/log1.txt', $fromUsername);
        $textTpl = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Content><![CDATA[%s]]></Content>
			<FuncFlag>0</FuncFlag>
			</xml>";
        if (!empty($keyword)) {
            $msgType = "text";
            $contentStr = "湖北气象服务-天气预报, 正在开发中!";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            //file_put_contents('./shuipf/Application/Weixin/Controller/res.txt', $resultStr);
            echo $resultStr;
        } else {
            $contentStr = "Input something...";
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

//         $token = C('WX_TOKEN');
        $token = "hubei_ftdc";
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            file_put_contents('./aaa.txt', $tmpStr . '----' . $signature);
//            file_put_contents('./shuipf/Application/Weixin/Controller/aaa.txt', $tmpStr.'----'.$signature);
            return true;
        } else {
            return false;
        }
    }

    public function replay($dataArr, $keywordArr = array())
    {
        $map ['id'] = $keywordArr ['aim_id'];
        $param ['token'] = get_token();
        $param ['openid'] = get_openid();

        if ($keywordArr ['extra_text'] == 'custom_reply_mult') {
            // 多图文回复
            $mult = M('custom_reply_mult')->where($map)->find();
            $map_news ['id'] = array(
                'in',
                $mult ['mult_ids']
            );

            $list = M('custom_reply_news')->where($map_news)->select();

            foreach ($list as $k => $info) {
                if ($k > 8)
                    continue;

                $articles [] = array(
                    'Title' => $info ['title'],
                    'Description' => $info ['intro'],
                    'PicUrl' => get_cover_url($info ['cover']),
                    'Url' => $this->_getNewsUrl($info, $param)
                );
            }
            $res = $this->replyNews($articles);
        } elseif ($keywordArr ['extra_text'] == 'custom_reply_news') {
            // 单条图文回复
            $info = M('custom_reply_news')->where($map)->find();

            // 组装微信需要的图文数据，格式是固定的
            $articles [0] = array(
                'Title' => $info ['title'],
                'Description' => $info ['intro'],
                'PicUrl' => get_cover_url($info ['cover']),
                'Url' => $this->_getNewsUrl($info, $param)
            );
            $res = $this->replyNews($articles);
        } else {
            // 增加积分
            add_credit('custom_reply', 300);

            // 文本回复
            $info = M('custom_reply_text')->where($map)->find();
            $contetn = replace_url(htmlspecialchars_decode($info ['content']));
            $this->replyText($contetn);
        }
    }

    function _getNewsUrl($info, $param)
    {
        if (!empty ($info ['jump_url'])) {
            $url = replace_url($info ['jump_url']);
        } else {
            $param ['id'] = $info ['id'];
            $url = addons_url('CustomReply://CustomReply/detail', $param);
        }
        return $url;
    }

    // 上报地理位置事件 感谢网友【blue7wings】和【strivi】提供的方案
    public function location($dataArr)
    {
        $latitude = $dataArr ['Location_X'];
        $longitude = $dataArr ['Location_Y'];
        $pos = file_get_contents('http://lbs.juhe.cn/api/getaddressbylngb?lngx=' . $latitude . '&lngy=' . $longitude);
        $pos_ar = json_decode($pos, true);
        $this->replyText(htmlspecialchars_decode($pos_ar ['row'] ['result'] ['formatted_address']));
        return true;
    }

}