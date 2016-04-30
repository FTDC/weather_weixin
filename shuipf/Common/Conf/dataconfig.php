<?php

// +----------------------------------------------------------------------
// | ShuipFCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------
return array(
    /* 数据库设置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    //'DB_HOST' => '192.168.0.100', // 服务器地址
	'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'weather_weixin', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '', // 密码
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => 'ftdc_', // 数据库表前缀

    /* 站点安全设置 */
    "AUTHCODE" => 'YmyFLLo9ELWiQP12FH', //密钥

    /* Cookie设置 */
    "COOKIE_PREFIX" => 'C3u_', //Cookie前缀

    /* 数据缓存设置 */
    'DATA_CACHE_PREFIX' => 'fE0_', // 缓存前缀
	'DB_PARAMS'=>array(
		'persist'=>1
	)
);
