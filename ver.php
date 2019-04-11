<?php
session_start();
function verify_rand($length){
    $result = "";
    $string = "012356789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for ($i = 0 ; $i < $length ; $i++){
        if($i==0) $result .=$string[mt_rand(0 , strlen($string) - 1)];
		else $result .=$string[mt_rand(0 , strlen($string) - 1)];
    }
    return $result;
}
$zs=4;
$randcode=verify_rand($zs);
$_SESSION['verify_rand']=strtolower($randcode);
header ("content-type: image/png");
$image_x = 90;
$image_y = 35;
$image = imagecreate($image_x , $image_y);
$background_color = imagecolorallocate($image,mt_rand(100,255),200,mt_rand(100,255));
$font_color = imagecolorallocate($image,0x00,0x00,0x00);
$gray_color  = imagecolorallocate($image,0x00,0x00,0x00);
//fonts
$fonts=array('apple/Myriad Set Pro/MyriadSetPro-ThinItalic.ttf','ALGER.TTF','BOD_CR.TTF','BOD_CR.TTF');

for($i=0;$i<$zs;$i++){
	$array = array(-1,0,1);
	$p = array_rand($array);
	$an = $array[$p];
	imagettftext($image,20, $an, $i*mt_rand(10,20)+10,25, $font_color, "fonts/".$fonts[mt_rand(0,count($fonts)-1)],substr($randcode,$i,1) );
}

imagerectangle($image,0,0,$image_x-1, $image_y-1,$gray_color);


for($i=0;$i<60;$i++){
imagesetpixel($image,mt_rand(0,$image_x),mt_rand(0,$image_y),$gray_color);
}

imagepng($image);
imagedestroy($image);
?>