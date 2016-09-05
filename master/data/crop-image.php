<?php
ob_start();
session_start();

$imagemurl = ($_POST['urlimg']);

$x = abs($_POST['x']);
$y = abs($_POST['y']);

$w = abs($_POST['w']);
$h = abs($_POST['h']);

$tw = abs($_POST['tw']);
$th = abs($_POST['th']);

$caminho_img_recortada = '../../uploads/' . $imagemurl;

if(in_array(0, array($w, $h, $tw, $th)))
	exit("Invalid params");

$jpeg_quality = 90;

$src = '../../uploads/' . $imagemurl;
$img_r = imagecreatefromjpeg($src);
$dst_r = ImageCreateTrueColor( $tw, $th );

imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $tw, $th, $w, $h);

//header('Content-type: image/jpeg');
imagejpeg($dst_r, $caminho_img_recortada, $jpeg_quality);
$_SESSION['sucesso'] = "Imagem recortada com sucesso!";

ob_end_flush();