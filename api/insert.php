<?php 
require_once 'include.php';

// $output = [$_POST, $_FILES];
// return print_r($output);
// return print_r($_POST);
// return print_r($_FILES);

$arr=$_POST;
// return print_r($arr);
if(empty($arr['title'])){
	echo "请填写资料名";
	return;
}
if(!isset($_FILES['file'])){
	echo "请选择要上传的文件";
	return;
}

//upload the file
if($_FILES['file']['error']!=4){
	$uploadFile=uploadFile('file',$arr['fileName'],'../upload/files/');
	if($uploadFile&&is_array($uploadFile)){
		$arr['file']=$uploadFile[0]['name'];
	}else{
		echo "上传文件失败";
		return;
	}
}
//upload the img and create the thumb
if(isset($_FILES['img'])){
	if($_FILES['img']['error']!=4){
		$uploadFile=uploadFile('img',$arr['fileName'],'../upload/thumb/',array("jpg","jpeg","gif","png"),157286400);
		if($uploadFile&&is_array($uploadFile)){
			$arr['img']=$uploadFile[0]['name'];
			$src="../upload/thumb/".$arr['img'];
			$src=iconv("UTF-8","gb2312", $src);
			thumb($src,$src,150);
		}
	}
}else{
	$arr['img']='default.jpg';
}

unset($arr['fileName']);
$arr['date']=date('o-m-d H:i:s');

// return print_r($arr);

insert('hh_content',$arr);
print_r($arr);

