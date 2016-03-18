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

class KeywordModel extends Model {
	
	public function _after_select(&$result){
		foreach($result as $key=>$value){
			switch ($value['addon']){
				case 'custom_reply_text':
					$result[$key]['addon'] = '文本回复';
					break;
				case 'custom_reply_news':
					$result[$key]['addon'] = '图文回复';
					break;
				case 'custom_reply_mult':
					$result[$key]['addon'] = '多图文回复';
					break;
				/* case 'coupon':
					$result[$key]['addon'] = '优惠劵';
					break;
				case 'scratch':
					$result[$key]['addon'] = '刮刮卡';
					break; */
			}
		}
	}
	
}
