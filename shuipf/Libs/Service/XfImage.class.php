<?php
namespace Libs\Service;

class XfImage extends \Libs\System\Service {

    /**
     * 取得图像信息
     * @param $img
     * @return array|bool
     */
    static function getImageInfo($img) {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else {
            return false;
        }
    }

    /**
     * 为图片添加水印
     * @param $source 原文件名
     * @param $water 水印图片
     * @param null $savename 另存文件名
     * @param int $alpha 水印的透明度
     * @param int $pos 水印的位置
     * @param int $pos_x 水印调整x轴
     * @param int $pos_y 水印调整y轴
     * @return bool
     */
    static function water($source, $water, $savename, $alpha=80, $pos=9, $pos_x=0, $pos_y=0) {

        //检查文件是否存在
        if (!file_exists($source) || !file_exists($water)) return false;

        //图片信息
        $sInfo = self::getImageInfo($source);
        $wInfo = self::getImageInfo($water);

//

        //如果图片小于水印图片，不生成图片
//        if ($sInfo["width"] < $wInfo["width"] || $sInfo['height'] < $wInfo['height']) return false;

//        a($sInfo, 1);

        //建立图像
        $sCreateFun = "imagecreatefrom" . $sInfo['type'];
        $sImage = $sCreateFun($source);
        $wCreateFun = "imagecreatefrom" . $wInfo['type'];
        $wImage = $wCreateFun($water);

        //设定图像的混色模式
        imagealphablending($wImage,true);
        imagealphablending($sImage,true);

        //图像位置,默认为右下角右对齐
        switch($pos)
        {
            case 0://0为随机
                $posX = rand(0,($sInfo["width"] - $wInfo["width"]));
                $posY = rand(0,($sInfo["height"] - $wInfo["height"]));
                break;
            case 1://1为顶端居左
                $posX = 0;
                $posY = 0;
                break;
            case 2://2为顶端居中
                $posX = ($sInfo["width"] - $wInfo["width"]) / 2;
                $posY = 0;
                break;
            case 3://3为顶端居右
                $posX = $sInfo["width"] - $wInfo["width"];
                $posY = 0;
                break;
            case 4://4为中部居左
                $posX = 0;
                $posY = ($sInfo["height"] - $wInfo["height"]) / 2;
                break;
            case 5://5为中部居中
                $posX = ($sInfo["width"] - $wInfo["width"]) / 2;
                $posY = ($sInfo["height"] - $wInfo["height"]) / 2;
                break;
            case 6://6为中部居右
                $posX = $sInfo["width"] - $wInfo["width"];
                $posY = ($sInfo["height"] - $wInfo["height"]) / 2;
                break;
            case 7://7为底端居左
                $posX = 0;
                $posY = $sInfo["height"] - $wInfo["height"];
                break;
            case 8://8为底端居中
                $posX = ($sInfo["width"] - $wInfo["width"]) / 2;
                $posY = $sInfo["height"] - $wInfo["height"];
                break;
            case 9://9为底端居右
                $posX = $sInfo["width"] - $wInfo["width"] - 5;
                $posY = $sInfo["height"] - $wInfo["height"] - 5;
                break;
            case 10://自定义
                $posX = $pos_x;
                $posY = $pos_y;
                break;
            default://底端居右
                $posX = $sInfo["width"] - $wInfo["width"] - 5;
                $posY = $sInfo["height"] - $wInfo["height"] - 5;
                break;
        }

        //生成混合图像
        imagecopy($sImage, $wImage, $posX, $posY, 0, 0, $wInfo['width'], $wInfo['height']);
        //imagecopymerge($sImage, $wImage, $posX, $posY, 0, 0, $wInfo['width'], $wInfo['height'], $alpha);


        //输出图像
        $ImageFun = 'Image' . $sInfo['type'];
        //如果没有给出保存文件名，默认为原图像名
        if (!$savename) {
            $savename = $source;
            @unlink($source);
        }
        //保存图像
        $ImageFun($sImage, $savename);
        imagedestroy($sImage);
    }

