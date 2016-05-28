<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>湖北实景天气, 湖北实景天气照片,湖北天气</title>
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/common.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/index.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/real.css">
    <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
    <script src="{$config_siteurl}/statics/photo/waterfall/js/jquery.waterfall.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/scroll.js"></script>
    <script language="javascript" type="text/javascript"
            src="{$config_siteurl}/statics/photo/waterfall/js/datepicker/WdatePicker.js"></script>
</head>
<body>

<div id="background"></div>
<div id="warp">
    <div id="headerbar">
        <script language="JavaScript" type="text/javascript"
                src="{$config_siteurl}/statics/photo/waterfall/js/date.js"></script>
        <script language="javascript" type="text/javascript"
                src="{$config_siteurl}/statics/photo/waterfall/js/setHome.js"></script>
        <script type="text/javascript">
            $(function () {
                $(".menu ul li").hover(function () {
                    $(this).find("ul").toggle();

                });
            });
        </script>

        <div id="headtop">
            <p id="date">
                <script> document.write(getNowDate()); </script><!-- <a href="" id="english">English</a>--></p>
            <p id="qucklylinks"><a href="javascript:SetHome(this,window.location)">设为首页</a><a
                    href="javascript:shoucang(document.title,window.location)">加入收藏</a><a
                    href="http://www.hbqx.gov.cn/xxbs/page/login.jsp" target="_blank">信息报送</a></p>
        </div>

        <div id="banner">
            <div id="logo"><img src="{$config_siteurl}/statics/photo/waterfall/img/logo.png"></div>
            <div id="focus">
                <div id="focus_bg"><img src="{$config_siteurl}/statics/photo/waterfall/img/banner1.jpg"></div>
                <div id="focus_show" style="opacity: 0;"><a href="#" target="_blank"><img src="{$config_siteurl}/statics/photo/waterfall/img/banner2.jpg"></a>
                </div>
                <div id="focus_img">
                    <div name="focus_img" id="focus_1">{$config_siteurl}/statics/photo/waterfall/img/banner1.jpg</div>
                    <div name="focus_img" id="focus_2">{$config_siteurl}/statics/photo/waterfall/img/banner2.jpg</div>
                    <div name="focus_img" id="focus_3">{$config_siteurl}/statics/photo/waterfall/img/banner3.jpg</div>
                </div>
                <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/focus.js"></script>
            </div><!--focus end-->
        </div>
        <!--banner end-->
        <div class="menu">
            <ul>
                <li><a href="http://www.hbqx.gov.cn/index.action">首页</a></li>
                <li><a href="http://www.hbqx.gov.cn/dept1.jsp" 　target="_blank">部门概况</a>
                    <ul class="clidren" style="display: none;">
                        <li><a href="http://www.hbqx.gov.cn/ld.action">领导班子</a></li>
                        <li><a href="http://www.hbqx.gov.cn/news.action?id=1">部门职责</a></li>
                        <li><a href="http://www.hbqx.gov.cn/news.action?id=2">内设机构</a></li>
                        <li><a href="http://www.hbqx.gov.cn/news.action?id=3">直属单位</a></li>
                    </ul>
                </li>
                <li><a href="http://www.hbqx.gov.cn/pubnews.action?id=4" 　target="_blank">信息公开</a>
                    <ul class="clidren" id="clidrenone" style="display: none;">
                        <li><a href="http://www.hbqx.gov.cn/pubnews.action?id=4">公开指南</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnews.action?id=68">公开目录</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=4">公开年报</a></li>
                        <li><a href="http://www.hbqx.gov.cn/jzxx.action?type=3">依申请公开</a></li>
                        <li><a href="http://www.hbqx.gov.cn/dept1.jsp">组织机构</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=6">政策法规</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=17">规划计划</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=19">人事信息</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=20">统计数据</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=21">财政资金</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=22">政府采购</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=23">重大项目</a></li>
                    </ul>
                </li>

                <li><a href="http://www.hbqx.gov.cn/online/page/index.jsp" 　target="_blank">网上办事</a>
                    <ul class="clidren" id="clidrentwo" style="display: none;">
                        <li><a href="http://www.hbqx.gov.cn/spsx.action" target="_blank">行政审批事项</a></li>
                        <li><a href="http://www.hbqx.gov.cn/bszn.action" target="_blank">办事指南</a></li>
                        <li><a href="http://www.hbqx.gov.cn/filedownload.action" target="_blank">资料下载</a></li>
                        <li><a href="http://www.hbqx.gov.cn/online/page/prolist1.jsp" target="_blank">网上申报</a></li>
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=114" target="_blank">公示公告</a>
                        </li>
                        <li><a href="http://www.hbqx.gov.cn/online/page/userpro1.jsp" target="_blank">结果查询</a></li>
                    </ul>
                </li>

                <li><a href="http://www.hbqx.gov.cn/jzxx.action?type=1" 　target="_blank">公众互动</a>
                    <ul class="clidren" id="clidrenthree">
                        <li><a href="http://www.hbqx.gov.cn/jzxx.action?type=1">局长信箱</a></li>
                        <li><a href="http://202.110.133.68:8000/zxgt/RWMWeb.aspx?org=200" target="_blank">在线沟通</a></li>
                        <li><a href="http://www.hbqx.gov.cn/jzxx.action?type=2">公众留言</a></li>
                        <li><a href="http://www.hbqx.gov.cn/mail.action?newstype=40">意见征集</a></li>
                        <li><a href="http://www.hbqx.gov.cn/wenjuanlist.action">网上调查</a></li>
                        <li><a href="http://www.hbqx.gov.cn/mail.action?newstype=41">在线访谈</a></li>
                    </ul>
                </li>

                <li><a href="http://www.hbqx.gov.cn/qx_tqyb.action" 　target="_blank">气象服务</a>
                    <ul class="clidren" id="clidrenfive">
                        <li><a href="http://www.hbqx.gov.cn/qx_tqyb.action">气象预报</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qx_tqsk.action">气象监测</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qxfw.action?newstype=59">气候评价</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qxfw.action?newstype=51">农业气象</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qx_jxh1.action">环境气象</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qxsp_news_list.jsp">天气预报节目</a></li>
                    </ul>
                </li>

                <li><a href="http://www.hbqx.gov.cn/qxkp.action?newstype=35" 　target="_blank">气象科普</a>
                    <ul class="clidren" id="clidren06">
                        <li><a href="http://www.hbqx.gov.cn/qxkp.action?newstype=35">气象百科</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qxkp.action?newstype=36">防灾宝典</a></li>
                        <li><a href="http://www.hbqx.gov.cn/qxkp.action?newstype=37">科普影音</a></li>
                        <li><a href="http://www.hbqx.gov.cn/kpzt.action?pid=104">科普专题</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!--menu end-->
    </div>
    <!--headerbar end-->
