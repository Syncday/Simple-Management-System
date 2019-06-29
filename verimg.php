<?php
if(!isset($_SESSION)){
    session_start();
}
header("content-type:image/png");
$image_width=80;
$image_height=18;
$new_number=getRandomString(6,"0123456789ABCDEF");//生成验证码
$_SESSION['check_checks']=$new_number;
setcookie('checkCode',$_SESSION['check_checks']);//保存到cokie
$num_image=imagecreate($image_width,$image_height);
imagecolorallocate($num_image,255,255,255);
for($i=0;$i<strlen($_SESSION['check_checks']);$i++){
    $font=mt_rand(3,5);
    $x=mt_rand(1,8)+$image_width*$i/6;
    $y=mt_rand(1,$image_height/6);

    $color=imagecolorallocate($num_image,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
    imagestring($num_image,$font,$x,$y,$_SESSION['check_checks'][$i],$color);
}
imagepng($num_image);
imagedestroy($num_image);
function getRandomString($len, $chars=null)  
{
    if (is_null($chars)) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
    }
    mt_srand(10000000*(double)microtime());  
    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {  
        $str .= $chars[mt_rand(0, $lc)];  
    }  
    return $str;  
}
?>
