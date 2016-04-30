<?php 
// +----------------------------------------------------------------------
// | 图文回复
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class CustomReplyController extends AdminBase{
	private $Config = null;
	private $model = null;
	
	protected function _initialize() {
		parent::_initialize();
		$this->Config = D('Common/Config');
		$configList = $this->Config->getField("varname,value");
		$this->assign('Site', $configList);
		$this->model = D('Weixin/CustomReplyNews');
		if(! TOKEN){
			$this->error('token不能为空!',U('index/index'));
		}
	}
	
	public function index(){
		$this->display();
	}
	
	//列表显示
	public function multlists(){
		$where['token']= array('eq',TOKEN);  //后期根据token查询
		if(!empty($_REQUEST ['keyword'])){
			$where['keyword'] = array (
					'like',
					'%'.htmlspecialchars($_REQUEST ['keyword']).'%' 
			);
		}
		$count = $this->model->count();
		$page = $this->page($count, 20);
		$list = $this->model->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('sort' => 'ASC'))->select();
		$this->assign("Page", $page->show());
		$this->assign("list", $list);
		$this->display();
	}
	
	//增加
	public function add(){
		if (IS_POST) {
			$_POST['token'] = TOKEN;
			if(!empty($_FILES['cover']['name'])){
				$_POST['cover'] = uplodes($_FILES['cover']);
			}
	        if ($this->model->createReply($_POST)) {
	            $this->success("添加成功！", U('CustomReply/multlists'));die;
	        } else {
	                $error = $this->model->getError();
	                $this->error($error ? $error : '添加失败！');
	        }
	    } else {
	        $this->display();
	    }
	}
	//编辑信息
	public function edit() {
		$id = I('request.id', 0, 'intval');
		if (empty($id)) {
			$this->error("请选择需要编辑的信息！");
		}
		if (IS_POST) {
			if(!empty($_FILES['cover']['name'])){
				$_POST['cover'] = uplodes($_FILES['cover']);
			}
			if (false !== $this->model->amendReply($_POST)) {
				$this->success("更新成功！", U('CustomReply/multlists'));die;
			} else {
				$error = $this->model->getError();
				$this->error($error ? $error : '修改失败！');
			}
		} else {
			$data = $this->model->where(array("id" => $id))->find();
			if (empty($data)) {
				$this->error('该信息不存在！');
			}
			$this->assign("data", $data);
			$this->display();
		}
	}	

	//删除
	public function del() {
		$id = $_REQUEST ['id'];
		if (empty($id)) {
			$this->error("没有指定删除对象！");
		}
		$where['id'] =array('in',$id); 
		//执行删除
		if ($this->model->where($where)->delete($id)) {
			$this->success("删除成功！");
		} else {
			$this->error($this->model->getError()? : '删除失败！');
		}
	}
}