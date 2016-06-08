<?php
// +----------------------------------------------------------------------
// | 微信接口
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Photo\Controller;

use Common\Controller\ShuipFCMS;
use Libs\Service\Jssdk;
use Libs\Service\XfImage;
use Libs\Service\XfUpload;

class PhotoController extends ShuipFCMS
{


    // 管理中心显示图片信息
    public function index()
    {
        $appid = C('WX_APP_ID');
        $secret = C('WX_SECRET');

        $jssdk = new Jssdk($appid, $secret);
        $signPackage = $jssdk->GetSignPackage();
        $this->assign("signPackage", $signPackage);

        $code = $_GET['code'];
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
        $token = json_decode(file_get_contents($token_url));

        //打印用户信息
        $openId = $token->openid;
        $access_token = $token->access_token;
        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openId . "&lang=zh_CN";
        $json_info = https_request($info_url);


        $user = json_decode($json_info, true);
        var_dump($user); exit();
        $this->assign("user", $user);
        $this->display();
    }


    public function shangbao()
    {
        $url = U('Photo/Photo/index');
        $autho_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . C('WX_APP_ID') . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        header('location:' . $autho_url);
    }


    public function uploadPhoto()
    {
        // 文件保存主目录
        $root_dir = './d/weather_photo/';

        if (!file_exists($root_dir)) {
            $data = array('state' => '上传文件文件夹不存在');
            echo json_encode($data);
            exit;
        }


        // 文件保目录
        $save_path = $root_dir;


        // 设置参数
        $upload_config = array(
            'maxSize' => 20480000,
            // 上传文件的最大值
            'supportMulti' => false,
            // 是否支持多文件上传
            'allowExts' => array('gif',
                'jpg',
                'jpeg',
                'png',
                'bmp'),
            // 允许上传的文件后缀 留空不作后缀检查

            'thumb' => true,
            // 使用对上传图片进行缩略图处理
            'thumbMaxWidth' => '1024',
            // 缩略图最大宽度
            'thumbMaxHeight' => '',
            // 缩略图最大高度
            'thumbPrefix' => '',
            // 缩略图前缀
            'thumbSuffix' => '',
            'thumbPath' => '',
            // 缩略图保存路径
            'thumbFile' => '',
            // 缩略图文件名
            'thumbExt' => '',
            // 缩略图扩展名
            'thumbRemoveOrigin' => false,
            // 是否移除原图

            'zipImages' => false,
            // 压缩图片文件上传
            'autoSub' => true,
            // 启用子目录保存文件
            'subType' => 'date',
            // 子目录创建方式 可以使用hash date custom
            'subDir' => '',
            // 子目录名称 subType为custom方式后有效
            'dateFormat' => 'Ym',
            'hashLevel' => 2,
            // hash的目录层次
            'savePath' => $save_path,
            // 上传文件保存路径
            'autoCheck' => true,
            // 是否自动检查附件
            'uploadReplace' => false,
            // 存在同名是否覆盖
            'saveRule' => 'uniqid',
            // 上传文件命名规则
            'hashType' => 'md5_file',
            // 上传文件Hash规则函数名
        );

        $XfUpload = new XfUpload($upload_config);
//        $this->load->library('xiaoFei/XfUpload', $upload_config, 'XfUpload');
//
//        $this->load->library('xiaoFei/XfImage', '', 'XfImage');

        $upload = $XfUpload;

        if (!$upload->upload()) {

            $data = array('state' => $upload->getErrorMsg());
        } else {

            // 取得成功上传的文件信息
            $uploads = $upload->getUploadFileInfo();

            $uploads = $uploads[0];


            // 文件绝对路径
            $original_file = $uploads['savepath'] . $uploads['savename'];

            if (filesize($original_file) < 10) {

                $data = array('state' => '图片上传失败');

                echo json_encode($data);
                exit;
            }

            //生成缩略图
            $ximage = new XfImage();
            $ximage->thumb($original_file, $this->thumb_name($original_file, "small"), '', 400, '', true);

            $data = array('state' => 'SUCCESS',
                'url' => str_replace($root_dir, '', $original_file),
                //'url_thumb' => str_replace($root_dir, '', $original_file_tb),
                'title' => $uploads['savename'],
                'original' => $uploads['name'],
                'type' => $uploads['type'],
                'size' => $uploads['size'],);
        }

        echo json_encode($data);
    }


    public function thumb_name($filename, $type = 'small')
    {
        $pos = strrpos($filename, '.');
        if (!$pos) return '';

        $str1 = substr($filename, 0, $pos);
        $str2 = substr($filename, $pos);

        return $str1 . '_' . $type . $str2;
    }


    /**
     *  发布实景图片
     */
    public function publish()
    {

        $title = I('title', '', 'trim');
        $description = I('description', '', '');
        $imglist = I('imglist', '', '');
        $city = I('city', '', '');
        $nickname = I('nickname', '', '');
        $location_xy = I('location_xy', '', '');

        if (empty($imglist)) {
            $this->error('请选择上传文件');
        }

        $data = array();
        foreach ($imglist as $item) {
            if (!empty($item)) {
                $data[] = array(
                    'title' => $title,
                    'description' => $description,
                    'img_path' => $item,
                    'city' => $city,
                    'location_xy' => $location_xy,
                    'username' => $nickname,
                    'addtime' => time(),
                );
            }
        }

        M('weather_photo')->addAll($data);

        echo '上报成功!';
        sleep(3);
        redirect(U('Photo/Photo/listPhoto'));
    }


