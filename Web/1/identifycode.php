<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>验证码</title>
</head>
<?php
 header("Cache-Control:no-cache,must-revalidate");   //禁止缓存
 session_start();                                     //启用会话
 srand((double)microtime()*1000000);                  //初始化随机数发生器
 $chars="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";     //定义图像验证码中的字符
 $identifycode="";
 $identifycodes="";
 for ($i=0;$i<4;$i++)    
  {
	$rnum=rand(0,35);                            //产生0-35之间的随机数
	 $identifycode.=$chars[$rnum]."";           //生成图像验证码中的字符串
	  $identifycodes.=$chars[$rnum];            //生成会话中的验证码字符串
	 } 
	$_SESSION['identifycode']=$identifycodes;     //将数验证码存入会话
	$img =imagecreate(90,20) or die("创建图像失败");   //创建空白图像
	$red=imagecolorallocate($img,255,0,0);            
	$white=imagecolorallocate($img,255,255,255);
	$gray=imagecolorallocate($img,200,200,200);
	imagefill($img,0,0,$white);                      //用白色填充图像
	imagestring($img,5,2,3,$identifycode,$red);         //用红色绘制字符串
	for($i=0;$i<300;$i++)                                 //绘制干扰像素
	 {
		imagesetpixel($img,rand()%90,rand()%30,$gray);
	}	 
	header("Content-type:image/png");         //输出HTTP头
	imagepng($img);                            //输出图像
	imagedestroy($img);	                 //释放内存
	 
?>		 
		 
	  
 





<body>
</body>
</html>