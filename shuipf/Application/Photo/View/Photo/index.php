<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>上报实景天气</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="{$config_siteurl}/statics/assets/i/favicon.png">
    <link rel="stylesheet" href="{$config_siteurl}/statics/assets/css/amazeui.css"/>
    <link rel="stylesheet" href="{$config_siteurl}/statics/webupload/webuploader.css"/>
    <link rel="stylesheet" href="{$config_siteurl}/statics/webupload/style.css"/>
    <style>

        ul{ list-style:  none;}
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
            .am-offcanvas-bar .am-nav > li > a {
                color: #ccc;
                border-radius: 0;
                border-top: 1px solid rgba(0, 0, 0, .3);
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, .05)
            }

            .am-offcanvas-bar .am-nav > li > a:hover {
                background: #404040;
                color: #fff
            }

            .am-offcanvas-bar .am-nav > li.am-nav-header {
                color: #777;
                background: #404040;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, .05);
                text-shadow: 0 1px 0 rgba(0, 0, 0, .5);
                border-top: 1px solid rgba(0, 0, 0, .3);
                font-weight: 400;
                font-size: 75%
            }

            .am-offcanvas-bar .am-nav > li.am-active > a {
                background: #1a1a1a;
                color: #fff;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, .3)
            }

            .am-offcanvas-bar .am-nav > li + li {
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
            margin-top: 10px;
            text-align: center;
            background: whitesmoke;
            position: relative;
            padding-bottom: 0px;;
        }

        .am-g-fixed p img {
            width: 100%;
        }

        .am-g {
            overflow: hidden;
        }

        .upload_from {
            background: #fff;
        }

        .upload_from input{ padding:  10px 0 10px 0;     border: 0;
            width: 100%;
            height: 45px;
            font-size: 15px;
            color: #000;
            outline: 0;}

        .upload_from textarea{ padding:  10px 0 10px 0;     border: 0;
            width: 100%;
            height: 170px;
            font-size: 15px;
            color: #000;
            outline: 0;}

        .pub-location {
            padding-left: 6px;
            height: 44px;
            font-size: 14px;
            line-height: 44px;
            background: #fff;
        }

        .pub-location .location-text {
            padding: 8px 8px 8px 28px;
            color: #757575;
            background: #fff url({$config_siteurl}/statics/photo/image/location.png) no-repeat;
            background-position: 8px center;
            background-size: 12px 16px;
        }

        .pub-type {
            display: -webkit-box;
            -webkit-box-pack: end;
            -webkit-box-align: center;
            -webkit-box-sizing: content-box;
            padding: 10px 20px;
            height: 35px;
            font-size: 16px;
            background: #fff; list-style: none;
        }

        .border-1px {
            display: block;
            position: relative;
            top: 0;
            left: 0;
            border: 1px solid #c8c7cc;
            width: 100%;
            height: 100%;
            content: " ";
            pointer-events: none;
        }

        .pub-type .active {
            background-image: url({$config_siteurl}/statics/photo/image/select-photo2-active.png);
        }

        .pub-type .pic-type {
            overflow: hidden;
            position: relative;
            margin-right: 14px;
            width: 25px;
            height: 25px;
            background: url({$config_siteurl}/statics/photo/image/select-photo2.png) no-repeat 0 0;
            background-size: 25px 25px;
        }

        .pub-type li {
            height: 35px;
            line-height: 35px;
        }

        .pub-publish {
            border: 0;
            border-radius: 4px;
            width: 81px;
            height: 35px;
            font-size: 16px;
            text-align: center;
            color: #fff;
            float: right;
            background-color: #2791dc;
        }

        .pub-pics {
            overflow: hidden;
            padding: 9px 18px 15px;
        }



        .up-entry {
            background: transparent url({$config_siteurl}/statics/photo/image/publish-sprite.png) no-repeat -130px 0;
            background-size: 270px 65px;
        }

        .pub-pics li {
            float: left;
            position: relative;
            margin: 6px 6px 0 0;
            width: 65px;
            height: 65px;
        }

        .upfile {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .list_img{
            border-top: 1px solid #eeeeee;
            margin-top: 10px;
            text-align: center;
            background: whitesmoke;
            position: relative;
            padding-bottom: 0px; min-height: 400px;;
        }
    </style>
</head>
<body>
<div class="am-g am-g-fixed">
    <div class=" ">
        <div class="am-g">
            <div class="am-u-sm-11 am-u-sm-centered">
                <div class="am-cf am-article">
                    <div class="upload_from">
                        <div class="editor-outer">
                            <input maxlength="200" spellcheck="false" class="ipt-theme" type="text" placeholder="标题，4-25个字">
                        </div>
                        <div class="editor-outer">
                            <textarea spellcheck="false" class="editor" placeholder="内容，10-700个字"></textarea>
                        </div>
                        <div class="pub-location"><span class="location-text">所在城市</span></div>
                        <div class="pub-line border-1px"></div>
                        <div class="pub-faces"></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="list_img" id="uploader">
<!--            <ul class="pub-pics">-->
<!--                <li class="up-entry">-->
<!--                    <input class="upfile up-entry-two" type="file" accept="image/*"  multiple="">-->
<!--                </li>-->
<!--            </ul>-->
            <div class="queueList">
                <div id="dndArea" class="placeholder">
                    <div id="filePicker"></div>
                    <p>或将照片拖到这里，单次最多可选10张</p>
                </div>
            </div>
            <div class="statusBar" style="display:none;">
                <div class="btns">
                    <div id="filePicker2"></div><div class="uploadBtn">发表</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{$config_siteurl}/statics/webupload/jquery.js"></script>
<script type="text/javascript" src="{$config_siteurl}/statics/webupload/webuploader.js"></script>
<script type="text/javascript" src="{$config_siteurl}/statics/webupload/upload.js"></script>
</body>
</html>