    /**
     * 微信端
     */
    public function listPhoto()
    {
        $list = M('weather_photo')->where(array('is_validate' => 1, 'is_delete' => 0))->select();
        $localfile = SITE_PATH . 'd/weather_photo/';
        foreach ($list as &$val) {
            $val['gg'] = $localfile . $val['img_path'];
//            $val['size'] = getimagesize(C('UPLOADFILEPATH').'weather_photo/' . $val['img_path']);
//            var_dump(C('UPLOADFILEPATH').'weather_photo/' . $val['img_path']);
            $val['size'] = getimagesize($val['gg']);
            $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
            $val['img_path_small'] = $this->thumb_name($val['img_path']);
//
        }

        $this->assign("list", $list);
        $this->display('list_bak');
    }


    // 管理中心显示图片信息
    public function hbqx_index()
    {
        $start_time = I('start_time');
        $end_time = I('end_time');
        $city = I('city');

        $Obj = M('weather_photo');

        $where = array('is_delete' => 0, 'is_validate' => 1);

        $start_time = strtotime($start_time);


        if (!empty($start_time) && empty($end_time)) {
            $where['addtime'] = array(array('GT', $start_time));
        } elseif (empty($start_time) && !empty($end_time)) {
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('LT', $end_time));
        } elseif (!empty($start_time) && !empty($end_time)) {
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }


        if (!empty($city)) {
            $where['city'] = $city;
        }

        $list = $Obj->where($where)->limit(0, 12)->order(array('addtime' => 'DESC'))->select();

//        echo $Obj->getLastSql(); exit;

        $localfile = SITE_PATH . 'd/weather_photo/';

        foreach ($list as &$val) {
            $val['gg'] = $localfile . $val['img_path'];
            $val['size'] = getimagesize($val['gg']);
            $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
            $val['img_path_small'] = $this->thumb_name($val['img_path']);
        }

