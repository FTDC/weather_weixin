<?php

use Admin\Controller\PublicController;
// +----------------------------------------------------------------------
// | ShuipFCMS 微信自定义函数
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------

function getUid($id){
	$user= D('user')->find($id);
	return $user['username'];
}

function getUserId($id){
	return '还没写代码';
	$user= D('user')->find($id);
	return $user['username'];
}

/**
 * 群发消息，图文标题展示
 */
function get_html_mult($mult_ids){
	$Obj = M('custom_reply_news');
	$map['id'] = array('in',$mult_ids);
	$list = $Obj->where($map)->select();
	$info = "";
	foreach ($list as $k => $v){
		$info .= $v['title'] . "<br />";
	}
	echo $info;
}