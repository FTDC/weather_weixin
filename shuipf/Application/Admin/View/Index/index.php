<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Xenon Boostrap Admin Panel"/>
    <meta name="author" content=""/>

    <title>湖北气象微信互动平台</title>
    <link rel="stylesheet" href="{$config_siteurl}/statics/assets/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/assets/css/xenon-core.css">
    <script src="{$config_siteurl}/statics/assets/js/jquery-1.11.1.min.js"></script>
</head>
<body class="page-body">
<div class="head-top">
    <div class="lef">
        <span></span> <em></em>
    </div>
    <div class="rig">
        <!-- User Info, Notifications and Menu Bar -->
        <nav class="navbar user-info-navbar" role="navigation">
            <!-- Right links for user info navbar -->
            <ul class="user-info-menu right-links list-inline list-unstyled">
                <li class="dropdown user-profile">
                    <a target="mainContent" href="{:U('Adminmanage/myinfo')}" data-toggle="dropdown">
                        <img src="{$config_siteurl}/statics/assets/images/user.png" alt="user-image" class="img-circle img-inline userpic-32" width="16"/>
                        <span>用户：{$userInfo.username}</span>
                    </a>
                </li>
                <li class="dropdown user-profile">
                    <a href="#" data-toggle="dropdown">
                        <img src="{$config_siteurl}/statics/assets/images/time.png" alt="user-image" class="img-circle img-inline userpic-32" width="21"/>
                        <span>登录时间：{$userInfo.last_login_time|date="Y-m-d H:i",###}</span>
                    </a>

                </li>

            </ul>
            <ul class="user-info-menu right-links list-inline list-unstyled user-info-menu-btn">
                <li class="dropdown user-profile edit-password">
                    <a target="mainContent" href="{:U('Adminmanage/chanpass')}" data-toggle="dropdown"></a>
                </li>
                <li class="dropdown user-profile exit">
                    <a href="{:U('Public/logout')}" data-toggle="dropdown"></a>
                </li>
            </ul>

        </nav>
    </div>
</div>
<div>
    <div class="sidebar-menu toggle-others fixed">
        <div class="sidebar-menu-inner">
            <header class="logo-env"></header>
            <ul id="main-menu" class="main-menu">
                <li class="main-menu-item1 active opened">
                    <a href="{:U('Management/manager')}" target="mainContent">
                        <i class="linecons-cog"></i>
                        <span class="title">用户管理</span>
                    </a>
                    <ul>
                        <li class="active main-menu-item2">
                            <a target="mainContent" href="{:U('Logs/index')}">
                                <span class="title">操作日志</span>
                            </a>
                        </li>
                        <li class="main-menu-item2">
                            <a target="mainContent" href="{:U('Logs/loginlog')}">
                                <span class="title">登录日志</span>
                            </a>
                        </li>
                        <li class="main-menu-item2">
                            <a target="mainContent" href="{:U('Weixin/UserCenter/index')}">
                                <span class="title">关注用户</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a target="mainContent" href="{:U('Weixin/CustomMenu/lists')}"> <i class="linecons-desktop"></i>
                        <span class="title">菜单管理</span>
                    </a>
                </li>
                <li style="display:none;">
                    <a target="mainContent" href="javascript:void(0);">
                        <i class="linecons-mail"></i>
                        <span class="title">消息管理</span>
                    </a>
                    <ul>
                        <li target="mainContent" class="main-menu-item2">
                            <a target="mainContent" href="{:U('Weixin/SendingMsg/lists')}">
                                <span class="title">消息群发</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a target="mainContent" href="{:U('Content/Content/index',array('menuid'=>65))}">
                        <i class="linecons-cloud"></i>
                        <span class="title">科普馆管理</span>
                    </a>
                    <ul>
                        <li target="mainContent" class="active main-menu-item2">
                            <a target="mainContent" href="{:U('Content/Category/index',array('menuid'=>47))}">
                                <span class="title">栏目管理</span>
                            </a>
                        </li>
                        <li  target="mainContent" class="main-menu-item2">
                            <a target="mainContent" href="{:U('Content/Content/index',array('menuid'=>65))}">
                                <span class="title">专题列表 </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a target="mainContent" href="javascript:void(0);">
                        <i class="linecons-globe"></i>
                        <span class="title">自定义回复</span>
                    </a>
                    <ul>
                        <li target="mainContent" class="active main-menu-item2">
                            <a target="mainContent" href="{:U('Weixin/CustomReplyText/textlists')}">
                                <span class="title">文本回复</span>
                            </a>
                        </li>
                        <li class="main-menu-item2" style="display:none;">
                            <a target="mainContent" href="{:U('Weixin/CustomReply/multlists')}">
                                <span class="title">图文回复</span>
                            </a>
                        </li>
                        <li target="mainContent" class="main-menu-item2" style="display:none;">
                            <a target="mainContent" href="{:U('Weixin/CustomReplyMult/multlists')}">
                                <span class="title">多图文回复</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a target="mainContent" href="{:U('Weixin/weather/tucao')}"> <i class="linecons-desktop"></i>
                        <span class="title">天气吐槽</span>
                    </a>
                </li>
                <li>
                    <a target="mainContent" href="{:U('Photo/index')}"> <i class="linecons-desktop"></i>
                        <span class="title">实景天气</span>
                    </a>
                </li>
                <li>
                    <a target="mainContent" href="{:U('Config/index',array('menuid'=>8))}">
                        <i class="linecons-star"></i>
                        <span class="title">系统设置</span>
                    </a>
                    <ul>
                        <li target="mainContent" class="active main-menu-item2">
                            <a target="mainContent" href="{:U('Rbac/rolemanage')}">
                                <span class="title">权限管理</span>
                            </a>
                        </li>
                        <li  target="mainContent" class="main-menu-item2">
                            <a target="mainContent" href="{:U('Crontab/index')}">
                                <span class="title">采集管理 </span>
                            </a>
                        </li>
                        <li  target="mainContent" class="main-menu-item2">
                            <a target="mainContent" href="{:U('Content/Models/index', array('menuid'=>54))}">
                                <span class="title">模型管理 </span>
                            </a>
                        </li>
                        <li target="mainContent" class="main-menu-item2">
                            <a target="mainContent" href="{:U('cache')}">
                                <span class="title">缓存更新</span>
                            </a>
                        </li>
                    </ul>
                </li>
<!--                <li>-->
<!--                    <a target="mainContent" href="javascript:void(0);">-->
<!--                    <a target="mainContent" href="{:U('Weixin/source/index')}">-->
<!--                        <i class="linecons-star"></i>-->
<!--                        <span class="title">素材管理</span>-->
<!--                    </a>-->
<!--                </li>-->
            </ul>

        </div>

    </div>

    <iframe src="{$config_siteurl}/shuipf/Application/Admin/View/Index/main.php"  style="float:right; min-height:700px; " frameborder="0" id="B_frame" name="mainContent"></iframe>
</div>

<script type="text/javascript">
     var w_h=$(window).height(),w_w=$(window).width();
     

      $(window).resize(function() {

           w_h=$(window).height(),w_w=$(window).width();
          $("iframe[name='mainContent']").css({"height":(w_h-126)+"px","width":(w_w-260-20)+"px"}); 
           
        });

    $(function () {
          $("iframe[name='mainContent']").css({"height":(w_h-126)+"px","width":(w_w-260-20)+"px"}) ; 

        siderH();
        $('#main-menu li').click(function () {
            var css = "main-menu-item1 active opened";
            $('#main-menu .main-menu-item1').removeClass(css);
            $(this).addClass(css);

            siderH();


        });
    })

    function siderH(){ //侧边栏高度

        var w_h=$(window).height();
        var s_h=$(".sidebar-menu").height();
        if((s_h+126)>=w_h)
        {
            return;
        }
        else{

           $(".sidebar-menu").height(w_h-126);
        }

    }
</script>
</body>
</html> 