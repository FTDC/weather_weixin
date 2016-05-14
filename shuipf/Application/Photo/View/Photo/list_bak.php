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
    <style type="text/css">
        ul.photo_gallery_13 {
            width: 100%;
            list-style: none;
            padding: 0px;
            margin: 0 auto;
            float: left;
            clear: both;
            overflow: hidden;
        }


        ul.photo_gallery_13 li {
            width: 150px;
            display: inline-block;
            padding: 5px;
            margin-top: 20px;
            -webkit-box-sizing: border-box;
            vertical-align: top;
            text-align: center;
            -webkit-box-shadow: 3px 3px 3px #eee;
            -moz-box-shadow: 3px 3px 3px #eee;
            box-shadow: 3px 3px 3px #eee;
        }

        ul.photo_gallery_13 li img {
            width: 130px;
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
                            <li class="images-item"><img data-width="<?php echo $vo['size'][0]; ?>" data-height="<?php echo $vo['size'][1]; ?>" title="{$vo['title']}" src="{$vo['img_path_small']}" alt="{$vo['title']}" data-src="{$vo['img_path']}"></li>
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
<script type="text/javascript">
    window.onload = function () {
        //运行瀑布流主函数
        PBL('photoslist', 'images-item');
        //模拟数据

        /**
         * 瀑布流主函数
         * @param  wrap    [Str] 外层元素的ID
         * @param  box    [Str] 每一个box的类名
         */
        function PBL(wrap, box) {
            //	1.获得外层以及每一个box
            var wrap = document.getElementById(wrap);
            var boxs = getClass(wrap, box);
            //	2.获得屏幕可显示的列数
            var boxW = boxs[0].offsetWidth;
            var colsNum = Math.floor(document.documentElement.clientWidth / boxW);
            wrap.style.width = boxW * colsNum+10 + 'px';//为外层赋值宽度
            //	3.循环出所有的box并按照瀑布流排列
            var everyH = [];//定义一个数组存储每一列的高度
            for (var i = 0; i < boxs.length; i++) {
                if (i < colsNum) {
                    everyH[i] = boxs[i].offsetHeight;
                } else {
                    var minH = Math.min.apply(null, everyH);//获得最小的列的高度
                    var minIndex = getIndex(minH, everyH); //获得最小列的索引
                    getStyle(boxs[i], minH, boxs[minIndex].offsetLeft, i);
                    everyH[minIndex] += boxs[i].offsetHeight;//更新最小列的高度
                }
            }
        }

        /**
         * 获取类元素
         * @param  warp        [Obj] 外层
         * @param  className    [Str] 类名
         */
        function getClass(wrap, className) {
            var obj = wrap.getElementsByTagName('*');
            var arr = [];
            for (var i = 0; i < obj.length; i++) {
                if (obj[i].className == className) {
                    arr.push(obj[i]);
                }
            }
            return arr;
        }

        /**
         * 获取最小列的索引
         * @param  minH     [Num] 最小高度
         * @param  everyH [Arr] 所有列高度的数组
         */
        function getIndex(minH, everyH) {
            for (index in everyH) {
                if (everyH[index] == minH) return index;
            }
        }

        /**
         * 数据请求检验
         */
        function getCheck() {
            var documentH = document.documentElement.clientHeight;
            var scrollH = document.documentElement.scrollTop || document.body.scrollTop;
            return documentH + scrollH >= getLastH() ? true : false;
        }

        /**
         * 获得最后一个box所在列的高度
         */
        function getLastH() {
            var wrap = document.getElementById('wrap');
            var boxs = getClass(wrap, 'box');
            return boxs[boxs.length - 1].offsetTop + boxs[boxs.length - 1].offsetHeight;
        }

        /**
         * 设置加载样式
         * @param  box    [obj] 设置的Box
         * @param  top    [Num] box的top值
         * @param  left    [Num] box的left值
         * @param  index [Num] box的第几个
         */
        var getStartNum = 0;//设置请求加载的条数的位置
        function getStyle(box, top, left, index) {
            if (getStartNum >= index) return;
            $(box).css({
                'position': 'absolute',
                'top': top+20,
                "left": left,
                "opacity": "0"
            });
            $(box).stop().animate({
                "opacity": "1"
            }, 999);
            getStartNum = index;//更新请求数据的条数位置
        }
    }
</script>
<script type="text/javascript" >
    $(function(){
        seajs.use('detail');
    })
</script>
</body>
</html>
