<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
  <Admintemplate file="Common/Nav"/>
  <div class="h_a">附件配置</div>
  <div class="table_full">
    <form method='post'   id="myform" class="J_ajaxForm"  action="{:U('Config/attach')}">
      <table cellpadding=0 cellspacing=0 width="100%" class="table_form" >
      <tr>
        <th width="140">FTP服务器地址:</th>
        <th><input type="text" class="input" name="caiji_ftphost" id="caiji_ftphost" size="30" value="{$Site.caiji_ftphost}"/> FTP服务器端口: <input type="text" class="input" name="caiji_ftpport" id="caiji_ftpport" size="5" value="{$Site.caiji_ftpport}"/></th>
      </tr>
<!--      <tr>-->
<!--        <th width="140">FTP上传目录:</th>-->
<!--        <th><input type="text" class="input" name="ftpuppat" id="ftpuppat" size="30" value="{$Site.ftpuppat}"/> -->
<!--        <span class="gray">"/"表示上传到FTP根目录</span></th>-->
<!--      </tr>-->
<!--      <tr>-->
<!--        <th width="140">FTP用户名:</th>-->
<!--        <th><input type="text" class="input" name="ftpuser" id="ftpuser" size="20" value="{$Site.ftpuser}"/></th>-->
<!--      </tr>-->
<!--      <tr>-->
<!--        <th width="140">FTP密码:</th>-->
<!--        <th><input type="password" class="input" name="ftppassword" id="ftppassword" size="20" value="{$Site.ftppassword}"/></th>-->
<!--      </tr>-->
      <div class="btn_wrap">
        <div class="btn_wrap_pd">
          <button class="btn btn_submit mr10 J_ajax_submit_btn" type="submit">提交</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script>
$(function(){
	//水印位置
	$('#J_locate_list > li > a').click(function(e){
		e.preventDefault();
		var $this = $(this);
		$this.parents('li').addClass('current').siblings('.current').removeClass('current');
		$('#J_locate_input').val($this.data('value'));
	});
});
</script>
</body>
</html>