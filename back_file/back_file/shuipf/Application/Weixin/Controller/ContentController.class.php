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

class ContentController extends ShuipFCMS
{

    /**
     * 显示详细信息
     *
     * @param $id ID
     * @param $tablename  数据表名称
     */
    public function detail()
    {
        $id = I('id', 'intval', 0);
        $tablename = I('model', 'trim', 0);
        $info = M($tablename)->find($id);

//        dump($info);
        $tpl = 'detail_';
        $this->assign('info', $info)
            ->assign('model', $tablename)
            ->display($tpl.$tablename);
    }
}

?>