    /**
     * 为图片添加文字水印
     * @param $source 原文件名
     * @param $water_text 水印文字
     * @param string $savename 另存文件名
     * @param int $fontsize 文字大小
     * @param int $pos 水印的位置
     * @param int $pos_x 水印调整x轴
     * @param int $pos_y 水印调整y轴
     * @param string $water_color 文字颜色
     * @param int $quality 效果
     * @return bool
     */
    static function water_text($source, $water_text, $savename = '', $fontsize = 9, $pos = 9, $pos_x = 0, $pos_y = 0, $water_color = '#ff0000', $quality = 80 ) {

        // 获取原图信息
        $info = XfImage::getImageInfo($source);

        $image_type = strtolower($info['type']);

        // 选择创建函数
        $createFun = 'imagecreatefromjpeg';

        switch ($image_type) {
            case 'png': $createFun = 'imagecreatefrompng'; break;
            case 'jpg': $createFun = 'imagecreatefromjpeg'; break;
            case 'jpeg': $createFun = 'imagecreatefromjpeg'; break;
            case 'gif': $createFun = 'imagecreatefromgif'; break;
            case 'bmp': $createFun = 'imagecreatefromwbmp '; break;
        }

        // 载入原图
        if(!function_exists($createFun)) {
            return false;
        }

        $srcImg = $createFun($source);

        // 文字字体
        $fontfile = dirname(__FILE__).'/data/font/zh/3.ttf';

        $temp = imagettfbbox(ceil($fontsize*1.1), 0, $fontfile, $water_text);
        $width = $temp[2] - $temp[6];
        $height = $temp[3] - $temp[7];
        unset($temp);

        //图像位置,默认为右下角右对齐
        switch($pos)
        {
            case 0://0为随机
                $posX = rand(0,($info["width"] - $width));
                $posY = rand(0,($info["height"] - $height));
                break;
            case 1://1为顶端居左
                $posX = 0;
                $posY = 0;
                break;
            case 2://2为顶端居中
                $posX = ($info["width"] - $width) / 2;
                $posY = 0;
                break;
            case 3://3为顶端居右
                $posX = $info["width"] - $width;
                $posY = 0;
                break;
            case 4://4为中部居左
                $posX = 0;
                $posY = ($info["height"] - $height) / 2;
                break;
            case 5://5为中部居中
                $posX = ($info["width"] - $width) / 2;
                $posY = ($info["height"] - $height) / 2;
                break;
            case 6://6为中部居右
                $posX = $info["width"] - $width;
                $posY = ($info["height"] - $height) / 2;
                break;
            case 7://7为底端居左
                $posX = 0;
                $posY = $info["height"] - $height;
                break;
            case 8://8为底端居中
                $posX = ($info["width"] - $width) / 2;
                $posY = $info["height"] - $height;
                break;
            case 9://9为底端居右
                $posX = $info["width"] - $width - 5;
                $posY = $info["height"] - $height - 5;
                break;
            case 10://自定义
                $posX = $pos_x;
                $posY = $pos_y;
                break;
            default://底端居右
                $posX = $info["width"] - $width - 5;
                $posY = $info["height"] - $height - 5;
                break;
        }

        // 文字颜色
        if(!empty($water_color) && (strlen($water_color)==7)) {
            $r = hexdec(substr($water_color,1,2));
            $g = hexdec(substr($water_color,3,2));
            $b = hexdec(substr($water_color,5));
        } else {
            return false;
        }

        // 添加文字
        //imagestring($srcImg, $fontsize, $posX, $posY, $water_text, imagecolorallocate($srcImg, $r, $g, $b));
        imagettftext($srcImg, $fontsize, 0, $posX, $posY, imagecolorallocate($srcImg, $r, $g, $b), $fontfile, $water_text);

        // 生成图片
        $imageFun = 'image' . ($image_type == 'jpg' ? 'jpeg' : $image_type);

        if (!$savename) {
            $savename = $source;
        }

        if ($imageFun == 'imagejpeg') {
            $imageFun($srcImg, $savename, $quality);
        } else{
            $imageFun($srcImg, $savename);
        }

        imagedestroy($srcImg);

        return true;
    }

