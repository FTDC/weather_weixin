<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 后台首页
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Admin\Controller;

use Common\Controller\AdminBase;
use Admin\Service\User;

class CrontabController extends AdminBase
{

    //后台框架首页
    public function index()
    {

        $list = D("crontab")->select();

        $this->assign('list', $list);

//        dump($list);
//        exit;
        $this->display();
    }


    //后台框架首页菜单搜索
    public function add()
    {

        $model = D("crontab");
        if (IS_POST) {

            $data = $_POST;

            $res = $model->add($data);
            if ($res > 0) {
                $this->success("添加成功！");
            } else {
                $this->error("添加失败！");
            }

        }

        $this->display("add");
    }


    /**
     * 编辑详细
     */
    public function  edit()
    {

        $model = D("crontab");
        $id = I('id', '', 'intval');

        if (empty($id)) {
            $this->error('请选择你要修改的路径!');
        }
        if (IS_POST) {
            $data = array(
                'name' => I('name'),
                'namerule' => I('namerule'),
                'second' => I('second'),
                'path' => I('path'),
                'action' => I('action'),
                'status' => I('status'),
            );

            $res = $model->where(array('id' => $id))->save($data);

            $this->success("更新成功！");

        }

        $info = $model->find($id);

        $this->assign('data', $info);
        $this->display();
    }


    public function  delete()
    {
        $model = D("crontab");
        $id = I('id', '', 'intval');

        if (empty($id)) {
            $this->error('请选择你要修改的路径!');
        }

        $res = $model->where(array('id'=>$id))->delete();

        if($res){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

}
