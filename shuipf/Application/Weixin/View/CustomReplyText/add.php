<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />

<body>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <div class="lsList">
    <form id="myform" class="J_ajaxForm" method="post" action="{:U(CustomReplyText/add)}">	 

<div class="table_full">
      <table width="100%">
        <tbody><tr>
          <th width="100"><em>*</em>关键词</th>
          <td><input  name="keyword" type="text" value="" class="listText" /></td>
        </tr>
        <tr>
          <th width="100"><em>*</em>关键词类型</th>
          <td>
          <select name="keyword_type">
                <option selected="" value="0">完全匹配 </option>
                <option value="1">左边匹配 </option>
                <option value="2">右边匹配 </option>
                <option value="3">模糊匹配 </option>
            </select>
            </td>
        </tr> 
        <tr>
          <th width="100"><em>*</em>回复内容</th>
          <td>
         <textarea name="content" rows="2" cols="20" style="height:100px;width:500px;"></textarea>
            </td>
        </tr>
        <tr>
          <th width="100"><em>*</em>排序号</th>
          <td>
         <input class="listText" type="text" value="0" name="sort">
            </td>
        </tr> 
      </tbody></table>      
    </div>
<div class="">
      <div class="btn_wrap_pd">
       <input type="submit" value="确&nbsp;定" class="listBtn btn btn_submit mr10" />
      </div>
    </div>



    </form>
</div> 

</div>
</body>
</html>
