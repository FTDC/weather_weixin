<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>湖北实景天气, 湖北实景天气照片,湖北天气</title>
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/common.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/index.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/real.css">
    <script src="{$config_siteurl}/statics/photo/waterfall/js/jquery-1.11.1.min.js"></script>
    <script language="javascript" type="text/javascript"  src="{$config_siteurl}/statics/photo/waterfall/js/datepicker/WdatePicker.js"></script>
</head>
<body>

<div id="background"></div>
<div id="warp">
    <div id="headerbar">

        <script language="JavaScript" type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/date.js"></script>
        <script language="javascript" type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/setHome.js"></script>
        <script type="text/javascript">
            $(function(){
                $(".menu ul li").hover(function(){
                    $(this).find("ul").toggle();

                });
            });
        </script>

        <div id="headtop">
            <p id="date"><script> document.write(getNowDate()); </script><!-- <a href="" id="english">English</a>--></p>
            <p id="qucklylinks"><a href="javascript:SetHome(this,window.location)">设为首页</a><a href="javascript:shoucang(document.title,window.location)">加入收藏</a><a href="http://www.hbqx.gov.cn/xxbs/page/login.jsp" target="_blank">信息报送</a></p>
        </div>

        <div id="banner">
            <div id="logo"><img src="{$config_siteurl}/statics/photo/waterfall/img/logo.png"></div>
            <div id="focus">
                <div id="focus_bg"><img src="{$config_siteurl}/statics/photo/waterfall/img/banner1.jpg"></div>
                <div id="focus_show" style="opacity: 0;"><a href="#" target="_blank"><img src="{$config_siteurl}/statics/photo/waterfall/img/banner2.jpg"></a></div>
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
                        <li><a href="http://www.hbqx.gov.cn/pubnewslist.action?newstype=114" target="_blank">公示公告</a></li>
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
    <div id="J_Blank_0" class="wf-blank wf-blank-0" style="padding: 10px 0;margin-bottom: 10px;">
        <h4 class="w_real_title">{$detail['title']}</h4>
        <span class="w_real_watch">第一时间窥视(*^__^*)</span>
    </div>
    <div id="w_layout_in" style="">
        <div class="w_main_article">
            <div class="w_ma_img">
                <a>
                    <img src="{$detail['img_path']}" alt="{$detail['title']}">
                </a>
            </div>
            <div class="w_ma_infor">
                <div class="w_mac_user">
                    <div class="w_mac_user_head">
                        <a>
                            <img src="{$config_siteurl}/statics/photo/waterfall/img/male_34.png" width="34" height="34" alt="{$detail['username']}">
                        </a>
                    </div>
                    <p class="font14">
                        <a>{$detail['username']}</a>
                    </p>
                    <p class="c666"></p>
                </div>
                <div class="w_mac_address">
                    <p class="font14">{$detail['title']}</p>
                    <p class="c999">{$detail['dateTime']}</p>
                </div>
            </div>
            <div class="w_ma_main">
                <p class="font14">我要分享:</p>
                <div class="bshare-custom icon-medium-plus"><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/button.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><a class="bshareDiv" onclick="return false;"></a><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
            </div>
        </div>
    </div>
    <!-- 瀑布流开始 -->
    <div id="J_WF_Wrap" class="wf-wrap" style="width: 1000px;position: absolute;top: -17px;">
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
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>武汉市))}" data="wh">武汉市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>黄石市))}" data="hs">黄石市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>襄樊市))}" data="xf">襄樊市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>十堰市))}" data="sy">十堰市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>荆州市))}" data="jz">荆州市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>宜昌市))}" data="yc">宜昌市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>荆门市))}" data="jm">荆门市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>鄂州市))}" data="ez">鄂州市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>孝感市))}" data="xg">孝感市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>黄冈市))}" data="hg">黄冈市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>咸宁市))}" data="xl">咸宁市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>随州市))}" data="sz">随州市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>恩施市))}" data="ens">恩施市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>仙桃市))}" data="xt">仙桃市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>潜江市))}" data="qj">潜江市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>天门市))}" data="tm">天门市</a>
                                </li>
                                <li><a href="{:U('Photo/Photo/hbqx_index', array('city'=>神农架林区))}"
                                       data="slj">神农架林区</a></li>
                                <li><a href="{:U('Photo/Photo/hbqx_index')}">全部</a></li>
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
                        <br />
                        <a href="javascript:void(0);" style="color:red">{$gonggao}</a>
                    </div>
                    <!-- 代码结束 -->
                </div>
            </div>
            <!-- section 查看美图-->
            <form method="post" action="{:U('Photo/Photo/hbqx_index')}">
                <input type="hidden" id="city" name="city" value="{$data['city']}">
                <!-- section 查看美图-->
                <div class="w_section mt35">
                    <h4 class="w_sh">
                        <span class="w_sh_title">查看美图</span>
                    </h4>
                    <div class="w_sm mt10 clearfix">
                        <input type="text" class="Wdate fl" name="start_time"
                               value="<?php echo empty($data['start_time']) ? '' : date('Y-m-d', $data['start_time']); ?>"
                               style="width:90px" id="start_time" onFocus="WdatePicker()"/>
                        <span class="fl">&nbsp;至&nbsp;</span>
                        <input type="text" class="Wdate fl" name="end_time"
                               value="<?php echo empty($data['end_time']) ? '' : date('Y-m-d', $data['end_time']); ?>"
                               style="width:90px" id="end_time" onFocus="WdatePicker()"/>
                        <input type="submit" value="查看"
                               style="height:25px;line-height:25px;padding:0 15px;margin-top:10px;cursor: pointer;"/>

                    </div>
                </div>
            </form>
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
</body>
</html>