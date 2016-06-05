<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>湖北实景天气, 湖北实景天气照片,湖北天气</title>
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/common.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/index.css">
    <link rel="stylesheet" href="{$config_siteurl}/statics/photo/waterfall/css/cssPb/real.css">
    <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/scroll.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/datepicker/WdatePicker.js"></script>
    <style type="text/css">
        /* 定义关键帧 */
        @-webkit-keyframes shade{
            from{opacity:1;}
            15%{opacity:0.4;}
            to{opacity:1;}
        }
        @-moz-keyframes shade{
            from{opacity:1;}
            15%{opacity:0.4;}
            to{opacity:1;}
        }
        @-ms-keyframes shade{
            from{opacity:1;}
            15%{opacity:0.4;}
            to{opacity:1;}
        }
        @-o-keyframes shade{
            from{opacity:1;}
            15%{opacity:0.4;}
            to{opacity:1;}
        }
        @keyframes shade{
            from{opacity:1;}
            15%{opacity:0.4;}
            to{opacity:1;}
        }
        /* wrap */
        #wrap{width:auto;height:auto;margin:0 auto;position:relative;}
        #wrap .box{width:240px;height:auto;padding:5px;border:none;float:left;}
        #wrap .box .info{    width: 240px;
            height: auto;
            border-radius: 8px;
            border: 1px solid #E0DFDF;
            /* box-shadow: 0 0 11px #666; */
            background: #fff;;}
        #wrap .box .info .pic{width:220px;height:auto;margin:0 auto;padding-top:10px;}
        #wrap .box .info .pic:hover{
            -webkit-animation:shade 3s ease-in-out 1;
            -moz-animation:shade 3s ease-in-out 1;
            -ms-animation:shade 3s ease-in-out 1;
            -o-animation:shade 3s ease-in-out 1;
            animation:shade 3s ease-in-out 1;
        }
        #wrap .box .info .pic img{width:220px;border-radius:3px;}
        #wrap .box .info .title{width:220px;height:75px;margin:0 auto; color:#666;font-size:14px;overflow:hidden;position: relative;
            z-index: 1}
    </style>
</head>
<body>

