<?php 
// +----------------------------------------------------------------------
// | 多图文回复
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class CustomReplyMultController extends AdminBase{
	private $Config = null;
	private $model = null;
	
	protected function _initialize() {
		parent::_initialize();
		$this->Config = D('Common/Config');
		$configList = $this->Config->getField("varname,value");
		$this->assign('Site', $configList);
		$this->model = D('Weixin/CustomReplyMult');
		if(! TOKEN){
			$this->error('token不能为空!',U('index/index'));
		}
	}
	
	public function index(){
		$this->display();
	}
	
	//列表显示
	public function Multlists(){
		$where['token']= array('eq',TOKEN);  //后期根据token查询
		if(!empty($_REQUEST ['keyword'])){
			$where['keyword'] = array (
					'like',
					'%'.htmlspecialchars($_REQUEST ['keyword']).'%' 
			);
		}
		$count = $this->model->count();
		$page = $this->page($count, 20);
		$list = $this->model->where($where)->limit($page->firstRow . ',' . $page->listRows)->select();
		foreach($list as $key=>$value){
			$mult_ids = explode(',',$value['mult_ids']);
			foreach($mult_ids as $k=>$v){
				$news = D('Admin/WpCustomReplyNews')->find($v);
				$list[$key]['news'] .= $news['title']."<br />";
			}
		}
		$this->assign("Page", $page->show());
		$this->assign("list", $list);
		$this->display();
	}
	
	//增加
	public function add(){
		if (IS_POST) {
			$a = explode(',',$_POST['mult_ids']);
			$a = count($a);
			if($a<3){
				$this->error("图文数不能少于2条!");
			}else{
				$_POST['mult_ids'] = substr($_POST['mult_ids'],0,-1);
			}
			$_POST['token'] = TOKEN;
	        if ($this->model->createReply($_POST)) {
	            $this->success("添加成功！", U('CustomReplyMult/multlists'));
	        } else {
	                $error = $this->model->getError();
	                $this->error($error ? $error : '添加失败！');
	        }
	    } else {
		    $where['token']= array('eq',TOKEN);  //后期根据token查询
			if(!empty($_REQUEST ['keyword'])){
				$where['keyword'] = array (
						'like',
						'%'.htmlspecialchars($_REQUEST ['keyword']).'%' 
				);
			}
	    	$count = D('Admin/WpCustomReplyNews')->count();
	    	$page = $this->page($count, 20);
	    	$list = D('Admin/WpCustomReplyNews')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('sort' => 'ASC'))->select();
	    	$this->assign("Page", $page->show());
	    	$this->assign("list", $list);
	        $this->display();
	    }
	}
	//编辑信息
	public function edit() {
		$id = I('request.id', 0, 'intval');
		if (empty($id)) {
			$this->error("请选择需要编辑的信息！");
		}
		if (IS_POST && $_POST['id']>0) {
			$a = preg_match_all("/,/",$_POST['mult_ids']);
			if($a<2){
				$this->error("图文数不能少于2条!");
			}else{
				$_POST['mult_ids'] = substr($_POST['mult_ids'],0,-1);
			}
			
			if (false !== $this->model->amendReply($_POST)) {
				$this->success("更新成功！", U('CustomReplyMult/Multlists'));
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
			$where= array('token'=>TOKEN);  //后期根据token查询
			$count = D('Admin/WpCustomReplyNews')->count();
			$page = $this->page($count, 20);
			$list = D('Admin/WpCustomReplyNews')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('sort' => 'ASC'))->select();
			$this->assign("Page", $page->show());
			$this->assign("list", $list);
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