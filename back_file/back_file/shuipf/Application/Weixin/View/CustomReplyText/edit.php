<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />

<body>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <div class="lsList">
    <form class="J_ajaxForm" action="{:U('CustomReplyText/edit')}" method="post" id="myform">
   	<input type="hidden" name="id" value="{$data.id}"/> 
    <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80"><em style="color:red">*</em>关键词</th>
            <td><input  name="keyword" type="text" value="{$data.keyword}" class="listText" /></td>
          </tr> 
           <tr>
            <th width="80"><em style="color:red">*</em>关键词类型</th>
            <td>
                 <select name="keyword_type">
                     <option {$data['selected_0']} value="0">完全匹配</option>
                     <option {$data['selected_1']} value="1">左边匹配</option>
                     <option {$data['selected_2']} value="2">右边匹配</option>
                     <option {$data['selected_3']} value="3">模糊匹配</option>
                 </select>
            </td>
          </tr>
           <tr>
            <th width="80"><em style="color:red">*</em>回复内容</th>
            <td>
                 <textarea name="content" style="width:500px;height:150px;">{$data.content}</textarea>
            </td>
          </tr>
           <tr>
            <th width="80"><em style="color:red">*</em>排序号</th>
            <td>
             <input class="listText" type="text" value="{$data.sort}" name="sort">
            </td>
          </tr>
        </tbody>
      </table>
   </div>
    <div class="btn_wrap">
      <div class="btn_wrap_pd">             
        <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">确&nbsp;定</button>
      </div>
    </div>
    </form>
</div>
</div>
</body>
</html>
