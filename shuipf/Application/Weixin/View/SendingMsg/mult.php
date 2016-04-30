    <div class="fl" style="width:50%;">
      <div class="table-bar" style="margin:0">
        <div class="fl">
          <select name="cate" id="cate_select" style="width:150px; height:30px; line-height:30px; padding:0; margin-bottom:0">
            <option value="0" >全部分类</option>
            <volist name="weisite_category" id="vo"> <option value="{$vo.id}" <if condition="$_GET[cate_id]==$vo[id]">selected="selected"</if>>{$vo.title}
              </option>
            </volist>
          </select>
        </div>
      </div>
      
      <!-- 数据列表 -->
      <div class="data-table fl" style=" margin:0; width:100%">
        <div class="table-striped">
          <table cellpadding="0" cellspacing="1">
            <!-- 表头 -->
            <thead>
              <tr>
                <th width="70%">标题</th>
				<th width="20">封面图片</th>
                <th width="10">操作</th>
              </tr>
            </thead>
            
            <!-- 列表 -->
            <tbody class="list_data">
              <volist name="list_data" id="vo">
                <tr>
                  <td id="news_{$vo.id}" class="title">{$vo.title}
                    <input type="hidden" value="{$vo.id}" name="ids[]"></td>
					<td class="cover">{$vo.cover|get_img_html}</td>
                  <td><a href="javascript:void(0);" onClick="select_news({$vo.id})">选择</a></td>
                </tr>
              </volist>
            </tbody>
          </table>
        </div>
        <div class="page"> {$_page|default=''} </div>
      </div>
      </div>
        <ul class="weixin-muti-preview fr" id="select_news">
         <volist name="select_news" id="vo">
        	<li class="sltr select-item" id="select_tr_{$vo.id}" rel="{$vo.id}">
            	<input type="hidden" name="ids[]" value="{$vo.id}">
            	<div>
                	<p>{$vo.title}</p>
                    <div class="cover">{$vo.cover|get_img_html}</div>
                    <a class="del" onclick="del_news({$vo.id})" href="javascript:void(0);">删除</a>
                </div>
            </li>
          </volist>
        </ul>
<block name="script"> 
<script type="text/javascript">
function select_news(id){
	var count = 0;
	var isExist = false;
	$('.sltr').each(function() { 
	   if( $(this).attr('rel')==id )  {
		   isExist = true;
	   }
	   count +=1;
	});
	if(isExist){
		return false;
	}	
	if(count>=9){
	    alert('同时最多不能超过9个');	
		return false;
	}
	
	var title = $('#news_'+id).parent().find('.title').html();
	var cover = $('#news_'+id).parent().find('.cover').html();
	html = '<li class="sltr select-item" rel="'+id+'" id="select_tr_'+id+'">'+
			'<p>'+title+'</p>'+
                    '<div class="cover">'+cover+'</div>'+
                    '<a class="del" onclick="del_news('+id+')" href="javascript:void(0);">删除</a>'+
					'</li>';
	
	$('#select_news').append(html);
	dragsort();
}
function del_news(id){
	var html = $('#select_tr_'+id).remove();
	dragsort();
}
function dragsort(){
	$("#select_news").dragsort({
          itemSelector: "li", dragSelector: "li", dragBetween: true
	 });
	/* var lisize = $("#select_news li").size();	
	 var height=0;
	 for(var i=0;i<lisize;i++){
		 height = height + $("#select_news li").eq(i).height()+20;
		 }
	 $('#select_news').height(height);*/
}
function seach(){
	var url = $("#search").attr('url');
	var query  = $('.search-form').find('input').serialize();console.log(query);
	query = query.replace(/(&|^)(\w*?\d*?\-*?_*?)*?=?((?=&)|(?=$))/g,'');console.log(query);
	query = query.replace(/^&/g,'');console.log(query);
	
	var cate_id = $("#cate_select").val();
	query += '&cate_id='+cate_id;
	
	if( url.indexOf('?')>0 ){
		url += '&' + query;
	}else{
		url += '?' + query;
	}
	window.location.href = url;	
}
$(function(){
	//搜索功能
	$("#search").click(function(){ seach();	});

    //回车自动提交
    $('.search-form').find('input').keyup(function(event){
        if(event.keyCode===13){
            $("#search").click();
        }
    });
	$('.select-item').hover(function(){
		$(this).find('.del').show();
		},function(){
			$(this).find('.del').hide();
			});
	dragsort();
})
</script> 
</block>
