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

class WpScratchModel extends Model {
	
	//自动验证
	protected $_validate = array(
			//array(验证字段,验证规则,错误提示,验证条件,附加规则,验证时间)
			array('keyword', 'require', '关键词不能为空！', 1, 'regex', 3),
			array('title', 'require', '标题不能为空！', 1, 'regex', 3),
			array('use_tips', 'require', '使用说明不能为空！', 1, 'regex', 3),
			array('predict_num', 'require', '预计参与人数不能为空！', 1, 'regex', 3),
			
	);
	//array(填充字段,填充内容,[填充条件,附加规则])
	protected $_auto = array(
			array('cTime', 'time', 1, 'function'),
			array('update_time', 'time', 3, 'function'),
	);
	
	
	/**
	 * 创建数据
	 * @param type $data
	 * @return boolean
	 */
	public function createScratch($data) {
		if (empty($data)) {
			$this->error = '没有数据！';
			return false;
		}
		$data['start_time'] = strtotime($data['start_time']);
		$data['end_time'] = strtotime($data['end_time']);
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
	public function amendScratch($data) {
		if (empty($data) || !is_array($data) || !isset($data['id'])) {
            $this->error = '没有需要修改的数据！';
            return false;
        }
        $info = $this->where(array('id' => $data['id']))->find();
        if (empty($info)) {
            $this->error = '该数据不存在！';
            return false;
        }
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
        if ($this->create($data)) {
            $status = $this->save();
            return $status !== false ? true : false;
        }
        return false;
	}
	
	public function _after_find(&$result){
		switch ($result['follower_condtion']){
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
		$where = $data;
		$where['addon'] = $options['table'];
		D('keyword')->where($where)->delete();
	}
	
}