    /**
     * 显示图片
     * @param $imgFile
     * @param string $text
     * @param string $x
     * @param string $y
     * @param string $alpha
     */
    function showImg($imgFile, $text='', $x='10', $y='10', $alpha='50') {
        //获取图像文件信息
        $info = XfImage::getImageInfo($imgFile);
        if ($info !== false) {
            $createFun = str_replace('/', 'createfrom', $info['mime']);
            $im = $createFun($imgFile);
            if ($im) {
                $ImageFun = str_replace('/', '', $info['mime']);
                //水印开始
                if (!empty($text)) {
                    $tc = imagecolorallocate($im, 0, 0, 0);
                    if (is_file($text) && file_exists($text)) {//判断$text是否是图片路径
                        // 取得水印信息
                        $textInfo = Image::getImageInfo($text);
                        $createFun2 = str_replace('/', 'createfrom', $textInfo['mime']);
                        $waterMark = $createFun2($text);
                        //$waterMark=imagecolorallocatealpha($text,255,255,0,50);
                        $imgW = $info["width"];
                        $imgH = $info["width"] * $textInfo["height"] / $textInfo["width"];
                        //$y	=	($info["height"]-$textInfo["height"])/2;
                        //设置水印的显示位置和透明度支持各种图片格式
                        imagecopymerge($im, $waterMark, $x, $y, 0, 0, $textInfo['width'], $textInfo['height'], $alpha);
                    } else {
                        imagestring($im, 80, $x, $y, $text, $tc);
                    }
                    //ImageDestroy($tc);
                }
                //水印结束
                if ($info['type'] == 'png' || $info['type'] == 'gif') {
                    imagealphablending($im, FALSE); //取消默认的混色模式
                    imagesavealpha($im, TRUE); //设定保存完整的 alpha 通道信息
                }
                Header("Content-type: " . $info['mime']);
                $ImageFun($im);
                @ImageDestroy($im);
                return;
            }

            //保存图像
            $ImageFun($sImage, $savename);
            imagedestroy($sImage);
            //获取或者创建图像文件失败则生成空白PNG图片
            $im = imagecreatetruecolor(80, 30);
            $bgc = imagecolorallocate($im, 255, 255, 255);
            $tc = imagecolorallocate($im, 0, 0, 0);
            imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
            imagestring($im, 4, 5, 5, "no pic", $tc);
            Image::output($im);
            return;
        }
    }

