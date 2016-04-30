<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
<script src="{$config_siteurl}/statics/js/wind.js"></script>
<link href="{$config_siteurl}/statics/js/artDialog/skins/default.css" rel="stylesheet" />
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <div class="lsList">
    <form enctype="multipart/form-data" id="myform" class="J_ajaxForm" method="post" action="{:U(CustomReplyText/add)}"> 
    <div class="table_full">
   <table width="100%" class="table_form contentWrap">
        <tbody>
          <tr>
            <th width="80"><em style="color:red">*</em>关键词</th>
            <td><input  name="keyword" type="text" value="" class="listText" /></td>
          </tr> 
          <tr>
            <th width="80"><em style="color:red">*</em>关键词类型</th>
            <td>
              <select name="keyword_type">
                <option selected="" value="0">完全匹配</option>
                <option value="1">左边匹配</option>
                <option value="2">右边匹配</option>
                <option value="3">模糊匹配</option>
              </select>
            </td>
          </tr> 
          <tr>
            <th width="80"><em style="color:red">*</em>标题</th>
            <td> <input  name="title" type="text" value="" class="listText" /></td>
          </tr> 
          <tr>
            <th width="80">简介</th>
            <td><textarea class="zj_desn" style="width:500px;height:150px;" name="intro"></textarea></td>
          </tr> 
          <tr>
            <th width="80">封面图片</th>
            <td> <a href="#" class="lsList_a cover"><img id="cover" src="{$config_siteurl}/statics/images/wx/btn_01.png" /></a>
              <input type="file" name="cover" class="listFile cover_up"  />
              <i>(可为空)</i></td>
          </tr> 
          <tr>
            <th width="80">内容</th>
            <td>
 <div id='content_tip'></div><script  style="line-height:none;height:250px;" type="text/plain" id="content" name="content"><p></p></script>
                <script type="text/javascript">
                //编辑器路径定义
                var editorURL = GV.DIMAUB;
                </script>
                <script type="text/javascript"  src="{$config_siteurl}/statics/js/ueditor/ueditor.config.js"></script>
                <script type="text/javascript"  src="{$config_siteurl}/statics/js/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript">
         var editorcontent = UE.getEditor('content',{  
                            textarea:'content',
                            elementPathEnabled:false,
                            toolbars:[[
            'fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
            'print', 'preview', 'searchreplace', 'help', 'drafts'
        ]],
                            autoHeightEnabled:false
                      });
                      editorcontent.ready(function(){
                            editorcontent.execCommand('serverparam', {
                                  'catid': '14',
                                  '_https':'/',
                                  'isadmin':'1',
                                  'module':'Content',
                                  'uid':'1',
                                  'groupid':'0',
                                  'sessid':'1408349596',
                                  'authkey':'15f43b911fc66cea5c9da69de9bbf703',
                                  'allowupload':'1',
                                  'allowbrowser':'1',
                                  'alowuploadexts':''
                             });
                             editorcontent.setHeight(300);
                      });
                      
    </script>
            </td>
          </tr> 
          <tr>
            <th width="80"><em style="color:red">*</em>排序号</th>
            <td> <input class="listText" type="text" value="0" name="sort"></td>
          </tr> 
          <tr>
            <th width="80"><em style="color:red">*</em>外链</th>
            <td><input class="listText" type="text" value="" name="jump_url"></td>
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
</body>
<script>
$(function () {
 	$(".cover_up").uploadPreview({ Img: "cover", Width: 120, Height: 120,Callback: function () { 
			$('#show_img').attr('src',$('#cover').attr('src'));
     	} });
 });
$(function(){
	$(".cover").click(function(){
		$(".cover_up").click();
		return false;
	});
})

</script>
</html>
