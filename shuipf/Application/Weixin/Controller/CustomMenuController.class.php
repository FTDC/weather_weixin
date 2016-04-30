<?php
// +----------------------------------------------------------------------
// | 自定义菜单
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class CustomMenuController extends AdminBase
{
	public $custom_menu = null;
	public $token = null;

	public function _initialize(){
		parent::_initialize ();
		$this->custom_menu = M('Custom_menu');
		$this->token = define('TOKEN','TOKEN');
	}
	
	/**
	  *	自定义菜单列表
	  */
	public function lists ()
	{
		$map = $this->token;
		$lists = $this->get_data($map);       //查询自定义菜单列表
		$this->assign('lists',$lists);
		$this->display();
	}
	
	/**
	  *	自定义菜单添加
	  */
	public function add()
	{
		//查询已有一级菜单
		$category_one = $this->custom_menu->where("pid='0' and token='{$this->token}'")->select();
		//echo $this->custom_menu->getlastSql();exit;
		if(!empty($_POST))
		{
			//处理提交的数据
			$_POST['token'] = $this->token;
			if($_POST['pid'] == '0' )
			{
				//统计一级菜单数量
				$count_c = $this->custom_menu->where("pid=0 and token='{$this->token}'")->count();
				// echo $this->custom_menu->getlastSql();exit;
				if($count_c >= 3)
				{
					// die("一级菜单栏目只能创建3个！");
					$this->error('一级菜单栏目只能创建3个');
				}
				else
				{
					$result = $this->custom_menu->add($_POST);
					//echo $this->custom_menu->getlastsql();
					if($result)
					{
						$this->success('添加一级菜单成功',U('Weixin/CustomMenu/lists'));die;
					}
					else
					{
						$this->error('添加一级菜单失败',U('Weixin/CustomMenu/lists'));die;
					}
				}
			}
			else
			{
				$count_c = $this->custom_menu->where("pid=$_POST[pid] and token='{$this->token}'")->count();
				if($count_c >=5)
				{
					$this->error('子菜单栏目只能创建5个');
				}
				else
				{
					$result = $this->custom_menu->add($_POST);
					if($result)
					{
						$this->success('添加菜单成功','Weixin/CustomMenu/lists');die;
					}
					else
					{
						$this->error('添加菜单失败');die;
					}
				}
			}
		}
		$this->assign('category',$category_one);
		$this->display();
	}
	
	/**
	  *	自定义菜单修改
	  */
	public function edit()
	{
		$id = I('get.id');                           //获取当前修改菜单ID
		$info = $this->custom_menu->find($id);       //查询当前修改菜单的内容
		$category = $this->custom_menu->where("pid='0' and token='{$this->token}'")->select();
		foreach($category as $key => $val)
		{
			if($id == $val['id'] or $info['pid'] == $val['id'])
			{
				$currently_c['id']    = $val['id'];
				$currently_c['title'] = $val['title'];
			}
		}
		if(!empty($_POST))
		{
			$id = I('get.id');
			$result = $this->custom_menu->where("id= $id")->setField($_POST);
			// echo $this->custom_menu->getlastSql();exit;
			if($result)
			{
				$this->success('修改成功',U('Weixin/CustomMenu/lists'));die;
			}
			else
			{
				 $this->error('修改失败',U('Weixin/CustomMenu/lists'));die;
			}
		}
		$this->assign('currently_c',$currently_c);
		$this->assign('category',$category);
		$this->assign('info',$info);
		$this->display();
	}
	
	/**
	  *	自定义菜单删除
	  */
	public function delete()
	{
		$id = I('get.id');
        if (empty($id)) {
            $this->error("没有指定删除对象！");
        }
        //执行删除
		$sql = "select pid form jbr_wq_custom_menu in (select )";
			if ($this->custom_menu->delete($id)) {
				$this->success("删除成功！");
			} else {
				$this->error('删除失败！');
			}
	}
	
	/**
	 * 自定义菜单显示样式拼接
	 * @param unknown $map
	 * @return multitype:
	 */
	public function get_data($map) {
		$map ['token'] = $map;
		$list = $this->custom_menu->where ( "token='{$map}'" )->order ( 'pid asc, sort asc' )->select ();
		// 取一级菜单
		foreach ( $list as $k => $vo ) {
			if ($vo ['pid'] != 0)
				continue;
			
			$one_arr [$vo ['id']] = $vo;
			unset ( $list [$k] );
		}
		
		foreach ( $one_arr as $p ) {
			$data [] = $p;
			
			$two_arr = array ();
			foreach ( $list as $key => $l ) {
				if ($l ['pid'] != $p ['id'])
					continue;
				
				$l ['title'] = '├──' . $l ['title'];
				$two_arr [] = $l;
				unset ( $list [$key] );
			}
			
			$data = array_merge ( $data, $two_arr );
		}
		
		return $data;
	}
	
	public function sendMenu()
	{
		$this->$this->redirect('Weixin/sendMenu');
	}
}