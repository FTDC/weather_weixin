<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />

<script type="text/javascript" src="{$config_siteurl}/statics/DatePicker/WdatePicker.js"></script>

<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
 	<Admintemplate file="Common/Nav"/>
    <div class="lsList" style="background:#fff;">
    <form enctype="multipart/form-data" id="myform" class="J_ajaxForm" method="post" action="">
    <div class="clearfix">
        <ul class="fl lsList_ul">
        	 <li>
                <span>背景图</span>
                <select name="select_background" class="listSel">
                    <option value="0">背景1 </option>
                    <option value="1">背景2 </option>
                    <option value="2">背景3 </option>
                    <option value="3">背景4 </option>
                    <option value="4">背景5 </option>
                    <option value="5">背景6 </option>
                    <option value="6">背景7 </option>
                    <option value="7">背景8 </option>
                    <option value="8">背景9</option>
                    <option value="9">背景10</option>
                    <option value="10">自定义 </option>
                </select>
            </li>
            
             <li class="listBox" style="display:<if condition="$card['select_background'] eq 10">block<else />none</if> ">
                <a href="#" class="lsList_a cover"><img id="cover" src="<if condition="empty($card['bg'])">{$config_siteurl}/statics/images/wx/btn_01.png<else />{$card['bg']}</if>" /></a>
            	<input type="file" name="bg" class="listFile cover_up"  />
            </li>
            
            <li>
                <span><em>*</em>卡名</span>
                <input name="title" type="text" value="{$card['title']}" class="listText" />
            </li>
            
            
        	 <li>
                <span>卡号位数</span>
                <select name="num" class="listSel">
                   	<option value="80001">5</option>
					<option value="800001">6</option>
					<option value="8000001">7</option>
					<option value="80000001">8</option>
					<option value="800000001">9</option>
                </select>
            </li>
            
            <li>
                <span><em>*</em>使用说明</span>
                <textarea name="use_tips" class="listRea">{$card['use_tips']}</textarea>
            </li>
            
            
            <li>
                <span>地址</span>
                <input name="address" type="text" value="{$card['address']}" class="listText_02" />
            </li>
            
            <li>
                <span>电话</span>
                <input name="phone" type="text" value="{$card['phone']}" class="listText_02" />
            </li>
            
            <li>
                <span>网址</span>
                <input name="url" type="text" value="{$card['url']}" class="listText_02" />
            </li>
            
            <li>
                <input type="submit" value="确&nbsp;定" class="listBtn" />
            </li>
        </ul>
        
       <div class="fr ListImg">
            <span id="show_title">{$card['title']}</span>
            <h3>
            <img id="show_img" src="<if condition="$card['select_background'] eq 10">{$card['bg']}<else />{$config_siteurl}/statics/card/card_bg_{$card['select_background']}.png</if>" width="288px" height="145px"/>
            </h3>
            <span id="show_num" >{$card['num']}</span>
        </div>
    </div>
    </form>
	</div>
</div>
</body>
<script type="text/javascript">
	//默认选中
	$(function (){
		$("select[name='select_background']").children().eq({$card['select_background']}).attr('selected',true);
		var length = {$card['length']}-5;
		$("select[name='num']").children().eq(length).attr('selected',true);
	});
	var select_background = '';
	$(function(){
		$("select[name='select_background']").change(function(){
			if($(this).children().last().is(":selected")){
				$('.listBox').css('display','block');
				var cardImg = $("#cover").attr('src')
				if(cardImg != "{$config_siteurl}/statics/images/wx/btn_01.png"){
					$('#show_img').attr('src',cardImg);
				}
				return false;
			}else{
				$('.listBox').css('display','none');
			}
			if($(this).children().is(":selected")){
				select_background = $(this).val();
				var imgUrl = "{$config_siteurl}/statics/card/card_bg_"+select_background+".png"
				$('#show_img').attr('src',imgUrl);
			}
	
		});

		$("select[name='num']").change(function(){
			if($(this).children().is(":selected")){
				$('#show_num').html($(this).val());
			}
		});


		$("input[name='title']").keyup(function(){
			var str = $(this).val();
			$('#show_title').html(str);

		});
		
	})

	$(function () {
     	$(".cover_up").uploadPreview({ Img: "cover", Width: 120, Height: 120,Callback: function () { 
				$('#show_img').attr('src',$('#cover').attr('src'));
				cardImg = $('#cover').attr('src');
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
