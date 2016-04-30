<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
<link href="{$config_siteurl}/statics/css/Base.css" rel="stylesheet" />
<div class="lsList">
<form name="myform" class="J_ajaxForm" action="{:U('edit')}&id={$info[id]}" method="post">  
<div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80"><em style="color:red">*</em>排序号</th>
            <td><input type="text" name="sort" value="{$info.sort}" class="listText" style="width:50px;text-align:center;"/></td>
          </tr>
          <tr>
            <th><em style="color:red">*</em>一级菜单</th>
            <td>  <select name="pid" class="listSel">
<<<<<<< .mine
=======
                <option value="{$currently_c.id}">{$currently_c['title']}</option>
>>>>>>> .r345
                <option value="0">无</option>
                <volist name="category" id="vo">
                <if condition="$vo['id'] neq $info['id'] && $info['pid'] neq $vo['id']">
                <option value="{$vo.id}">{$vo.title}</option>
                </if>
                </volist>
            </select> <i>（如果是一级菜单，选择“无”即可）</i></td>
          </tr>
          <tr>
            <th><em style="color:red">*</em>菜单名</th>
            <td><input type="text" name="title" value="{$info.title}" class="listText" /><i>（可创建最多 3 个一级菜单，每个一级菜单下可创建最多 5 个二级菜单。编辑中的菜单不会马上被用户看到，请放心填写）</i></td>
          </tr>
          <tr>
            <th>关联关键词</th>
            <td><input name="keyword" type="text" value="{$info.keyword}" class="listText" /><i>(关联关键词与URL选填一项)</i></td>
          </tr>
          <tr>
            <th>关联URL</th>
            <td><input name="url" type="text" value="{$info.url}" class="listText" /> <i>(关联关键词与URL选填一项)</i></td>
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
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
</body>
</html>

<script type="text/javascript">
	 $(function () {
            $("#up").uploadPreview({ Img: "ImgPr", Width: 120, Height: 120 });
        });
</script>
<script type="text/javascript">
	$(function(){
		$(".lsList_a").click(function(){
			$(".listFile").click();
			return false;
		});
	})
</script>