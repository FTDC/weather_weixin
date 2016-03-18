<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />


<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <div class="lsList">
    <form enctype="multipart/form-data" id="myform" class="J_ajaxForm" method="post" action="">
	<ul class="lsList_ul">
        
        <!--  
        <li>
        	<span><em>*</em>标题</span>
            <input value="{$wecome['title']}" name="title" type="text" value="" class="listText" />
        </li>
        -->
         <li>
        	<span>内容</span>
            <textarea name="description" class="zj_desn">{$wecome['description']}</textarea>
        </li>
        <!-- 
        <li class="listBox">
                <span>图片</span>
                <a href="#" class="lsList_a cover"><img id="cover" src="<if condition="empty($wecome['img_url'])">{$config_siteurl}/statics/images/wx/btn_01.png<else />{$wecome['img_url']}</if>" /></a>
            	<input type="file" name="img_url" class="listFile cover_up"  />
        </li>
        -->
        
        
        <li>
        	<span><em>*</em>链接</span>
            <input value="{$wecome['url']}" class="listText" type="text"  name="url">
        </li>
        
        
        <li>
        	<input type="submit" value="确&nbsp;定" class="listBtn" />
        </li>
    </ul>
    </form>
</div>
</div>
</body>
<script>
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
