<extend name="Base/common" />
<block name="body">
  <div class="span9 page_message">
    <section id="contents"> 
    <include file="Addons/_nav" />
    <div class="tab-content has-weixinpreivew"> 
    <div class="fl" style="width:100%;">
      <form id="form" action="{$post_url}" method="post" class="form-horizontal" style="width:100%">
        <div>
	        <div class="form-item cf">
	          <label class="item-label">发送人类型<span class="check-tips"> </span></label>
	          <div class="controls">
	            <select name="is_to_all">
	            <!-- selected="selected" -->
	              <option value="0">发送所有关注用户 </option>
	              <option value="1">发送给群组 </option>
	              <option value="2">发送给用户</option>
	            </select>
	          </div>
	        </div>
	      	<div class="form-item cf">
	          <label class="item-label">消息类型<span class="check-tips"> </span></label>
	          <div class="controls">
	            <select name="type">
	              <option value="news">图文消息 </option>
	              <option value="mult">多图文消息</option>
	              <option value="text">文本消息</option>
	              <!-- <option value="image">图片消息</option> -->
	            </select>
	          </div>
	        </div>
	        <div class="content_text">
		        <include file="./Addons/CustomReply/View/default/SendingMsg/text.php" />
        	</div>
        	<div class="content_news">
       			<include file="./Addons/CustomReply/View/default/SendingMsg/news.php" />
        	</div>
        	<div class="content_image">
		        <include file="./Addons/CustomReply/View/default/SendingMsg/image.php" />
        	</div>
        	<div class="content_mult fl" style="width:100%">
		        <include file="./Addons/CustomReply/View/default/SendingMsg/mult.php" />
        	</div>
            <div class="form-item cf">
                <button class="btn submit-btn" style="margin-top:15px;" id="submit" type="submit" target-form="form-horizontal">保 存</button>
            </div>
        </div>
      </form>
    </section>
  </div>
</block>
<block name="script"> 
  <script type="text/javascript" src="__STATIC__/jquery.dragsort-0.5.1.min.js"></script> 
  <script type="text/javascript">
$(function(){
	$('.submit-btn').click(function(){
		$('.title input').remove();
	});
	var type = $('[name=type]').val();
	switch(type){
		case "news":
			$('.content_news').show();
			$('.content_image').hide();
			$('.content_mult').hide();
			$('.content_text').hide();
			break;
		case "image":
			$('.content_image').show();
			$('.content_news').hide();
			$('.content_mult').hide();
			$('.content_text').hide();
			break;
		case "mult":
			$('.content_mult').show();
			$('.content_news').hide();
			$('.content_image').hide();
			$('.content_text').hide();
			break;
		case "text":
			$('.content_text').show();
			$('.content_news').hide();
			$('.content_mult').hide();
			$('.content_image').hide();
			break;
	}
	//搜索功能
	$("#search").click(function(){ seach();	});
    //回车自动提交
    $('.search-form').find('input').keyup(function(event){
        if(event.keyCode===13){
            $("#search").click();
        }
    });
	$('[name=type]').change(function(){
		var type = $('[name=type]').val();
	    $("[name=type]").find("option[value='"+ type +"']").attr("selected",true); 
	    $("[name=type]").find("option[value!='"+ type +"']").attr("selected",false); 
		switch(type){
			case "news":
				$('.content_news').show();
				$('.content_image').hide();
				$('.content_mult').hide();
				$('.content_text').hide();
				break;
			case "image":
				$('.content_image').show();
				$('.content_news').hide();
				$('.content_mult').hide();
				$('.content_text').hide();
				break;
			case "mult":
				$('.content_mult').show();
				$('.content_news').hide();
				$('.content_image').hide();
				$('.content_text').hide();
				break;
			case "text":
				$('.content_text').show();
				$('.content_news').hide();
				$('.content_mult').hide();
				$('.content_image').hide();
				break;
		}
	});
	dragsort();
})
</script> 
</block>