        $this->assign("data", array('city' => $city, 'start_time' => $start_time, 'end_time' => $end_time));
        $this->assign("list", $list);
        $this->display();
    }

    public function query_list()
    {
        $start_time = I('start_time');
        $end_time = I('end_time');
        $city = I('city');
        $page = I('page');

        $pageSize = 12;

        $Obj = M('weather_photo');

        $where = array('is_delete' => 0, 'is_validate' => 1);

        if (!empty($start_time) && !empty($end_time)) {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }

        if (!empty($city)) {
            $where['city'] = $city;
        }

        $list = $Obj->where($where)->limit($page * $pageSize . ',' . $pageSize)->order(array('addtime' => 'DESC'))->select();
        $localfile = SITE_PATH . 'd/weather_photo/';
        foreach ($list as &$val) {
            $thumb_name = $this->thumb_name($val['img_path']);
            $val['gg'] = $localfile . $thumb_name;
            $size = getimagesize($val['gg']);
            $val['width'] = $size[0];
            $val['hight'] = $size[1];
            $val['dateTime'] = date('Y-m-d H:i', $val['addtime']);
            $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
            $val['img_path_small'] = $this->thumb_name($val['img_path']);
        }
//        exit;

        if (empty($list)) {
            $data = array('status' => 0, 'data' => '');
        } else {
            $data = array('status' => 1, 'data' => ($list));
        }
        exit(json_encode($data));
    }


    /**
     * 图片详细
     */
    public function detail()
    {
        $id = I('id', '', 'intval');
        if ($id == 0) $this->error('图片不存在!');

        $Obj = M('weather_photo');

        $where = array('id' => $id);

        $detail = $Obj->where($where)->find();

        $detail['dateTime'] = date('Y-m-d H:i', $detail['addtime']);
        $detail['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $detail['img_path'];

        $this->assign("detail", $detail);
        $this->display('hbqx_index_detail');

    }

    // 上报地理位置事件 感谢网友【blue7wings】和【strivi】提供的方案
    public function getaddressbylngb()
    {
        $latitude = I('latitude', '');
        $longitude = I('longitude', '');
//        $pos = file_get_contents('http://lbs.juhe.cn/api/getaddressbylngb?lngx=' . $latitude . '&lngy=' . $longitude);
//        $pos = file_get_contents('http://api.map.baidu.com/geocoder/v2/?output=json&ak=Uu7nmbVo3yWthageyl4CqGck&location=' . $latitude . ',' . $longitude);
        $pos = file_get_contents('http://api.map.baidu.com/geocoder/v2/?output=json&ak=Uu7nmbVo3yWthageyl4CqGck&location=' . $latitude . ',' . $longitude . '&output=json&pois=1');
        $pos_ar = json_decode($pos, true);
        echo json_encode($pos_ar['result']['addressComponent']);
        exit();
//        $res=json_decode($str,true);
//        $res=object_array($res);
//        echo $str; exit();

    }


    /**
     * 获取用户详细信息
     *
     * $openid  用户微信ID
     */
    private function _getuserinfo($openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $this->access_token . '&openid=' . $openid . '&lang=zh_CN';

        $userinfo = https_request($url);

        return json_decode($userinfo, true);
    }

    /**
     *  审核内容
     */
    public function public_check()
    {

        $ids = I('ids');

        if (empty($ids)) $this->error('请选择要操作的图片!');

        $Obj = M('weather_photo');
        $Obj->where(array('id' => array('in', $ids)))->save(array('is_validate' => 1));

        $this->success('审核成功!');
    }


    /**
     * 审核不通过
     */
    public function public_nocheck()
    {
        $ids = I('ids');
        if (empty($ids)) $this->error('请选择要操作的图片!');

        $Obj = M('weather_photo');
        $Obj->where(array('id' => array('in', $ids)))->save(array('is_validate' => 2));

        $this->success('操作成功!');
    }


    /**
     *  删除图片信息
     */
    public function delete_pic()
    {
        $ids = I('ids');
        if (empty($ids)) $this->error('请选择要操作的图片!');

        $Obj = M('weather_photo');
        $Obj->where(array('id' => array('in', $ids)))->save(array('is_delete' => 1));

        $this->success('操作成功!');
    }


    /**
     * 美图评选
     */
    public function beautiful()
    {
        $ids = I('ids');

        if (empty($ids)) $this->error('请选择要操作的图片!');

        $Obj = M('weather_photo');
        $Obj->where(array('id' => array('in', $ids)))->save(array('is_beautiful' => 1));

        $this->success('评选成功!');
    }


    /**
     * 取消美图评选
     */
    public function cancel_beautiful()
    {
        $ids = I('ids');

        if (empty($ids)) $this->error('请选择要操作的图片!');

        $Obj = M('weather_photo');
        foreach ($ids as $item) {
            $Obj->where(array('id' => array('in', $ids)))->save(array('is_beautiful' => 0));
        }
        $this->success('评选成功!');
    }


    /**
     * 赞美图
     */
    public function parise_photo()
    {
        $photo_id = I('photo_id', 0, 'intval');

        if ($photo_id == 0) $this->error('请选择要操作的图片!');

        $Obj = M('weather_photo');
//        $res = $Obj->where(array('id' => $photo_id))->save(array('exp','parise+1'));
        $res = $Obj->query('UPDATE ftdc_weather_photo SET parise=parise+1 WHERE id = ' . $photo_id);

        echo $Obj->getLastSql();
        exit();
        echo json_encode($res);
        exit;
    }


    /**
     * 对链接进行outho验证
     * @author zhaojie <z510727296@163.com>
     */
    public function authorInfo()
    {
        $str = I('request.backurl') ? I('request.backurl') : '';
        session('backurl', $str);
        $join = "left join wp_member_public_link as l on m.id = l.mp_id";
        $appinfo = M('Member_public as m')->join($join)->where('l.is_use = 1')->find();
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?s=/home/task/getInfo";
        $autho_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $appinfo['appid'] . "&redirect_uri=" . urlencode($url) . "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
        header('location:' . $autho_url);
    }

    /**
     * 获取openid
     * @author zhaojie <z510727296@163.com>
     * @return json  open id status
     */
    public function getInfo()
    {
        $url = I('request.backurl');
        $backurl = session('backurl');
        file_put_contents('./Application/Home/Controller/a.txt', var_export($backurl, true) . "\n", FILE_APPEND);
        $code = $_GET['code'];
        $state = $_GET['state'];
        //换成自己的接口信息
        $join = "left join wp_member_public_link as l on m.id = l.mp_id";
        $appinfo = M('Member_public as m')->join($join)->where('l.is_use = 1')->find();
        $appid = $appinfo['appid'];
        $appsecret = $appinfo['secret'];
        if (empty($code)) $this->error('授权失败');
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
        $token = json_decode(file_get_contents($token_url));
        if (isset($token->errcode)) {
            echo '<h1>错误：</h1>' . $token->errcode;
            echo '<br/><h2>错误信息：</h2>' . $token->errmsg;
            exit;
        }

        //打印用户信息
        $openId = $token->openid;
        $access_token = $token->access_token;
        $info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $access_token . "&openid=" . $openId . "&lang=zh_CN";
        $json_info = https_request($info_url);

        $info_str = $this->encode($json_info);
        /* if(strstr($backurl,'?')){
            $urls = $backurl . '&data=' . $info_str;
        }else{
            $urls = $backurl . '?data=' . $info_str;
        } */
        $backarr = parse_url($backurl);
        $headurl = $backarr['scheme'] . "://" . $backarr['host'] . $backarr['path'] . "?" . $backarr['query'] . '&data=' . $info_str;
        if ($strs['fragment']) {
            $headurl .= "#" . $strs['fragment'];
        }

        file_put_contents('./Application/Home/Controller/a.txt', var_export($headurl, true) . "\n", FILE_APPEND);
        header('location:' . $headurl);
    }


}