</div>
<div id="w_layout_1000" class="wrap">
    <div id="w_layout_in" style="">

    </div>
    <!-- 瀑布流开始 -->
    <div id="J_WF_Wrap" class="wf-wrap" style="width: 1000px;">
        <div id="J_Blank_0" class="wf-blank wf-blank-0">
            <h4 class="w_real_title">武汉网友实景</h4>
            <span class="w_real_watch">第一时间窥视(*^__^*)</span>
        </div>
        <div id="J_Blank_1" class="wf-blank wf-blank-1">
            <!-- section 湖北城市-->
            <div class="w_section mt35">
                <h4 class="w_sh">
                    <span class="w_sh_title">湖北城市</span>
                </h4>
                <div class="w_sm mt5">
                    <div class="w_hotCity">
                        <div style="padding-left:12px;">
                            <ul class="w_hc_list">
                                <li>
                                    <a href="/photos/beijing" target="">北京</a>
                                </li>
                                <li>
                                    <a href="/photos/shanghai" target="">上海</a>
                                </li>
                                <li>
                                    <a href="/photos/shenyang" target="">沈阳</a>
                                </li>
                                <li>
                                    <a href="/photos/tianjin" target="">天津</a>
                                </li>
                                <li>
                                    <a href="/photos/shijiazhuang" target="">石家庄</a>
                                </li>
                                <li>
                                    <a href="/photos/wulumuqi" target="">乌鲁木齐</a>
                                </li>
                                <li>
                                    <a href="/photos/changsha" target="">长沙</a>
                                </li>
                                <li>
                                    <a href="/photos/chongqing" target="">重庆</a>
                                </li>
                                <li>
                                    <a href="/photos/changchun" target="">长春</a>
                                </li>
                                <li>
                                    <a href="/photos/nanjing" target="">南京</a>
                                </li>
                                <li>
                                    <a href="/photos/taiyuan" target="">太原</a>
                                </li>
                                <li>
                                    <a href="/photos/zhengzhou" target="">郑州</a>
                                </li>
                                <li>
                                    <a href="/photos/wuhan" target="">武汉</a>
                                </li>
                                <li>
                                    <a href="/photos/xian" target="">西安</a>
                                </li>
                                <li>
                                    <a href="/photos/hefei" target="">合肥</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- section 美图活动-->
            <div class="w_section mt35">
                <h4 class="w_sh">
                    <span class="w_sh_title">美图活动</span>
                </h4>
                <div class="w_sm" style="height:169px;overflow:hidden;">
                    <!-- 代码开始 -->
                    <div class="list_lh" style="height:169px;overflow:hidden;">
                        <ul>
                            <li>
                                <a href="" style="color:red">&nbsp;&nbsp;&nbsp;&nbsp;公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢公众气象服务中心于2016你那能看房辽宁省地方了呢</a>
                            </li>
                        </ul>
                    </div>
                    <!-- 代码结束 -->

                </div>
            </div>
            <!-- section 查看美图-->
            <div class="w_section mt35">
                <h4 class="w_sh">
                    <span class="w_sh_title">查看美图</span>
                </h4>
                <div class="w_sm mt10 clearfix">
                    <input type="text" class="Wdate fl" style="width:90px" id="d4321"
                           onFocus="WdatePicker({maxDate:'#F{$dp.$D('d4322',{d:-1});}'})"/>
                    <span class="fl">&nbsp;至&nbsp;</span>
                    <input type="text" class="Wdate fl" style="width:90px" id="d4322"
                           onFocus="WdatePicker({minDate:'#F{$dp.$D('d4321',{d:1});}'})"/>
                    <input type="button" value="查看"
                           style="height:25px;line-height:25px;padding:0 15px;margin-top:10px;cursor: pointer;"/>

                </div>
            </div>
            <!-- section 图片来源-->
            <div class="w_section mt35">
                <h4 class="w_sh">
                    <span class="w_sh_title">图片来源</span>
                </h4>
                <div class="w_sm mt10">
                    <!--  墨迹天气logo-->
                    <div class="w_sm_img" style="tex">
                        <img src="{$config_siteurl}/statics/photo/waterfall/img/hbqx.jpg" alt=""></div>
                    <!--  天气通logo-->

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //绑定点赞
    function praise(o) {
        event.stopPropagation();
        if (o.find("b").html() == "赞") {
            var n = o.find("span i").html();
            o.find("b").html("已赞");
            o.find("span i").html(n * 1 + 1);
        }
        else {
            alert("您已经点赞！");
            return false;
        }
    }

    $(function () {
        var opt = {
            // 自定义跨域请求
            ajaxFunc: function (success, error) {
                $.ajax({
                    type: 'POST',
                    url: '{$config_siteurl}/index.php?g=Photo&m=Photo&a=query_list',
                    data: "p=" + 1,
                    dataType:'json',
                    success: success,
                    error: error
                });
            },
            createHtml: function (res) {
                var html = '';
                console.log(res);
                data = res;
                for (var i in data) {
                    //渲染填充
                        console.log(data[i]);
                    html += '<div class="wf-item-inner" wf-data="in" style="width: 232px;"><a href="#" target="_blank"><img src="' + data[i].img_path_small + '" style="width: 232px;" class="thumb_img"><span class="__wf_item_area__" title="' + data[i].title + '">' + data[i].title + '</span><span class="__wf_item_time__">' + data[i].dateTime + '</span></a><div class="handle"><a name="likeOrNo" href="javascript:;" onclick="praise($(this))" class="a-LGrayl"> <i class="likeIcon"></i><b>赞</b><span name="likeCountNum" style="display:inline-block;">(<i>123</i>人已赞)</span></a></div></div>';
                }
                return html;

            },
            auto_imgHeight: true,
            insert_type: 1
        }
        $('#w_layout_in').waterfall(opt);
        //$("html,body").scrollTop(10);
        //公告滚动
    });
    $(function () {
        $("div.list_lh").myScroll({
            speed: 40, //数值越大，速度越慢
            rowHeight: 68 //li的高度
        });
    });
</script>
</body>
</html>