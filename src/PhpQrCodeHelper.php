<?php
namespace shengxiaoweimo\helper;
require_once dirname(__FILE__).'./phpqrcode/phpqrcode.php';

/**
 * PhpQrCodeHelper::createPng('http://www.baidu.com' , './img/test.png' , 1 , 0 , 0);
 * Class PhpQrCodeHelper
 */
class PhpQrCodeHelper
{
    /**
     * 生成png二维码
     * @param $text             二维码参数
     * @param bool $outfile     生成的图片存放路径
     * @param int $level        报错级别
     * @param int $size         图片大小
     * @param int $margin       空白边距
     * @param bool $saveandprint
     */
    public static function createPng($text , $outfile = false, $level = 1, $size = 3, $margin = 4, $saveandprint=false)
    {
       \QRcode::png($text , $outfile);
    }

    /**
     * 图片合并
     * @param $backgroundImagePath  背景图
     * @param $textImagePath        要合并图片
     * @return false|string
     */
    public static function opentow($backgroundImagePath , $textImagePath , $fileName){
        //创建图片的实例
        $backgroundImage = imagecreatefromstring(file_get_contents($backgroundImagePath));
        $textImage = imagecreatefromstring(file_get_contents($textImagePath));
        //获取水印图片的宽高
        $src_w =250;
        $src_h=250;
        //如果水印图片本身带透明色，则使用imagecopy方法
        imagecopy($backgroundImage, $textImage, 0,0, 0, 0, $src_w, $src_h);
        //输出图片

        ob_start();
        imagepng($backgroundImage);
        $string_data = ob_get_contents(); // read from buffer
        ob_end_clean(); // delete buffer

        file_put_contents($fileName , $string_data);
    }

    public static function qrcode($url , $filename , $avatar , $file){
        $errorCorrectionLevel = "Q"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "4"; // 点的大小：1到10 //生成图片大小
        $padding = 2;

        \QRcode::png($url, $filename, $errorCorrectionLevel, $matrixPointSize, $padding, '','#3fbfff');

        // 加上logo
        if ($avatar !== FALSE) {
            $QR = imagecreatefromstring(file_get_contents($filename));
            $logo = imagecreatefromstring(file_get_contents($avatar));
            $QR_width = imagesx($QR);//二维码图片宽度
            $QR_height = imagesy($QR);//二维码图片高度
            $logo_width = imagesx($logo);//logo图片宽度
            $logo_height = imagesy($logo);//logo图片高度
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            //重新组合图片并调整大小
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
                $logo_qr_height, $logo_width, $logo_height);

            ob_start();
            imagepng($QR);
            $string_data = ob_get_contents(); // read from buffer
            ob_end_clean(); // delete buffer

            //保存图片
            file_put_contents($file , $string_data);
        }
    }
}



