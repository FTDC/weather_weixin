<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>湖北实景天气, 湖北实景天气照片,湖北天气</title>
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/common.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/index.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/real.css">
    <script src="{$config_siteurl}/statics/photo/waterfall/js/jquery-1.11.1.min.js"></script>
    <script src="{$config_siteurl}/statics/photo/waterfall/js/waterfall.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/scroll.js"></script>
    <script language="javascript" type="text/javascript"
            src="{$config_siteurl}/statics/photo/waterfall/js/datepicker/WdatePicker.js"></script>
</head>
<body>
<iframe frameborder=0 width=100% height=210 marginheight=0 marginwidth=0 scrolling=no
        src="http://www.hbqx.gov.cn/index.action"></iframe>
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
                           onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'d4322\',{d:-1});}'})"/>
                    <span class="fl">&nbsp;至&nbsp;</span>
                    <input type="text" class="Wdate fl" style="width:90px" id="d4322"
                           onFocus="WdatePicker({minDate:'#F{$dp.$D(\'d4321\',{d:1});}'})"/>
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
    var opt = {
        getResource: function (index, render) {
            $.ajax({
                url: "{$config_siteurl}/index.php?g=Photo&m=Photo&a=query_list",
                dataType: 'json',
                type: 'post',
                data: {'city': 'wuhan', 'page': '1'},
                success: function (data) {
//                    console.log(data);
                    var html = '';
                    for (var i in data) {
                        //渲染填充
//                        console.log(data[i]);
                        html += '<div class="wf-item" wf-data="in" style="width: 244px;"><a href="#" target="_blank"><img src="' + data[i].img_path + '" style="width: 244px;"><span class="__wf_item_area__" title="' + data[i].title + '">' + data[i].title + '</span><span class="__wf_item_time__">' + data[i].dateTime + '</span></a></div>';
                    }
                    console.log(html);
                    return $(html);
                }
            });
            //index为已加载次数,render为渲染接口函数,接受一个dom集合或jquery对象作为参数。通过ajax等异步方法得到的数据可以传入该接口进行渲染，如 render(elem)
        },
        auto_imgHeight: true,
        insert_type: 1
    }
    $('#w_layout_in').waterfall(opt);
    $("html,body").scrollTop(10);
    //公告滚动

    $(function () {
        $("div.list_lh").myScroll({
            speed: 40, //数值越大，速度越慢
            rowHeight: 68 //li的高度
        });
    });
</script>
</body>
</html>