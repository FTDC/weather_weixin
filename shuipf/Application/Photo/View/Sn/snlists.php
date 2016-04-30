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
                <th width="5%" >SN码</th>
                <th width="10%" >昵称</th>
                <if condition="!empty($show)">
                <th width="10%" >奖项</th>
                </if>
                <th width="10%" >创建时间</th>
                <th width="10%" >是否已使用</th>
                <th width="8%" >使用时间</th>
                <th width="10%" >操作</th>
            </tr>
        </thead>
            <tbody>
              <tr>
              	  <foreach name="list" item="vo">
                      <td>{$vo.sn}</td>
                      <if condition="$vo.uid gt 0 ">
                      <td>{$vo.uid|getUid}(测试)</td>
                      <else />
                       <td>{$vo.user_id|getUserId}</td>
                      </if>
                      <if condition="!empty($show)">
                      <td>{$vo.prize_title}</td>
                      </if>
                      <td> {$vo.cTime|date="Y-m-d",###}</td>
                      <td>
                      <if condition="$vo.is_use eq 1 ">
                      	已使用
                      <else />
                      	未使用
                      </if>
                      </td>
                      <td>
                      <if condition="$vo.is_use eq 1 ">
                      {$vo.use_time|date="Y-m-d",###}
                      </if>
                      </td>
                      <td>
                      	<a target="_self" href="{:U('Sn/del',array('id'=>$vo['id']))}">删除</a>
                      	<a target="_self" href="{:U('Sn/set_use',array('id'=>$vo['id']))}">改变使用状态</a>
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