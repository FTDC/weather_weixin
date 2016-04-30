22
<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
   <div class="table_list">
  <table width="100%" cellspacing="0">
     	<thead>
        	<tr>
                <th width="5%" >粉丝编号</th>
                <th width="10%" >OpenId</th>
                <th width="10%" >昵称</th>
                <th width="10%" >性别</th>
                <th width="8%" >关注时间</th>
                <th width="10%" >操作</th>
            </tr>
        </thead>
            <tbody>
              <tr>
              	  <foreach name="list" item="vo">
                      <td>{$vo.id}</td>
                      <td>{$vo.openid}</td>
                      <td>{$vo.nickname}</td>
                      <if condition="$vo['sex'] eq 1">
                      <td>男</td>
                      <elseif condition="$vo['sex'] eq 2" />
                      <td>女</td>
                      <else />
                      <td>保密</td>
                      </if>
                      <td>
                       <if condition="$vo['subscribe_time'] gt 1">
                      {$vo.subscribe_time|date="Y-m-d",###}
                      </if>
                      </td>
                      <td>
                      	<a target="_self" href="{:U('UserCenter/edit',array('id'=>$vo['id']))}">编辑</a>
                      	<a target="_self" href="{:U('UserCenter/del',array('id'=>$vo['id']))}">删除</a>
                      </td>
                  </tr><tr>
                  </foreach>
             </tr>            
          </tbody>
     </table>
      <div class="p10">
        <div class="pages"> {$Page} </div>
      </div>
   </div>
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script type="text/javascript">
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