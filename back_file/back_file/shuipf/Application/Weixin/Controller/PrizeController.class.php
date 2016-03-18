<?php

namespace Weixin\Controller;

use Common\Controller\AdminBase;

class PrizeController extends AdminBase {
	private $Config = null;
	private $model = null;
	
	protected function _initialize() {
		parent::_initialize();
		$this->Config = D('Common/Config');
		$configList = $this->Config->getField("varname,value");
		$this->assign('Site', $configList);
		$this->model = D('Admin/WpPrize');
	}
	
	public function prizelists() {
		$id = I('request.id', 0, 'intval');
		if ($id) {
			session('target_id',$id );
		} else {
			$target_id = session ('target_id' );
		}
		$where = array('target_id'=>$id);
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
			if(!empty($_FILES['img']['name'])){
				$_POST['img'] = uplodes($_FILES['img']);
			}
			$_POST ['target_id'] = session('target_id' );
			$_POST ['addon'] = 'Scratch';
			if ($this->model->add($_POST)) {
				$this->success("添加成功！", U('Prize/prizelists',array('id'=>session('target_id' ))));
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
			if(!empty($_FILES['img']['name'])){
				$_POST['img'] = uplodes($_FILES['img']);
			}
			if (false !== $this->model->save($_POST)) {
				$this->success("修改成功！", U('Prize/prizelists',array('id'=>session('target_id' ))));
			} else {
				$error = $this->model->getError();
				$this->error($error ? $error : '修改失败！');
			}
		} else {
			$data = $this->model->find($id);
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
