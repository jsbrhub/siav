<?php

session_start(); // inicial a sessao
 
$codigoCaptcha = substr(md5( time() ) ,0,6);
 
$_SESSION['captcha'] = $codigoCaptcha;
 
$imagemCaptcha = imagecreatefrompng("img/fundocaptch.png");
 
$fonteCaptcha = imageloadfont("img/anonymous.gdf");
 
$corCaptcha = imagecolorallocate($imagemCaptcha,255,0,0);
 
imagestring($imagemCaptcha,$fonteCaptcha,50,5,$codigoCaptcha,$corCaptcha);
 
header("Content-type: image/png");
 
imagepng($imagemCaptcha);
 
imagedestroy($imagemCaptcha);