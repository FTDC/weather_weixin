<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />


<body>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <div class="lsList" style="background:#fff;">
    <form enctype="multipart/form-data" id="myform" class="J_ajaxForm" method="post" action="{:U(Coupon/edit)}">
    <input type="hidden" name="id" value="{$data.id}" />
    <div class="clearfix">
        <ul class="fl lsList_ul">
            <li>
                <span>昵称</span>
                <input name="nickname" type="text" value="{$data.nickname}" class="listText" />
            </li>
            
            <li>
                <span>性别</span>
                <select name="sex">
					<option value="0">保密 </option>
					<option value="1">男性 </option>
					<option value="2">女性 </option>
				</select>
            </li>
            <script>
			$("select[name='sex']").children().eq({$data.sex}).attr('selected',true);
			
            </script>
             <li class="listBox">
                <span>头像</span>
                <a href="#" class="lsList_a cover"><img id="cover" src="<if condition="!empty($data['headimgurl'])">{$data['headimgurl']}<else />{$config_siteurl}/statics/images/wx/btn_01.png</if>" /></a>
            	<input type="file" name="headimgurl" class="listFile cover_up"  />
            </li>
            
            
            <li>
                <span>城市 </span>
                <input name="city" type="text" value="{$data.city}" class="listText_02" />
            </li>
            
            <li>
                <span>省份 </span>
                <input name="province" type="text" value="{$data.province}" class="listText_02" />
            </li>
            
            <li>
                <span>国家 </span>
                <input name="country" type="text" value="{$data.country}" class="listText_02" />
            </li>
            
            <li>
                <span>语言 </span>
                <input name="language" type="text" value="{$data.language}" class="listText_02" />
            </li>
            
            <li>
                <span>手机 </span>
                <input name="mobile" type="text" value="{$data.mobile}" class="listText_02" />
            </li>
            
            <li>
                <span>财富值 </span>
                <input name="score" type="text" value="{$data.score}" class="listText_02" />
            </li>
            
             <li>
                <span>经验值 </span>
                <input name="experience" type="text" value="{$data.experience}" class="listText_02" />
            </li>
            
            <li>
                <input type="submit" value="确&nbsp;定" class="listBtn" />
            </li>
        </ul>
    </div>
    </form>
	</div>
</div>
</div>
</body>
<script type="text/javascript">
	$(function () {
     	$(".cover_up").uploadPreview({ Img: "cover", Width: 120, Height: 120,Callback: function () { 
				$('#show_img').attr('src',$('#cover').attr('src'));
         	} });
     });
	$(function(){
		$(".cover").click(function(){
			$(".cover_up").click();
			return false;
		});
	})
</script>
</html>
