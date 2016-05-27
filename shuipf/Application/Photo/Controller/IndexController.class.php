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

class IndexController extends ShuipFCMS
{


    // 管理中心显示图片信息
    public function index()
    {
        $start_time = I('start_time');
        $end_time = I('end_time');

        $Obj = M('weather_photo');
        $where = array('is_delete' => 0);

        $count = $Obj->where($where)->count();
        $page = $this->page($count, 20);

        if (!empty($start_time) && !empty($end_time)) {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }


        $list = $Obj->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('addtime' => 'DESC'))->select();

        foreach ($list as $key => &$val) {
            if (!empty($val['img_path'])) {
                $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
                $val['img_path_small'] = $this->thumb_name($val['img_path']);
            }
        }

        $this->assign("Page", $page->show());
        $this->assign("list", $list);
        $this->display();
    }


    // 管理中心美图信息
    public function beautiful_list()
    {
        $start_time = I('start_time');
        $end_time = I('end_time');

        $Obj = M('weather_photo');

        $where = array('is_delete' => 0, 'is_beautiful' => 1);

        $count = $Obj->where($where)->count();
        $page = $this->page($count, 20);

        if (!empty($start_time) && !empty($end_time)) {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time) + 86399;
            $where['addtime'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }


        $list = $Obj->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('addtime' => 'DESC'))->select();

        foreach ($list as $key => &$val) {
            if (!empty($val['img_path'])) {
                $val['img_path'] = C("WEB_DOMAIN") . '/d/weather_photo/' . $val['img_path'];
                $val['img_path_small'] = $this->thumb_name($val['img_path']);
            }
        }

        $this->assign("Page", $page->show());
        $this->assign("list", $list);
        $this->display('index');
    }


    public function thumb_name($filename, $type = 'small')
    {
        $pos = strrpos($filename, '.');
        if (!$pos) return '';

        $str1 = substr($filename, 0, $pos);
        $str2 = substr($filename, $pos);

        return $str1 . '_' . $type . $str2;
    }


}