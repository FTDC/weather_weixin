<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <title>上期精选</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="stylesheet" href="{$config_siteurl}/statics/assets/css/amazeui.css"/>
    <style>
        ul.photo_gallery_13 {
            width: 100%;
            list-style: none;
            padding: 0px;
            margin: 10px 0 20px 0;
            float: left;
            clear: both;
        }

        ul {
            list-style: none;
            margin: 0 auto;
            min-height: 600px;
            overflow: hidden;
            position: relative;
        }

        ul.photo_gallery_13 li {
            width: 46%;
            display: inline-block;
            padding-right: 10px;
            -webkit-box-sizing: border-box;
            vertical-align: top;
            margin: 5px 5px;
            -webkit-box-shadow: 3px 3px 3px #eee;
            -moz-box-shadow: 3px 3px 3px #eee;
            box-shadow: 3px 3px 3px #eee;
            position: absolute;
            text-align: center;
            width: 244px

        }

        ul.photo_gallery_13 li img {
            width: 100%;
            vertical-align: bottom;
        }
    </style>
</head>
<body>
<div class="am-g am-g-fixed">
    <div class=" ">
        <div class="swiper-container">
            <div class="user-images">
                <ul id="photoslist" class="photo_gallery_13">
                    <notempty name="list">
                        <volist name="list" id="vo">
                            <li class="images-item"><img data-width="<?php echo $vo['size'][0]; ?>" data-height="<?php echo $vo['size'][1]; ?>" style="width: 150px;" title="{$vo['title']}" src="{$vo['img_path_small']}" alt="{$vo['title']}" data-src="{$vo['img_path']}"></li>
                        </volist>
                    </notempty>
                    <div class="clearleft"></div>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{$config_siteurl}/statics/photo/js/lib.js"></script>
<script type="text/javascript" src="{$config_siteurl}/statics/photo/js/photo.js"></script>
<script type="text/javascript" >
    $(function(){
        var cases = $("#photoslist li");
        var case_h = [[],[],[],[]];
        var sum = [0,0,0,0];
        $.each(cases, function(i){
            var m = i%4;
            var step = Math.floor(i/4);
            cases.eq(i).css("left", 220*m+"px");
            case_h[m].push(cases.eq(i).height());
            if(!step){
                cases.eq(i).css("top", "0");
            }else{
                var num = 0;
                for(var n=0; n<step; n++){
                    num += case_h[m][n] + 20;
                }
                cases.eq(i).css("top", num+"px");
            }
        });
        $(case_h).each(function(i){
            $(case_h[i]).each(function(j){
                sum[i] += case_h[i][j];
            });
        });
        cases.parent().css("height", sum.sort(function(a,b){return a<b?a:-1})[0]+100+"px");

        seajs.use('detail');
    })
</script>
</body>
</html>
