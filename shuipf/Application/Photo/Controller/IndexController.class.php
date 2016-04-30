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

    public function __construct()
    {

    }

    // 管理中心显示图片信息
    public function  index(){
        $this->display();
    }

    

}