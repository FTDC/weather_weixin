<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />

<script type="text/javascript" src="{$config_siteurl}/statics/DatePicker/WdatePicker.js"></script>

<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
 	<Admintemplate file="Common/Nav"/>
    <div class="lsList" style="background:#fff;">
    <form enctype="multipart/form-data" id="myform" class="J_ajaxForm" method="post" action="">
    <div class="clearfix">
        <ul class="fl lsList_ul">
          
            <li>
                <span>姓名</span>
                <input name="username" type="text"  class="listText_02" />
            </li>
            
            <li>
                <span>手机号</span>
                <input name="phone" type="text" class="listText_02" />
            </li>
          
            
            <li>
                <input type="submit" value="确&nbsp;定" class="listBtn" />
            </li>
        </ul>
    </div>
    </form>
	</div>
</div>
</body>
	
</html>
