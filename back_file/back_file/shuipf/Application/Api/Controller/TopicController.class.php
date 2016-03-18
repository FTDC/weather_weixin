<?php
// +----------------------------------------------------------------------
// | 微信自定义菜单
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Api\Controller;

use Common\Controller\ShuipFCMS;

class TopicController extends ShuipFCMS
{
    // 专题首页
    public function index()
    {
        $catemodel = D('Content/Category');

        $cate = I('type', '', 'trim');

        $where = array('modelid' => 1);
        $fields = 'catid, module, parentid, arrparentid, catname, image';
        $catelist = $catemodel->where($where)->field($fields)->order("listorder asc")->select();

        //echo $catemodel->getLastSql();

//        dump($catelist); exit;

        $this->assign('catelist', $catelist)->assign('cate', $cate);
        $this->display();
    }


    /**
     * 专题列表
     */
    public function topiclist()
    {
        $model = D('category');
        $cateId = I('catid', '', 'intval');

        if ($cateId == '') $this->error('你查看的分类不存在!');

        $catename = $model->where('catid=' . $cateId)->getField('catname');


        $article_model = D('article');
        $data = $article_model->where(array('catid'=>$cateId))->order(array("id" => "DESC"))->select();
        //$data = $model->where($where)->limit($pagestart. ',' . $pagesize)->order(array("id" => "DESC"))->select();

//         dump($data); exit();

        $this->assign('catename', $catename)
            ->assign('catid', $cateId)
            ->assign('start', 0)
            ->assign('list', $data);

        $this->display();


    }


    public function getlist()
    {
        //实例化模型
        $model = D('article');
        $catid = I('catid');
        $pagesize = 10;
        $pagestart = I('start', 0, 'intval');

        //信息总数
        $where = array('catid' => $catid);


        $count = $model->where($where)->count();

        $data = $model->where($where)->limit($pagestart . ',' . $pagesize)->order(array("id" => "DESC"))->select();


        $res = array(
            'events' => $data,
            'start' => 10,
            'count' => $pagesize,
            'total' => $count
        );

        echo json_encode($res);
        exit();
        $this->assign('catid', $this->catid)
            ->assign('start', 0)
            ->assign('count', $pagesize)
            ->assign('total', $count)
            ->assign('events', $data);
    }

    /**
     *  专题详细页
     */

    public function detail()
    {
        $model = D('category');
        $cateId = I('catid', '', 'intval');
        $id = I('id', '', 'intval');

        if ($id == '') $this->error('你查看的文章不存在!');

        $catename = $model->where('catid=' . $cateId)->getField('catname');


        $article_model = D('article');
        $article_data_model = D('article_data');
        $where = array('id' => $id);
        $data1 = $article_model->where($where)->find();
        $data2 = $article_data_model->where($where)->find();

        $article = array_merge($data1, $data2);
        $article['catname'] = $catename;

        $this->assign('info', $article);
        $this->display();
    }


    /**
     * 科普馆介绍
     */
    public function kepuguan()
    {
        $this->display();
    }


}

?>