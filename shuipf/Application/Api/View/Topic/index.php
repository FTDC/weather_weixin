<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>湖北气象科普窗</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name='apple-touch-fullscreen' content='yes'>
    <meta name="full-screen" content="no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/Public/index/img/startup/apple-touch-icon-57x57-pr.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/Public/index/img/startup/apple-touch-icon-72x72-pr.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/Public/index/img/startup/apple-touch-icon-114x114-pr.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/Public/index/img/startup/apple-touch-icon-144x144-pr.png" />
    <link rel="apple-touch-icon-precomposed" sizes="192x192" href="/Public/index/img/startup/apple-touch-icon-192x192-pr.png" />
    <link rel="apple-touch-startup-image" href="/Public/index/img/startup/startup5.png" media="(device-height:568px)">
    <link rel="apple-touch-startup-image" size="640x920" href="/Public/index/img/startup/startup.png" media="(device-height:480px)">
    <link href="{$config_siteurl}/statics/topic/base5.css?t=<?php echo time();?>" rel="stylesheet" type="text/css">
    <link href="{$config_siteurl}/statics/topic/style.css?t=<?php echo time();?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/assets/css/amazeui.css">
    <script type="text/javascript" src="{$config_siteurl}/statics/js/jquery.js"></script>
    <script src="{$config_siteurl}/statics/topic/common.js?t=<?php echo time();?>"></script>
    <script type="text/javascript">
        var Fromurl = "/index.php?s=/index/message.html";
    </script>
    <script type="text/javascript" src="{$config_siteurl}/statics/topic/touchwipe.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/topic/jquery.jscroll.min.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/topic/TweenMax.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //$('.jscroll').jscroll({
               // loadingHtml: '<span>再来几条</span>',
                //autoTrigger: true,
                //autoTriggerUntil: 2
                //nextSelector:'a.next:last'
            //});
            $(".btn").click(function(){
                $("#dir").hide();
                window.location="/index.php?s=/review/index.html";
            });
        });
        function showDes(el){
            var subcon = $(el).parent().next();
            var status = $(el).parent().next().css("display");

            if ($(document).scrollTop() >= ($(document).height() - $(window).height())) {
                //alert("最后一个")
                var subconH = subcon.height();
                //$(document).scrollTop($(document).height() - $(window).height() + subconH);
                var st = $(document).scrollTop();
                //alert(st);
                $('html, body').animate({
                    scrollTop: st + subconH+30
                }, 500);
            }

            if (status == "block") {
                subcon.fadeOut();
            } else {
                subcon.fadeIn();
            }
        }
    </script>
    <style type="text/css">
        .jscroll-loading { text-align: center;  margin-bottom: 10px; padding: 20px 0; }
        .jscroll-loading span { padding: 5px 0; background: url("{$config_siteurl}/statics/topic/loading.gif") no-repeat left center; padding-left: 25px; color: #999; }
    .dir{
        padding:0;
    }
     .my-footer { 
      padding: 10px 0;
      margin-top: 10px;
      text-align: center;  
    }
    </style>
</head>

<body> 
<div id="index" class="wh"   <notempty name="cate"> style="display: none;"</notempty>>
<!--    <h2 class="tit"><img src="/Public/index/img/logo.png"></h2>-->
    <div class="book book123"><img src="{$config_siteurl}/statics/topic/index.jpg" style="width:100%!important;"></div>
</div>

<!-- <div id="qianyan" class="wh"   <notempty name="cate"> style="display: none;"</notempty>>
     <h2 class="tit"><span></span><span></span><span></span>
    </h2>
    <h2 class="tit2">气象服务五满意</h2>
    <p style="height:100%;background:#bcd9df;vertical-align: middle;margin:0;margin: 0px auto;
     
  display: -webkit-box;
  -webkit-box-orient: horizontal;
  -webkit-box-pack: center;
  -webkit-box-align: center;
  
  display: -moz-box;
  -moz-box-orient: horizontal;
  -moz-box-pack: center;
  -moz-box-align: center;
  
  display: -o-box;
  -o-box-orient: horizontal;
  -o-box-pack: center;
  -o-box-align: center;
  
  display: -ms-box;
  -ms-box-orient: horizontal;
  -ms-box-pack: center;
  -ms-box-align: center;
  
  display: box;
  box-orient: horizontal;
  box-pack: center;
  box-align: center"><img src="{$config_siteurl}/statics/topic/qianyan.png" alt="气象服务五满意" style="margin-top:-205px;"></p>
    <div class="next"><img src="{$config_siteurl}/statics/topic/arrow2.png"></div>
</div> -->

<div id="dir">
    <!--h2 class="tit">
        <a href="/index.php?s=/index.html"><img src="/Public/index/img/logo.png" alt=""></a>
        <a href="javascript:;"><span></span><span></span><span></span></a>
    </h2--> 
    <header data-am-widget="header" class="am-header am-header-default"> 
  <h1 class="am-header-title">目 录</h1>
</header>
    <div class="jscroll">
        <ul class="dir">
            <li class="cf" style="background: '<?php echo $item['image'];?>' ">
                <div class="num">1.</div>
                <div class="titAll">
                    <a href="{:U('Api/Topic/kepuguan')}" class="imgtit"></a>
                    <a href="{:U('Api/Topic/kepuguan')}" class="txtit">科普馆介绍</a>
                </div>
            </li>
            <?php foreach($catelist as $key=>$item){?>
            <li class="cf" style="background: '<?php echo $item['image'];?>' ">
                <div class="num"><?php echo $key+2; ?>.</div>
                <div class="titAll">
                    <a href="{:U('Api/Topic/topiclist', array('catid'=>$item['catid']))}" class="imgtit"></a>
                    <a href="{:U('Api/Topic/topiclist', array('catid'=>$item['catid']))}" class="txtit"><?php echo $item['catname'];?></a>
                    <!-- <p><span>阅读人数：584320</span>工作法 • 开会</p> -->
                </div>
            </li>
            <?php }?>
            </ul>
<!--        <a href="/index.php?s=/news/getpage/page/2.html" class="next">next page</a>-->
    </div>
    <footer class="my-footer">
  <p>湖北气象<br><small>© Copyright Hubei Meteorology 2015</small></p>
</footer>
</div>
<script src="{$config_siteurl}/statics/topic/common_home.js?t=<?php echo time();?>"></script>
<script type="text/javascript">
    $(function() {
        //导航菜单 滚动显示/隐藏效果
        var disScroll;
        var lastScrollTop = 0;
        var delat = 5;
        var navHight = $('.header').outerHeight();
        $(window).scroll(function(event) {
            disScroll = true;
        });
        setInterval(function() {
            if (disScroll) {
                hasScrolled();
                disScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();
            if (Math.abs(st - lastScrollTop) <= delat) {
                return;
            };
            // st滚动距离大于导航高度并且大于上次高度
            if (st > navHight + 40 && st > lastScrollTop) {
                $('.js-tit').removeClass('header-show').addClass('header-hide');
            } else {
                if (st + $(window).height() < $(document).height()) {
                    $('.js-tit').removeClass('header-hide').addClass('header-show');
                }
            }
            lastScrollTop = st;
        };
    })
</script>
</body>
</html>