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
        $description = I('description', '', 'description');
        $imglist = I('imglist', '', '');
        $city = I('city', '', '');
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
                    'username' => 'xjin',
                    'addtime' => time(),
                );
            }
        }

        M('weather_photo')->addAll($data);

        echo '上报成功!';
        sleep(3);
        redirect(U('Photo/Photo/listPhoto'));
    }


    public function listPhoto()
    {
        $list = M('weather_photo')->where(array('is_validate' => 0))->select();
        foreach ($list as &$val) {
            $val['gg'] = C('UPLOADFILEPATH').'weather_photo/' . $val['img_path'];
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

        $Obj = M('weather_photo');

        $count = $Obj->count();
        $page = $this->page($count, 20);

        $where = array();

        if (!empty($start_time) && !empty($end_time)) {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }


        $list = $Obj->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('addtime' => 'DESC'))->select();

        foreach ($list as &$val) {
            $val['gg'] = C('UPLOADFILEPATH').'weather_photo/' . $val['img_path'];
//            $val['size'] = getimagesize(C('UPLOADFILEPATH').'weather_photo/' . $val['img_path']);
//            var_dump(C('UPLOADFILEPATH').'weather_photo/' . $val['img_path']);
            $val['size'] = getimagesize($val['gg']);
            $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
            $val['img_path_small'] = $this->thumb_name($val['img_path']);
//
        }

//        dump($list); exit();

        $this->assign("Page", $page->show());
        $this->assign("list", $list);
        $this->display();
    }

    public function query_list(){
        $start_time = I('start_time');
        $end_time = I('end_time');

        $Obj = M('weather_photo');

        $count = $Obj->count();
        $page = $this->page($count, 20);

        $where = array();

        if (!empty($start_time) && !empty($end_time)) {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }

        $list = $Obj->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('addtime' => 'DESC'))->select();

        foreach ($list as &$val) {
            $val['gg'] = C('UPLOADFILEPATH').'weather_photo/' . $val['img_path'];
//            $val['size'] = getimagesize(C('UPLOADFILEPATH').'weather_photo/' . $val['img_path']);
//            var_dump(C('UPLOADFILEPATH').'weather_photo/' . $val['img_path']);
            $val['size'] = getimagesize($val['gg']);
            $val['dateTime'] =date('Y-m-d H:i', $val['addtime']);
            $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
            $val['img_path_small'] = $this->thumb_name($val['img_path']);
//
        }

        if(empty($list)){
            $data =array('status'=> 0, 'data'=> '');
        }else{
            $data =array('status'=> 0, 'data'=> ($list));
        }
        exit(json_encode($data));
    }

    // 上报地理位置事件 感谢网友【blue7wings】和【strivi】提供的方案
    public function getaddressbylngb()
    {
        $latitude = I('latitude', '');
        $longitude = I('longitude', '');
//        $pos = file_get_contents('http://lbs.juhe.cn/api/getaddressbylngb?lngx=' . $latitude . '&lngy=' . $longitude);
//        $pos = file_get_contents('http://api.map.baidu.com/geocoder/v2/?output=json&ak=Uu7nmbVo3yWthageyl4CqGck&location=' . $latitude . ',' . $longitude);
        $pos = file_get_contents('http://api.map.baidu.com/geocoder/v2/?output=json&ak=Uu7nmbVo3yWthageyl4CqGck&location=' . $latitude . ','.$longitude.'&output=json&pois=1');
        $pos_ar = json_decode($pos, true);
        echo json_encode($pos_ar['result']['addressComponent']); exit();
//        $res=json_decode($str,true);
//        $res=object_array($res);
//        echo $str; exit();

    }




}