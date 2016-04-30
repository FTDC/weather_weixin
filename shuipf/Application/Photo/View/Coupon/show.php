<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{$config_siteurl}/statics/Coupon/mobile_module.css?v=1408523779" media="all">
	<title>优惠劵</title>
    <link rel="shortcut icon" href="{$config_siteurl}favicon.ico">
</head>
<link href="{$config_siteurl}/statics/Coupon/Coupon.css?v=1408523779" rel="stylesheet" type="text/css">
<body id="scratch">
	<div class="container body">
    	<div class="scr_top">
        	<img src="{$config_siteurl}/statics/Coupon/top.jpg"/>
        </div>
        <div class="block_out">
        	<div class="block_inner">
            	<h6>优惠券信息</h6>
                <p>优惠券：{$data.title}<br/>
                SN码&nbsp;&nbsp;：{$sn.sn}<br/>
                状 态&nbsp;&nbsp;：<eq name="sn.is_use" value="1">已使用<else />未使用</eq><br/>
                有效期：{$data.start_time|date="Y-m-d",###} 至 {$data.end_time|date="Y-m-d",###}
                </p>
            </div>
        </div>
        <div class="block_out">
        	<div class="block_inner">
            	<h6>使用说明</h6>
                <p>{$data.use_tips}</p>
            </div>
        </div>
        <div class="block_out">
        	<div class="block_inner">
            	<h6>领取条件</h6>
                <p>
                <volist name="condition" id="vo">
                {$key+1}、{$vo} <br/>
                </volist>
</p>
            </div>
        </div>
        <p class="copyright">金百瑞 版权所有</p>
        </div>
    </div>
</body>
</html>
