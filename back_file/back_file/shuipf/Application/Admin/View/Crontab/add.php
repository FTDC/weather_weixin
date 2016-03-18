<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">模型属性</div>
  <form action="{:U("add")}" method="post" class="J_ajaxForm" >
    <div class="table_full">
      <table width="100%" class="table_form">
        <tr>
          <th width="120">名称：</th>
          <td class="y-bg"><input type="text" class="input" name="name" id="name" size="30" value=""/></td>
        </tr>
        <tr>
          <th>名称规则：</th>
          <td class="y-bg"><input type="text" class="input" name="namerule" id="namerule" size="30" value=""/>(Y四位数年 m月 d日 H24小时制 h 12小时制 i 小时)</td>
        </tr>
        <tr>
          <th>采集时间间隔：</th>
          <td class="y-bg"><input type="text" class="input" name="second" id="second" size="30"  value=""/>秒</td>
        </tr>
        <tr>
          <th>采集地址：</th>
          <td class="y-bg"><input type="text" class="input" name="path" id="path" size="30" value=""/></td>
        </tr>
        <tr>
          <th>采集的方法：</th>
          <td class="y-bg"><input type="text" class="input" name="action" id="action" size="30" value=""/></td>
        </tr>
        <tr>
          <th>状态：</th>
          <td class="y-bg"><input name="status" id="status" value="1" type="radio" checked="">开启<input name="status" id="status" value="0" type="radio" checked="">关闭</td>
        </tr>
      </table>
    </div>
    <div class="">
      <div class="btn_wrap_pd">
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">添加</button>
      </div>
    </div>
  </form>
</div>
<script src="{$config_siteurl}/statics/js/common.js"></script>
</body>
</html>