<div id="background"></div>
<div id="warp">
    <div id="headerbar">

        <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/date.js"></script>
        <script type="text/javascript" src="{$config_siteurl}/statics/photo/waterfall/js/setHome.js"></script>
        <script type="text/javascript">
            $(function(){
                $(".menu ul li").hover(function(){
                    $(this).find("ul").toggle();
                });
            });
        </script>
        <script>

            //绑定点赞
            function praise(o) {
                event.stopPropagation();
                if (o.find("b").html() == "赞") {
                    var n = o.find("span i").html();
                    var photo_id = o.find("span i").attr('data');
                    o.find("b").html("已赞");
                    o.find("span i").html(n * 1 + 1);
                    $.ajax({
                        type: 'POST',
                        url: '{$config_siteurl}/index.php?g=Photo&m=Photo&a=parise_photo',
                        data: {'photo_id':photo_id},
                        dataType:'html',
                        success: function (des) {
                            console.log(des);
                        }
                    });
                }
                else {
                    alert("您已经点赞！");
                    return false;
                }
            }

            window.onload = function(){
                //运行瀑布流主函数
                PBL('wrap','box');
                var num=2,data =null, status=0;
                //设置滚动加载
                window.onscroll = function(){

                    if(status > 0) return false;
                    $.ajax({
                        type: 'POST',
                        url: '{$config_siteurl}/index.php?g=Photo&m=Photo&a=query_list',
                        data: {'page':num++, 'starttime':'', 'endtime':'',  'city': ''},
                        dataType:'json',
                        success: function(res){
                            var data = res.data;
                            //校验数据请求
                            if(getCheck()){
                                var wrap = $('#wrap'),box='';
                                for(i in data){
                                    //创建box
                                    // var box = document.createElement('div');
                                    // box.className = 'box';
                                    // wrap.appendChild(box);
                                    // //创建info
                                    // var info = document.createElement('div');
                                    // info.className = 'info';
                                    // box.appendChild(info);
                                    // //创建pic
                                    // var pic = document.createElement('div');
                                    // pic.className = 'pic';
                                    // info.appendChild(pic);
                                    // //创建img
                                    // var img = document.createElement('img');
                                    // img.src = data[i].src;
                                    // img.style.height = 'auto';
                                    // pic.appendChild(img);
                                    // //创建title
                                    // var title = document.createElement('div');
                                    // title.className = 'title';
                                    // info.appendChild(title);
                                    // //创建a标记
                                    // var a = document.createElement('a');
                                    // a.innerHTML = data[i].title;
                                    // title.appendChild(a);
                                    // //创建span标记
                                    // var span = document.createElement('span');
                                    // span.innerHTML = data[i].time;
                                    // span.style.display="block";
                                    // title.appendChild(span);
                                    //创建span标记
                                    box+='<div class="box" style="position: absolute; top: 786px; left: 0px; opacity: 1;">'+
                                        '<div class="info">'+
                                        '<div class="pic"><img src="' + data[i].img_path_small + '"></div>'+
                                        '<div class="title"><a href="{$config_siteurl}/index.php?g=Photo&m=Photo&a=detail&id='+data[i].id+'">'+
                                        data[i].title+
                                        ' <span class="__wf_item_time__" style="display:block">'+data[i].dateTime+'</span>'+
                                        '<div class="handle">'+
                                        ' <a name="likeOrNo" href="javascript:;" onclick="praise($(this))" class="a-LGrayl"> <i class="likeIcon"></i> <b>赞</b>'+
                                        ' <span name="likeCountNum" style="display:inline-block;">'+
                                        ' ( <i data="'+data[i].id+'">'+data[i].parise+'</i>人已赞)'+
                                        '</span>'+
                                        '</a>'+
                                        '</div>'+

                                        '</div>'+
                                        '</div>'+
                                        '</div> ';
                                }
                                wrap.append(box);
                                if(res.status > 0){
                                    PBL('wrap','box');
                                }else{
                                    status = 0;
                                }

                            }
                        }
                    });

                }
            };
            /**
             * 瀑布流主函数
             * @param  wrap  [Str] 外层元素的ID
             * @param  box   [Str] 每一个box的类名
             */
            function PBL(wrap,box){
                //  1.获得外层以及每一个box
                var wrap = document.getElementById(wrap);
                var boxs  = getClass(wrap,box);
                //  2.获得屏幕可显示的列数
                var boxW = boxs[0].offsetWidth;
                // var colsNum = Math.floor(document.documentElement.clientWidth/boxW);
                var colsNum = Math.floor(800/boxW);
                wrap.style.width = boxW*colsNum+'px';//为外层赋值宽度
                //  3.循环出所有的box并按照瀑布流排列
                var everyH = [];//定义一个数组存储每一列的高度
                for (var i = 0; i < boxs.length; i++) {
                    if(i<colsNum){
                        everyH[i] = boxs[i].offsetHeight;
                    }else{
                        var minH = Math.min.apply(null,everyH);//获得最小的列的高度
                        var minIndex = getIndex(minH,everyH); //获得最小列的索引
                        getStyle(boxs[i],minH,boxs[minIndex].offsetLeft,i);
                        everyH[minIndex] += boxs[i].offsetHeight;//更新最小列的高度
                    }
                }
            }
            /**
             * 获取类元素
             * @param  warp      [Obj] 外层
             * @param  className [Str] 类名
             */
            function getClass(wrap,className){
                var obj = wrap.getElementsByTagName('*');
                var arr = [];
                for(var i=0;i<obj.length;i++){
                    if(obj[i].className == className){
                        arr.push(obj[i]);
                    }
                }
                return arr;
            }
            /**
             * 获取最小列的索引
             * @param  minH   [Num] 最小高度
             * @param  everyH [Arr] 所有列高度的数组
             */
            function getIndex(minH,everyH){
                for(index in everyH){
                    if (everyH[index] == minH ) return index;
                }
            }
            /**
             * 数据请求检验
             */
            function getCheck(){
                var documentH = document.documentElement.clientHeight;
                var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
                return documentH+scrollH>=getLastH() ?true:false;
            }
            /**
             * 获得最后一个box所在列的高度
             */
            function getLastH(){
                var wrap = document.getElementById('wrap');
                var boxs = getClass(wrap,'box');
                return boxs[boxs.length-1].offsetTop+boxs[boxs.length-1].offsetHeight;
            }
            /**
             * 设置加载样式
             * @param  box   [obj] 设置的Box
             * @param  top   [Num] box的top值
             * @param  left  [Num] box的left值
             * @param  index [Num] box的第几个
             */
            var getStartNum = 0;//设置请求加载的条数的位置
            function getStyle(box,top,left,index){
                if (getStartNum>=index) return;
                $(box).css({
                    'position':'absolute',
                    'top':top,
                    "left":left,
                    "opacity":"0"
                });
                $(box).stop().animate({
                    "opacity":"1"
                },999);
                getStartNum = index;//更新请求数据的条数位置
            }
        </script>
        <div id="headtop">
            <p id="date"><script> document.write(getNowDate()); </script><!-- <a href="" id="english">English</a>--></p>
            <p id="qucklylinks"><a href="javascript:SetHome(this,window.location)">设为首页</a><a href="javascript:shoucang(document.title,window.location)">加入收藏</a><a href="http://www.hbqx.gov.cn/xxbs/page/login.jsp" target="_blank">信息报送</a></p>
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
        <h4 class="w_real_title">武汉网友实景</h4>
        <span class="w_real_watch">第一时间窥视(*^__^*)</span>
    </div>
    <div id="w_layout_in" style="">
        <div id="wrap">

                <volist name="list" id="item">
            <div class="box">
                <a href="{:U('photo/photo/detail', array('id'=>$item['id']))}">
                <div class="info">
                    <div class="pic"><img src="{$item.img_path_small}"></div>
                    <div class="title">
                        <span class="__wf_item_time__" style="display:block">{$item.title}</span>
                        <div class="handle">
                            <a name="likeOrNo" href="javascript:;" onclick="praise($(this))" class="a-LGrayl"> <i class="likeIcon"></i> <b>赞</b>
                        <span name="likeCountNum" style="display:inline-block;">
                            ( <i data="{$item.id}">{$item.parise}</i>
                            人已赞)
                        </span>
                            </a>
                        </div></div>
                </div>
                </a>
            </div>
                </volist>
                
        </div>
    </div>
    <!-- 瀑布流开始 -->
    <div id="J_WF_Wrap" class="wf-wrap" style="width: 1000px;">
        <div id="J_Blank_1" class="wf-blank wf-blank-1" style="top: -90px;">
            <!-- section 湖北城市-->
            <div class="w_section mt35">
                <h4 class="w_sh">
                    <span class="w_sh_title">湖北城市</span>
                </h4>
                <div class="w_sm mt5">
                    <div class="w_hotCity">
                        <div style="padding-left:12px;">
                            <ul class="w_hc_list">
                                <li><a href="javascript:void(0);" data="wh" >武汉市</a></li>
                                <li><a href="javascript:void(0);" data="hs" >黄石市</a></li>
                                <li><a href="javascript:void(0);" data="xf" >襄樊市</a></li>
                                <li><a href="javascript:void(0);" data="sy" >十堰市</a></li>
                                <li><a href="javascript:void(0);" data="jz" >荆州市</a></li>
                                <li><a href="javascript:void(0);" data="yc" >宜昌市</a></li>
                                <li><a href="javascript:void(0);" data="jm" >荆门市</a></li>
                                <li><a href="javascript:void(0);" data="ez" >鄂州市</a></li>
                                <li><a href="javascript:void(0);" data="xg" >孝感市</a></li>
                                <li><a href="javascript:void(0);" data="hg" >黄冈市</a></li>
                                <li><a href="javascript:void(0);" data="xl" >咸宁市</a></li>
                                <li><a href="javascript:void(0);" data="sz" >随州市</a></li>
                                <li><a href="javascript:void(0);" data="ens" >恩施市</a></li>
                                <li><a href="javascript:void(0);" data="xt" >仙桃市</a></li>
                                <li><a href="javascript:void(0);" data="qj" >潜江市</a></li>
                                <li><a href="javascript:void(0);" data="tm" >天门市</a></li>
                                <li><a href="javascript:void(0);" data="slj" >神农架林区</a></li>
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
                    <input type="text" class="Wdate fl" style="width:90px" id="d4321" onFocus="WdatePicker()"/>
                    <span class="fl">&nbsp;至&nbsp;</span>
                    <input type="text" class="Wdate fl" style="width:90px" id="d4322" onFocus="WdatePicker()"/>
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
                        <img src="http://wechat.7ido.com/statics/photo/waterfall/img/hbqx.jpg" alt=""></div>
                    <!--  天气通logo-->

                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $("div.list_lh").myScroll({
                speed: 40, //数值越大，速度越慢
                rowHeight: 68 //li的高度
            });
        });</script>
</div>
</body>
</html>