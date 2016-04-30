<?php
// +----------------------------------------------------------------------
// | 微信回复配置
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 All rights reserved.
// +----------------------------------------------------------------------
// | Author: 赵杰
// +----------------------------------------------------------------------

namespace Weixin\Controller;

use Common\Controller\ShuipFCMS;

class ResponseController extends ShuipFCMS
{
    //文字回复Xml
    public $textXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";

    //图文回复
    public $imgXml = "<xml>
					 <ToUserName><![CDATA[%s]]></ToUserName>
					 <FromUserName><![CDATA[%s]]></FromUserName>
					 <CreateTime>%s</CreateTime>
					 <MsgType><![CDATA[%s]]></MsgType>
					 <ArticleCount>1</ArticleCount>
					 <Articles>
					 <item>
					 <Title><![CDATA[%s]]></Title> 
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>
					 </Articles>
					 </xml>";
    //图文回复
    public $imgXml_all = "<xml>
					 <ToUserName><![CDATA[%s]]></ToUserName>
					 <FromUserName><![CDATA[%s]]></FromUserName>
					 <CreateTime>%s</CreateTime>
					 <MsgType><![CDATA[%s]]></MsgType>
					 <ArticleCount>1</ArticleCount>
					 <Articles>
					 <item>
					 <Title><![CDATA[%s]]></Title> 
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>
					 <item>
					 <Title><![CDATA[%s]]></Title> 
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>
					 <item>
					 <Title><![CDATA[%s]]></Title> 
					 <Description><![CDATA[%s]]></Description>
					 <PicUrl><![CDATA[%s]]></PicUrl>
					 <Url><![CDATA[%s]]></Url>
					 </item>
					 </Articles>
					 <FuncFlag>1</FuncFlag>
					 </xml>";
    public $voice_xml = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Voice>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>
                    </xml>";


    public $music_xml = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Music>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <MusicUrl><![CDATA[%s]]></MusicUrl>
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    </Music>
                    </xml>";


