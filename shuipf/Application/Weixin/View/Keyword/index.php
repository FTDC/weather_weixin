<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
 <link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
  
   
   <div class="zj_lqq">
	   <a id="del" href="javascript:void(0);" >删除</a>
	   <div class="search-form fr cf">
			<form id="myform" class="J_ajaxForm" method="post" action="{:U('Keyword/index')}">
			<div class="sleft">
				<input class="lsText" type="text" placeholder="请输入关键字" value="" name="username">
				<input type="button" value="搜索" class="lsButton"/>
			</div>
			</form>
		</div>
	</div>
   <div class="table_list">
   <form id="delform" class="J_ajaxForm" method="post" action="{:U('Keyword/del')}">
  <table width="100%" cellspacing="0">
     	<thead>
        	<tr>
        		<th width="5%"><input type="checkbox" onclick="checkAll(this)"></th>
                <th width="5%" >编号</th>
                <th width="10%" >关键词</th>
                <th width="10%" >所属内容</th>
                <th width="10%" >数据ID</th>
                <th width="10%" >增加时间</th>
                <th width="8%" >请求数</th>
                <th width="10%" >操作</th>
            </tr>
        </thead>
            <tbody>
              <tr>
              	  <foreach name="list" item="vo">
              	  	<td><input class="checkbox" type="checkbox" value="{$vo.id}"></td>
                      <td>{$vo.id}</td>
                      <td>{$vo.keyword}</td>
                      <td>{$vo.addon}</td>
                      <td>{$vo.aim_id}</td>
                      <td> {$vo.cTime|date="Y-m-d",###}</td>
                      <td>{$vo.request_count}</td>
                      <td>
                      	<a target="_self" href="{:U('Keyword/del',array('id'=>$vo['id']))}">删除</a>
                      </td>
                  </tr><tr>
                  </foreach>
             </tr>            
          </tbody>
     </table>
     </form>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
   </div>
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script type="text/javascript">
$("#del").live('click',function(){
	$(".checkbox").each(function() {
		if($(this).is(":checked")){
			$(this).attr('name','id[]');
		}
	});
	$('#delform').submit();
});
function checkAll(obj){
	$('.checkbox').attr('checked',obj.checked);
}

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