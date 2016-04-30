<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
   <Admintemplate file="Common/Nav"/>
   <link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
   <div class="table_list" style="border-top:0px none;">
       <div class="top_title">
           <span class="float_right">共<span style="color:#FF0000;">{$total_count}</span>人关注</span>
           <!--<a href="javascript:$.RefreshPage();" class="float_right">刷新</a>-->关注用户管理
       </div>
  <table width="100%" cellspacing="0">
     	<thead>
        	<tr>
                <td width="5%" >图像</td>
                <td width="10%" >OpenId</td>
                <td width="10%" >昵称</td>
                <td width="10%" >性别</td>
                <td width="8%" >关注时间</td>
                <td width="10%" >地区</td>
            </tr>
        </thead>
            <tbody>
              <tr>
              	  <foreach name="userlists" item="vo" key="key">
                      <td><img src="{$vo.headimgurl}" height="25" width="25"/> </td>
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
                          {$vo.city}/{$vo.province}
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