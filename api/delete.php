<?php 
require_once 'include.php';

$id=$_POST['id'];
$sql="select img,file from hh_content where id=$id";
$data=fetchOne($sql);
// return print_r($data);

if($data['img']!="default.jpg"){
	$img="../upload/thumb/".$data['img'];

	// return print_r($img);
	//iconv 转换字符，否则win10下无法找到文件名带有中文字符的文件
	$img=iconv("UTF-8","gb2312", $img);

	if(file_exists($img)){
		unlink($img);
	}
}

$file="../upload/files/".$data['file'];

// return print_r($file);
$file=iconv("UTF-8","gb2312", $file);

if(file_exists($file)){
	unlink($file);
}

delete('hh_content',"id=$id");