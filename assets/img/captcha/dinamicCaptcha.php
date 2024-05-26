<?php
//iniciar una sesión
session_start();

require("dinamicText.php");
require("../../../../constants.php"); 

header("Content-type:image/jpeg");

$captchaWidth = 200;
$captchaHeight  = 50;
$img   = imagecreate($captchaWidth,$captchaHeight);

$grey  = imagecolorallocate($img, 200, 200, 200);
$green = imagecolorallocate($img, 0, 255, 0);
$red   = imagecolorallocate($img, 255, 0, 0);
$blue  = imagecolorallocate($img, 0, 0, 255);
$white = imagecolorallocate($img, 255, 255, 255);

$longCaptcha         = 5;
$textoCaptcha        = dinamycCaptchaText(CAPTCHA_CARACTERS, $longCaptcha);
$fontSizeCaptcha     = 30;
$positionLettersY    = 40;
$positionLettersX    = 30;
$_SESSION['captcha'] = $textoCaptcha;

$colorLetters = [
    $green,
    $red,
    $blue,
    $white,
];

$nLines = 5;

imagefill($img , 0, 0,$gris);

for ($i=0; $i < $longCaptcha; $i++) { 
    imagettftext($img, $fontSizeCaptcha, 0, $positionLettersX, $positionLettersY, $colorLetters[rand( 0, count($colorLetters)-1 )], "../../fonts/Roboto-Black.ttf", $textoCaptcha[$i]);
    $positionLettersX += 30;
}

for($i = 0;$i <= $nLines; $i++){
    $x1 = rand(0,$captchaWidth);
    $y1 = rand(0,$captchaHeight);
    $x2 = rand(0,$captchaWidth);
    $y2 = rand(0,$captchaHeight);

    imageline($img , $x1, $y1, $x2, $y2, $colorLetters[rand( 0, count($colorLetters)-1 )]);
}

imagejpeg($img);

imagedestroy($img);



