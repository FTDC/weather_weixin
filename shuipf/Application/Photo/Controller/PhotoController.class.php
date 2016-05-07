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
use Libs\Service\XfUpload;

class PhotoController extends ShuipFCMS
{


    // 管理中心显示图片信息
    public function index()
    {
        $this->display();
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
        $save_path = $root_dir ;


        // 设置参数
        $upload_config = array('maxSize' => 20480000,
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


}