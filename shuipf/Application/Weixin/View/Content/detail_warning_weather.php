<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo $info['disastertype'];?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="{$config_siteurl}/statics/assets/i/favicon.png">
    <link rel="stylesheet" href="{$config_siteurl}/statics/assets/css/amazeui.css"/>
    <style>
        @media only screen and (min-width: 641px) {
            .am-offcanvas {
                display: block;
                position: static;
                background: none;
            }

            .am-offcanvas-bar {
                position: static;
                width: auto;
                background: none;
                -webkit-transform: translate3d(0, 0, 0);
                -ms-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            .am-offcanvas-bar:after {
                content: none;
            }

        }

        @media only screen and (max-width: 640px) {
            .am-offcanvas-bar .am-nav>li>a {
                color:#ccc;
                border-radius: 0;
                border-top: 1px solid rgba(0,0,0,.3);
                box-shadow: inset 0 1px 0 rgba(255,255,255,.05)
            }

            .am-offcanvas-bar .am-nav>li>a:hover {
                background: #404040;
                color: #fff
            }

            .am-offcanvas-bar .am-nav>li.am-nav-header {
                color: #777;
                background: #404040;
                box-shadow: inset 0 1px 0 rgba(255,255,255,.05);
                text-shadow: 0 1px 0 rgba(0,0,0,.5);
                border-top: 1px solid rgba(0,0,0,.3);
                font-weight: 400;
                font-size: 75%
            }

            .am-offcanvas-bar .am-nav>li.am-active>a {
                background: #1a1a1a;
                color: #fff;
                box-shadow: inset 0 1px 3px rgba(0,0,0,.3)
            }

            .am-offcanvas-bar .am-nav>li+li {
                margin-top: 0;
            }
        }

        .my-head {
            margin-top: 40px;
            text-align: center;
        }

        .my-button {
            position: fixed;
            top: 0;
            right: 0;
            border-radius: 0;
        }
        .my-sidebar {
            padding-right: 0;
            border-right: 1px solid #eeeeee;
        }

        .my-footer {
            border-top: 1px solid #eeeeee;
            padding: 10px 0;
            margin-top: 10px;
            text-align: center;
            background: whitesmoke;
        }
        .am-g-fixed p img{
            width: 100%;
        }
        .am-g {
            overflow: hidden;
        }
    </style>
</head>
<body>
<header class="am-g my-head">
    <div class="am-u-sm-12 am-article">
        <h1 class="am-article-title"><?php echo $info['disastertype'];?>预警信息</h1>
        <p class="am-article-meta"><?php echo  $info['title']?> 时效性:<?php echo  $info['deadtime']?>小时</p>
    </div>
</header>
<hr class="am-article-divider"/>
<div class="am-g am-g-fixed">
    <div class=" ">
        <div class="am-g">
            <div class="am-u-sm-11 am-u-sm-centered">
                <div class="am-cf am-article"><?php echo  $info['content'];?></div>
                <div class="am-cf am-article"><?php echo  $info['prevent'];?></div>
            </div>
        </div>
    </div>
    <div class="am-mian-bg" ><img src="{$config_siteurl}/statics/topic/index_bg.png" alt="" width="100%"></div>
</div>
<footer class="my-footer">
    <p>湖北气象<br><small>© Copyright Hubei Meteorology 2015</small></p>
</footer>

</body>
</html>
