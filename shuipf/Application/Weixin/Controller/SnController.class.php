<?php 
// +----------------------------------------------------------------------
// | 信息记录
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class SnController extends AdminBase{
	private $Config = null;
	private $model = null;
	
	protected function _initialize() {
		parent::_initialize();
		$this->Config = D('Common/Config');
		$configList = $this->Config->getField("varname,value");
		$this->assign('Site', $configList);
		$this->model = D('Admin/WpSnCode');
	}
	
	//列表显示
	public function snlists(){
		$id = I('request.id', 0, 'intval');
		$show = I('request.show', 0, 'string');
		if($show == 'yes'){
			$this->assign("show", $show);
		}
		$where = array('target_id'=>$id);
		$count = $this->model->count();
		$page = $this->page($count, 20);
		$list = $this->model->where($where)->select();
		$this->assign("list", $list);
		$this->display();
	}
	
	//删除
	public function del() {
		$id = I('get.id');
		if (empty($id)) {
			$this->error("没有指定删除对象！");
		}
		//执行删除
		if ($this->model->delete($id)) {
			$this->success("删除成功！");
		} else {
			$this->error($this->model->getError()? : '删除失败！');
		}
	}
	
	function set_use() {
		$map ['id'] = I ( 'id' );
		$data = $this->model->where ( $map )->find ();
		if (! $data) {
			$this->error ( '数据不存在' );
		}
		if ($data ['is_use']) {
			$data ['is_use'] = 0;
			$data ['use_time'] = '';
		} else {
			$data ['is_use'] = 1;
			$data ['use_time'] = time ();
		}
		$res = $this->model->where ( $map )->save ( $data );
		if ($res) {
			$this->success ( '设置成功' );
		} else {
			$this->error ( '设置失败' );
		}
	}
}
