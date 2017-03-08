<?php
$imgsrc = "2.jpg";
$imgdst = "test.jpg";
wusun($imgsrc, $imgdst);
function wusun($imgsrc, $imgdst){
	
	$percent = 1;  //图片压缩比
	list($width,$height,$type)=getimagesize($imgsrc);//获取原图尺寸
	//缩放尺寸
	$new_width = $width * $percent;
	$new_height = $height * $percent;

	switch($type){
		case 1:
			$giftype=check_gifcartoon($imgsrc); 
			if($giftype){ 
				$image_wp=imagecreatetruecolor($new_width, $new_height); 
				$image = imagecreatefromgif($imgsrc); 
				imagecopyresized($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
				imagejpeg($image_wp, $imgdst,75); 
				imagedestroy($image_wp); 
			} 

		break;
		case 2:
			$image_wp=imagecreatetruecolor($new_width, $new_height); 
			$image = imagecreatefromjpeg($imgsrc); 
			//imagecopyresampled
			imagecopyresized($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
			imagejpeg($image_wp, $imgdst,75); 
			imagedestroy($image_wp);
		break;
		case 3:
			$image_wp=imagecreatetruecolor($new_width, $new_height); 
			$image = imagecreatefrompng($imgsrc); 

			imagecopyresized($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height); 
			imagejpeg($image_wp, $imgdst,100); 
			imagedestroy($image_wp); 
		break;
	}
}


/** 
* desription 判断是否gif动画 
* @param sting $image_file图片路径 
* @return boolean t 是 f 否 
*/
function check_gifcartoon($image_file){ 
  $fp = fopen($image_file,'rb'); 
  $image_head = fread($fp,1024); 
  fclose($fp); 
  return preg_match("/".chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0'."/",$image_head)?false:true; 
}
?>