    // 自定义回复
    public function responseMsg($postStr)
    {
        if (!empty ($postStr)) {
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $msgType = $postObj->MsgType;
            $EventKey = $postObj->EventKey;
            $Event = $postObj->Event;
            $content = $postObj->Content;
            $time = time();
            define('THIS_TOKEN', $toUsername);

            $json = json_encode($postObj);
            $datas = json_decode($json, true);

            //关注自动回复开始
            if ($Event == "subscribe") {
                $msgType = "text";
                $time = time();
                $contentStr = "感谢您关注湖北气象公众微信！";
                $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                return $resultStr;
                die;
                //return $this->getConcern($toUsername, $fromUsername, $msgType, $Event);die;
            }
            if ($Event == "unsubscribe") {

            }
            if ($Event == "CLICK") {
                if ($EventKey == "全省预报") {
                    //纯文本消息
                    $tmp = M('province_weather');
                    $info = $tmp->order('addtime desc')->find();
                    $contents = str_replace("@", "\n", $info['content']);
                    $info["content"] = $contents;
                    return $this->getMessage($info, $content, $toUsername, $fromUsername, $msgType, $Event);
                    die;

                } else if ($EventKey == "灾害预警") {
                    //单图文消息
                    $tmp = M('warning_weather');
                    $where = time() . " < (deadtime * 60 * 60) + addtime";
                    //$where = "";
                    $list = $tmp->where($where)->order('addtime desc')->select();
                    //file_put_contents('./shuipf/Application/Weixin/Controller/list.txt', json_encode($list), FILE_APPEND);
                    //$list = '';
                    $signImg = C('WEATHER_SIGN_IMG');
                    if (!empty($list)) {
                        $time = time();
                        $count = count($list);
                        $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/statics/images/test.jpg";
//                    $PicUrl = "";
                        $msgType = "news";
                        $info = $list[0];

                        $Url = U('Weixin/Content/detail', array('id' => $info['id'], 'model' => 'warning_weather'));
                        //if(isset($signImg[$info['disastertype']]))
                        //$PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/statics/weathericon/".$signImg[$info['disastertype']];
                        $contents[0] = array(
                            "Title" => '气象预警信息',//$info['title'],
                            "Description" => '',
                            "PicUrl" => $PicUrl,
                            "Url" => $Url
                        );

                        foreach ($list as $key => $value) {

                            $Url = U('Weixin/Content/detail', array('id' => $value['id'], 'model' => 'warning_weather'));
                            $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/statics/images/test.jpg";
                            if (isset($signImg[$info['disastertype']]))
                                $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/statics/weathericon/" . $signImg[$value['disastertype']];

                            $contents[] = array(
                                "Title" => $value['disastertype'] . '预警信号',
                                "Description" => '',
                                "PicUrl" => $PicUrl,
                                "Url" => $Url
                            );
                        }
                        return $this->transmitNews($postObj, $contents);
                    } else {
                        $msgType = "text";
                        $time = time();
                        $contentStr = "当前无预警！";
                        $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                        return $resultStr;
                    }
                    exit;
                } else if ($EventKey == "地质灾害预警") {
                    //单图文消息
                    $tmp = M('geological');
                    $where = time() - 86400 . "  <  addtime";
                    //$where = "";
                    $list = $tmp->where($where)->order('addtime desc')->select();

                    if (!empty($list)) {
                        $resultStr = '';
                        foreach ($list as $key => $info) {

                            //if ($time >= $info['addtime']) {
                            $info['content'] = $info['content'];
                            $contents = str_replace("@", "\n", $info['content']);
                            $msgType = "news";
                            $time = time();
                            //$title = $info['disastertype'];
                            $title = '地质灾害预警 发布时间:' . $info['title'];
                            $Description = $info['content'];

                            $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/statics/images/test.jpg";
                            if (!empty($info['img']))
                                $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/weatherdata" . $info['img'];
                            $Url = U('Weixin/Content/detail', array('id' => $info['id'], 'model' => 'geological'));
                            $resultStr .= sprintf($this->imgXml, $fromUsername, $toUsername, $time, $msgType, $title, $Description, $PicUrl, $Url);
                        }
                        //file_put_contents('./shuipf/Application/Weixin/Controller/gg.txt', $resultStr, FILE_APPEND);
                        return $resultStr;
                    } else {
                        $msgType = "text";
                        $time = time();
                        $contentStr = "暂无！";
                        $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);

                        return $resultStr;
                    }
                    exit;
                } else if ($EventKey == "空气质量") {
                    //多图文消息
                    $tmp = M('aqi_weather');
                    $info = $tmp->order('addtime desc')->find();
                    $content = unserialize($info['content']);
                    $time = time();
                    $count = count($info['content']);
                    $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . "/weixin/statics/images/test.jpg";
//                    $PicUrl = "";
                    $msgType = "news";

                    $Url = U('Weixin/Content/detail', array('id' => $info['id'], 'model' => 'aqi_weather'));

                    $contents[0] = array(
                        "Title" => $info['title'],//$info['title'],
                        "Description" => '',
                        "PicUrl" => $PicUrl,
                        "Url" => $Url
                    );

                    foreach ($content as $key => $value) {
                        $contents[] = array(
                            "Title" => $value,//$info['title'],
                            "Description" => '',
                            "PicUrl" => '',
                            "Url" => $Url
                        );
                    }
                    return $this->transmitNews($postObj, $contents);
                    die;
                } else if ($EventKey == "主播爆天气") {
                    $time = time();
                    $msgType = "music";
                    $Obj = M('weather_voice');
                    $where = array(//  'file_type' => "1",
                    );

                    $info = $Obj->where($where)->order('add_time desc')->find();
                    if ($info['media_id']) {

                        $MediaId = $info['media_id'];
                        $filepath = C('WEB_DOMAIN') . '/' . $info['filepath_local'];
                        $resultStr = sprintf($this->music_xml, $fromUsername, $toUsername, $time, $msgType, $info['name'], '点击播放天气预报', $filepath, $filepath, $MediaId);
                    } else {
                        $msgType = "text";
                        $time = time();
                        $contentStr = "当前暂无语音爆天气信息！";
                        $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        return $resultStr;
                        die;
                    }
//                 	$resultStr = sprintf($this->voice_xml, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                    return $resultStr;
                    die;
                } else {
					
                    $tmp = M('keyword');
                    $where = "keyword = '{$EventKey}'";
                    $info = $tmp->where("{$where}")->find();
					
                    // $info = $tmp->where("token='" . THIS_TOK . "' {$where}")->find();
                    if ($info) {
                        //return $this->getMenuInfo($info, $toUsername, $fromUsername, $msgType, $Event);die;
                        $content = $EventKey;
                        return $this->getMessage($info, $content, $toUsername, $fromUsername, $msgType, $Event);
                        die;
                    }
                }
            }
            //关注自动回复结束
            // 语音留言
            // voice : 接收语音消息识别为文字匹配
            if ($datas['MsgType'] == 'voice') {

                //file_put_contents('./shuipf/Application/Weixin/Controller/voice.txt', json_encode($datas), FILE_APPEND);

                $data = array(
                    'content' => $datas['Recognition'],
                    'openid' => $datas['FromUserName'],
                    'media_id' => $datas ['MediaId'],
                    'crdate' => time(),
                );
                $res = M('voice_msg')->add($data);

                $content = "留言成功";
                $info['content'] = "留言成功";
                return $this->getMessage($info, $content, $toUsername, $fromUsername, $msgType, $Event);
                die;
            }
			
            //文本回复
            if ($content) {
                $city_info = M('city_weather')->where("`cityname`='{$content}'")->order('addtime desc')->find();
                if (empty($city_info)) {
                    $tmp = M('keyword');
                    $where = "keyword like '%{$content}%'";
                    $info = $tmp->where("{$where}")->select();
                } else {
                    $contents = $content . '三天天气预报:@' . $city_info['content'];
                    $city_info['content'] = str_replace("@", "\n", $contents);
                    $info = $city_info;
                }

                if ($info) {
                    return $this->getMessage($info, $content, $toUsername, $fromUsername, $msgType, $Event);
                }
            }
        } else {
            return "";
        }
    }

    //文本回复
    public function getMenuInfo($info, $toUsername, $fromUsername, $msgType, $Event)
    {
        $where['id'] = array('eq', $info['aim_id']);
        $table = substr($info['addon'], 4);
        $tmp = M($table);
        $content = $tmp->where($where)->find();
       // file_put_contents('./shuipf/Application/Weixin/Controller/data1.txt', var_export($content, true), FILE_APPEND);
        if ($content) {
            if ($info['addon'] == "custom_reply_news") {
                $msgType = "news";
                $time = time();
                $title = $content['title'];
                $Description = $content['intro'];
                $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . $content['cover'];
                $Url = $content['jump_url'];
                $resultStr = sprintf($this->imgXml, $fromUsername, $toUsername, $time, $msgType, $title, $Description, $PicUrl, $Url);
                return $resultStr;
                exit;
            }
        }
    }

    //获取关注时回复的数据
    public function getConcern($toUsername, $fromUsername, $msgType, $Event)
    {
        //推送到微信的XML数据格式
        $tmp = M('member_public');
        $content = $tmp->find();
        $tmps = json_decode($content['addon_config'], true);
        $msgType = "text";
        if ($tmps['Wecome']['url']) {
            $url = $tmps['Wecome']['url'];
        } else {
            $url = "http://" . $_SERVER['HTTP_HOST'];
        }
        $contentStr = "<a href='{$url}' >" . $tmps['Wecome']['description'] . "</a>";
        $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        return $resultStr;
    }

    //文本回复
    public function getMessage($info, $content, $toUsername, $fromUsername, $msgType, $Event)
    {
        foreach ($info as $key => $value) {
            switch ($value['keyword_type']) {
                case '0':
                    $where['keyword'] = array('like', "{$content}");
                    break;
                case '1':
                    $where['keyword'] = array('like', "%{$content}");
                    break;
                case '2':
                    $where['keyword'] = array('like', "{$content}%");
                    break;
                case '3':
                    $where['keyword'] = array('like', "%{$content}%");
                    break;
                default :
                    $where['keyword'] = array('like', "{$content}");
            }

            $where['id'] = array('eq', $value['aim_id']);
            $table = substr($info['addon'], 4);
            $tmp = M($table);
            $content = $tmp->where($where)->find();
			//file_put_contents('./shuipf/Application/Weixin/Controller/ssf.txt', $tmp->getLastSql(), FILE_APPEND);
            if ($content) {
                if ($info['addon'] == "ftdc_custom_reply_text") {
                    $msgType = "text";
                    $time = time();
                    $contentStr = $content['content'];
                    $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					file_put_contents('./shuipf/Application/Weixin/Controller/ssf.txt', $resultStr, FILE_APPEND);
                    return $resultStr;
                    exit;
                }
                if ($info['addon'] == "ftdc_custom_reply_news") {
                    $msgType = "news";
                    $time = time();
                    $title = $content['title'];
                    $Description = $content['intro'];
                    $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . $content['cover'];
                    $Url = $content['jump_url'];
                    $resultStr = sprintf($this->imgXml, $fromUsername, $toUsername, $time, $msgType, $title, $Description, $PicUrl, $Url);
                    return $resultStr;
                    exit;
                }
                if ($info['addon'] == "ftdc_custom_reply_mult") {
                    return $this->getMoreMsg($content['mult_ids'], $toUsername, $fromUsername, $msgType, $Event);
                    exit;
                }
            } else {
                $msgType = "text";
                $time = time();
                $contentStr = $info['content'];
                $resultStr = sprintf($this->textXml, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                return $resultStr;
                exit;
            }
        }
    }

    protected function getMoreMsg($ids, $toUsername, $fromUsername, $msgType, $Event)
    {
        $where['id'] = array('in', $ids);
        $content = D('custom_reply_news')->where($where)->select();
        $count = count($content);
        $time = time();
        $msgType = "news";
        $resultStr = "<xml>
                <ToUserName><![CDATA[{$fromUsername}]]></ToUserName>
                <FromUserName><![CDATA[{$toUsername}]]></FromUserName>
                <CreateTime>{$time}</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>{$count}</ArticleCount>
                <Articles>";
        foreach ($content as $key => $value) {
            $PicUrl = "http://" . $_SERVER['HTTP_HOST'] . $value['cover'];
            $resultStr .= "<item>
            <Title><![CDATA[{$value['title']}]]></Title>
            <Description><![CDATA[{$value['intro']}]]></Description>
            <PicUrl><![CDATA[{$PicUrl}]]></PicUrl>
            <Url><![CDATA[{$value['jump_url']}]]></Url>
            </item>";
        }
        $resultStr .= "</Articles></xml>";

        return $resultStr;
    }


    public function transmitNews($object, $newsArray)
    {
        if (!is_array($newsArray)) {
            return;
        }

        $itemTpl = "<item>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <PicUrl><![CDATA[%s]]></PicUrl>
                    <Url><![CDATA[%s]]></Url>
                </item>";

        $item_str = "";
        foreach ($newsArray as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>$item_str</Articles>
                    </xml>";

        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        // file_put_contents('./shuipf/Application/Weixin/Controller/aqi.txt', var_export($result, true), FILE_APPEND);

        return $result;
    }

    /**
     * 上传语音素材到微信
     */
    public function uploadSource($data, $type)
    {
        //生成自定义菜单
        $appid = C('WX_APP_ID');
        $secret = C('WX_SECRET');
        $access_token = session('access_token');
        if (empty($access_token)) {
            $access_token = $this->getAccesstoken($appid, $secret);
            session('access_token', $access_token, 7200);
        }

        //S('access_token',$access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=" . $access_token . "&type=" . $type;
        file_put_contents('./source.txt', var_export($url, true) . "\n", FILE_APPEND);
        file_put_contents('./source.txt', var_export($data, true) . "\n", FILE_APPEND);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $json = curl_exec($ch);
        curl_close($ch);

        //$json = https_request($url,$data);
        $result = json_decode($json, true);
        file_put_contents('./source.txt', var_export($json, true), FILE_APPEND);
        return $result;
    }

    public function getAccesstoken($appid, $secret)
    {
        $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $secret;
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
        file_put_contents('./source.txt', var_export($access, true), FILE_APPEND);
        return $access ['access_token'];
    }
}
