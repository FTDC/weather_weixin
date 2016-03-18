<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <div class="table_list">
  <table width="100%" cellspacing="0">
     	<thead>
        	<tr>
                <td width="30%">标题</td>                
                <td width="20%" >图片</td>
                <td width="10%" >操作</td>
            </tr>
        </thead>
            <tbody>
              <tr>
              	  <foreach name="list" item="vo">
              	  <td>{$vo.title}</td>
                  <td>{$vo.cover}</td>
                  <td><a class="choose" target="_self" href="javascript:void(0);">选择</a><input type="hidden" value="{$vo.id}"/></td>
                  </tr><tr>
                  </foreach>
             </tr>            
          </tbody>
     </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
      
       <div class="lsList">
    <form id="myform" class="J_ajaxForm" method="post" action="{:U(CustomReplyMult/add)}">
	<input type="hidden" name="mult_ids" value=""/> 
     <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80"><em style="color:red">*</em>关键词</th>
            <td> <input  name="keyword" type="text" value="" class="listText" /></td>
          </tr>    
           <tr>
            <th width="80"><em style="color:red">*</em>关键词类型</th>
            <td>
              <select name="keyword_type">
                <option  value="0" >完全匹配</option>
                <option  value="1">左边匹配</option>
                <option  value="2">右边匹配</option>
                <option  value="3">模糊匹配</option>
              </select>
            </td>
          </tr>  
        </tbody>
      </table>
   </div>
 <div class="">
   <div class="btn_wrap_pd">
     <input type="submit" value="确&nbsp;定" class="listBtn btn btn_submit mr10"></div>
 </div>

    </form>
</div>
      
   </div>
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script type="text/javascript">
var mult_ids = '';
$(function(){
	$(".choose").live('click',function(){
		var id = $(this).next().val();
		var reg=eval("/"+id+"/");
		var result=reg.exec(mult_ids);
		if(result==null){
			mult_ids += id+","
		}
		alert(mult_ids);
		$("input[name='mult_ids']").val(mult_ids);
	})
})


function generates(genid){
	//生成静态
	if(genid == 1){
		$("#index_ruleid_1").show();
		$("#index_ruleid_1 select").attr("disabled",false);
		$("#index_ruleid_0").hide();
		$("#index_ruleid_0 select").attr("disabled","disabled");
	}else{
		$("#index_ruleid_0").show();
		$("#index_ruleid_0 select").attr("disabled",false);
		$("#index_ruleid_1").hide();
		$("#index_ruleid_1 select").attr("disabled","disabled");
	}
}
</script>
</body>
</html>