    /**
     * 生成缩略图
     * @param $image
     * @param $thumbname
     * @param string $type
     * @param bool $w
     * @param bool $h
     * @param bool $interlace
     * @param int $quality
     * @return bool
     */
    static function thumb($image, $thumbname, $type='', $w=false, $h=false, $interlace=true, $quality =80) {

        // 获取原图信息
        $info = XfImage::getImageInfo($image);

        $image_type = strtolower($info['type']);

        // 原始大小
        $s_w = $info['width'];
        $s_h = $info['height'];

        $type = empty($type) ? $info['type'] : $type;
        $type = strtolower($type);
        $interlace = $interlace ? 1 : 0;

        unset($info);

        if(!$w && !$h) return false;

        // 初始化
        $src_w = 0;
        $src_h = 0;
        $src_x = 0;
        $src_y = 0;

        if (($w && !$h) || (!$w && $h)) {

            // 等比例压缩
            $src_w = $s_w;
            $src_h = $s_h;

            if ($w && !$h)  { // 定宽

                if ($s_w<$w) {

                    if ($image!=$thumbname) {
                        @copy($image, $thumbname);
                    }

                    return $thumbname;
                }

                $_ratio = $w / $s_w ;

                $h = $s_h*$_ratio;

            } else {

                if ($s_h<$h) {

                    if ($image!=$thumbname) {
                        @copy($image, $thumbname);
                    }

                    return $thumbname;
                }

                $_ratio = $h / $s_h;

                $w = $s_w*$_ratio;
            }

        }  else {

            // 固定大小截取
            $resize_ratio = $w/$h;	//改变后的图象的比例

            $ratio = $s_w/$s_h;	//实际图象的比例

            if($resize_ratio == $ratio){//等比例

                $_ratio = $s_w/ $w;

                $src_w = $w*$_ratio;

                $src_h = $h*$_ratio;

            }elseif($resize_ratio > $ratio){//高度优先

                $_ratio = $s_w / $w;
                $src_w = $s_w;
                $src_h = $h * $_ratio;
                $src_y = ($s_h - $src_h) / 2;

            }elseif($resize_ratio < $ratio){//宽度优先
                $_ratio = $s_h / $h;
                $src_h = $s_h;
                $src_w = $w * $_ratio;
                $src_x = ($s_w - $src_w) / 2;
            }
        }

        // 选择创建函数
        $createFun = 'imagecreatefromjpeg';

        switch ($image_type) {
            case 'png': $createFun = 'imagecreatefrompng'; break;
            case 'jpg': $createFun = 'imagecreatefromjpeg'; break;
            case 'jpeg': $createFun = 'imagecreatefromjpeg'; break;
            case 'gif': $createFun = 'imagecreatefromgif'; break;
            case 'bmp': $createFun = 'imagecreatefromwbmp '; break;
        }

        // 载入原图
        if(!function_exists($createFun)) {
            return false;
        }

        $srcImg = $createFun($image);

        //创建缩略图
        if ($type != 'gif' && function_exists('imagecreatetruecolor')) {
            $thumbImg = imagecreatetruecolor($w, $h);
        } else {
            $thumbImg = imagecreate($w, $h);
        }

        //png和gif的透明处理
        if('png'==$type){

            imagealphablending($thumbImg, false);//取消默认的混色模式（为解决阴影为绿色的问题）
            imagesavealpha($thumbImg,true);//设定保存完整的 alpha 通道信息（为解决阴影为绿色的问题）

        }elseif('gif'==$type){

            /*$trnprt_indx = imagecolortransparent($srcImg);

            if ($trnprt_indx >= 0) {
                //its transparent
                $trnprt_color = imagecolorsforindex($srcImg , $trnprt_indx);
                $trnprt_indx = imagecolorallocate($thumbImg, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
                imagefill($thumbImg, 0, 0, $trnprt_indx);
                imagecolortransparent($thumbImg, $trnprt_indx);
            }*/
        }

        // 复制图片
        if (function_exists("ImageCopyResampled")) {
            imagecopyresampled($thumbImg, $srcImg, 0, 0, $src_x, $src_y, $w, $h, $src_w, $src_h);
        } else {
            imagecopyresized($thumbImg, $srcImg, 0, 0, $src_x, $src_y, $w, $h, $src_w, $src_h);
        }

        // 对jpeg图形设置隔行扫描
        if ('jpg' == $type || 'jpeg' == $type) {

            imageinterlace($thumbImg, $interlace);
        }

        // 生成图片
        $imageFun = 'image' . ($type == 'jpg' ? 'jpeg' : $type);

        if ($imageFun == 'imagejpeg') {
            $imageFun($thumbImg, $thumbname, $quality);
        }
        else{
            $imageFun($thumbImg, $thumbname);
        }

        imagedestroy($thumbImg);

        imagedestroy($srcImg);

        return $thumbname;
    }

    static function output($im, $type='png', $filename='') {
        header("Content-type: image/" . $type);
        $ImageFun = 'image' . $type;
        if (empty($filename)) {
            $ImageFun($im);
        } else {
            $ImageFun($im, $filename);
        }
        imagedestroy($im);
    }

}