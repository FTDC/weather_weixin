<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>分享有奖</title>
</head>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<body>
分享有奖
</body>
<script type="text/javascript" src="{$config_siteurl}/statics/js/jweixin.js"></script>
<script type="text/javascript" src="{$config_siteurl}/statics/js/jquery.js"></script>
<script type="text/javascript">
//初始化成功
wx.config({
    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','startRecord','stopRecord','onVoiceRecordEnd','playVoice','pauseVoice','stopVoice','onVoicePlayEnd','uploadVoice','downloadVoice','chooseImage','previewImage','uploadImage','downloadImage','translateVoice','getNetworkType','openLocation','getLocation','hideOptionMenu','showOptionMenu','hideMenuItems','showMenuItems','hideAllNonBaseMenuItem','showAllNonBaseMenuItem','closeWindow','scanQRCode','chooseWXPay','openProductSpecificView','addCard','chooseCard','openCard'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
//初始化成功
//初始化成功
wx.ready(function(){
	// 获取“分享到朋友圈”按钮点击状态及自定义分享内容接口
	wx.onMenuShareTimeline({
	    title: '分享天气信息，赢话费', // 分享标题
	    link: '{:U("Api/Topic/kepuguan")}', // 分享链接
	    imgUrl: '', // 分享图标
	    success: function () {
	    	$.ajax({
	            type: 'POST',
	           async: false,
	       dataType : 'json',
	             url: '{:U("Api/Index/shared")}',
	            data: 'submit=submit',
	         success: function (request) {
	                alert('shard success');
	             },
	          error: function () {                    
						
	             },
	             cache: false
	         });
	    	
	        // 用户确认分享后执行的回调函数
	    },
	    cancel: function () {
	    	alert('cancel');
	        // 用户取消分享后执行的回调函数
	    }
	});
});
//初始化错误
wx.error(function(res){
	//alert("jsSDK初始化错误");
    // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。

});


</script>
</html>