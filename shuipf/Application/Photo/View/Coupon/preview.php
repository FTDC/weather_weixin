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
	<div class="container body" style="position:relative">
    	<div class="prev_get">
        	<div class="top"></div>
            <div class="mid">
            	<div class="get_text">
                	<h6>领取条件</h6>
                    <p class="list">
                        <volist name="condition" id="vo">
                        <span class="num">{$key+1}</span>{$vo} <br/>
                        </volist>    
                          	
                    </p>
                </div>
                <notempty name="error">
                    <h3 class="get_error">
                        {$error}
                    </h3>
                <else />
            		<center><a href="{:U('set_sn_code',array('id'=>$data[id]))}"><img class="get_btn" src="{$config_siteurl}/statics/Coupon/get_btn.jpg"/></a></center>
                </notempty>
            </div>
            <div class="btm"></div>
        </div>
        
        <p class="copyright">金百瑞 版权所有</p>
        </div>
    </div>
</body>
</html>