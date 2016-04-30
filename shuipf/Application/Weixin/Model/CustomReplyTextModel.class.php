<?php

// +----------------------------------------------------------------------
// | ShuipFCMS 后台用户模型
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

namespace Weixin\Model;

use Common\Model\Model;

class CustomReplyTextModel extends Model {
	
	//自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			array('keyword', 'require', '关键词不能为空！', 1, 'regex', 3),
				
	);
	
	
	/**
	 * 创建数据
	 * @param type $data
	 * @return boolean
	 */
	public function createReply($data) {
		if (empty($data)) {
			$this->error = '没有数据！';
			return false;
		}
		if ($this->create($data)) {
			$id = $this->add();
			if ($id) {
				return $id;
			}
			$this->error = '入库失败！';
			return false;
		} else {
			return false;
		}
	}
	
	/**
	 * 修改信息
	 * @param type $data
	 */
	public function amendReply($data) {
		if (empty($data) || !is_array($data) || !isset($data['id'])) {
            $this->error = '没有需要修改的数据！';
            return false;
        }
        $info = $this->where(array('id' => $data['id']))->find();
        if (empty($info)) {
            $this->error = '该数据不存在！';
            return false;
        }
        if ($this->create($data)) {
            $status = $this->save();
            return $status !== false ? true : false;
        }
        return false;
	}
	
	public function _after_select(&$result){
		foreach($result as $key=>$value){
			switch ($value['keyword_type']){
				case 0:
					$result[$key]['keyword_type_str'] = '完全匹配';
					break;
				case 1:
					$result[$key]['keyword_type_str'] = '左边匹配';
					break;
				case 2:
					$result[$key]['keyword_type_str'] = '右边匹配';
					break;
				case 3:
					$result[$key]['keyword_type_str'] = '模糊匹配';
					break;
			}
		}
	}
	
	public function _after_find(&$result){
		switch ($result['keyword_type']){
			case 0:
				$result['selected_0'] = 'selected=""';
				break;
			case 1:
				$result['selected_1'] = 'selected=""';
				break;
			case 2:
				$result['selected_2'] = 'selected=""';
				break;
			case 3:
				$result['selected_3'] = 'selected=""';
				break;
		}
	}
	
	public function _after_insert($data,$options){
		$temp['keyword'] = $data['keyword'];
	    $temp['keyword_type'] = $data['keyword_type'];
	    $temp['token'] = $data['token'];
	    $temp['addon'] = $options['table'];
	    $temp['aim_id'] =$data['id'];
	    $temp['cTime'] = time();
		D('keyword')->add($temp);
	}
	
	public function _after_update($data,$options){
		$where['aim_id'] = array('eq',$data['id']);
		$where['addon'] = array('eq',$options['table']);
		$res = D('keyword')->where($where)->find();
		$temp['keyword'] = $data['keyword'];
		$temp['keyword_type'] = $data['keyword_type'];
		if($res){
			D('keyword')->where($where)->save($temp);
		}else{
		    $temp['token'] = TOKEN;
		    $temp['addon'] = $options['table'];
		    $temp['aim_id'] =$data['id'];
		    $temp['cTime'] = time();
			D('keyword')->add($temp);
		}
		
	}
	
	public function _after_delete($data,$options){
		$where['aim_id'] = $data['id'];
		$where['addon'] = $options['table'];
		D('keyword')->where($where)->delete();
	}
}
