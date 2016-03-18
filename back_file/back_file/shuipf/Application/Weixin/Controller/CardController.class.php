<?php 
// +----------------------------------------------------------------------
// | 会员卡
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class CardController extends AdminBase{
	private $Config = null;
	private $model = null;
	
	protected function _initialize() {
		parent::_initialize();
		$this->Config = D('Common/Config');
		$configList = $this->Config->getField("varname,value");
		$this->assign('Site', $configList);
		$this->model = D('Admin/WpMemberPublic');
		if(! TOKEN){
			$this->error('token不能为空!',U('index/index'));
		}
	}
	
	public function Card(){
		$addon_config = $this->model->where(array('token'=>TOKEN))->getField('addon_config');
		$addon_config = json_decode($addon_config,true);
		if (IS_POST) {
			if(!empty($_FILES['bg']['name'])){
				$_POST['bg'] = uplodes($_FILES['bg']);
			}
			$_POST['time'] = time();
			$_POST['length'] = strlen($_POST['num']);
			$addon_config['Card'] = $_POST;
			$data['addon_config'] = json_encode($addon_config);
			$where['token'] = array('eq',TOKEN);
			
			$result=$this->model->where($where)->save($data);
				
	        if ($result>0) {
	            $this->success("操作成功！");
	        } else {
	                $error = $this->model->getError();
	                $this->error($error ? $error : '操作失败！');
	        }
	    } else {
	    	$this->assign('card',$addon_config['Card']);
	        $this->display();
	    }
	}
	
	public function member(){
		$where['token']= array('eq',TOKEN);  //后期根据token查询
		if(!empty($_REQUEST ['username'])){
			$where['username'] = array (
					'like',
					'%'.htmlspecialchars($_REQUEST ['username']).'%'
			);
		}
		$count = D('wp_card_member')->count();
		$page = $this->page($count, 20);
		$list = D('wp_card_member')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('cTime' => 'DESC'))->select();
		$this->assign("Page", $page->show());
		$this->assign("list", $list);
		$this->display();
	}
	/*
	public function memberAdd(){
		if (IS_POST) {
			$_POST['token'] = TOKEN;
			$_POST['cTime'] = time();
	        if (D('wp_card_member')->add($_POST)) {
	            $this->success("添加成功！", U('Card/member'));
	        } else {
	                $error = D('wp_card_member')->getError();
	                $this->error($error ? $error : '添加失败！');
	        }
	    } else {
	        $this->display();
	    }
	}*/
	public function memberEdit(){
		$id = I('request.id', 0, 'intval');
		unset($_POST['id']);
		if (empty($id)) {
			$this->error("请选择需要编辑的信息！");
		}
		if (IS_POST) {
			if (false !== D('wp_card_member')->where(array('id'=>$id))->save($_POST)) {
				$this->success("更新成功！", U('Card/member'));
			} else {
				$error = D('wp_card_member')->getError();
				$this->error($error ? $error : '修改失败！');
			}
		} else {
			$data = D('wp_card_member')->where(array("id" => $id))->find();
			if (empty($data)) {
				$this->error('该信息不存在！');
			}
			$this->assign("data", $data);
			$this->display();
		}
	}
	//删除
	public function memberDel() {
		$id = $_REQUEST ['id'];
		if (empty($id)) {
			$this->error("没有指定删除对象！");
		}
		$where['id'] =array('in',$id);
		//执行删除
		if (D('wp_card_member')->where($where)->delete($id)) {
			$this->success("删除成功！");
		} else {
			$this->error(D('wp_card_member')->getError()? : '删除失败！');
		}
	}
	public function notice(){
		$where['token']= array('eq',TOKEN);  //后期根据token查询
		if(!empty($_REQUEST ['title'])){
			$where['title'] = array (
					'like',
					'%'.htmlspecialchars($_REQUEST ['title']).'%'
			);
		}
		$count = D('wp_card_notice')->count();
		$page = $this->page($count, 20);
		$list = D('wp_card_notice')->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('cTime' => 'DESC'))->select();
		$this->assign("Page", $page->show());
		$this->assign("list", $list);
		$this->display();
	}
	//增加
	public function noticeAdd(){
		if (IS_POST) {
			$_POST['token'] = TOKEN;
			$_POST['cTime'] = time();
	        if (D('wp_card_notice')->add($_POST)) {
	            $this->success("添加成功！", U('Card/notice'));
	        } else {
	                $error = D('wp_card_notice')->getError();
	                $this->error($error ? $error : '添加失败！');
	        }
	    } else {
	        $this->display();
	    }
	}
	//编辑信息
	public function noticeEdit() {
		$id = I('request.id', 0, 'intval');
		unset($_POST['id']);
		if (empty($id)) {
			$this->error("请选择需要编辑的信息！");
		}
		if (IS_POST) {
			if (false !== D('wp_card_notice')->where(array('id'=>$id))->save($_POST)) {
				$this->success("更新成功！", U('Card/notice'));
			} else {
				$error =D('wp_card_notice')->getError();
				$this->error($error ? $error : '修改失败！');
			}
		} else {
			$data = D('wp_card_notice')->where(array("id" => $id))->find();
			if (empty($data)) {
				$this->error('该信息不存在！');
			}
			$this->assign("data", $data);
			$this->display();
		}
	}	
	
	//删除
	public function noticeDel() {
		$id = $_REQUEST ['id'];
		if (empty($id)) {
			$this->error("没有指定删除对象！");
		}
		$where['id'] =array('in',$id);
		//执行删除
		if (D('wp_card_notice')->where($where)->delete($id)) {
			$this->success("删除成功！");
		} else {
			$this->error(D('wp_card_notice')->getError()? : '删除失败！');
		}
	}
	
}