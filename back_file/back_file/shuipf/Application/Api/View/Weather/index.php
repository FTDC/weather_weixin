
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>天气查询</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;,maximum-scale=1,user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{$config_siteurl}/statics/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="{$config_siteurl}/statics/css/base1.css"/>
    <link rel="stylesheet" href="{$config_siteurl}/statics/css/font-awesome.min.css"/>
    <style>
        html,body{height:100%;}
        body{
            background:url('{$config_siteurl}/statics/images/tianqi_bg.jpg');
            background-size:100% 100%;
            background-repeat:no-repeat;
        }
        .user_Weather_View .container{width:100%;margin: 0;padding: 0;}
        .user_Weather_View .container .row{width:100%;height:47px;background: #fff;margin:0;box-shadow: 0px 3px 2px #c0c0c0;}
        .user_Weather_View .container .row form{width:100%;height:30px;margin:5px auto;}
        .user_Weather_View .container .row1{width:98%;margin:10px auto;height:40px;color:#fff;padding:10px 0 0 10px;}
        button.icon_search1{
            width:40px;
            height:34px;
            background: url('{$config_siteurl}/statics/images/select2x2.png') -79px -50px  no-repeat;
        }
        .content{padding:5px;}
        .imgList_4 li img{height: 65px;}
        .imgList_4 li:first-child img{height: 160px;}
        @charset "UTF-8";
        /*
        基础样式
        */

        /*
        列表样式1

            纵向列表
            ul>li>a>内容:name img
        */
        .list_1{padding:5px 0px;margin: 0px;}
        .list_1 li{margin:0px;border-bottom: 1px solid #ccc;}
        .list_1 li:active{background-color: #f1f1f1;}
        .list_1 li a{padding:0px 10px;width: 100%;height: 80px;line-height: 80px;}
        .list_1 li a img{width:60px;height: 60px;float: right;margin: 10px 0px;}

        /*
        列表样式2

            纵向列表(带右侧箭头)
            ul>li>a
        */
        .list_2{ margin: 5px; padding:0px;border-radius: 5px;border: 1px solid #ccc;}
        .list_2 li{margin:0px;border-bottom: 1px solid #ccc;overflow: hidden;}
        .list_2 li:last-child{border-bottom: none;}
        .list_2 li:active{background-color: #f1f1f1;}
        .list_2 li a{padding:0px 10px;width: 100%;height: 40px;line-height: 40px;position: relative;color: #555;}
        .list_2 li a i{vertical-align: middle;}
        .list_2 li a i:last-child{font-size:2em;color: #ccc;}
        .list_2 li a .content{padding:0px 10px;width: 92%;display: inline-block;white-space: nowrap;text-overflow: ellipsis;}

        /*
        列表样式3

            纯文本样式列表右侧一个箭头
            a>ul>li
        */
        .list_3{ margin: 5px; padding:0px;border-radius: 5px;border: 1px solid #ccc;color: #333;background-color: #fff;position: relative;}
        .list_3 ul{padding: 10px;margin: 0px;}
        .list_3 li{margin:0px;overflow: hidden;height:25px;line-height:25px;}
        .list_3 i{position: absolute;top: 30%;right: 10px;font-size: 3em;opacity: 0.5;}

        /*
        列表样式4

            纯文本样式列表项中每一个右侧有一个箭头
            ul>li>a>内容：i
        */
        .list_4{padding:0px;margin: 5px;}
        .list_4 li{margin:0px;overflow: hidden;height:40px;line-height:40px;border-bottom: 1px solid #ccc;}
        .list_4 li:active{background-color: #f1f1f1;}
        .list_4 li a{display: block;padding:0px 10px;}
        .list_4 i{float: right;font-size: 2.2em;line-height: 40px;}

        /*
        图文列表1

            头像列表
            dl>dt>dd
        */
        .imgList_1{padding:5px;content: '';display: table;clear: both;width: 100%;margin:0px;}
        .imgList_1 dt{float: left;margin-right: 10px;}
        .imgList_1 dt img{width:80px;height: 80px;border-radius: 80px;line-height: 0px;border:5px solid #fff;}
        .imgList_1 dd{line-height: 30px;}
        .imgList_1 dd.name{font-size: 1.2em;margin-top: 10px;}
        .imgList_1 dd.des{}

        /*
        图文列表2

            图文列表，右侧文字4行
            dl>dt>dd>div|div
        */
        .imgList_2{padding:5px;content: '';display: table;clear: both;width: 100%;margin:0px;padding: 10px;border-bottom: 1px solid #ccc;height: 80px;}
        .imgList_2 dt{float: left;margin-right: 10px;}
        .imgList_2 dt img{width:80px;height: 80px;line-height: 0px;}
        .imgList_2 dd{line-height: 30px;}
        .imgList_2 dd.name{font-size: 1.2em;}
        .imgList_2 dd.name div{line-height: 19px;}
        .imgList_2 dd.name div:first-child span{font-size: 0.8em;color: #ccc;}
        .imgList_2 dd.name div:last-child h4{padding:0px;margin:0px;}
        .imgList_2 dd.des{font-size: 0.8em;line-height: 22px;}
        .imgList_2 dd.des div:last-child{color: #FF6600;}

        /*
        图文列表3

            纯图片纵向列表
            ul>li>a>img
        */
        .imgList_3{padding:5px;width: 100%;margin:0px;}
        .imgList_3>li{padding:5px;margin:0px;}
        .imgList_3>li>a{display: block;overflow: hidden;}
        .imgList_3>li>a>img{width:100%;}

        /*
        图文列表4

            图文混排纵向列表(第一条带黑色描述条)
            ul
                li
                    a
                        img
                        p
                li
                    a
                        p
                        img
        */
        .imgList_4{padding:5px;width: 100%;margin:0px;}
        .imgList_4>li{padding:5px;margin:0px;background-color: #fff;border-bottom: 1px solid #ccc;}
        .imgList_4>li:last-child{border-bottom: none;}
        .imgList_4>li>a{display: block;overflow: hidden;position: relative;text-decoration: none;}
        .imgList_4>li>a{color: #000;}
        .imgList_4>li>a:after{clear: both;content: '';}
        .imgList_4>li>a>p{float: left;width: 75%;padding:5px;margin: 0px;font-size: 1em;height: 45px;overflow: hidden;}
        .imgList_4>li>a>img{float:left;width:25%;padding:5px;border-radius: 10px;}
        .imgList_4>li:first-child{padding:10px;}
        .imgList_4>li:first-child img{width: 100%;padding: 0px;border-radius: 0px;}
        .imgList_4>li:first-child p{background-color: rgba(000,000,000,0.6);color: #fff;height: 30px;line-height: 30px;padding: 0px 5px;position: absolute;z-index: 5;bottom: 0px;margin: 0px;width: 100%;font-size: 0.9em;}

        /*
        Tab切换

            两列切换
            .Tabs
                header.tabType
                    div#oDiv*
                tab
                    a
                        ul
                            li
                                content
            time时间
            右侧箭头
        */
        .Tabs .tabType{width: 100%;padding: 0px;margin: 0px;}
        .Tabs .tabType div[id^="oDiv"]{height: 38px;line-height: 38px;text-align: center;border-bottom: 1px solid #ccc;color: #666;}
        .Tabs .tabType div.active{color: #333;border-bottom:2px solid #FF9900;}
        .Tabs .tabNone{display: none;}
        .Tabs .tab a:active{background-color: #f1f1f1;}
        .Tabs .tab a{border-bottom: 1px solid #ccc;display: block;color: #666; font-size: 0.9em;position: relative;}
        .Tabs .tab a ul{padding: 0px 10px;margin: 0px;}
        .Tabs .tab a li{min-height: 25px;line-height: 25px;}
        .Tabs .tab a .Description{width: 99%;}
        .Tabs .tab a>i{position: absolute;top: 22%;right: 15px;font-size: 3em;opacity: 0.5;}
    </style>
</head>
<body>
<section class="user_Weather_View">
    <main class="container"><!-- 主体部分 -->
        <div class="row">
            <form class="bs-example bs-example-form" action="/index.php?g=Wap&m=ConvenienceCheck&a=weatherSearch" method="post" role="form">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" name="weatherCity" placeholder="输入城市名称查询天气（例：南京）"  />
                           <span class="input-group-btn">
                              <button class="btn btn-default icon_search1" type="submit"></button>
                           </span>
                    </div>
                </div>
                <input type="hidden" name="__hash__" value="3d0f80c699c83dae011e3ed6795dd79c_24c355346d47862d838171f9f143fbc7" /></form>
        </div>
        <div class="content">


            <ul class="imgList_4">
                <li>
                    <a href="javascript:;">
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20141010/543753b7e31e5.jpg" alt="天气" />
                        <p>今日南京天气</p>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <p>今天白天 中到大雨 东南风小于3级 最高27℃</p>
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20140924/542229d7115f8.gif" alt="天气图标" />
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <p>今天夜晚 中雨 东风小于3级 最低23℃</p>
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20140923/54214bcc951d9.gif" alt="天气图标" />
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <p>明天白天 中雨 东风小于3级 最高27℃</p>
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20140924/54222bb491cfc.gif" alt="天气图标" />
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <p>明天夜晚 雷阵雨 东风3到4级 最低23℃</p>
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20140924/5422298c0e46a.gif" alt="天气图标" />
                    </a>
                </li>

                <li>
                    <a href="javascript:;">
                        <p>后天白天 阴 东风小于3级 最高29℃</p>
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20140924/54222d838194e.gif" alt="天气图标" />
                    </a>
                </li>

                <li>
                    <a href="javascript:;">
                        <p>后天夜晚 阴 东风小于3级 最低23℃</p>
                        <img src="http://114.215.197.41/images/nbgehi1402380840/20140924/5422293866894.gif" alt="天气图标" />
                    </a>
                </li>
            </ul>
        </div>
    </main>
</section>
</body>
</html>